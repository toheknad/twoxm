<?php
declare(strict_types=1);

namespace Console\Debug;

use Auth\Model\User\Entity\Email;
use Auth\Model\User\Entity\Token;
use Auth\Model\User\Entity\User;
use City\Model\Repository\CityFilter;
use Core\FlusherInterface;
use DateTimeImmutable;
use Doctrine\AbstractFilter;
use Ramsey\Uuid\Uuid;
use Searcher\Model\Entity\Coordinate;
use Searcher\Model\Entity\Gender;
use Searcher\Model\Entity\Geo;
use Searcher\Model\Entity\Searcher;
use Searcher\Model\Entity\StatusOneInfo;
use Symfony\Component\Console\Command\Command;
use City\Model\Repository\SiteRepositoryInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Auth\Model\User\Repository\UserRepositoryInterface;
use Searcher\Model\Repository\SearcherRepositoryInterface;

class GenerateRandomSearchersCommand extends Command
{
    public const NAME = 'debug:generate-random-searcehrs';

    private FlusherInterface $flusher;
    private UserRepositoryInterface $userRepository;
    private SiteRepositoryInterface $cityRepository;
    private SearcherRepositoryInterface $searcherRepository;

    public function __construct(
        FlusherInterface $flusher,
        UserRepositoryInterface $userRepository,
        SiteRepositoryInterface $cityRepository,
        SearcherRepositoryInterface $searcherRepository
    ) {
        parent::__construct();

        $this->flusher = $flusher;
        $this->userRepository = $userRepository;
        $this->cityRepository = $cityRepository;
        $this->searcherRepository = $searcherRepository;
    }

    protected function configure()
    {
        $this->setName(self::NAME);
        $this->setDescription('Generates given count random searchers.');
        $this->addArgument('count_to_generate', InputArgument::REQUIRED);
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $token = new Token(Uuid::uuid4()->toString(), new DateTimeImmutable('tomorrow'));

        $searcherCount = (int)$input->getArgument('count_to_generate');

        for ($i = 0; $i < $searcherCount; ++$i) {
            $city = $this->cityRepository->findAll(
                (new CityFilter())
                    ->setPageSize(1)
                    ->setOrderType(AbstractFilter::ORDER_TYPE_RAND)
            );

            $city = reset($city);

            $user = User::requestJoinByEmail(
                new DateTimeImmutable('now'),
                new Email(Uuid::uuid4()->toString() . "{$i}@test.com"),
                "hash",
                $token
            );

            $user->confirmJoin($token->getValue(), new DateTimeImmutable('yesterday'));

            $this->userRepository->add($user);
            $this->flusher->flush();

            $searcher = new Searcher(
                $user,
                "test{$i}",
                new Gender("male"),
                rand(15, 45),
                null,
            );

            $searcher->setStatusOneInfo(
                new StatusOneInfo(
                    $searcher,
                    $city,
                    new Geo(
                        new Coordinate(
                            rand(0, 899321605) / 10000000000,
                            rand(0, 899321605) / 10000000000,
                        ),
                        $i
                    )
                )
            );

            $this->searcherRepository->add($searcher);
            $this->flusher->flush();
        }

        return 1;
    }
}