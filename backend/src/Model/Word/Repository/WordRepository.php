<?php


namespace Model\Word\Repository;


use Api\Auth\Service\PasswordHasher;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;
use Model\Word\Word;

class WordRepository implements WordRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    private const METHOD_TWO_DAYS = [
        1 => '20',
        2 => '480',
        3 => '1440'
    ];
    private const METHOD_SLOW = [
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

    public function getWordsReadyToRepeat(int $userId): array
    {
        $stageOne = $this->repository->createQueryBuilder('w')
                ->select('COUNT(w.id)')
                ->andWhere('w.stage = 0')
                ->andWhere('w.user = :user')
                ->setParameter(':user', $userId)
                ->getQuery()->getSingleScalarResult();

        return [
            'count' => $stageOne
        ];
    }
}