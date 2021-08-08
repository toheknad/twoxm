<?php

declare(strict_types=1);

namespace App\Model\User;


use App\Model\User\DTO\Role;
use App\Model\User\DTO\Status;
use App\Model\User\Embedded\Token;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use App\Model\User\DTO\Email;

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
     * @ORM\Embedded(class="App\Model\User\Embedded\Token")
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
        $this->role = Role::searcher();
    }

    public static function createUserByEmail(): self {

    }

}