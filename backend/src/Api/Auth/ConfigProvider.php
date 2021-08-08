<?php

declare(strict_types=1);

namespace Api\Auth;

use Api\Auth\Routes\SignUpByEmail\SignUpByEmailRequestHandler;
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
        ]);

        return $configAggregator->getMergedConfig();
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [],
            'factories' => [],
        ];
    }

    protected function getRoutes(): array
    {
        return [
            [
                'name'       => 'api.auth.signup-by-email-request',
                'path'       => '/api/auth/signup-by-email-request[/]',
                'middleware' => [
                    SignUpByEmailRequestHandler::class
                ],
                'methods'    => ['POST'],
            ],
        ];
    }
}
