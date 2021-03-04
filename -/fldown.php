<?
error_reporting(E_ALL);
set_time_limit(0);
setlocale(LC_ALL, 'ru_RU.UTF-8');
mb_internal_encoding('UTF-8');
ob_start();

require_once('pathfrom.php'); //прилагается :О)

$pathfrom = 'https://www.relaxa.ru/uploads/shop/icons/'; //откуда
$pathto = './imgs/'; //куда(папка, должна существовать), относительный путь, поменяй на свою


for($i = 0; $i < $cn; ++$i){

$context_options = array (
'https' => array (
'method' => 'GET',
'header'=> "Host www.relaxa.ru\r\n"
."User-Agent Googlebot/2.1 (+http://www.google.com/bot.html)\r\n"
."Accept: text/html, application/xhtml+xml, application/xml;q=0.9, */*;q=0.8"
."Accept-Language ru-RU,ru;q=0.8,en-US;q=0.5,en;q=0.3\r\n"
."Accept-Encoding deflate, br\r\n"
."Connection keep-alive\r\n"
."Upgrade-Insecure-Requests 1\r\n"
."If-Modified-Since Tue, 16 May 2017 14:16:54 GMT\r\n"
."Cache-Control max-age=0\r\n"
)
);

$context = stream_context_create($context_options);

if($result = file_get_contents($pathfrom.$img[$i], NULL, $context)){
file_put_contents($pathto.$img[$i], $result);
}

sleep(1); //можно попробовать отключить, но сервак может принять за ddos
}

echo $i;

@ob_flush();
exit();
?>