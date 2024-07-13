<?php

namespace App\Helpers;

use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;
use Mockery\Exception;

class HelperClass
{
    public string $appVersion = '0.0.1';

    public function checkAPIStatus(): JsonResponse
    {
        return response()->json([
            'status_code' => 200,
            'success' => true,
            'api_version' => $this->appVersion,
        ]);
    }

    public function cryptoEncode($id): string
    {
        return base64_encode(base64_encode(base64_encode(base64_encode($id))));
    }

    public function cryptoDecode($key): string
    {
        return base64_decode(base64_decode(base64_decode(base64_decode($key))));
    }

    public function sanitizeString($str): string
    {
        $str = preg_replace('/[áàãâä]/', '', $str);
        $str = preg_replace('/[éèêë]/', '', $str);
        $str = preg_replace('/[íìîï]/', '', $str);
        $str = preg_replace('/[óòõôö]/', '', $str);
        $str = preg_replace('/[úùûü]/', '', $str);
        $str = preg_replace('/[ç]/', '', $str);
        $str = preg_replace('/[e]/', '', $str);
        $str = preg_replace('/[^a-z0-9]/', '', $str);

        return preg_replace('/[^0-9]/', '', $str);
    }

    public function saveImage(&$useModel, $keyObject, $requestObject, $fileDirectory): bool|string
    {
        if($useModel && $requestObject && $fileDirectory && str_starts_with($requestObject, "data:")) {
            $img = utf8_decode($requestObject);

            $arrContextOptions = [
                "ssl" => [
                    "verify_peer" => false,
                    "verify_peer_name" => false,
                ],
            ];

            $file = file_get_contents($img, false, stream_context_create($arrContextOptions));

            if (str_starts_with($img, "data:")) {
                $extension = explode('/', explode(':', substr($img, 0, strpos($img, ';')))[1])[1];
            } else {
                $extension = pathinfo(parse_url($img, PHP_URL_PATH), PATHINFO_EXTENSION);
            }

            if ($useModel->uuid) {
                $filename = "$useModel->uuid.$extension";
            } else {
                $hash = md5(uniqid(rand(), true));
                $filename = "$hash.$extension";
            }

            if (Storage::disk('public')->exists("{$fileDirectory}/{$filename}")) {
                Storage::disk('public')->delete("{$fileDirectory}/{$filename}");
            }

            Storage::disk('public')->put("{$fileDirectory}/{$filename}", $file);

            return $useModel[$keyObject] = $filename;
        }

        return false;
    }

    public function setRolePermissions($read = null, $create = null, $edit = null, $delete = null): array
    {
        $perm_read   = !empty($read)   ? 1 : 0;
        $perm_create = !empty($create) ? 1 : 0;
        $perm_edit   = !empty($edit)   ? 1 : 0;
        $perm_delete = !empty($delete) ? 1 : 0;

        return [
            'read'   => $perm_read,
            'create' => $perm_create,
            'edit'   => $perm_edit,
            'delete' => $perm_delete,
        ];
    }

    public function setIcon($icon = null): string|array
    {
        return !empty($icon) ? $icon : 'lock';
    }

    public static function getRoleAdmin()
    {
        // Busca a primeira função criada (Administrador)
        $role = new Role();
        $roleAdmin = $role->first();

        return $roleAdmin['uuid'];
    }

    public static function isAdmin($roles = []): bool
    {
        if (empty($roles)) {
            return false;
        }

        $roleAdmin = HelperClass::getRoleAdmin();
        foreach ($roles as $role) {
            if ($role['role_uuid'] == $roleAdmin) {
                return true;
            }
        }

        return false;
    }

    public static function havePermission($rolesUser = [], $rolesEntity = []): bool
    {
        if (isset($rolesUser) || isset($rolesEntity)) {
            return false;
        }

        try {
            // Verifica se há interseção entre os dois arrays
            $intersection = array_intersect($rolesUser, $rolesEntity);

            $response = !empty($intersection);
        } catch (Exception $exception) {
            $response = false;
        }

        return $response;
    }

    public static function getAppKey(): bool|string
    {
        $path = 'application/key.json';

        if (!Storage::disk('db')->exists($path)) {
            if (!HelperClass::setAppKey()) {
                return false;
            }
        }

        return CryptoService::decryptAppKey(Storage::disk('db')->get($path)) ?? false;
    }

    public static function setAppKey(): bool
    {
        $path = 'application/key.json';
        $encryptionKey = CryptoService::encryptAppKey(CryptoService::generateEncryptionKey());

        if (!Storage::disk('db')->exists($path)) {
            if (!Storage::disk('db')->put($path, $encryptionKey)) {
                return false;
            }
        }

        return true;
    }

    public static function verificarNivelSegurancaSenha($senha) {
        // Comprimento mínimo da senha
        $comprimentoMinimo = 8;

        // Pontuação inicial
        $pontuacao = 0;

        // Verificar comprimento mínimo
        if (strlen($senha) >= $comprimentoMinimo) {
            $pontuacao++;

            // Verificar caracteres especiais
            if (preg_match('/[!@#$%^&*(),.?":{}|<>]/', $senha)) {
                $pontuacao++;
            }

            // Verificar letras maiúsculas
            if (preg_match('/[A-Z]/', $senha)) {
                $pontuacao++;
            }

            // Verificar letras minúsculas
            if (preg_match('/[a-z]/', $senha)) {
                $pontuacao++;
            }

            // Verificar números
            if (preg_match('/[0-9]/', $senha)) {
                $pontuacao++;
            }
        }

        // Definir nível de segurança
        if ($pontuacao >= 4) {
            return 3;
        } elseif ($pontuacao >= 2) {
            return 2;
        } else {
            return 1;
        }
    }
}
