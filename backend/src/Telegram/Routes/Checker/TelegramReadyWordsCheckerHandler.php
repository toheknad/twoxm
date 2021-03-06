<?php

declare(strict_types=1);

namespace Telegram\Routes\Checker;

use Core\FlusherInterface;
use DateTime;
use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use Model\User\Repository\UserRepository;
use Model\Word\Repository\WordRepository;
use Model\Word\Word;
use PHPUnit\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Telegram\Tools\MessagesHandleTool;


class TelegramReadyWordsCheckerHandler implements RequestHandlerInterface
{
    private FlusherInterface $flusher;
    private Telegram $telegram;
    private MessagesHandleTool $messagesHandleTool;
    /**
     * @var WordRepository
     */
    private WordRepository $wordRepository;
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    public function __construct(FlusherInterface $flusher,
                                Telegram $telegram,
                                MessagesHandleTool $messagesHandleTool,
                                WordRepository $wordRepository,
                                UserRepository $userRepository

    )
    {
        $this->telegram = $telegram;
        $this->messagesHandleTool = $messagesHandleTool;
        $this->flusher = $flusher;
        $this->wordRepository = $wordRepository;
        $this->userRepository = $userRepository;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        try {
            $words = $this->wordRepository->getWordsReadyToRepeatForTelegram();
            print_r($words);
            foreach ($words as $user) {
                $text[] = "<b>TWOMX - учим слова</b>";
                $text[] = "У вас скопились неповторенные слова";
                $text[] = "<a href=\"http://www.".getenv('FRONTEND_URL')."/repeat/\">Перейти на сайт</a>";
                $text = implode(PHP_EOL, $text);

                $currentUserWord = $this->wordRepository->get($user['word_id']);
                $this->wordRepository->add($currentUserWord->setTelegramNoticeTime(new \DateTimeImmutable()));

                Request::sendMessage([
                    'chat_id' => $user['telegramChatId'],
                    'text'    => $text,
                    'parse_mode' => "HTML"
                ]);

            }
            $this->flusher->flush();
        }
        catch (\Exception $e) {
            return new JsonResponse(
                [
                    'response' => $e->getMessage()
                ],
                401
            );
        }
        return new JsonResponse(
            [
                'token' => ''
            ],
            201
        );
    }
}
