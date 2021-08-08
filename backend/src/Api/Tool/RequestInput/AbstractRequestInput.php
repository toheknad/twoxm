<?php

declare(strict_types=1);

namespace Api\Tool\RequestInput;

use ReflectionProperty;

abstract class AbstractRequestInput
{
    public function isInitialized(string $propertyName): bool
    {
        $property = new ReflectionProperty(static::class, $propertyName);

        return $property->isInitialized($this);
    }
}