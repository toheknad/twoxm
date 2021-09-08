<?php

declare(strict_types=1);

namespace Model\Word;


use Doctrine\Common\Collections\ArrayCollection;
use Model\Word\DTO\Status;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Model\User\User;

/**
 * @ORM\Entity
 * @ORM\Table(name="words")
 */
class Word
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer", scale=11, options={"unsigned":true})
     * @ORM\GeneratedValue
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="Model\User\User",inversedBy="word")
     */
    private User $user;

    /**
     * @ORM\Column(type="string")
     */
    private string $word;

    /**
     * @ORM\Column(type="integer",  scale=10)
     */
    private int $method;

    /**
     * @ORM\Column(type="integer",  scale=10, options={"default": 0})
     */
    private int $stage = 0;

    /**
     * @ORM\Column(type="word_status", scale=10)
     */
    private Status $status;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $createdAt;


    public function __construct($word, User $user, $method, $createdAt) {
        $this->word = $word;
        $this->createdAt = $createdAt;
        $this->user = $user;
        $this->method = $method;
        $this->status = Status::active();

    }


    public function getUser(): User
    {
        return $this->user;
    }

    public function getId(): int
    {
        return $this->id;
    }

}