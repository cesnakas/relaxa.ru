<?
define("NEED_AUTH", true);
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

if (isset($_REQUEST["backurl"]) && strlen($_REQUEST["backurl"])>0) 
	LocalRedirect($backurl);

$APPLICATION->SetTitle("Вход на сайт");
$APPLICATION->SetPageProperty("title", "Вход на сайт | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Вход на сайт интернет-магазина «RELAXA STAR». Массажные кресла, массажеры, товары для фитнеса. ☎ Телефон: 8 (800) 333 00 51");
$APPLICATION->SetPageProperty("tags", "Вход, на, сайт, войти, авторизоваться, зарегистрироваться, мой, кабинет, пользователь, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры");
$APPLICATION->SetPageProperty("keywords", "Вход, на, сайт, войти, авторизоваться, зарегистрироваться, мой, кабинет, пользователь, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры");
?>
<p class="notetext">
	Вы зарегистрированы и успешно авторизовались.
</p>
<p>
	<a href="/">Вернуться на главную страницу</a>
</p>

<p>
	<a href="/personal/">Войти в личный кабинет</a>
</p>
<br>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>