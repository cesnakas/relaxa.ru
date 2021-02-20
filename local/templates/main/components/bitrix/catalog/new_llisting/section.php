<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?/*$APPLICATION->SetPageProperty("title", $arParams["LIST_BROWSER_TITLE"]);?>
<?$rg_title = $APPLICATION->ShowMeta("title", $arParams["LIST_BROWSER_TITLE"])?>
<?$APPLICATION->AddHeadString($rg_title, false);*/?>

<?$this->setFrameMode(true);?>
<? 
		if (CModule::IncludeModule("iblock")){
		   $arFilter = array(
		      "ACTIVE" => "Y",
		      "GLOBAL_ACTIVE" => "Y",
		      "IBLOCK_ID" => $arParams["IBLOCK_ID"],
		   );
		   if(strlen($arResult["VARIABLES"]["SECTION_CODE"])>0){
		      $arFilter["=CODE"] = $arResult["VARIABLES"]["SECTION_CODE"];
		   }
		   elseif($arResult["VARIABLES"]["SECTION_ID"]>0){
		      $arFilter["ID"] = $arResult["VARIABLES"]["SECTION_ID"];
		   }

		   $obCache = new CPHPCache;
		   if($obCache->InitCache(3600000, serialize($arFilter), "/iblock/catalog")){
		      $arCurSection = $obCache->GetVars();
		   }
		   else{
		      $arCurSection = array();
		      $dbRes = CIBlockSection::GetList(array(), $arFilter, false, array("ID"));
		      $dbRes = new CIBlockResult($dbRes);

		      if(defined("BX_COMP_MANAGED_CACHE")){
		         global $CACHE_MANAGER;
		         $CACHE_MANAGER->StartTagCache("/iblock/catalog");

		         if ($arCurSection = $dbRes->GetNext()){
		            $CACHE_MANAGER->RegisterTag("iblock_id_".$arParams["IBLOCK_ID"]);
		         }
		         $CACHE_MANAGER->EndTagCache();
		      }
		      else{
		         if(!$arCurSection = $dbRes->GetNext())
		            $arCurSection = array();
		      }

		      $obCache->EndDataCache($arCurSection);
		   }

			$OPTION_CURRENCY  = CCurrency::GetBaseCurrency();
			$ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arCurSection["IBLOCK_ID"], $arCurSection["ID"]);
			$arResult["IPROPERTY_VALUES"] = $ipropValues->getValues();
		}
	?>
   <?
		// get section banner
		if(empty($arParams["SHOW_SECTION_BANNER"]) || !empty($arParams["SHOW_SECTION_BANNER"]) && $arParams["SHOW_SECTION_BANNER"] == "Y"){
			if(!empty($arResult["VARIABLES"]["SECTION_ID"])){
				$arResult["SECTION_BANNERS"] = array();
				$arSectionID = array();
				$navChain = CIBlockSection::GetNavChain($arParams["IBLOCK_ID"], $arResult["VARIABLES"]["SECTION_ID"]);
				while($arNextSection = $navChain->GetNext()){
					$arSectionID[$arNextSection["ID"]] = $arNextSection["ID"];
				}
				if(!empty($arSectionID)){
					$rsSection = CIBlockSection::GetList(array("DEPTH_LEVEL" => "DESC"), array("IBLOCK_ID" => $arParams["IBLOCK_ID"], "ID" => $arSectionID, "ACTIVE" => "Y", "GLOBAL_ACTIVE" => "Y"), false, array("ID", "IBLOCK_ID", "UF_BANNER", "UF_BANNER_LINK"));
					while($arSection = $rsSection->GetNext()){
						if(!empty($arSection["UF_BANNER"])){
							foreach ($arSection["UF_BANNER"] as $ib => $bannerID){
								$arResult["SECTION_BANNERS"][$ib]["IMAGE"] = CFile::ResizeImageGet($bannerID, array("width" => 2560, "height" => 1440), BX_RESIZE_IMAGE_PROPORTIONAL, true);
								if(!empty($arSection["UF_BANNER_LINK"][$ib])){
									$arResult["SECTION_BANNERS"][$ib]["LINK"] = $arSection["UF_BANNER_LINK"][$ib];
								}
							}
							break(1);
						}
					}
				}
			}
		}
	?>
