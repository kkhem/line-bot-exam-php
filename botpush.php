<?php



require "vendor/autoload.php";

$access_token = 'Wi2qUPlazMv6/shh9XJ1r0SeXRmfVyqxbTJgSqazLM+5DjrvqLBuF9rNVogQXqfe11rMbXxYFdx+5Ul9Ue/xgCM39ET/gMOST9AaEoGCDbEn34K8TdX1onpoWIoMBJygd8YJ/lxhdBNzfgIRPMh7AwdB04t89/1O/w1cDnyilFU=';

$channelSecret = '75c03f392f6e53d662d6f5a8db9e421f';

$pushID = 'U7ef7a449f2a5c2057eacfc02ba2eb286';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);

$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('hello world');
$response = $bot->pushMessage($pushID, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();







