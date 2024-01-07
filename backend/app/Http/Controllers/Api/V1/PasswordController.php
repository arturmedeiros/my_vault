<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\CryptoService;
use App\Helpers\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Password;
use App\Models\RoleUser;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PasswordController extends Controller
{
    protected Request $request;
    protected Password $password;
    protected RoleUser $role_user;

    public function __construct(Password $password, RoleUser $role_user, Request $request)
    {
        $this->password = $password;
        $this->role_user = $role_user;
        $this->request = $request;
    }

    public function index(): JsonResponse
    {
        $userUuid = auth()->user()['uuid'];

        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if ($isAdmin) {
            $passwords = $this->password
                ->with(['roles', 'type'])
                ->orderBy('id', 'DESC')
                ->paginate(2);
        } else {
            if (empty(auth()->user()['roles'])) {
                return response()->json([]);
            }
            $passwords = $this->password
                ->join('role_users', 'passwords.user_key', '=', 'role_users.user_uuid')
                ->leftJoin('roles', 'roles.uuid', '=', 'role_users.role_uuid')
                ->leftJoin('users', 'users.uuid', '=', 'role_users.user_uuid')
                ->select('role_users.uuid', 'role_users.user_uuid', 'role_users.name', 'role_users.password_uuid', 'role_users.role_uuid', 'passwords.*')
                ->where('role_users.user_uuid', $userUuid)
                ->orderBy('passwords.id', 'DESC')
                ->paginate(10);
        }

        return response()->json($passwords);
    }

    public function store(FormRequest $request): JsonResponse
    {
        try {
            $data = $request->all();
            $data['user_key'] = auth()->user()['uuid'];

            if ($request->has('pass') && $request->input('pass')) {
                $data['pass'] = CryptoService::encryptPassword($data['pass'], HelperClass::getAppKey());
            }

            $password = $this->password->create($data);

            return response()->json($password, 201); // 201 Created status code.
        } catch (Exception $exception) {
            return response()->json([
                'success' => false,
                'error' => 'Server error: '. $exception->getMessage()
            ], 500);
        }
    }

    public function show($key): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);

        $password = $this->password
            ->with(['roles'])
            ->where('uuid', '=', $key)
            ->first();

        if (!isset($password)) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        if (!$isAdmin && !HelperClass::havePermission(auth()->user()['roles'], $password['roles'])) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        return response()->json($password);
    }

    public function update($key, FormRequest $request): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);

        $password = $this->password
            ->with(['roles'])
            ->where('uuid', '=', $key)
            ->first();
        if (!isset($password)) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        if (!$isAdmin && !HelperClass::havePermission(auth()->user()['roles'], $password['roles'])) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        $modelAttributes = array_keys($password->getAttributes());
        $data = $request->only($modelAttributes);

        if ($request->has('pass') && $request->input('pass')) {
            $data['pass'] = CryptoService::encryptPassword($data['pass'], HelperClass::getAppKey());
        }

        $password->update($data);

        return response()->json($password);
    }

    public function destroy($key): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        $password = $this->password
            ->where('uuid', '=', $key)
            ->first();

        if (!isset($password)) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        if (!$isAdmin && !HelperClass::havePermission(auth()->user()['roles'], $password['roles'])) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        if (!$this->password->where('uuid', '=', $key)->delete()) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        return response()->json(null, 204);
    }
}
