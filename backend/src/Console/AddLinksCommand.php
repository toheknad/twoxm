<?php
declare(strict_types=1);

namespace Console;

use Console\Tools\RabbitMQ\Consumer;
use Console\Tools\RabbitMQ\ParserConsumer;
use Console\Tools\RabbitMQ\Producer;
use Core\FlusherInterface;
use DoctrineProxies\__CG__\Link\Model\Entity\Link;
use GuzzleHttp\Client;
use Laminas\Diactoros\Response\JsonResponse;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use Model\User\Repository\UserRepository;
use Model\Word\Repository\WordRepository;
use Model\Word\Word;
use ProductLink\Model\Entity\ProductLink;
use ProductLink\Model\Repository\ProductLinkRepositoryInterface;
use Site\Model\Entity\Site;
use Site\Model\Repository\SiteRepositoryInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Telegram\Tools\MessagesHandleTool;

class AddLinksCommand extends Command
{
    public const NAME = 'telegram:send-notification';
    /**
     * @var FlusherInterface
     */
    private FlusherInterface $flusher;
    /**
     * @var Telegram
     */
    private Telegram $telegram;
    /**
     * @var MessagesHandleTool
     */
    private MessagesHandleTool $messagesHandleTool;
    /**
     * @var WordRepository
     */
    private WordRepository $wordRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;
    private ?string $name;

    public function __construct(FlusherInterface $flusher,
                                Telegram $telegram,
                                MessagesHandleTool $messagesHandleTool,
                                WordRepository $wordRepository,
                                UserRepository $userRepository,
                                string $name = null
    )
    {
        parent::__construct($name);
        $this->flusher = $flusher;
        $this->telegram = $telegram;
        $this->messagesHandleTool = $messagesHandleTool;
        $this->wordRepository = $wordRepository;
        $this->userRepository = $userRepository;
        $this->name = $name;
    }

    protected function configure()
    {
        $this->setName(self::NAME);
        $this->setDescription('Test console command.');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            $words = $this->wordRepository->getWordsReadyToRepeatForTelegram();
            foreach ($words as $user) {
                $text[] = "<b>TWOMX - учим слова</b>";
                $text[] = "У вас скопились неповторенные слова";
                $text[] = "<a href=\"http://www.localhost:8080/repeat/\">Перейти на сайт</a>";
                $text = implode(PHP_EOL, $text);

                $currentUserWords = $this->wordRepository->findByUser($user['id']);
                foreach ($currentUserWords as $word) {
                    /** @var Word $word */
                    $this->wordRepository->add($word->setTelegramNoticeTime(new \DateTimeImmutable()));
                }
                Request::sendMessage([
                    'chat_id' => $user['telegramChatId'],
                    'text'    => $text,
                    'parse_mode' => "HTML"
                ]);

            }
            $this->flusher->flush();
        }
        catch (\Exception $e) {
            return 400;
        }
        return 400;
    }
}