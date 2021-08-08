<?php

declare(strict_types=1);

use Doctrine\ORM\EntityManagerInterface;
use Laminas\ServiceManager\AbstractFactory\ReflectionBasedAbstractFactory;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Telegram;
use Psr\Container\ContainerInterface;

return [
    // Provides application-wide services.
    // We recommend using fully-qualified class names whenever possible as
    // service names.
    'dependencies' => [
        'factories' => [
            Telegram::class => function (ContainerInterface $container): Telegram {

                if(getenv('PROD') == 'true') {
                    $bot_api_key = getenv('TELEGRAM_TOKEN');
                    $bot_username = getenv('TELEGRAM_BOT_NAME');
                    return (new Telegram($bot_api_key, $bot_username))->useGetUpdatesWithoutDatabase();
                } else {
                    $bot_api_key = getenv('TELEGRAM_TOKEN_TEST');
                    $bot_username = getenv('TELEGRAM_BOT_NAME_TEST');
                    $telegram = new Telegram($bot_api_key, $bot_username);
                    return $telegram->useGetUpdatesWithoutDatabase();
                }
            },
        ],
    ],
];