<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\RoleUser;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleUserController extends Controller
{
    protected Request $request;
    protected RoleUser $role_user;

    public function __construct(RoleUser $role_user, Request $request)
    {
        $this->role_user = $role_user;
        $this->request = $request;
    }

    public function index(): JsonResponse
    {
        // Apenas admin pode vizualisar.
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }
        else {
            $roles_user = $this->role_user
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        return response()->json($roles_user);
    }

    public function store(FormRequest $request): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }
        else {
            $data = $request->all();
            $role_user = $this->role_user->create($data);
        }

        return response()->json($role_user, 201);
    }

    public function show($key): JsonResponse
    {
        $role_user = $this->role_user->where('uuid', '=', $key)->first();
        if (!isset($role_user)) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        return response()->json($role_user);
    }

    public function update($key, FormRequest $request): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        $role_user = $this->role_user->where('uuid', '=', $key)->first();

        if (!$role_user) {
            return response()->json([
                'error' => 'Registro não encontrado'
            ], 404);
        }

        $modelAttributes = array_keys($role_user->getAttributes());
        $data = $request->only($modelAttributes);

        $role_user->update($data);

        return response()->json($role_user);
    }

    public function destroy($key): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        if (!$this->role_user->where('uuid', '=', $key)->delete()) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        return response()->json(null, 204);
    }
}
