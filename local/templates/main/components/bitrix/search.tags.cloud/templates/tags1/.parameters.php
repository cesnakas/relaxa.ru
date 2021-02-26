<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$arTemplateParameters = array(
    "FONT_MAX" => array(
		"NAME" => GetMessage("SEARCH_FONT_MAX"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "50"
    ),
    "FONT_MIN" => array(
		"NAME" => GetMessage("SEARCH_FONT_MIN"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "10"
    ),
    "COLOR" => array(
		"NAME" => GetMessage("SEARCH_COLOR"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "333333"
    ),
    "BG" => array(
		"NAME" => GetMessage("SEARCH_BG"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "ffffff"
    ),
    "WIDTH2" => array(
		"NAME" => GetMessage("SEARCH_WIDTH"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "160"
    ),
    "HEIGHT" => array(
		"NAME" => GetMessage("SEARCH_HEIGHT"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "160"
    ),
    "SPEED" => array(
		"NAME" => GetMessage("SEARCH_SPEED"),
		"TYPE" => "STRING",
		"MULTIPLE" => "N",
		"DEFAULT" => "100"
    ),
    "TRANS" => Array(
		"NAME" => GetMessage("SEARCH_TRANS"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"VALUE" => "Y",
		"DEFAULT" =>"Y",
    ),
    "DISTR" => Array(
		"NAME" => GetMessage("SEARCH_DISTR"),
		"TYPE" => "CHECKBOX",
		"MULTIPLE" => "N",
		"VALUE" => "N",
		"DEFAULT" =>"N",
    ),
);
?>