<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\PhpFileProvider;
use Laminas\ConfigAggregator\ConfigAggregator;

// To enable or disable caching, set the `ConfigAggregator::ENABLE_CACHE` boolean in
// `config/autoload/local.php`.
$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
    \Laminas\HttpHandlerRunner\ConfigProvider::class,
    Api\ConfigProvider::class,
    Console\ConfigProvider::class,
    \Model\ConfigProvider::class,
    Core\ConfigProvider::class,
    ExternalService\ConfigProvider::class,

    /** <System configs> */
    // \Mezzio\Twig\ConfigProvider::class,  // ??????????????????????????????????????????
    \Mezzio\Router\FastRouteRouter\ConfigProvider::class,
    new ArrayProvider($cacheConfig),
    \Mezzio\Helper\ConfigProvider::class,
    \Mezzio\ConfigProvider::class,
    \Mezzio\Router\ConfigProvider::class,
    \Laminas\Diactoros\ConfigProvider::class,
    /** </System configs> */

    new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*},{,*.}local}.php'),
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
