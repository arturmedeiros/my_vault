<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\RoleService;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected User $user;
    protected Request $request;

    public function __construct(User $user, Request $request)
    {
        $this->user = $user;
        $this->request = $request;
    }

    public function index(): JsonResponse
    {
        // Apenas admin pode vizualisar todos os usuários.
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if($isAdmin) {
            $users = $this->user
                ->with(['roles'])
                ->orderBy('id', 'DESC')
                ->paginate(10);

            $usersDataFormatted = [];
            foreach ($users->items() as $user) {
                $user->roles = (new RoleService())->rolesFormatted($user->roles);
                $usersDataFormatted[] = $user;
            }

            // Insere novo valor para a chave "data" (com as permissões do usuário formatadas).
            $users->appends('data', $usersDataFormatted);
        } else {
            // Usuários vêem apenas as próprias informações.
            $users = $this->user
                ->with(['roles'])
                ->where('uuid', '=', auth()->user()['uuid'])
                ->first();
            // Formata as permissões do usuário.
            $users->roles = (new RoleService())->rolesFormatted($users->roles);
        }

        return response()->json($users);
    }

    public function store(): JsonResponse
    {
        try {
            $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
            if(!$isAdmin) {
                return response()->json(['error' => 'Você não tem permissão para executar essa ação.'], 401);
            }

            $data = $this->request->all();

            if ($this->request->has('password') && $this->request->input('password')) {
                $data['password'] = bcrypt($this->request->input('password'));
            } else {
                return response()->json([
                    'success' => false,
                    'error' => 'Password is required.'
                ], 400);
            }

            if (!$this->request->has('email') && !$this->request->input('email')) {
                return response()->json([
                    'success' => false,
                    'error' => 'Email is required.'
                ], 400);
            }

            $user = $this->user->create($data);

            return response()->json($user, 201); // 201 Created status code.
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => 'Server error: '. $exception->getMessage()
            ], 500);
        }
    }

    public function show($key): JsonResponse
    {
        if (!$key && empty($this->request->input('key'))) {
            return response()->json([
                'success' => false,
                'error' => 'User Key is required.'
            ], 400);
        }

        $key = !$key && $this->request->input('key') ? $this->request->input('key') : $key;

        $user = $this->user
            ->with(['roles'])
            ->where('uuid', '=', $key)
            ->first();

        // Formata as permissões do usuário.
        $user->roles = (new RoleService())->rolesFormatted($user->roles);

        if (!isset($user)) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        return response()->json($user);
    }

    public function update(): JsonResponse
    {
        if (empty($this->request->input('key'))) {
            return response()->json([
                'success' => false,
                'error' => 'User Key is required.'
            ], 400);
        }

        $key = $this->request->input('key');

        // Apenas admin pode editar outros usuários.
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin && auth()->user()['uuid'] !== $key) {
            return response()->json(['error' => 'Você não tem permissão para executar essa ação.'], 401);
        }

        $user = $this->user
            ->with(['roles'])
            ->where('uuid', '=', $key)
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Usuário não encontrado'], 404);
        }

        $modelAttributes = array_keys($user->getAttributes());
        $data = $this->request->only($modelAttributes);

        if ($this->request->has('password') && $this->request->input('password')) {
            $data['password'] = bcrypt($this->request->input('password'));
        }

        $user->update($data);

        // Formata as permissões do usuário.
        $user->roles = (new RoleService())->rolesFormatted($user->roles);

        return response()->json($user);
    }

    public function destroy(): JsonResponse
    {
        if (empty($this->request->input('key'))) {
            return response()->json([
                'success' => false,
                'error' => 'User Key is required.'
            ], 400);
        }

        $key = $this->request->input('key');

        if(auth()->user()['uuid'] === $key) {
            return response()->json([
                'error' => 'Você não pode remover o próprio usuário. Entre em contato com o administrador.'
            ], 401);
        }

        // Apenas admin pode remover outros usuários.
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json(['error' => 'Você não tem permissão para executar essa ação.'], 401);
        }

        if (!$this->user->where('uuid', '=', $key)->delete()) {
            return response()->json(['error' => 'Usuário não encontrado.'], 404);
        }

        return response()->json(null, 204);
    }
}
