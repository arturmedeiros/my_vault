<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected Request $request;
    protected Role $role;

    public function __construct(Role $role, Request $request)
    {
        $this->role = $role;
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
            $roles = $this->role
                ->orderBy('id', 'DESC')
                ->paginate(10);
        }

        return response()->json($roles);
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
            $data['permissions'] = (new HelperClass())->setRolePermissions(true, false, false, false);
            $role = $this->role->create($data);
        }

        return response()->json($role, 201);
    }

    public function show($key): JsonResponse
    {
        $role = $this->role->where('uuid', '=', $key)->first();
        if (!isset($role)) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        return response()->json($role);
    }

    public function update($key, FormRequest $request): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        $role = $this->role->where('uuid', '=', $key)->first();

        if (!$role) {
            return response()->json([
                'error' => 'Registro não encontrado'
            ], 404);
        }

        $modelAttributes = array_keys($role->getAttributes());
        $data = $request->only($modelAttributes);

        $role->update($data);

        return response()->json($role);
    }

    public function destroy($key): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        if (!$this->role->where('uuid', '=', $key)->delete()) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        return response()->json(null, 204);
    }
}
