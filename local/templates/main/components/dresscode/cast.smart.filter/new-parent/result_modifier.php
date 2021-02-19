<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (isset($arParams["TEMPLATE_THEME"]) && !empty($arParams["TEMPLATE_THEME"]))
{
	$arAvailableThemes = array();
	$dir = trim(preg_replace("'[\\\\/]+'", "/", dirname(__FILE__)."/themes/"));
	if (is_dir($dir) && $directory = opendir($dir))
	{
		while (($file = readdir($directory)) !== false)
		{
			if ($file != "." && $file != ".." && is_dir($dir.$file))
				$arAvailableThemes[] = $file;
		}
		closedir($directory);
	}

	if ($arParams["TEMPLATE_THEME"] == "site")
	{
		$solution = COption::GetOptionString("main", "wizard_solution", "", SITE_ID);
		if ($solution == "eshop")
		{
			$theme = COption::GetOptionString("main", "wizard_eshop_adapt_theme_id", "blue", SITE_ID);
			$arParams["TEMPLATE_THEME"] = (in_array($theme, $arAvailableThemes)) ? $theme : "blue";
		}
	}
	else
	{
		$arParams["TEMPLATE_THEME"] = (in_array($arParams["TEMPLATE_THEME"], $arAvailableThemes)) ? $arParams["TEMPLATE_THEME"] : "blue";
	}
}
else
{
	$arParams["TEMPLATE_THEME"] = "blue";
}

$arParams["FILTER_VIEW_MODE"] = (isset($arParams["FILTER_VIEW_MODE"]) && toUpper($arParams["FILTER_VIEW_MODE"]) == "HORIZONTAL") ? "HORIZONTAL" : "VERTICAL";
$arParams["POPUP_POSITION"] = (isset($arParams["POPUP_POSITION"]) && in_array($arParams["POPUP_POSITION"], array("left", "right"))) ? $arParams["POPUP_POSITION"] : "left";

$uri = $APPLICATION->GetCurPage();


if(in_array($uri, ['/massazhnoe-oborudovanie/massazhnye_stoly_i_stulya/','/massazhnoe-oborudovanie/massazhery/massazhnye_podushki/'] )){
    unset($arResult["ITEMS"][18]);

    unset($arResult["ITEMS"][25]);

    unset($arResult["ITEMS"][23]);

    unset($arResult["ITEMS"][11]);
}

global $secFilter;
global $propListFilter;
$propListFilter = array();

$arFLIst = array();

if (Cmodule::IncludeModule('asd.iblock')) {
    $arFields = CASDiblockTools::GetIBUF($arParams['IBLOCK_ID']);
    $propListFilter = $arFields['UF_FILTER'];
}

if(!empty($propListFilter)) {
    foreach($arResult['ITEMS'] as $fItem) {
        if(in_array($fItem['CODE'], $propListFilter) || $fItem['CODE'] == "AFP_PRICE") {
            $arResult['NEW_ITEMS'][] = $fItem;
        }
    }
}
