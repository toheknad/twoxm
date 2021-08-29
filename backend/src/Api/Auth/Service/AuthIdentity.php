<?php

declare(strict_types=1);

namespace Api\Auth\Service;


use Model\User\DTO\Role;

class AuthIdentity
{
    private int $id;
    private Role $role;
    private bool $active;

    public function __construct(
        int $id,
        Role $role,
        bool $active
    ) {
        $this->id = $id;
        $this->role = $role;
        $this->active = $active;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function setRole(Role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function isActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): self
    {
        $this->active = $active;

        return $this;
    }

}

