<?php

declare(strict_types=1);

namespace Model\Word;


use Doctrine\Common\Collections\ArrayCollection;
use Model\User\Repository\UserRepository;
use Model\Word\DTO\Status;
use DateTimeImmutable;
use Doctrine\ORM\Mapping as ORM;
use Model\User\User;
use Model\Word\Repository\WordRepository;

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
     * @ORM\Column(type="string")
     */
    private string $translate;

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

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private DateTimeImmutable $timeRepeat;

    /**
     * @ORM\Column(type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $telegramNoticeTime = null;


    public function __construct($word, User $user, $method, $createdAt, $timeRepeat, $stage, $translate) {
        $this->word         = $word;
        $this->createdAt    = $createdAt;
        $this->user         = $user;
        $this->method       = $method;
        $this->stage        = $stage;
        $this->status       = Status::active();
        $this->timeRepeat   = $timeRepeat;
        $this->translate    = $translate;
    }


    public function getUser(): User
    {
        return $this->user;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getStage(): int
    {
        return $this->stage;
    }

    public function getMethod(): int
    {
        return $this->method;
    }

    public function setStage(int $stage): Word
    {
        $this->stage = $stage;
        return $this;
    }

    public function changeTimeRepeat(): Word
    {
        /** @var \DateTimeImmutable $createdAt */
        $createdAt =  (new DateTimeImmutable())->format('Y-m-d H:i');

        if ($this->method == 1) {
            $time = WordRepository::METHOD_TWO_DAYS[$this->stage];
        } else if ($this->method == 2) {
            $time = WordRepository::METHOD_SLOW[$this->stage];
        }
        $interval = (new \DateInterval("PT{$time}M"));
        $newTimeRepeat =  (new \DateTimeImmutable($createdAt))->add($interval);

        $this->timeRepeat = $newTimeRepeat;

        return $this;
    }

    public function setStatus(Status $status): Word
    {
        $this->status = $status;
        return $this;
    }

    public function setTelegramNoticeTime(?DateTimeImmutable $time): Word
    {
        $this->telegramNoticeTime = $time;
        return $this;
    }

}