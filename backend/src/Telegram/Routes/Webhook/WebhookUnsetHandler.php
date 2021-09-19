<?php

declare(strict_types=1);

namespace Telegram\Routes\Webhook;

use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WebhookUnsetHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        // Load composer
        $bot_api_key  = getenv('TELEGRAM_TOKEN');
        $bot_username = getenv('TELEGRAM_BOT_NAME');

        try {
            // Create Telegram API object
            $telegram = new Telegram($bot_api_key, $bot_username);

            $result = $telegram->deleteWebhook();
        } catch (TelegramException $e) {
            // log telegram errors
            return (new JsonResponse(
                $e->getMessage()
                ,
                200,
                [],
                JSON_PRETTY_PRINT
            ));
        }
        return (new JsonResponse(
           '321312'
            ,
            200,
            [],
            JSON_PRETTY_PRINT
        ));
    }

}
