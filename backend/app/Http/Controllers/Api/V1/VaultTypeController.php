<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\VaultType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VaultTypeController extends Controller
{
    protected Request $request;
    protected VaultType $vault_type;

    public function __construct(Request $request, VaultType $vault_type)
    {
        $this->request = $request;
        $this->vault_type = $vault_type;
    }

    public function index(): JsonResponse
    {
        $vault_types = $this->vault_type
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json($vault_types);
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
            $vault_type = $this->vault_type->create($data);
        }

        return response()->json($vault_type, 201);
    }

    public function show($key): JsonResponse
    {
        $vault_type = $this->vault_type->where('uuid', '=', $key)->first();
        if (!isset($role)) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        return response()->json($vault_type);
    }

    public function update($key, FormRequest $request): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        $vault_type = $this->vault_type->where('uuid', '=', $key)->first();

        if (!$vault_type) {
            return response()->json([
                'error' => 'Registro não encontrado'
            ], 404);
        }

        $modelAttributes = array_keys($vault_type->getAttributes());
        $data = $request->only($modelAttributes);

        $vault_type->update($data);

        return response()->json($vault_type);
    }

    public function destroy($key): JsonResponse
    {
        $isAdmin = HelperClass::isAdmin(auth()->user()['roles']);
        if(!$isAdmin) {
            return response()->json([
                'error' => 'Você não tem permissão para executar essa ação.'
            ], 401);
        }

        if (!$this->vault_type->where('uuid', '=', $key)->delete()) {
            return response()->json([
                'error' => 'Registro não encontrado.'
            ], 404);
        }

        return response()->json(null, 204);
    }
}
