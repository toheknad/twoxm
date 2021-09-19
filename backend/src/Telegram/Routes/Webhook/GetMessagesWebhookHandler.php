<?php

declare(strict_types=1);

namespace Telegram\Routes\Webhook;

use Core\FlusherInterface;
use DateTime;
use Longman\TelegramBot\ChatAction;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Request;
use Longman\TelegramBot\Telegram;
use PHPUnit\Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Telegram\Tools\MessagesHandleTool;


class GetMessagesWebhookHandler implements RequestHandlerInterface
{
    private FlusherInterface $flusher;
    private Telegram $telegram;
    private MessagesHandleTool $messagesHandleTool;

    public function __construct(FlusherInterface $flusher,
                                Telegram $telegram,
                                MessagesHandleTool $messagesHandleTool

    )
    {
        $this->telegram = $telegram;
        $this->messagesHandleTool = $messagesHandleTool;
        $this->flusher = $flusher;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = file_get_contents('php://input');

        $data = json_decode($data, true);
        $this->messagesHandleTool->start($data);

        return (new JsonResponse("Ok!", 200, [], JSON_PRETTY_PRINT));
    }
}
