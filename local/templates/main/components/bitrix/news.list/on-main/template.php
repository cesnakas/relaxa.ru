<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<style>
	.home_massage_equipment_b .ittems_int img{
min-height: 250px;
	}
</style>
<?foreach($arResult["ITEMS"] as $arItem):
		if ($arItem["DISPLAY_PROPERTIES"]['SHOW_ON_MAIN']['DISPLAY_VALUE'] == "YES"):?> 
<div class="ittems_int">
			<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
				<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" />
			</a>
			<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
				<h4 style=" text-transform: uppercase; "><?echo $arItem["NAME"]?></h4>
			</a>
			<p><?echo $arItem["PREVIEW_TEXT"];?></p>
</div>
		<?endif;?>
<?endforeach;?>