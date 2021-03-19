<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$period = 0; $time = 0;

/* default options */
$options['width'] = '160';
$options['height'] = '160';
$options['tcolor'] = '333333';
$options['bgcolor'] = 'ffffff';
$options['speed'] = '100';
$options['trans'] = 'true';
$options['distr'] = 'true';

// ********************************************************************************
$arParams["FONT_MIN"] = intVal($arParams["FONT_MIN"]) > 0 ? $arParams["FONT_MIN"] : 10;
$arParams["FONT_MAX"] = intVal($arParams["FONT_MAX"]) > 0 ? $arParams["FONT_MAX"] : 50;
$arParams["FONT_RANGE"] = $arParams["FONT_MAX"] - $arParams["FONT_MIN"];

$arParams["ANGULARITY"] = 0;
if (strLen($arParams["COLOR"]) == 6 && hexdec($arParams["COLOR"]) > 0)
	{ $arResult["COLOR"] = $arParams["COLOR"]; }
else
	{ $arResult["COLOR"] = $options['tcolor']; }

if (strLen($arParams["BG"]) == 6 && hexdec($arParams["BG"]) > 0)
	{ $arResult["BG"] = $arParams["BG"]; }
else
	{ $arResult["BG"] = $options['bgcolor']; }

$arParams["WIDTH"] = trim($arParams["WIDTH2"]);
$unit = array();
preg_match("/(\d+)/i", $arParams["WIDTH2"], $unit);
$arResult["WIDTH2"] = (empty($unit) ? $options['width'] : $unit[1]);

$arParams["HEIGHT"] = trim($arParams["HEIGHT"]);
$unit = array();
preg_match("/(\d+)/i", $arParams["HEIGHT"], $unit);
$arResult["HEIGHT"] = (empty($unit) ? $options['height'] : $unit[1]);

$arParams["SPEED"] = trim($arParams["SPEED"]);
$unit = array();
preg_match("/(\d+)/i", $arParams["SPEED"], $unit);
$arResult["SPEED"] = (empty($unit) ? $options['speed'] : $unit[1]);

$arResult["TRANS"] = $arParams["TRANS"];
$arResult["DISTR"] = $arParams["DISTR"];


if (intVal($arParams["PERIOD_NEW_TAGS"]) > 0)
{
	$time = time();
	$period = intVal($arParams["PERIOD_NEW_TAGS"])*24*3600;
}
// ********************************************************************************
if (is_array($arResult["SEARCH"]))
{
	foreach ($arResult["SEARCH"] as $key => $res)
	{
		if ($arResult["CNT_ALL"] != 0)
		{
			$cnt = $res["CNT"];
			if ($period > 0  && (($time - $res["TIME"]) <= $period))
			{
				$cnt += ($arResult["CNT_MAX"] - $cnt)*($period - ($time - $res["TIME"]))/$period;
			}

			$font_size = ($cnt / $arResult["CNT_ALL"]) *
				(($arParams["FONT_RANGE"] * $arParams["ANGULARITY"]) + 1) * ($arParams["FONT_RANGE"] * $arParams["ANGULARITY"]) / 2 +
				pow(($cnt-$arResult["CNT_MIN"])/max(1, $arResult["CNT_MAX"]-$arResult["CNT_MIN"]), 0.8) *
				($arParams["FONT_RANGE"] * (1 - $arParams["ANGULARITY"]));

			$font_size = min($arParams["FONT_MAX"], intVal($font_size + $arParams["FONT_MIN"]));
		}
		$arResult["SEARCH"][$key]["FONT_SIZE"] = $font_size;
	}
}

?>