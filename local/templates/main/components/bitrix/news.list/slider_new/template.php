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
<div class="slider_one">

<?foreach($arResult["ITEMS"] as $arItem){?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	<div class="slide__main__top slide__main__top-<?=$arItem['ID']?>">
		<div class="wrapper">
			<div class="slider__main__content"><a href="<?=$arItem['PROPERTIES']['LINK_MOBILE']['VALUE']?>" class="slideMobileLink <? if ($arItem['PROPERTIES']['LINK_MOBILE']['VALUE'] == "#"):?>openWebFormModal<? endif; ?>" data-id="5" style="background: url(<?=CFile::GetPath($arItem['PROPERTIES']['PHOTO_MOBILE']['VALUE'])?>) center center no-repeat; background-size: cover; width: 100%;"></a><div class="slideContent"><?=$arItem['PREVIEW_TEXT']?></div></div>
		</div>
	</div>

<?}?>
</div>

<?foreach($arResult['ITEMS'] as $styles){?>
	<style>
		.slide__main__top-<?=$styles['ID']?> {
			background-image: url(<?=$styles['PREVIEW_PICTURE']['SRC']?>);
		}
	</style>
<?}?>