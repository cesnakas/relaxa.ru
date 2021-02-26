<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();?>
<?/*$APPLICATION->IncludeComponent(
	"uplab:tilda", 
	".default", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"NOJQ" => "N",
		"PAGE" => "16484369",
		"PROJECT" => "2065774",
		"STOP_CACHE" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);*/?>
<? if (!empty($arResult["PROPERTIES"]["FIELD"]["~VALUE"]["TEXT"])): ?>
    <div>                                     
    <?= $arResult["PROPERTIES"]["FIELD"]["~VALUE"]["TEXT"] ?>
    </div>
<? endif;?>