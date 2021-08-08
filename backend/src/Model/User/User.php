<?php

declare(strict_types=1);

namespace Model\User;


use Api\Auth\Service\PasswordHasher;
use Model\User\DTO\Role;
use Model\User\DTO\Status;
use Model\User\Embedded\Token;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Model\User\DTO\Email;

/**
 * @ORM\Entity
 * @ORM\Table(name="users")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", scale=11, options={"unsigned":true})
     * @ORM\GeneratedValue
     */
    private int $id;

    /** @ORM\Column(type="user_email", unique=true) */
    private Email $email;

    /**
     * @ORM\Column(type="string")
     */
    private string $passwordHash;

    /**
     * @ORM\Column(type="user_status")
     */
    private Status $status;

    /**
     * @ORM\Embedded(class="Model\User\Embedded\Token")
     */
    private ?Token $confirmToken = null;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;

    /**
     * @ORM\Column(type="user_role", length=16)
     */
    private Role $role;

    private function __construct(
        DateTimeImmutable $createdAt,
        Email $email,
        Status $status
    ) {
        $this->createdAt = $createdAt;
        $this->email = $email;
        $this->status = $status;
        $this->role = Role::default();
    }

    public static function createUserByEmail(
        Email $email,
        DateTimeImmutable $createdAt,
        string $passwordHash,
        Token $confirmToken
    ): self
    {
        $user = new self($createdAt, $email, Status::wait());
        $user->passwordHash = $passwordHash;
        $user->confirmToken = $confirmToken;

        return $user;

    }

    public function validatePassword(string $password, PasswordHasher $passwordHasher): bool
    {
        return $passwordHasher->validate($password, $this->passwordHash);
    }

    public function getRole(): Role
    {
        return $this->role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function isActive(): bool
    {
        return $this->status->isActive();
    }

}