<?if(!empty($arResult["SECTION_BANNERS"])):?>
		<div id="catalog-section-banners">
			<ul class="slideBox">
				<?foreach ($arResult["SECTION_BANNERS"] as $isc => $arNextBanner):?>
					<?if(!empty($arNextBanner["IMAGE"])):?>
						<li><a<?if(!empty($arNextBanner["LINK"]) && filter_var($arNextBanner["LINK"], FILTER_VALIDATE_URL)):?> href="<?=$arNextBanner["LINK"]?>"<?endif;?>><img src="<?=$arNextBanner["IMAGE"]["src"]?>"></a></li>
					<?endif;?>
				<?endforeach;?>
			</ul>
			<a href="#" class="catalog-section-banners-btn-left"></a>
			<a href="#" class="catalog-section-banners-btn-right"></a>
			<script>
				$(function() {
					$("#catalog-section-banners").dwSlider({
						rightButton: ".catalog-section-banners-btn-right",
						leftButton: ".catalog-section-banners-btn-left",
						delay: 6000,
						speed: 1000
					});
				});
			</script>
		</div>
	<?endif;?>








<?
// текущая страница: /ru/?id=3&s=5
$curPage = $APPLICATION->GetCurPage(true); // результат - /ru/index.php
?>

<style>
        .m_equ_cat {
            margin-left: -14px;
        }

        .m_equ_cat {
            overflow: auto;
            margin-left: -21px;
        }

        .m_equ_cat div, .m_feet_cat div {
            margin-left: 14px;
            min-height: 230px;
            margin-bottom: 14px;
        }

        .m_equ_cat div {
            float: left;
            margin-left: 21px;
            margin-bottom: 19px;
            box-shadow: 0px 0px 11px #ccc;
        }

        .m_equ_cat div img {
            margin-bottom: -6px;
        }

        .m_equ_cat a {
            float: left;
        }

        @media (min-width: 1024px) {
            .hide-if-big-1024 {
                display: none;
            }
        }
    </style>







<div class="wrapper">
<div id="catalogColumn_new">


	<div class="leftColumn">
		
