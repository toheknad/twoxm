<?php

declare(strict_types=1);

namespace Model\Word\Repository;

use Model\User\User;
use Model\User\DTO\Email;
use Model\Word\Word;

interface WordRepositoryInterface
{
    public function get(int $id): Word;

    public function add(Word $word): void;

    public function remove(Word $word): void;

}
