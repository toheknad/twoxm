<?php

declare(strict_types=1);

namespace ExternalService;

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;
use Searcher\Model\Repository\SearcherRepository;
use Searcher\Model\Repository\SearcherRepositoryInterface;

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
                SearcherRepositoryInterface::class => SearcherRepository::class,
            ],
            'factories' => [

            ],
        ];
    }

}

