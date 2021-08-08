<?php


namespace Model\User\Repository;


use Api\Auth\Service\PasswordHasher;
use Model\User\DTO\Email;
use Model\User\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

class UserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    private EntityRepository $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;

        /** @var EntityRepository $userRepository */
        $userRepository = $entityManager->getRepository(User::class);

        $this->repository = $userRepository;
    }

    public function hasByEmail(Email $email): bool
    {
        return $this->repository->createQueryBuilder('t')
                ->select('COUNT(t.id)')
                ->andWhere('t.email = :email')
                ->setParameter(':email', $email->getValue())
                ->getQuery()->getSingleScalarResult() > 0;
    }

    public function getByEmail(Email $email ): User
    {
        if (!$user = $this->repository->findOneBy(["email" => $email->getValue()])) {
            throw new DomainException("User isn't found");
        }
        /** @var User $user */
        return $user;
    }

    public function get(int $id): User
    {
        if (!$user = $this->repository->find($id)) {
            throw new DomainException('User is not found.');
        }

        /** @var User $user */
        return $user;
    }

    public function add(User $user): void
    {
        $this->entityManager->persist($user);
    }

    public function remove(User $user): void
    {
        $this->entityManager->remove($user);
    }
}