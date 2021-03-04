<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Корзина");
$APPLICATION->SetPageProperty("title", "Корзина | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Корзина с товарами пользователя интернет-магазина «RELAXA STAR». Массажные кресла, массажеры, товары для фитнеса. ☎ Телефон: 8 (800) 333 00 51");
$APPLICATION->SetPageProperty("tags", "Корзина, товар, покупка, совершить, посмотреть, купить, оплатить, заказ, добавить, способ, оплата, стоимость, пользователь, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры");
$APPLICATION->SetPageProperty("keywords", "Корзина, товар, покупка, совершить, посмотреть, купить, оплатить, заказ, добавить, способ, оплата, стоимость, пользователь, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры");
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"old_version_18-PAH", 
	array(
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"COLUMNS_LIST" => array(
			0 => "NAME",
			1 => "DELETE",
			2 => "PRICE",
			3 => "QUANTITY",
			4 => "SUM",
		),
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"HIDE_COUPON" => "N",
		"QUANTITY_FLOAT" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"TEMPLATE_THEME" => "blue",
		"SET_TITLE" => "Y",
		"AJAX_OPTION_ADDITIONAL" => "",
		"OFFERS_PROPS" => array(
		),
		"COMPONENT_TEMPLATE" => "old_version_18-PAH",
		"USE_PREPAYMENT" => "N",
		"ACTION_VARIABLE" => "action",
		"CORRECT_RATIO" => "N",
		"AUTO_CALCULATION" => "Y",
		"USE_GIFTS" => "N",
		"COLUMNS_LIST_EXT" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "SUM",
		),
		"COMPATIBLE_MODE" => "Y",
		"ADDITIONAL_PICT_PROP_1" => "-",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"ADDITIONAL_PICT_PROP_12" => "-",
		"ADDITIONAL_PICT_PROP_13" => "-",
		"ADDITIONAL_PICT_PROP_14" => "-",
		"ADDITIONAL_PICT_PROP_15" => "-",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"ADDITIONAL_PICT_PROP_21" => "-",
		"DEFERRED_REFRESH" => "N",
		"USE_DYNAMIC_SCROLL" => "Y",
		"SHOW_FILTER" => "N",
		"SHOW_RESTORE" => "Y",
		"COLUMNS_LIST_MOBILE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "DISCOUNT",
			2 => "DELETE",
			3 => "DELAY",
			4 => "SUM",
		),
		"TOTAL_BLOCK_DISPLAY" => array(
			0 => "bottom",
		),
		"DISPLAY_MODE" => "extended",
		"PRICE_DISPLAY_MODE" => "N",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"DISCOUNT_PERCENT_POSITION" => "bottom-right",
		"PRODUCT_BLOCKS_ORDER" => "props,sku,columns",
		"USE_PRICE_ANIMATION" => "Y",
		"LABEL_PROP" => "",
		"EMPTY_BASKET_HINT_PATH" => "/"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>