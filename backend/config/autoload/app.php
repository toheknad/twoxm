<?php

declare(strict_types=1);

use Laminas\ConfigAggregator\ConfigAggregator;

return [
    'debug'                        => (bool)getenv("APP_DEBUG"),
    ConfigAggregator::ENABLE_CACHE => !((bool)getenv("APP_DEBUG")),
];