<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
    $arResult['ITEM']['IBLOCK_ID'],
    $arResult['ITEM']['ID']
);
$arElMetaProp = $ipropValues->getValues();
$APPLICATION->SetPageProperty("title", $arElMetaProp["ELEMENT_META_TITLE"]);
$APPLICATION->SetPageProperty("description", $arElMetaProp["ELEMENT_META_DESCRIPTION"]);
$APPLICATION->SetTitle($arElMetaProp["ELEMENT_PAGE_TITLE"]);
