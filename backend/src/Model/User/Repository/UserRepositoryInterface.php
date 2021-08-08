<?php

declare(strict_types=1);

namespace Model\User\Repository;

use Model\User\User;
use Model\User\DTO\Email;

interface UserRepositoryInterface
{
    public function hasByEmail(Email $email): bool;

    public function get(int $id): User;

    public function add(User $user): void;

    public function remove(User $user): void;

}
