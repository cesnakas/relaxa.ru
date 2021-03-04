<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мой кабинет");
$APPLICATION->SetPageProperty("title", "Мой кабинет | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Личный кабинет пользователя интернет-магазина «RELAXA STAR». Массажные кресла, массажеры, товары для фитнеса. ☎ Телефон: 8 (800) 333 00 51");
$APPLICATION->SetPageProperty("tags", "Личный, кабинет, информация, телефон, изменить, аватар, кэшбек, форма, заявки, дропшиппинг, посещение, демозала, пользователь, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры");
$APPLICATION->SetPageProperty("keywords", "Личный, кабинет, информация, телефон, изменить, аватар, кэшбек, форма, заявки, дропшиппинг, посещение, демозала, пользователь, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.profile",
	"custom",
	Array(
		"SET_TITLE" => "Y"
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>