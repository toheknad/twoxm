<?php

declare(strict_types=1);

namespace Api\Auth\Service\JWT;

use Interop\Container\ContainerInterface;

class JWTTokenDecoderFactory
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new JWTTokenDecoder(
            file_get_contents("/app/JWT/privateKey")
        );
    }
}

