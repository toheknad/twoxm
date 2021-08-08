<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Client\ClientInterface;
use Psr\Container\ContainerInterface;

return [
    'dependencies' => [
        'factories' => [
            ClientInterface::class => function (ContainerInterface $container): ClientInterface {

                return new Client(
                    [
                        RequestOptions::TIMEOUT => 0,
                    ]
                );
            },
        ],
    ],

];
