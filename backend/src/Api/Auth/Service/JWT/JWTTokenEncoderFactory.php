<?php

declare(strict_types=1);

namespace Api\Auth\Service\JWT;

use Interop\Container\ContainerInterface;

class JWTTokenEncoderFactory
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new JWTTokenEncoder(
            file_get_contents("/app/JWT/privateKey"),
            (int)getenv('JWT_TOKEN_EXPIRE_IN_SECONDS')
        );
    }
}

