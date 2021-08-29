<?php

declare(strict_types=1);

namespace Api\Tool\Middleware;

use Api\Auth\Service\AuthIdentity;
use Api\Auth\Service\JWT\JWTTokenDecoder;
use Exception;
use Model\User\DTO\Role;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

class AuthenticationMiddleware implements MiddlewareInterface
{
    private JWTTokenDecoder $tokenDecoder;

    public function __construct(
        JWTTokenDecoder $tokenDecoder
    ) {
        $this->tokenDecoder = $tokenDecoder;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $auth = $request->getHeader('Authorization');

        if (!empty($auth)) {
            $auth = explode(' ', $auth[0]);

            if (count($auth) === 2) {
                try {
                    $token = $this->tokenDecoder->decode($auth[1]);
                } catch (Exception $exception) {
                    throw new Exception('Invalid token provided: ' . $exception->getMessage(), 401);
                }

                $authIdentity = new AuthIdentity((int)$token['user_id'], new Role($token['role']), $token['active']);
                $request = $request->withAttribute(AuthIdentity::class, $authIdentity);
            }
        }

        return $handler->handle($request);
    }
}
