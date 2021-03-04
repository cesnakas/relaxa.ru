<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

$BASE_PRICE = CCatalogGroup::GetBaseGroup();
$arSortFields = array(
	"SHOWS" => array(
		"ORDER"=> "DESC",
		"CODE" => "SHOWS",
		"NAME" => "популярности"
	),	
	"NAME" => array( // параметр в url
		"ORDER"=> "ASC", //в возрастающем порядке
		"CODE" => "NAME", // Код поля для сортировки
		"NAME" => "алфавиту" // имя для вывода в публичной части, редактировать в (/lang/ru/section.php)
	),
	"PRICE_ASC"=> array(
		"ORDER"=> "ASC",
		"CODE" => "PROPERTY_MINIMUM_PRICE",  // изменен для сортировки по ТП
		"NAME" => "увеличению цены"
	),
	"PRICE_DESC" => array(
		"ORDER"=> "DESC",
		"CODE" => "PROPERTY_MAXIMUM_PRICE", // изменен для сортировки по ТП
		"NAME" => "уменьшению цены"
	)
);
$rsMinPriceProperty = CIBlock::GetProperties($arParams["IBLOCK_ID"], Array(), Array("CODE" => "MINIMUM_PRICE"));
if($rsMinPriceProperty->SelectedRowsCount() != 1){
	$arSortFields["PRICE_ASC"] = array(
		"ORDER"=> "ASC",
		"CODE" => "CATALOG_PRICE_".$BASE_PRICE["ID"],
		"NAME" => "увеличению цены"
	);
	$arSortFields["PRICE_DESC"] = array(
		"ORDER"=> "DESC",
		"CODE" => "CATALOG_PRICE_".$BASE_PRICE["ID"],
		"NAME" => "уменьшению цены"
	);
}
if(!empty($_REQUEST["SORT_FIELD"]) && !empty($arSortFields[$_REQUEST["SORT_FIELD"]])){

	setcookie("CATALOG_SORT_FIELD", $_REQUEST["SORT_FIELD"], time() + 60 * 60 * 24 * 30 * 12 * 2, "/");

	$arParams["ELEMENT_SORT_FIELD"] = $arSortFields[$_REQUEST["SORT_FIELD"]]["CODE"];
	$arParams["ELEMENT_SORT_ORDER"] = $arSortFields[$_REQUEST["SORT_FIELD"]]["ORDER"];	

	$arSortFields[$_REQUEST["SORT_FIELD"]]["SELECTED"] = "Y";

}elseif(!empty($_COOKIE["CATALOG_SORT_FIELD"]) && !empty($arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]])){ // COOKIE
	
	$arParams["ELEMENT_SORT_FIELD"] = $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["CODE"];
	$arParams["ELEMENT_SORT_ORDER"] = $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["ORDER"];
	
	$arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["SELECTED"] = "Y";
}
$arSortProductNumber = array(
	30 => array("NAME" => 30), 
	60 => array("NAME" => 60), 
	90 => array("NAME" => 90)
);

if(!empty($_REQUEST["SORT_TO"]) && $arSortProductNumber[$_REQUEST["SORT_TO"]]){
	setcookie("CATALOG_SORT_TO", $_REQUEST["SORT_TO"], time() + 60 * 60 * 24 * 30 * 12 * 2, "/");
	$arSortProductNumber[$_REQUEST["SORT_TO"]]["SELECTED"] = "Y";
	$arParams["PAGE_ELEMENT_COUNT"] = $_REQUEST["SORT_TO"];
}elseif (!empty($_COOKIE["CATALOG_SORT_TO"]) && $arSortProductNumber[$_COOKIE["CATALOG_SORT_TO"]]){
	$arSortProductNumber[$_COOKIE["CATALOG_SORT_TO"]]["SELECTED"] = "Y";
	$arParams["PAGE_ELEMENT_COUNT"] = $_COOKIE["CATALOG_SORT_TO"];
}
