<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Настройки пользователя");
$APPLICATION->SetPageProperty("title", "Настройки пользователя | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Настройки пользователя в личном кабинете интернет-магазина «RELAXA STAR». Массажные кресла, массажеры, товары для фитнеса. ☎ Телефон: 8 (800) 333 00 51");
$APPLICATION->SetPageProperty("tags", "Личный, мой, кабинет, настройки, пользователь, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры");
$APPLICATION->SetPageProperty("keywords", "Личный, мой, кабинет, настройки, пользователь, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры");
?>

<?$APPLICATION->IncludeComponent("bitrix:main.profile", "custom", Array(
	"SET_TITLE" => "Y",	// Устанавливать заголовок страницы
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>