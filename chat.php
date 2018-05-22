<?php
require_once 'vendor/autoload.php';
require_once 'mysql/connect_db.php';
foreach(glob("conversation/*.php") as $file){
    require $file;
}

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\BotMan\Cache\DoctrineCache;
use Doctrine\Common\Cache\FilesystemCache;

$con = connect_db();

$config = [
    // Your driver-specific configuration
    // "telegram" => [
    //    "token" => "TOKEN"
    // ]
];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$doctrineCacheDriver = new FilesystemCache(__DIR__.'/cache');
$botman = BotManFactory::create($config, new DoctrineCache($doctrineCacheDriver));

$botman->hears('{command}', function (BotMan $bot, $command) use ($con) {
    $query = "SELECT next_conv FROM command WHERE command_pattern='$command'";
    $result = $con->query($query);
    if($col = $result->fetch(PDO::FETCH_NUM)){
        $bot->startConversation(new $col[0]);
    } else {
        $bot->reply('Salah memasukkan perintah!');
    }
});

$botman->listen();