<?php


namespace Telegram\Tools;
use Api\Auth\Service\PasswordHasher;
use Core\FlusherInterface;
use Exception;
use Longman\TelegramBot\Entities\InlineKeyboard;
use Longman\TelegramBot\Entities\Keyboard;
use Longman\TelegramBot\Request;
use Model\User\DTO\Email;
use Model\User\Repository\UserRepository;

class MessagesHandleTool
{
    private FlusherInterface $flusher;
    private UserRepository $userRepository;
    private PasswordHasher $passwordHasher;

    public function __construct(FlusherInterface $flusher,
                                UserRepository $userRepository,
                                PasswordHasher $passwordHasher
    )
    {
        $this->flusher = $flusher;
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;
    }

    public function start(Array $message)
    {
        echo "<pre>";
        print_r($message);
        echo "</pre>";
        $userText = $message['message']['text'];
        $chatId = $message['message']['chat']['id'];
        $text = [];
        if ($userText == '/start') {
            $text[] = 'Привет!';
            $text[] = 'Я бот, который будет тебе напоминать, когда нужно повторять слова, которые ты учишь в TWOMX.';
            $text[] = 'Введите логин и пароль после комманды, например';
            $text[] = '/login my-account@google.com 12345678';

        } else if (strpos($userText,'/login') === 0 ) {
            $login = trim($userText);
            $login = explode(' ', $login);

            print_r($login);

            try {
                print_r('T2EST-----');
                $user = $this->userRepository->getByEmail(new Email($login[1]));
                print_r('11111111');
            } catch (Exception $e) {
                print_r($e->getMessage());
                $text[] = 'Упс! Аккаунта с такой почтой не существует';
            }

            if ($user && !$user->validatePassword($login[2], $this->passwordHasher)) {
                $text[] = 'Упс! Вы ввели неправильный пароль.';
                $text[] = 'Попробуйте еще раз';
            } else {
                $text[] = 'Вы авторизировались!';
                $text[] = 'Теперь вы будете получать сообщения с напоминанием, когда слово будет готово к повторению';
            }
        }

        $text = implode(PHP_EOL, $text);
        print_r($text);
        Request::sendMessage([
            'chat_id' => $chatId,
            'text'    => $text,
            'parse_mode' => 'Markdown'
        ]);

    }


}