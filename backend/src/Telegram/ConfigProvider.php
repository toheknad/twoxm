<?php

declare(strict_types=1);

namespace Telegram;


use Telegram\Routes\Checker\TelegramReadyWordsCheckerHandler;
use Telegram\Routes\Messages\GetMessagesHandler;
use Telegram\Routes\Webhook\GetMessagesWebhookHandler;
use Telegram\Routes\Webhook\WebhookSetHandler;
use Telegram\Routes\Webhook\WebhookUnsetHandler;
use Laminas\ConfigAggregator\ArrayProvider;
use Laminas\ConfigAggregator\ConfigAggregator;

class ConfigProvider
{

    public function __invoke(): array
    {
        $config = new ArrayProvider([
            'dependencies' => $this->getDependencies(),
            'routes'       => $this->getRoutes(),
        ]);

        $configAggregator = new ConfigAggregator([
            $config,
        ]);

        return $configAggregator->getMergedConfig();
    }

    public function getDependencies(): array
    {
        return [
            'aliases'   => [
            ],
            'factories' => [
            ],
        ];
    }

    protected function getRoutes(): array
    {
        return [
            [
                'name'       => 'telegram.webhook.set',
                'path'       => '/telegram/webhook/set[/]',
                'middleware' => [
                   WebhookSetHandler::class
                ],
                'methods'    => ['GET'],
            ],
            [
                'name'       => 'telegram.webhook.unset',
                'path'       => '/telegram/webhook/unset[/]',
                'middleware' => [
                    WebhookUnsetHandler::class
                ],
                'methods'    => ['GET'],
            ],
            [
                'name'       => 'telegram.webhook.get-messages',
                'path'       => '/telegram/webhook/get-messages[/]',
                'middleware' => [
                    GetMessagesWebhookHandler::class
                ],
                'methods'    => ['POST'],
            ],
            [
                'name'       => 'telegram.messages.get-messages',
                'path'       => '/telegram/messages/get-messages[/]',
                'middleware' => [
                    GetMessagesHandler::class
                ],
                'methods'    => ['GET'],
            ],
            [
                'name'       => 'telegram.checker.get-ready-words',
                'path'       => '/telegram/checker/get-ready-words[/]',
                'middleware' => [
                    TelegramReadyWordsCheckerHandler::class
                ],
                'methods'    => ['GET'],
            ],
        ];
    }
}

