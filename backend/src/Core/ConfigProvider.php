<?php

declare(strict_types=1);

namespace Core;

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
                FlusherInterface::class       => Flusher::class,
                DbTransactionInterface::class => DbTransaction::class,
            ],
            'factories' => [
            ],
        ];
    }
}

