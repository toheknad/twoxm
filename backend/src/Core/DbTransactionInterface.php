<?php

declare(strict_types=1);

namespace Core;

interface DbTransactionInterface
{
    public function begin(): void;

    public function commit(): void;

    public function rollback(): void;
}

