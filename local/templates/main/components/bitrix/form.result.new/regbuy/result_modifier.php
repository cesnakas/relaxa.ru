<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$count = 0;

foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion) {
	if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'hidden' && $arQuestion['STRUCTURE'][0]['FIELD_TYPE'] != 'checkbox') {
		$count++;
	}
}
$arResult['FIELDS_COUNT'] = $count;
$arResult['COLUMN_FIELDS_COUNT'] = ceil($count/2);