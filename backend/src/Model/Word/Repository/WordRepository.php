<?php


namespace Model\Word\Repository;


use Api\Auth\Service\PasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;
use Model\Word\DTO\Status;
use Model\Word\Word;

class WordRepository implements WordRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public const METHOD_TWO_DAYS = [
        1 => '20',
        2 => '480',
        3 => '1440'
    ];
    public const METHOD_SLOW = [
        1 => '30',
        2 => '1440',
        3 => '20160',
        4 => '86400'
    ];

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        /** @var EntityRepository $userRepository */
        $userRepository = $entityManager->getRepository(Word::class);

        $this->repository = $userRepository;
    }

    public function get(int $id): Word
    {
        if (!$word = $this->repository->find($id)) {
            throw new DomainException('Word is not found.');
        }

        /** @var Word $word */
        return $word;
    }

    public function add(Word $word): void
    {
        $this->entityManager->persist($word);
    }

    public function remove(Word $word): void
    {
        $this->entityManager->remove($word);
    }

    public function getCountWordsReadyToRepeat(int $userId): array
    {
        $now = (new \DateTime())->format('Y-m-d H:i');
        $stageOne = $this->repository->createQueryBuilder('w')
                ->select('COUNT(w.id)')
                ->andWhere('w.timeRepeat < :now')
                ->andWhere('w.user = :user')
                ->andWhere("w.status = 'active'")
                ->setParameter(':user', $userId)
                ->setParameter(':now', $now)
                ->getQuery()->getSingleScalarResult();

        return [
            'count' => $stageOne
        ];
    }

    public function getUserStatistic(int $userId): array
    {
        $countAllWords = $this->repository->createQueryBuilder('w')
            ->select('COUNT(w.id)')
            ->andWhere('w.user = :user')
            ->setParameter(':user', $userId)
            ->getQuery()->getSingleScalarResult();

        $countLearnedWords = $this->repository->createQueryBuilder('w')
            ->select('COUNT(w.id)')
            ->andWhere('w.user = :user')
            ->andWhere("w.status = 'learned'")
            ->setParameter(':user', $userId)
            ->getQuery()->getSingleScalarResult();

        return [
            'all'       => $countAllWords,
            'learned'   => $countLearnedWords
        ];
    }

    public function getPlaceInTop(int $userId): array
    {
        $now = (new \DateTime())->format('Y-m-d H:i');
        $count = $this->repository->createQueryBuilder('w')
            ->select('COUNT(w.id)')
            ->andWhere('w.user = :user')
            ->setParameter(':user', $userId)
            ->getQuery()->getSingleScalarResult();

        return [
            'count' => $count
        ];
    }

    public function getWordsReadyToRepeat(int $userId): array
    {
        $now = (new \DateTime())->format('Y-m-d H:i');
        $stageOne = $this->repository->createQueryBuilder('w')
            ->select('w.id, w.word, w.translate')
            ->andWhere('w.timeRepeat < :now')
            ->andWhere('w.user = :user')
            ->andWhere("w.status = 'active'")
            ->setParameter(':user', $userId)
            ->setParameter(':now', $now)
            ->getQuery()->getResult();

        return $stageOne;
    }
}