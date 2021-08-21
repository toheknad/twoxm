<?php

declare(strict_types=1);

namespace Model\Word\DTO;

use Webmozart\Assert\Assert;

class Status
{
    private const ACTIVE = 'active';
    private const LEARNED = 'learned';

    private string $value;

    public function __construct($value)
    {
        Assert::oneOf($value,[
            self::ACTIVE,
            self::LEARNED
        ]);
        $this->value = $value;
    }

    public static function active(): self
    {
        return new self(self::ACTIVE);
    }

    public static function learned(): self
    {
        return new self(self::LEARNED);
    }


    public function getValue(): string
    {
        return $this->value;
    }

}