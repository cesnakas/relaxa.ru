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
		"COMPONENT_TEMPLATE" => "template2",
		"PRICE_CODE" => array(
			0 => "Розничная",
		),
		"PROPERTY_CODE" => array(
			0 => "",
            1 => "",
            2 => "OLD_PRICE",
        ),
        "AJAX_MODE" => "Y",
        "NAME" => "CATALOG_COMPARE_LIST",
        "IBLOCK_TYPE" => "news",
        "IBLOCK_ID" => "2",
        "FIELD_CODE" => array(),
        "PROPERTY_CODE" => array(),
        "OFFERS_FIELD_CODE" => array(),
        "OFFERS_PROPERTY_CODE" => array(),
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_ORDER" => "asc",
        "DETAIL_URL" => "",
        "BASKET_URL" => "/personal/cart/",
        "ACTION_VARIABLE" => "action",
        "PRODUCT_ID_VARIABLE" => "id",
        "SECTION_ID_VARIABLE" => "SECTION_ID",
        "USE_PRICE_COUNT" => "Y",
        "SHOW_PRICE_COUNT" => "1",
        "PRICE_VAT_INCLUDE" => "Y",
        "DISPLAY_ELEMENT_SELECT_BOX" => "Y",
        "ELEMENT_SORT_FIELD_BOX" => "name",
        "ELEMENT_SORT_ORDER_BOX" => "asc",
        "ELEMENT_SORT_FIELD_BOX2" => "id",
        "ELEMENT_SORT_ORDER_BOX2" => "desc",
        "HIDE_NOT_AVAILABLE" => "N",
        "AJAX_OPTION_SHADOW" => "Y",
        "AJAX_OPTION_JUMP" => "Y",
        "AJAX_OPTION_STYLE" => "Y",
        "AJAX_OPTION_HISTORY" => "Y",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>