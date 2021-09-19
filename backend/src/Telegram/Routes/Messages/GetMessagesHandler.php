<?php

declare(strict_types=1);

namespace Telegram\Routes\Messages;

use Longman\TelegramBot\Telegram;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;
use Telegram\Tools\MessagesHandleTool;

class GetMessagesHandler implements RequestHandlerInterface
{
    private Telegram $telegram;
    private MessagesHandleTool $messagesHandleTool;

    public function __construct(Telegram $telegram, MessagesHandleTool $messagesHandleTool)
    {
        $this->telegram = $telegram;
        $this->messagesHandleTool = $messagesHandleTool;
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $messages = $this->telegram->handleGetUpdates()->getRawData();

        foreach ($messages['result'] as $message) {
            $this->messagesHandleTool->start($message);
        }

        return new JsonResponse(
            [
                'token' => 'test'
            ],
            201
        );
    }


}
