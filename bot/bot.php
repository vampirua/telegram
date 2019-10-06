<?php
require_once "vendor/autoload.php";
$token = "982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88";
$bot = new \TelegramBot\Api\Client($token);
// команда для start
$bot->command('start', function ($message) use ($bot) {
    $answer = 'Добро пожаловать!';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// команда для помощи
$bot->command('hello', function ($message) use ($bot) {
    $text = $message->getText();
    $param = str_replace('/hello ', '', $text);
    $answer = 'Неизвестная команда';
    if (!empty($param))
    {
        $answer = 'Привет, ' . $param;
    }
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

$bot->run();