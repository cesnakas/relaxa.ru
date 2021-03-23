<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<?

foreach ($arResult["PROPERTIES"] as $key => $propElement) {
	if (!empty($propElement["VALUE"])) {
		if (is_array($propElement["VALUE"])) {
			$arResult["PROPERTIES"][$key] = $propElement;
			$arResult["PROPERTIES"][$key]["VALUE"] = implode(" / ", $propElement["VALUE"]);
		} else {
			$arResult["PROPERTIES"][$key] = $propElement;
		}
	}
}

/*foreach($arResult['ITEMS'] as $key=>$val) {	
  // записываем свойство CONDITIONS в массив $arResult
  $res = CIBlockElement::GetProperty(
    22,
    $val['ID'],
    "sort",
    "asc",
    array("CODE" => "VID_MASSAGA")
  );
  
  $i = 0;
  while ($ob = $res->GetNext()) {
    $arResult['ITEMS'][$key]['PROPERTIES']['VID_MASSAGA']['NAME'] = $ob['NAME'];
    $arResult['ITEMS'][$key]['PROPERTIES']['VID_MASSAGA']['VALUE'][$i++] = $ob['VALUE'];
    }*/

?>