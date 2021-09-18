<?php

declare(strict_types=1);

namespace Api\Memorization;

use Api\Auth\Routes\SignUpByEmail\SignUpByEmailRequestHandler;
use Api\Auth\Service\JWT\JWTTokenEncoder;
use Api\Auth\Service\JWT\JWTTokenEncoderFactory;
use Api\Auth\Service\Tokenizer\Tokenizer;
use Api\Auth\Service\Tokenizer\TokenizerFactory;
use Api\Memorization\Routes\Repeat\Save\SaveWordAsRepeatedHandler;
use Api\Memorization\Routes\Repeat\WordsReadyCountHandler;
use Api\Memorization\Routes\Repeat\WordsReadyHandler;
use Api\Memorization\Routes\Statistic\WordsCountHandler;
use Api\Memorization\Routes\Statistic\WordsLearnedCountHandler;
use Api\Memorization\Routes\Words\WordsSaveHandler;
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
                'name'       => 'api.words.save',
                'path'       => '/api/words/save[/]',
                'middleware' => [
                    WordsSaveHandler::class
                ],
                'methods'    => ['POST'],
            ],
            [
                'name'       => 'api.repeat.get-count-ready-words',
                'path'       => '/api/repeat/get-count-ready-words[/]',
                'middleware' => [
                    WordsReadyCountHandler::class
                ],
                'methods'    => ['POST'],
            ],
            [
                'name'       => 'api.repeat.get-ready-words',
                'path'       => '/api/repeat/get-ready-words[/]',
                'middleware' => [
                    WordsReadyHandler::class
                ],
                'methods'    => ['POST'],
            ],
            [
                'name'       => 'api.repeat.save-word-as-repeated',
                'path'       => '/api/repeat/save-word-as-repeated[/]',
                'middleware' => [
                    SaveWordAsRepeatedHandler::class
                ],
                'methods'    => ['POST'],
            ],
            [
                'name'       => 'api.statistic.get-words-count',
                'path'       => '/api/statistic/get-words-count[/]',
                'middleware' => [
                    WordsCountHandler::class
                ],
                'methods'    => ['POST'],
            ],
            [
                'name'       => 'api.statistic.get-words-learned-count',
                'path'       => '/api/statistic/get-words-learned-count[/]',
                'middleware' => [
                    WordsLearnedCountHandler::class
                ],
                'methods'    => ['POST'],
            ],
        ];
    }
}
