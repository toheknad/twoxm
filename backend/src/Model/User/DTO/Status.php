<?php

declare(strict_types=1);

namespace Model\User\DTO;

use Webmozart\Assert\Assert;

class Status
{
    private const WAIT = 'wait';
    private const ACTIVE = 'active';

    private string $value;

    public function __construct($value)
    {
        Assert::oneOf($value,[
            self::ACTIVE,
            self::WAIT
        ]);
        $this->value = $value;
    }

    public static function wait(): self
    {
        return new self(self::WAIT);
    }

    public function isActive(): bool
    {
        return $this->value === self::ACTIVE;
    }

    public function getValue(): string
    {
        return $this->value;
    }

}