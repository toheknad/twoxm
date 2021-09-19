<?php

declare(strict_types=1);

namespace Api\Tool\Middleware;

use Laminas\Diactoros\Response\EmptyResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware implements MiddlewareInterface
{

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        if ($request->getMethod() == 'OPTIONS') {
            $response = new EmptyResponse(200);
        } else {
            $response = $handler->handle($request);
        }
        $accessControlAllowHeaders = $request->getHeader('Access-Control-Request-Headers');

        if (!$accessControlAllowHeaders) {
            $accessControlAllowHeaders = '';
        }

        return $response->withHeader('Access-Control-Allow-Methods', 'HEAD, GET, POST, PUT, PATCH, DELETE')
            ->withHeader('Access-Control-Allow-Headers', $accessControlAllowHeaders)
            ->withHeader('Access-Control-Allow-Credentials', 'true')
            ->withHeader('Access-Control-Allow-Origin', getenv("FRONTEND_URL"));
    }
}
