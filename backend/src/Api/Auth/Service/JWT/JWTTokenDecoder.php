<?php

declare(strict_types=1);

namespace Api\Auth\Service\JWT;

use Firebase\JWT\JWT;

class JWTTokenDecoder
{
    private string $privateKey;

    public function __construct(string $privateKey)
    {
        $this->privateKey = $privateKey;
    }

    public function decode(string $token): array
    {
        return (array)JWT::decode($token, $this->privateKey, ['HS256']);
    }

}

