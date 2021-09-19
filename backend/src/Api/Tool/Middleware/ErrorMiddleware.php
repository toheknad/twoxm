<?php

declare(strict_types=1);

namespace Api\Tool\Middleware;

use Throwable;
use Laminas\Diactoros\Response\JsonResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class ErrorMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {

        try {
            $response = $handler->handle($request);
        } catch (Throwable $e) {
            $code = $e->getCode();
            if (!$code) {
                $code = 400;
            }
            return new JsonResponse(
                [
                    $e->getMessage(),
                    $e->getFile(),
                    $e->getLine(),
                ],
                // $e->getCode(),
                $code,
                [],
                JSON_PRETTY_PRINT
            );
        }
        return $response;
    }

}
