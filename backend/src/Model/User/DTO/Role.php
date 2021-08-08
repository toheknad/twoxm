<?php

declare(strict_types=1);

namespace App\Model\User\DTO;

use Webmozart\Assert\Assert;

class Role
{
    public const ADMIN    = 'admin';
    public const SEARCHER = 'searcher';

    private string $value;

    public function __construct(string $value)
    {
        Assert::oneOf($value, [
            self::SEARCHER,
            self::ADMIN,
        ]);

        $this->value = $value;
    }

    public static function searcher(): self
    {
        return new self(self::SEARCHER);
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