<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.smart.filter", 
	".default", 
	array(
		"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"SECTION_ID" => $arCurSection["ID"],
		"FILTER_NAME" => $arParams["FILTER_NAME"],
		"PRICE_CODE" => array(
			0 => "Розничная",
		),
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => $arParams["CACHE_TIME"],
		"CACHE_GROUPS" => "N",
		"SAVE_IN_SESSION" => "N",
		"FILTER_VIEW_MODE" => $arParams["FILTER_VIEW_MODE"],
		"XML_EXPORT" => "Y",
		"SECTION_TITLE" => "NAME",
		"SECTION_DESCRIPTION" => "DESCRIPTION",
		"HIDE_NOT_AVAILABLE" => "N",
		"TEMPLATE_THEME" => $arParams["TEMPLATE_THEME"],
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"SEF_MODE" => "Y",
		"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
		"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
		"PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
		"COMPONENT_TEMPLATE" => ".default",
		"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
		"SECTION_CODE_PATH" => ""
	),
	$component
);?>

	</div>










	<div class="rightColumn">
		<h1><?if(!empty($arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"])):?><?=$arResult["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]?><?else:?><?=$APPLICATION->ShowTitle(false)?><?endif;?></h1>
	 <?$APPLICATION->IncludeComponent(
				"bitrix:catalog.section.list",
				"relink_new",
				array(
					"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
					"IBLOCK_ID" => $arParams["IBLOCK_ID"],
					"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
					"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
					"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
					"TOP_DEPTH" => 1,
					"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
					"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
					"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
					"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
					"ADD_SECTIONS_CHAIN" => (isset($arParams["ADD_SECTIONS_CHAIN"]) ? $arParams["ADD_SECTIONS_CHAIN"] : '')
				),
				$component
			);?>
			
			
		
      








        <? /*if (strpos($curPage, '/massazhery/index.php') !== false) { ?>

                  <style>
            .m_feet_cat {
                max-width: 910px;
                margin: 0 auto;
						  display: block;
            }
#catalogColumn .rightColumn {
    display: table !important;
}

        </style>

<div class="m_equ_cat">
					<div class="item_one">
<a href="/massazhnoe-oborudovanie/massazhery/massazhery_shei/">
						<img src="/bitrix/templates/dresscodeV2/img/cat_7_1.png" alt="">
</a>
					</div>
					<div class="item_to">
<a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/">
						<img src="/bitrix/templates/dresscodeV2/img/cat_7_2.png" alt="">
</a>
					</div>
					<div class="item_tr">
<a href="/massazhnoe-oborudovanie/massazhery/massazhnye_nakidki/">
						<img src="/bitrix/templates/dresscodeV2/img/cat_7_3.png" alt="">
</a>
					</div>
					<div class="item_qt">
<a href="/massazhnoe-oborudovanie/massazhery/massazhery_golovy_i_glaz/">
						<img src="/bitrix/templates/dresscodeV2/img/cat_7_4.png" alt="">
</a>
					</div>
					<div class="item_st">
<a href="/massazhnoe-oborudovanie/massazhery/massazhnye_podushki/">
						<img src="/bitrix/templates/dresscodeV2/img/cat_7_5.png" alt="">
</a>
					</div>
				</div>


        <? } */?>

	
	
	
	
	
	
	
	
	<?global $APPLICATION;?>
	<?$BASE_PRICE = CCatalogGroup::GetBaseGroup();?>
	<?$arSortFields = array(
		"SHOWS" => array(
			"ORDER"=> "DESC",
			"CODE" => "SHOWS",
			"NAME" => GetMessage("CATALOG_SORT_FIELD_SHOWS")
		),	
		"NAME" => array( // параметр в url
			"ORDER"=> "ASC", //в возрастающем порядке
			"CODE" => "NAME", // Код поля для сортировки
			"NAME" => GetMessage("CATALOG_SORT_FIELD_NAME") // имя для вывода в публичной части, редактировать в (/lang/ru/section.php)
		),
		"PRICE_ASC"=> array(
			"ORDER"=> "ASC",
			"CODE" => "PROPERTY_MINIMUM_PRICE",  // изменен для сортировки по ТП
			"NAME" => GetMessage("CATALOG_SORT_FIELD_PRICE_ASC")
		),
		"PRICE_DESC" => array(
			"ORDER"=> "DESC",
			"CODE" => "PROPERTY_MAXIMUM_PRICE", // изменен для сортировки по ТП
			"NAME" => GetMessage("CATALOG_SORT_FIELD_PRICE_DESC")
		)
	);?>

	<?
	$rsMinPriceProperty = CIBlock::GetProperties($arParams["IBLOCK_ID"], Array(), Array("CODE" => "MINIMUM_PRICE"));
	if($rsMinPriceProperty->SelectedRowsCount() != 1){
		$arSortFields["PRICE_ASC"] = array(
			"ORDER"=> "ASC",
			"CODE" => "CATALOG_PRICE_".$BASE_PRICE["ID"],
			"NAME" => GetMessage("CATALOG_SORT_FIELD_PRICE_ASC")
		);
		$arSortFields["PRICE_DESC"] = array(
			"ORDER"=> "DESC",
			"CODE" => "CATALOG_PRICE_".$BASE_PRICE["ID"],
			"NAME" => GetMessage("CATALOG_SORT_FIELD_PRICE_DESC")
		);
	}
	?>

	<?if(!empty($_REQUEST["SORT_FIELD"]) && !empty($arSortFields[$_REQUEST["SORT_FIELD"]])){

		setcookie("CATALOG_SORT_FIELD", $_REQUEST["SORT_FIELD"], time() + 60 * 60 * 24 * 30 * 12 * 2, "/");

		$arParams["ELEMENT_SORT_FIELD"] = $arSortFields[$_REQUEST["SORT_FIELD"]]["CODE"];
		$arParams["ELEMENT_SORT_ORDER"] = $arSortFields[$_REQUEST["SORT_FIELD"]]["ORDER"];	

		$arSortFields[$_REQUEST["SORT_FIELD"]]["SELECTED"] = "Y";

	}elseif(!empty($_COOKIE["CATALOG_SORT_FIELD"]) && !empty($arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]])){ // COOKIE
		
		$arParams["ELEMENT_SORT_FIELD"] = $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["CODE"];
		$arParams["ELEMENT_SORT_ORDER"] = $arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["ORDER"];
		
		$arSortFields[$_COOKIE["CATALOG_SORT_FIELD"]]["SELECTED"] = "Y";
	}
	?>

	<?$arSortProductNumber = array(
		30 => array("NAME" => 30), 
		60 => array("NAME" => 60), 
		90 => array("NAME" => 90)
	);?>

	<?if(!empty($_REQUEST["SORT_TO"]) && $arSortProductNumber[$_REQUEST["SORT_TO"]]){
		setcookie("CATALOG_SORT_TO", $_REQUEST["SORT_TO"], time() + 60 * 60 * 24 * 30 * 12 * 2, "/");
		$arSortProductNumber[$_REQUEST["SORT_TO"]]["SELECTED"] = "Y";
		$arParams["PAGE_ELEMENT_COUNT"] = $_REQUEST["SORT_TO"];
	}elseif (!empty($_COOKIE["CATALOG_SORT_TO"]) && $arSortProductNumber[$_COOKIE["CATALOG_SORT_TO"]]){
		$arSortProductNumber[$_COOKIE["CATALOG_SORT_TO"]]["SELECTED"] = "Y";
		$arParams["PAGE_ELEMENT_COUNT"] = $_COOKIE["CATALOG_SORT_TO"];
	}?>

	<?$arTemplates = array(
		"SQUARES" => array(
			"CLASS" => "squares"
		),
		"LINE" => array(
			"CLASS" => "line"
		),
		"TABLE" => array(
			"CLASS" => "table"
		)	
	);?>

	<?if(!empty($_REQUEST["VIEW"]) && $arTemplates[$_REQUEST["VIEW"]]){
		setcookie("CATALOG_VIEW", $_REQUEST["VIEW"], time() + 60 * 60 * 24 * 30 * 12 * 2);
		$arTemplates[$_REQUEST["VIEW"]]["SELECTED"] = "Y";
		$arParams["CATALOG_TEMPLATE"] = $_REQUEST["VIEW"];
	}elseif (!empty($_COOKIE["CATALOG_VIEW"]) && $arTemplates[$_COOKIE["CATALOG_VIEW"]]){
		$arTemplates[$_COOKIE["CATALOG_VIEW"]]["SELECTED"] = "Y";
		$arParams["CATALOG_TEMPLATE"] = $_COOKIE["CATALOG_VIEW"];
	}else{
		$arTemplates[key($arTemplates)]["SELECTED"] = "Y";
	}
	?>

	<?$APPLICATION->IncludeComponent("dresscode:slider", "middle", array(
		"IBLOCK_TYPE" => "sliders",
		"IBLOCK_ID" => "28",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "3600000",
		"PICTURE_WIDTH" => "1480",
		"PICTURE_HEIGHT" => "202",
		"COMPONENT_TEMPLATE" => "middle"
	),
	false,
	array(
	"ACTIVE_COMPONENT" => "N"
	)
);?>
	<div id="catalog">
		<?$APPLICATION->IncludeComponent(
			"bitrix:catalog.section.list",
			"catalog-pictures",
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"COUNT_ELEMENTS" => $arParams["SECTION_COUNT_ELEMENTS"],
				"TOP_DEPTH" => 1,
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"VIEW_MODE" => $arParams["SECTIONS_VIEW_MODE"],
				"SHOW_PARENT_NAME" => $arParams["SECTIONS_SHOW_PARENT_NAME"],
				"HIDE_SECTION_NAME" => (isset($arParams["SECTIONS_HIDE_SECTION_NAME"]) ? $arParams["SECTIONS_HIDE_SECTION_NAME"] : "N"),
				"ADD_SECTIONS_CHAIN" => "N"
			),
			$component
		);?>
		<noindex>
			<script>
				
				$('.relink').click(function(){
	$('.leftColumn').tooggleClass('active');
	$('#smartFilter').attr('top',$('.relink').outerHeight(true)); 
	
});
				</script> 
		<div id="catalogLine">
			<?if(!empty($arSortFields)):  //<div class="column mobile__filter">Фильтр</div>
			?>
			
				<div class="column">
					<div class="label sort">
						<?=GetMessage("CATALOG_SORT_LABEL");?>
					</div>
					
					<?if($_GET['price']=='DESC'):?><a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("price=ASC", array("price","reiting"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png" /> По цене</a><?else:?>
					<a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("price=DESC", array("price","reiting"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png" />По цене</a><?endif;?>
					
						<?if($_GET['reiting']=='ASC'):?>
						<a title="По убыванию"href="<?=$APPLICATION->GetCurPageParam("reiting=DESC", array("price","reiting"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png" /> По рейтингу</a>
					<?else:?>
					<a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("reiting=ASC", array("price","reiting"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png" />По рейтингу</a>
				<?endif;?>
					
				</div>
			<?endif;?>
			<?if(!empty($arSortProductNumber)):?>
				<div class="column">
					<div class="label">
						Показывать:
					</div>
					<select name="countElements" id="selectCountElements">
						<?foreach ($arSortProductNumber as $arSortNumberElementId => $arSortNumberElement):?>
							<option value="<?=$APPLICATION->GetCurPageParam("SORT_TO=".$arSortNumberElementId, array("SORT_TO"));?>"<?if($arSortNumberElement["SELECTED"] == "Y"):?> selected<?endif;?>><?=$arSortNumberElement["NAME"]?> моделей</option>
						<?endforeach;?>
					</select>
				</div>
			<?endif;?>
		
		</div>
		</noindex>
		<?reset($arTemplates);?>
	
		<?
		
		if($_GET['price']||$_GET['reiting']) $sort=($_GET['price'])? $_GET['price']:$_GET['reiting']; else $sort="DESC";

			if($_GET['price']){
				$SORT_FIELD = "catalog_PRICE_1";
			}elseif($_GET['reiting']){
				$SORT_FIELD = "shows";
			}else{
				$SORT_FIELD = "sort";
			}
	
		 $mm =	$APPLICATION->IncludeComponent(
			"bitrix:catalog.section",
			 'squares_new',
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
				"ELEMENT_SORT_FIELD" => $SORT_FIELD,
				"ELEMENT_SORT_ORDER" => $sort  ,
				"ELEMENT_SORT_FIELD2" => "ID",
				"ELEMENT_SORT_ORDER2" =>  'ASC' ,
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
				"META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
				"META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
				"BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
				"INCLUDE_SUBSECTIONS" => $arParams["INCLUDE_SUBSECTIONS"],
				"BASKET_URL" => $arParams["BASKET_URL"],
				"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
				"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
				"SECTION_ID_VARIABLE" => $arParams["SECTION_ID_VARIABLE"],
				"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
				"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
				"FILTER_NAME" => $arParams["FILTER_NAME"],
				"CACHE_TYPE" => $arParams["CACHE_TYPE"],
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"CACHE_FILTER" => $arParams["CACHE_FILTER"],
				"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"SET_STATUS_404" => $arParams["SET_STATUS_404"],
				"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
				"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
				"LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
				"PRICE_CODE" => $arParams["PRICE_CODE"],
				"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
				"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],

				"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
				"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
				"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
				"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
				"PRODUCT_PROPERTIES" => $arParams["PRODUCT_PROPERTIES"],

				"DISPLAY_TOP_PAGER" => $arParams["DISPLAY_TOP_PAGER"],
				"DISPLAY_BOTTOM_PAGER" => $arParams["DISPLAY_BOTTOM_PAGER"],
				"PAGER_TITLE" => $arParams["PAGER_TITLE"],
				"PAGER_SHOW_ALWAYS" => $arParams["PAGER_SHOW_ALWAYS"],
				"PAGER_TEMPLATE" => 'new', 
				"PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
				"PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
				"PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],

				"OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
				"OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
				"OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
				"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
				"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
				"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
				"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
				"OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

				"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
				"SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
				"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
				"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
				'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
				'CURRENCY_ID' => $arParams['CURRENCY_ID'],
				'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],

				'LABEL_PROP' => $arParams['LABEL_PROP'],
				'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
				'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],

				'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
				'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
				'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
				'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
				'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
				'MESS_BTN_BUY' => $arParams['MESS_BTN_BUY'],
				'MESS_BTN_ADD_TO_BASKET' => $arParams['MESS_BTN_ADD_TO_BASKET'],
				'MESS_BTN_SUBSCRIBE' => $arParams['MESS_BTN_SUBSCRIBE'],
				'MESS_BTN_DETAIL' => $arParams['MESS_BTN_DETAIL'],
				'MESS_NOT_AVAILABLE' => $arParams['MESS_NOT_AVAILABLE'],

				"USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
				'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

				'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
				"HIDE_MEASURES" => $arParams["HIDE_MEASURES"],
				"ADD_SECTIONS_CHAIN" => "N"
			),
			$component
			);
		 
		 ?>
			
		</div>
	</div>
</div>
</div>

</div>
<? $APPLICATION->ShowViewContent('section_description'); ?>
<div class="why__listing">
	<div class="wrapper">
		<h3 class="heading">Почему стоит обратиться к нам</h3>
		<div class="info__txt">Мы ценим ваше время и деньги</div>
		<div class="all__why">

			<div class="s__why s__why__001">
				<div class="icon__why"><img src="/bitrix/templates/dresscodeV2_new/images/ND/we001.png"></div>
				<div class="heading__why">Бесплатный тест-драйв</div>
				<div class="info__why">Бесплатный тест-драйв оборудования в демонстрационных залах Москвы</div>
			</div>

			<div class="s__why s__why__002">
				<div class="icon__why"><img src="/bitrix/templates/dresscodeV2_new/images/ND/we002.png"></div>
				<div class="heading__why">Доставка за 1 день</div>
				<div class="info__why">Экспресс-доставка и сборка по Москве и области в день заказа</div>
			</div>

			<div class="s__why s__why__003">
				<div class="icon__why"><img src="/bitrix/templates/dresscodeV2_new/images/ND/we003.png"></div>
				<div class="heading__why">Бесплатная гарантия до 5 лет</div>
				<div class="info__why">Расширенное гарантийное обслуживание в сервисных центрах компании</div>
			</div>

			<div class="s__why s__why__004">
				<div class="icon__why"><img src="/bitrix/templates/dresscodeV2_new/images/ND/we004.png"></div>
				<div class="heading__why">Покупка в рассрочку</div>
				<div class="info__why">Оплата покупки с помощью рассрочки от 0% до 12 месяцев</div>
			</div>

		</div>
	</div>
</div>