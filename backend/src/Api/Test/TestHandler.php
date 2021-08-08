<?php

declare(strict_types=1);

namespace Api\Test;

use Api\Tool\Hydrator\RequestInputHydrator;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Searcher\Model\Entity\Searcher;
use Searcher\Model\Repository\SearcherFilter;
use Searcher\Model\Repository\SearcherRepositoryInterface;
use Searcher\Service\CoordinateService;

class TestHandler implements RequestHandlerInterface
{
    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        set_time_limit(180);

        return new JsonResponse(
            [
              '2131'
            ],
            200,
            [],
            JSON_PRETTY_PRINT

        );
    }

}
