<?php

declare(strict_types=1);

namespace App\Shared\Application\Service;

class CryptService
{
    private const SECRET_IV = 'k;vwZaM{4M;7?4hE-AwkBgd*nw!F_x';
    private const SECRET_KEY = 'FV2$mZIK[+4rt?aZ:xYamCCq7hzx9i';

    public static function sha256(string $action, string $value): string
    {
        $output = '';
        $encrypt_method = 'AES-256-CBC';

        $key = hash('sha256', self::SECRET_KEY);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = mb_substr(hash('sha256', self::SECRET_IV), 0, 16);
        if ('encrypt' == $action) {
            $output = openssl_encrypt($value, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } elseif ('decrypt' == $action) {
            $output = openssl_decrypt(base64_decode($value, true), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}
