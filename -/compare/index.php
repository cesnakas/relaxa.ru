<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Сравнение товаров");
$APPLICATION->SetPageProperty("title", "Сравнение товаров | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Сравнить товары перед покупкой в интернет-магазине «RELAXA STAR». ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!");
$APPLICATION->SetPageProperty("tags", "купить, заказать, цена, интернет-магазин, доставка, стоимость, большой, выбор, товары, известные, производители, массаж, кресла, массажеры, тренажеры, фитнес, сравнить, сопоставить, узнать, разницу, отличия, различия, сходства, выгода");
$APPLICATION->SetPageProperty("keywords", "купить, заказать, цена, интернет-магазин, доставка, стоимость, большой, выбор, товары, известные, производители, массаж, кресла, массажеры, тренажеры, фитнес, сравнить, сопоставить, узнать, разницу, отличия, различия, сходства, выгода");
?><style>
ul>li>ul {
    display: block;
}
</style>
<h1>Список сравнения</h1>
 <?$APPLICATION->IncludeComponent(
	"dresscode:catalog.compare", 
	"template2", 
	array(
		"ACTION_VARIABLE" => "action",
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_HISTORY" => "Y",
		"AJAX_OPTION_JUMP" => "Y",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_STYLE" => "Y",
		"BASKET_URL" => "/personal/cart/",
		"COMPONENT_TEMPLATE" => "template2",
		"CONVERT_CURRENCY" => "Y",
		"CURRENCY_ID" => "RUB",
		"DETAIL_URL" => "",
		"DISPLAY_ELEMENT_SELECT_BOX" => "Y",
		"ELEMENT_SORT_FIELD" => "sort",
		"ELEMENT_SORT_FIELD_BOX" => "name",
		"ELEMENT_SORT_FIELD_BOX2" => "id",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_ORDER_BOX" => "asc",
		"ELEMENT_SORT_ORDER_BOX2" => "desc",
		"FIELD_CODE" => "",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "1",
		"IBLOCK_TYPE" => "catalog",
		"NAME" => "CATALOG_COMPARE_LIST",
		"OFFERS_FIELD_CODE" => "",
		"OFFERS_PROPERTY_CODE" => "",
		"PRICE_CODE" => array(
			0 => "Розничная",
		),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PROPERTY_CODE" => array(
			0 => "VID_MASSAGA",
		),
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SHOW_PRICE_COUNT" => "1",
		"USE_PRICE_COUNT" => "Y",
		"PRODUCT_PRICE_CODE" => array(
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "360000",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>