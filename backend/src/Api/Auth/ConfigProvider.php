<?php

declare(strict_types=1);

namespace Api\Auth;

use Api\Auth\Routes\Login\LoginHandler;
use Api\Auth\Routes\SignUpByEmail\SignUpByEmailRequestHandler;
use Api\Auth\Service\JWT\JWTTokenEncoder;
use Api\Auth\Service\JWT\JWTTokenEncoderFactory;
use Api\Auth\Service\Tokenizer\Tokenizer;
use Api\Auth\Service\Tokenizer\TokenizerFactory;
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
            'factories' => [
                Tokenizer::class => TokenizerFactory::class,
                JWTTokenEncoder::class => JWTTokenEncoderFactory::class
            ],
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
            [
                'name'       => 'api.auth.login',
                'path'       => '/api/auth/login[/]',
                'middleware' => [
                    LoginHandler::class
                ],
                'methods'    => ['POST'],
            ],
        ];
    }
}
