<?php

declare(strict_types=1);

namespace App\Model\User\DTO;

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

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

}