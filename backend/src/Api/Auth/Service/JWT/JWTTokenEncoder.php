<?php

declare(strict_types=1);

namespace Api\Auth\Service\JWT;

use Firebase\JWT\JWT;
use Model\User\User;

class JWTTokenEncoder
{
    private string $privateKey;
    private int $expirationTimeSeconds;

    public function __construct(
        string $privateKey,
        int $expirationTimeSeconds
    ) {
        $this->privateKey = $privateKey;
        $this->expirationTimeSeconds = $expirationTimeSeconds;
    }

    public function encode(User $user): string
    {
        $time = time();

        return $token = JWT::encode(
            [
                "iat"     => $time,
                "exp"     => $time + $this->expirationTimeSeconds,
                "user_id" => $user->getId(),
                "role"    => $user->getRole()->getValue(),
                "active"  => $user->isActive(),
            ],
            $this->privateKey
        );
    }

}
