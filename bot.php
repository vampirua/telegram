<?php
require_once "vendor/autoload.php";
$token = "982221383:AAEgNznDDyQdYXeC_6eoO33jZ3mXDE_YM88";
$bot = new \TelegramBot\Api\Client($token);


$json = file_get_contents('https://api.privatbank.ua/p24api/exchange_rates?json&date=06.10.2019');
$obj = json_decode($json);

foreach ($obj as $item) {
    foreach ($item as $value) {
        if ($value->currency == 'USD') {
            $sale = $value->saleRate;
            $buy = $value->purchaseRate;
            $bot->command('USD', function ($message) use ($bot) {

                $answer = " Sale : , Buy : ";
                $bot->sendMessage($message->getChat()->getId(), $answer);
            });
        }
    }
}

$bot->command('start', function ($message) use ($bot) {
    $answer = 'Добро пожаловать!';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

// команда для помощи
$bot->command('help', function ($message) use ($bot) {
    $answer = 'Команды:
/help - вывод справки';
    $bot->sendMessage($message->getChat()->getId(), $answer);
});

$bot->run();
?>
