<?php

declare(strict_types=1);

namespace Model\User\DTO;

use Webmozart\Assert\Assert;

class Role
{
    public const ADMIN    = 'admin';
    public const DEFAULT = 'default';

    private string $value;

    public function __construct(string $value)
    {
        Assert::oneOf($value, [
            self::DEFAULT,
            self::ADMIN,
        ]);

        $this->value = $value;
    }

    public static function default(): self
    {
        return new self(self::DEFAULT);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
