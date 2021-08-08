<?php

declare(strict_types=1);

namespace Api\Tool\Middleware;

use DomainException;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class DomainExceptionMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (DomainException $exception) {
            return new JsonResponse([
                'message' => $exception->getMessage(),
            ],
                409,
                [],
                JSON_PRETTY_PRINT
            );
        }
    }
}
