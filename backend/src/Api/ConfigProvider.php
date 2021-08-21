<?php

declare(strict_types=1);

namespace Api;

use Api\Test\TestHandler;
use Api\Test\TestRouteForAdminHandler;
use Api\Test\TestRouteForUserHandler;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;

class ConfigProvider
{

    public function __invoke(): array
    {
        $config = new ArrayProvider([
            'dependencies' => $this->getDependencies(),
            'routes'       => $this->getRoutes(),
        ]);

        $configAggregator = new ConfigAggregator([
            $config,
            Auth\ConfigProvider::class,
            Memorization\ConfigProvider::class
        ]);

        return $configAggregator->getMergedConfig();
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [],
            'factories' => [

            ],
        ];
    }

    protected function getRoutes(): array
    {
        return [
            [
                'name'       => 'api.test-for-admin',
                'path'       => '/api/test-for-admin[/]',
                'middleware' => [
                    TestRouteForAdminHandler::class,
                ],
                'methods'    => ['GET'],
            ],
        ];
    }
}
