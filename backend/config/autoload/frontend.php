<?php

declare(strict_types=1);

use Frontend\FrontendUrlGenerator;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [

            FrontendUrlGenerator::class => function (ContainerInterface $container): FrontendUrlGenerator {

                $config = $container->get('config')['frontend'];

                return new FrontendUrlGenerator($config['url']);
            },
        ],
    ],

    'frontend' => [
        'url' => getenv('FRONTEND_URL'),
    ],
];
