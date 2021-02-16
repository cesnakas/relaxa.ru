<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

	$arResult = $USER->SendPassword($_POST['USER_LOGIN'], $_POST['USER_EMAIL']);
	if($arResult["TYPE"] == "OK") echo '<p style="color:#4abf52;font-size:16px;">Контрольная строка для смены пароля выслана.</p>';
	else echo '<p style="color:red;font-size:16px;">Введенный логин (email) не найден.</p>';
?>