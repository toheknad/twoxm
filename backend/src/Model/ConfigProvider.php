<?php

declare(strict_types=1);

namespace Model;

use App\Auth\User\Service\Tokenizer\Tokenizer;
use App\Auth\User\Service\Tokenizer\TokenizerFactory;
use Model\User\Repository\WordRepository;
use Model\User\Repository\UserRepositoryInterface;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;

class ConfigProvider
{

    public function __invoke(): array
    {
        $config = new ArrayProvider([
            'dependencies' => $this->getDependencies(),
        ]);

        $configAggregator = new ConfigAggregator([
            $config,
        ]);

        return $configAggregator->getMergedConfig();
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [
                UserRepositoryInterface::class => WordRepository::class
            ],
            'factories' => [
                Tokenizer::class => TokenizerFactory::class
            ],
        ];
    }
}
