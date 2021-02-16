<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
setcookie('roulette', 'Y', time() + 60*60*24*45, '/');
global $_SESSION;
$_SESSION['roulette'] = "Y";
?>