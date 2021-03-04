<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заказы");
?>


<style>
.bx-soa-pp-company-smalltitle {
    color: #000000;
    font-size: 16px;
    font-weight: bold;
	}

.bx-soa-section{
    background-color: white;
}


</style>


<?$APPLICATION->IncludeComponent(
	"bitrix:sale.order.ajax", 
	"template1-120618-PAH", 
	array(
		"ACTION_VARIABLE" => "action",
		"ADDITIONAL_PICT_PROP_4" => "-",
		"ADDITIONAL_PICT_PROP_5" => "-",
		"ALLOW_APPEND_ORDER" => "Y",
		"ALLOW_AUTO_REGISTER" => "Y",
		"ALLOW_NEW_PROFILE" => "N",
		"ALLOW_USER_PROFILES" => "N",
		"BASKET_IMAGES_SCALING" => "adaptive",
		"BASKET_POSITION" => "before",
		"COMPATIBLE_MODE" => "Y",
		"COUNT_DELIVERY_TAX" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"DELIVERIES_PER_PAGE" => "9",
		"DELIVERY2PAY_SYSTEM" => "",
		"DELIVERY_FADE_EXTRA_SERVICES" => "N",
		"DELIVERY_NO_AJAX" => "Y",
		"DELIVERY_NO_SESSION" => "Y",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"DISABLE_BASKET_REDIRECT" => "N",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"PATH_TO_AUTH" => "/auth/",
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_ORDER" => "/personal/order/make/",
		"PATH_TO_PAYMENT" => "/personal/order/payment/",
		"PATH_TO_PERSONAL" => "/personal/order/",
		"PAY_FROM_ACCOUNT" => "N",
		"PAY_SYSTEMS_PER_PAGE" => "9",
		"PICKUPS_PER_PAGE" => "1",
		"PRODUCT_COLUMNS" => "",
		"PRODUCT_COLUMNS_HIDDEN" => array(
		),
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PRICE_FORMATED",
		),
		"PROPS_FADE_LIST_1" => array(
			0 => "1",
			1 => "2",
			2 => "3",
			3 => "7",
			4 => "28",
		),
		"PROP_1" => array(
			0 => "4",
			1 => "5",
		),
		"SEND_NEW_USER_NOTIFY" => "Y",
		"SERVICES_IMAGES_SCALING" => "adaptive",
		"SET_TITLE" => "Y",
		"SHOW_ACCOUNT_NUMBER" => "Y",
		"SHOW_BASKET_HEADERS" => "N",
		"SHOW_COUPONS_BASKET" => "Y",
		"SHOW_COUPONS_DELIVERY" => "N",
		"SHOW_COUPONS_PAY_SYSTEM" => "Y",
		"SHOW_DELIVERY_INFO_NAME" => "Y",
		"SHOW_DELIVERY_LIST_NAMES" => "Y",
		"SHOW_DELIVERY_PARENT_NAMES" => "N",
		"SHOW_MAP_IN_PROPS" => "N",
		"SHOW_NEAREST_PICKUP" => "N",
		"SHOW_NOT_CALCULATED_DELIVERIES" => "L",
		"SHOW_ORDER_BUTTON" => "always",
		"SHOW_PAYMENT_SERVICES_NAMES" => "N",
		"SHOW_PAY_SYSTEM_INFO_NAME" => "Y",
		"SHOW_PAY_SYSTEM_LIST_NAMES" => "Y",
		"SHOW_PICKUP_MAP" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"SHOW_TOTAL_ORDER_BUTTON" => "Y",
		"SHOW_VAT_PRICE" => "N",
		"SKIP_USELESS_BLOCK" => "Y",
		"SPOT_LOCATION_BY_GEOIP" => "Y",
		"TEMPLATE_LOCATION" => "popup",
		"TEMPLATE_THEME" => "site",
		"USER_CONSENT" => "Y",
		"USER_CONSENT_ID" => "2",
		"USER_CONSENT_IS_CHECKED" => "Y",
		"USER_CONSENT_IS_LOADED" => "Y",
		"USE_CUSTOM_ADDITIONAL_MESSAGES" => "N",
		"USE_CUSTOM_ERROR_MESSAGES" => "N",
		"USE_CUSTOM_MAIN_MESSAGES" => "N",
		"USE_ENHANCED_ECOMMERCE" => "N",
		"USE_PRELOAD" => "Y",
		"USE_PREPAYMENT" => "N",
		"USE_YM_GOALS" => "Y",
		"COMPONENT_TEMPLATE" => "template1-120618-PAH",
		"PICKUP_MAP_TYPE" => "yandex",
		"ADDITIONAL_PICT_PROP_1" => "-",
		"ADDITIONAL_PICT_PROP_12" => "-",
		"ADDITIONAL_PICT_PROP_13" => "-",
		"ADDITIONAL_PICT_PROP_14" => "-",
		"ADDITIONAL_PICT_PROP_15" => "-",
		"YM_GOALS_COUNTER" => "",
		"YM_GOALS_INITIALIZE" => "BX-order-init",
		"YM_GOALS_EDIT_REGION" => "BX-region-edit",
		"YM_GOALS_EDIT_DELIVERY" => "BX-delivery-edit",
		"YM_GOALS_EDIT_PICKUP" => "BX-pickUp-edit",
		"YM_GOALS_EDIT_PAY_SYSTEM" => "BX-paySystem-edit",
		"YM_GOALS_EDIT_PROPERTIES" => "BX-properties-edit",
		"YM_GOALS_EDIT_BASKET" => "BX-basket-edit",
		"YM_GOALS_NEXT_REGION" => "BX-region-next",
		"YM_GOALS_NEXT_DELIVERY" => "BX-delivery-next",
		"YM_GOALS_NEXT_PICKUP" => "BX-pickUp-next",
		"YM_GOALS_NEXT_PAY_SYSTEM" => "BX-paySystem-next",
		"YM_GOALS_NEXT_PROPERTIES" => "BX-properties-next",
		"YM_GOALS_NEXT_BASKET" => "BX-basket-next",
		"YM_GOALS_SAVE_ORDER" => "BX-order-save",
		"EMPTY_BASKET_HINT_PATH" => "/",
		"USE_PHONE_NORMALIZATION" => "Y",
		"ADDITIONAL_PICT_PROP_21" => "-",
		"ADDITIONAL_PICT_PROP_52" => "-",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>