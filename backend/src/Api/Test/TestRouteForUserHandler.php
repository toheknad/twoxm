<?php

declare(strict_types=1);

namespace Api\Test;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class TestRouteForUserHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return (new JsonResponse(
            "Congrats your role is USER or HIGHER!"
            ,
            200,
            [],
            JSON_PRETTY_PRINT
        ));
    }

}
