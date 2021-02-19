<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?/*
$for_unset = [
    'DEALER_PRICE',
    'VIP_PRICE',
    'VIP_DEMO_PRICE',
    'PREMIUM_PRICE'
];
foreach ($arResult["DISPLAY_PROPERTIES_GROUP"] as $key => $arProp) {
    if (in_array($arProp['CODE'], $for_unset)) {
        debug($arProp['CODE']);
        unset($arResult["PROPERTIES"][$key]);
        debug($arResult["PROPERTIES"][$key]);
    }
}
*/

// перелинковка для елемента
foreach ($arResult["PROPERTIES"] as $prop) {
	if($prop["CODE"]=="URL_RELINK"){
		$url_rel = $prop["VALUE"];
		break;
	}
}
if(isset($url_rel) && !empty($url_rel)){
	$i=0;
	foreach ($arResult["DISPLAY_PROPERTIES_GROUP"] as $item) {
		if($item["CODE"]=="TYPE"){
			if($arResult["DISPLAY_PROPERTIES_GROUP"][$i]["DISPLAY_VALUE"]!=""){
				$arResult["DISPLAY_PROPERTIES_GROUP"][$i]["DISPLAY_VALUE"] = '<a href="'.$url_rel.'">'.$arResult["DISPLAY_PROPERTIES_GROUP"][$i]["DISPLAY_VALUE"]."</a>";
				break;
			}
		}
		$i=$i+1;
	}
}
foreach ($arResult["PROPERTIES"] as $key => $propElement) {
	if ($propElement["CODE"] === 'URL_RELINK' || $propElement["CODE"] === 'COLOR_SELECT' ) {
		continue;
	}
	if (!empty($propElement["VALUE"])) {
		$productBrand = GetIBlockElement($propElement["VALUE"], 'info');
		if (empty($productBrand) === false) {
			$arResult["ALL_PROPERTIES"][$key] = $propElement;
			$arResult["ALL_PROPERTIES"][$key]["VALUE"] = $productBrand["NAME"];
		}
		elseif (is_array($propElement["VALUE"])) {
			$arResult["ALL_PROPERTIES"][$key] = $propElement;
			$arResult["ALL_PROPERTIES"][$key]["VALUE"] = implode(" / ", $propElement["VALUE"]);
		} else {
			$arResult["ALL_PROPERTIES"][$key] = $propElement;
		}
	}
}

?>