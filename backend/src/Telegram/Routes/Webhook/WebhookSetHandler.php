<?php

declare(strict_types=1);

namespace Telegram\Routes\Webhook;

use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Laminas\Diactoros\Response\JsonResponse;

class WebhookSetHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $bot_api_key  = getenv('TELEGRAM_TOKEN');
        $bot_username = getenv('TELEGRAM_BOT_NAME');
        $hook_url     = getenv('TELEGRAM_WEBHOOK_URL');

        try {
            // Create Telegram API object
            $telegram = new Telegram($bot_api_key, $bot_username);

            // Set webhook
            $result = $telegram->setWebhook($hook_url);
            if ($result->isOk()) {
                return (new JsonResponse(
                    $result->getDescription(),
                    200,
                    [],
                    JSON_PRETTY_PRINT
                ));
            }
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
