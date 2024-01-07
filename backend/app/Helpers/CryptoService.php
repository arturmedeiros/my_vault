<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\Log;

class CryptoService
{
    private const ALGORITHM = 'AES-256-CBC';

    public static function generateEncryptionKey(): string
    {
        try {
            $key = random_bytes(16);
        } catch (Exception $exception) {
            $key = null;
            Log::error('Failed to generate encryption key.', [$exception->getMessage()]);
        }

        return $key;
    }

    private static function generateInitializationVector(): string
    {
        try {
            $iv = random_bytes(openssl_cipher_iv_length(self::ALGORITHM));
        } catch (Exception $exception) {
            $iv = null;
            Log::error('Failed to generate initialization vector.', [$exception->getMessage()]);
        }

        return $iv;
    }

    public static function encryptPassword($password, $encryptionKey): string
    {
        try {
            $iv = self::generateInitializationVector();
            $encrypted = openssl_encrypt($password, self::ALGORITHM, $encryptionKey, 0, $iv);
        } catch (Exception $exception) {
            $iv = null;
            $encrypted = null;
            Log::error('Failed to generate encrypted password.', [$exception->getMessage()]);
        }
        return base64_encode($iv . $encrypted);
    }

    public static function decryptPassword($encryptedPassword, $encryptionKey): bool|string
    {
        $data = base64_decode($encryptedPassword);
        $iv = substr($data, 0, openssl_cipher_iv_length(self::ALGORITHM));
        $encrypted = substr($data, openssl_cipher_iv_length(self::ALGORITHM));
        return openssl_decrypt($encrypted, self::ALGORITHM, $encryptionKey, 0, $iv);
    }

    public static function encryptAppKey($encryptionKey): string
    {
        return base64_encode(base64_encode($encryptionKey));
    }

    public static function decryptAppKey($encryptionKey): bool|string
    {
        return base64_decode(base64_decode($encryptionKey));
    }
}

