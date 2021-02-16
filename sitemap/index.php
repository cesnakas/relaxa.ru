<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Массаж, массажное, кресло, офисное, качалка, кресло-качалка, массажер, купить, заказать, цена, интернет-магазин, доставка, стоимость, большой, выбор, товары, фитнес, тренажер, аппарат, иммунитет, здоровье, красота, акции, скидки, карта, навигация, сайт, сориентироваться");
$APPLICATION->SetPageProperty("keywords", "Массаж, массажное, кресло, офисное, качалка, кресло-качалка, массажер, купить, заказать, цена, интернет-магазин, доставка, стоимость, большой, выбор, товары, фитнес, тренажер, аппарат, иммунитет, здоровье, красота, акции, скидки, карта, навигация, сайт, сориентироваться");
$APPLICATION->SetTitle("Карта сайта");
$APPLICATION->SetPageProperty("title", "Карта сайта | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Навигация по сайту интернет-магазина «RELAXA STAR». Массажное оборудование, тренажеры для фитнеса, аппартаы для поддержания иммунитета, товары для здоровья и красоты, акции и скидки. ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!");

?>
<h1><?=$APPLICATION->ShowTitle(false)?></h1>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.map",
	"sitemap",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"COL_NUM" => "3",
		"COMPONENT_TEMPLATE" => "sitemap",
		"LEVEL" => "3",
		"SET_TITLE" => "Y",
		"SHOW_DESCRIPTION" => "N"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>