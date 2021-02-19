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

<div class="title_art_news"> 
<div class="back">
    <a href="<?if(('http://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER'] || 'https://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=""):?><?=$_SERVER['HTTP_REFERER']?><?else:?>/<?endif;?>">
                <img src="/verstka/img/mobile/back.png" alt="" class="back_img">
    </a>
</div>
<h1><?=$APPLICATION->ShowTitle(false)?></h1>
</div>

<div class="new_section_articles_pre">
<?
$arParams['IBLOCK_ID'] = 51; // ID инфоблока
// подключение модуля инфоблоков
CModule::IncludeModule('iblock');

$sectRes = CIBlockSection::GetList(
               array("SORT"=>"ASC"), // сортировка
               array("IBLOCK_ID" => $arParams['IBLOCK_ID']), // параметры фильтра
               false, // возврат кол-ва элементов в разделе
               array('ID','NAME','SECTION_PAGE_URL'), // поля для выборки
               false // параметры постраничной навигации
            );
while ($arSect = $sectRes->GetNext()){
echo  '<a href="'. $arSect['SECTION_PAGE_URL'].'"><div class="new_section_articles">'.$arSect['NAME']."</div></a>";
}
?>
</div>

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>


<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	?>
	
	<a href="<?echo $arItem["DETAIL_PAGE_URL"]?>">
	<div class="news-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
	
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<img
						class="preview_picture"
						border="0"
						src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
						width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
						height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
						alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
						title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
						/>
			<?else:?>
				<img
					class="preview_picture"
					border="0"
					src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>"
					width="<?=$arItem["PREVIEW_PICTURE"]["WIDTH"]?>"
					height="<?=$arItem["PREVIEW_PICTURE"]["HEIGHT"]?>"
					alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>"
					title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>"
					/>
			<?endif;?>
		<?endif?>
		<?if($arParams["DISPLAY_NAME"]!="N" && $arItem["NAME"]):?>
			<?if(!$arParams["HIDE_LINK_WHEN_NO_DETAIL"] || ($arItem["DETAIL_TEXT"] && $arResult["USER_HAVE_ACCESS"])):?>
				<div class="head_description"><?echo $arItem["NAME"]?></div><br />
			<?else:?>
				<div class="head_description"><?echo $arItem["NAME"]?></div><br />
			<?endif;?>
		<?endif;?>
		<?if($arParams["DISPLAY_PREVIEW_TEXT"]!="N" && $arItem["PREVIEW_TEXT"]):?>
			<div class="description_news"><?echo $arItem["PREVIEW_TEXT"];?></div>
		<?endif;?>
		<?if($arParams["DISPLAY_DATE"]!="N" && $arItem["DISPLAY_ACTIVE_FROM"]):?>
			<div class="news-date-time"><?echo $arItem["DISPLAY_ACTIVE_FROM"]?></div>
		<?endif?>		
		<?if($arParams["DISPLAY_PICTURE"]!="N" && is_array($arItem["PREVIEW_PICTURE"])):?>
			<div style="clear:both"></div>
		<?endif?>
		<?/*foreach($arItem["FIELDS"] as $code=>$value):?>
			<div class="show-prop">
			<? echo '<img src="https://relaxa.ru/bitrix/templates/dresscodeV2/components/bitrix/news/news/images/svg/eye_icon.svg">' ?>&nbsp;<?=$value;?>
			</div><br />
		<?endforeach;*/?>
			<div class="show-prop">
			<? echo '<img src="https://relaxa.ru/bitrix/templates/dresscodeV2/components/bitrix/news/news/images/svg/eye_icon.svg">' ?>&nbsp;
			<?if (strlen($arItem['SHOW_COUNTER'])>0):?>
			<?=$arItem['SHOW_COUNTER']?>
			<?else:?>
			0
			<?endif;?>
			</div><br />		
		<?/*foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
			<small>
			<?=$arProperty["NAME"]?>:&nbsp;
			<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
				<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
			<?else:?>
				<?=$arProperty["DISPLAY_VALUE"];?>
			<?endif?>
			</small><br />
		<?endforeach;*/?>		
	</div></a>
<?endforeach;?>
<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
<?php
$APPLICATION->IncludeComponent(
	"bitrix:search.tags.cloud", 
	"cloud", 
	array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"COLOR_NEW" => "3E74E6",
		"COLOR_OLD" => "C0C0C0",
		"COLOR_TYPE" => "Y",
		"FILTER_NAME" => "arrTags",
		"FONT_MAX" => "50",
		"FONT_MIN" => "14",
		"PAGE_ELEMENTS" => "10",
		"PERIOD" => "",
		"PERIOD_NEW_TAGS" => "",
		"SHOW_CHAIN" => "Y",
		"SORT" => "NAME",
		"TAGS_INHERIT" => "Y",
		"URL_SEARCH" => "/news/index.php",
		"WIDTH" => "100%",
		"COMPONENT_TEMPLATE" => "cloud",
		"COLOR" => "333333",
		"BG" => "ffffff",
		"WIDTH2" => "160",
		"HEIGHT" => "160",
		"SPEED" => "100",
		"TRANS" => "Y",
		"DISTR" => "N",
		"arrFILTER" => array(
			0 => "iblock_content",
		),
		"arrFILTER_iblock_content" => array(
			0 => "51",
		)
	),
	false
);
?>
</div>
