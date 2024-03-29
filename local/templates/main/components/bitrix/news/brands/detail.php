<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);
?>
<?global $APPLICATION;?>
<?
if(!empty($arResult["VARIABLES"]["ELEMENT_CODE"])){
	$arSelect = Array("ID", "IBLOCK_ID", "NAME", "DETAIL_TEXT", "DETAIL_PICTURE", "SECTION_PAGE_URL");
	$arFilter = Array("IBLOCK_ID" => IntVal($arParams["IBLOCK_ID"]), "CODE" => $arResult["VARIABLES"]["ELEMENT_CODE"], "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
	$res = CIBlockElement::GetList(Array(), $arFilter, false, false, $arSelect);
	if($ob = $res->GetNextElement()){
		$arResult["ITEM"] = $ob->GetFields(); 
		$ELEMENT_ID = $arResult["ITEM"]["ID"];
		$ELEMENT_NAME = $arResult["ITEM"]["NAME"];
		$arFields["ITEM"] = $ob->GetProperties();		
	}
	
	
	
}
?>
<?
if(CModule::IncludeModule("iblock")){
	if(!empty($ELEMENT_ID)){
		$ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues(
		    $arParams["IBLOCK_ID"],
		    $ELEMENT_ID
		);
		if($arSeoProp = $ipropValues->getValues()){
			$APPLICATION->SetPageProperty("description", $arSeoProp["ELEMENT_META_DESCRIPTION"]);
			$APPLICATION->SetPageProperty("keywords", $arSeoProp["ELEMENT_META_KEYWORDS"]);
			$APPLICATION->SetTitle($arSeoProp["ELEMENT_META_TITLE"]);
		}else{
			$APPLICATION->AddChainItem($ELEMENT_NAME);
			$APPLICATION->SetTitle($ELEMENT_NAME);
		}
	}
}
?>

<?if(!empty($ELEMENT_ID)):?>

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
			$rsMinPriceProperty = CIBlock::GetProperties($arParams["PRODUCT_IBLOCK_ID"], Array(), Array("CODE" => "MINIMUM_PRICE"));
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


	<?$BIG_PICTURE = CFile::ResizeImageGet($arResult["ITEM"]["DETAIL_PICTURE"], array("width" => 150, "height" => 250), BX_RESIZE_IMAGE_PROPORTIONAL, false);?>

<?php if (isset($arResult['ITEM']['NAME']) && !empty($arResult['ITEM']['NAME'])) { ?>
		<!--h1><?=$arResult['ITEM']['NAME']?></h1-->
		
	<?php }	?>
	
	
	
	
	<?if ($arFields["ITEM"]["TITLE_BRAND_PIC"]["VALUE"] === "Да"):?>		
		<div class="brandsBigPicture"><img src="<?=$BIG_PICTURE["src"]?>" alt="<?=$arResult["ITEM"]["NAME"]?>"></div>
	<?endif;?>

	<?if(!empty($arResult["ITEM"]["DETAIL_TEXT"])):?>
		<div class="brandsDescription"><?=$arResult["ITEM"]["DETAIL_TEXT"]?></div>
	<?endif;?>
	
	<div class="backToList_button">
	<a href="<?=$arResult["FOLDER"]?>" class="backToList"><?=GetMessage("BACK_TO_LIST_PAGE")?></a>
	</div>


	<? if ($arFields["ITEM"]["BRAND_GOODS_URL"]["VALUE"]):?>
	<div class="brand_goods_button">
	<a href="<?=$arFields["ITEM"]["BRAND_GOODS_URL"]["VALUE"];?>" class="brand_goods">
	<svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 0C5.07449 0 1.672 2.2351 0 5.5C1.672 8.7649 5.07449 11 9 11C12.9254 11 16.3279 8.7649 18 5.5C16.328 2.2351 12.9254 0 9 0ZM13.4376 2.91679C14.4952 3.57634 15.3913 4.45978 16.0644 5.5C15.3913 6.54022 14.4951 7.42366 13.4376 8.08321C12.1088 8.91196 10.5743 9.35 9 9.35C7.4257 9.35 5.8912 8.91196 4.5624 8.08321C3.5049 7.42362 2.60877 6.54019 1.93563 5.5C2.60873 4.45974 3.5049 3.57631 4.5624 2.91679C4.63127 2.87382 4.70085 2.83219 4.77084 2.79132C4.5958 3.26102 4.5 3.76795 4.5 4.29688C4.5 6.72688 6.51473 8.69687 9 8.69687C11.4852 8.69687 13.5 6.72688 13.5 4.29688C13.5 3.76795 13.4042 3.26102 13.2292 2.79128C13.2991 2.83216 13.3687 2.87382 13.4376 2.91679ZM9 3.74687C9 4.65816 8.24449 5.39687 7.3125 5.39687C6.38051 5.39687 5.625 4.65816 5.625 3.74687C5.625 2.83559 6.38051 2.09687 7.3125 2.09687C8.24449 2.09687 9 2.83559 9 3.74687Z" fill="#0A5A77"/>
                </svg>
	Товары бренда</a>
	</div>
	<?endif; ?>

	
	<?
			global $arrFilter;
			$arrFilter["PROPERTY_ATT_BRAND"] = $ELEMENT_ID;
			$countElements = CIBlockElement::GetList(array(), $arrFilter, array(), false);
	?>
		<?if($countElements > 1){

			$arSections = array();
			$arResult["MENU_SECTIONS"] = array();
			$arFilter["SECTION_ID"] = array();
			
			$res = CIBlockElement::GetList(array("NAME" => "ASC"), $arrFilter, false, false, array("ID"));
			while($nextElement = $res->GetNext()){
				$resGroup = CIBlockElement::GetElementGroups($nextElement["ID"], false);
				while($arGroup = $resGroup->Fetch()){
				    $IBLOCK_SECTION_ID = $arGroup["ID"];
					$arSections[$IBLOCK_SECTION_ID] = $IBLOCK_SECTION_ID;
					$arSectionCount[$IBLOCK_SECTION_ID] = !empty($arSectionCount[$IBLOCK_SECTION_ID]) ? $arSectionCount[$IBLOCK_SECTION_ID] + 1 : 1;
				}

				$arResult["ITEMS"][] = $nextElement;
			}

			if(!empty($arSections)){
				$arFilter = array("ID" => $arSections);
				$rsSections = CIBlockSection::GetList(array("NAME" => "ASC"), $arFilter);
				while ($arSection = $rsSections->Fetch()){
					$searchParam = "SECTION_ID=".$arSection["ID"];
					$searchID = intval($_GET["SECTION_ID"]);
					$arSection["SELECTED"] = $arSection["ID"] == $searchID ? Y : N;
					$arSection["FILTER_LINK"] = $APPLICATION->GetCurPageParam($searchParam , array("SECTION_ID"));
					$arSection["ELEMENTS_COUNT"] = $arSectionCount[$arSection["ID"]];
					array_push($arResult["MENU_SECTIONS"], $arSection);
				}
			}

		}?>

		<?
			$OPTION_CURRENCY  = CCurrency::GetBaseCurrency();
		?>

<?/*
	<?if($countElements > 0):?>
		<div id="catalog">
		<h1 class="brandsHeading"><?if(!empty($arSeoProp["ELEMENT_PAGE_TITLE"])):?><?=$arSeoProp["ELEMENT_PAGE_TITLE"]?><?else:?><?=GetMessage("CATALOG_TITLE")?><?=$ELEMENT_NAME?><?endif;?></h1>
			<?if($countElements > 1):?>
				<div id="catalogColumn">
					<div class="leftColumn">
						<?if(!empty($arResult["MENU_SECTIONS"]) && count($arResult["MENU_SECTIONS"]) > 1):?>
							<div id="nextSection">
								<span class="title"><?=GetMessage("SELECT_CATEGORY");?></span>
								<ul>
									<?foreach ($arResult["MENU_SECTIONS"] as $ic => $arSection):?>
										<li><a href="<?=$arSection["FILTER_LINK"]?>"<?if($arSection["SELECTED"] == Y):?> class="selected"<?endif;?>><?=$arSection["NAME"]?> (<?=$arSection["ELEMENTS_COUNT"]?>)</a></li>
									<?endforeach;?>
								</ul>
							</div>
						<?endif;?>
						<?$APPLICATION->IncludeComponent(
	"dresscode:cast.smart.filter", 
	".default", 
	array(
		"IBLOCK_TYPE" => $arParams["PRODUCT_IBLOCK_TYPE"],
		"IBLOCK_ID" => $arParams["PRODUCT_IBLOCK_ID"],
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"FILTER_NAME" => $arParams["PRODUCT_FILTER_NAME"],
		"HIDE_NOT_AVAILABLE" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"CACHE_TYPE" => "N",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SAVE_IN_SESSION" => "N",
		"INSTANT_RELOAD" => "N",
		"PRICE_CODE" => array(
		),
		"XML_EXPORT" => "N",
		"SECTION_TITLE" => "-",
		"SECTION_DESCRIPTION" => "-",
		"CONVERT_CURRENCY" => "N",
		"FILTER_BRAND_ID" => $ELEMENT_ID,
		"CURRENCY_ID" => $OPTION_CURRENCY,
		"COMPONENT_TEMPLATE" => ".default",
		"SECTION_CODE" => "",
		"SEF_MODE" => "N",
		"PAGER_PARAMS_NAME" => "arrPager",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
					</div>
				<?endif;?>	
				<?if($countElements > 1):?>
					<div class="rightColumn">
				<?endif;?>
					<div id="catalogLine">
						<?if(!empty($arSortFields)):?>
							<div class="column">
								<div class="label">
									<?=GetMessage("CATALOG_SORT_LABEL");?>
								</div>
								<select name="sortFields" id="selectSortParams">
									<?foreach ($arSortFields as $arSortFieldCode => $arSortField):?>
										<option value="<?=$APPLICATION->GetCurPageParam("SORT_FIELD=".$arSortFieldCode, array("SORT_FIELD"));?>"<?if($arSortField["SELECTED"] == "Y"):?> selected<?endif;?>><?=$arSortField["NAME"]?></option>
									<?endforeach;?>
								</select>
							</div>
						<?endif;?>
						<?if(!empty($arSortProductNumber)):?>
							<div class="column">
								<div class="label">
									<?=GetMessage("CATALOG_SORT_TO_LABEL");?>
								</div>
								<select name="countElements" id="selectCountElements">
									<?foreach ($arSortProductNumber as $arSortNumberElementId => $arSortNumberElement):?>
										<option value="<?=$APPLICATION->GetCurPageParam("SORT_TO=".$arSortNumberElementId, array("SORT_TO"));?>"<?if($arSortNumberElement["SELECTED"] == "Y"):?> selected<?endif;?>><?=$arSortNumberElement["NAME"]?></option>
									<?endforeach;?>
								</select>
							</div>
						<?endif;?>
						<?if(!empty($arTemplates)):?>
							<div class="column">
								<div class="label">
									<?=GetMessage("CATALOG_VIEW_LABEL");?>
								</div>
								<div class="viewList">
									<?foreach ($arTemplates as $arTemplatesCode => $arNextTemplate):?>
										<div class="element"><a<?if($arNextTemplate["SELECTED"] != "Y"):?> href="<?=$APPLICATION->GetCurPageParam("VIEW=".$arTemplatesCode, array("VIEW"));?>"<?endif;?> class="<?=$arNextTemplate["CLASS"]?><?if($arNextTemplate["SELECTED"] == "Y"):?> selected<?endif;?>"></a></div>
									<?endforeach;?>
								</div>
							</div>
						<?endif;?>
					</div>
					<?
						reset($arTemplates);
					?>

					<?
						global $arrFilter;
						unset($arrFilter["FACET_OPTIONS"]);
					?>

					<?$arrFilter["FACET_OPTIONS"] = array();?>

					<?$APPLICATION->IncludeComponent(
						"bitrix:catalog.section",
						 !empty($arParams["CATALOG_TEMPLATE"]) ? strtolower($arParams["CATALOG_TEMPLATE"]) : strtolower(key($arTemplates)),
						array(
							"IBLOCK_TYPE" => $arParams["PRODUCT_IBLOCK_TYPE"],
							"IBLOCK_ID" => $arParams["PRODUCT_IBLOCK_ID"],
							"ELEMENT_SORT_FIELD" => $arParams["ELEMENT_SORT_FIELD"],
							"ELEMENT_SORT_ORDER" => $arParams["ELEMENT_SORT_ORDER"],
							"INCLUDE_SUBSECTIONS" => "Y",
							"FILTER_NAME" => $arParams["PRODUCT_FILTER_NAME"],
							"PRICE_CODE" => $arParams["PRODUCT_PRICE_CODE"],
							"PROPERTY_CODE" => $arParams["PRODUCT_PROPERTY_CODE"],
							"PAGER_TEMPLATE" => "round",
							"PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
							'CONVERT_CURRENCY' => $arParams['PRODUCT_CONVERT_CURRENCY'],
							'CURRENCY_ID' => $arParams['PRODUCT_CURRENCY_ID'],
							"HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE"],
							"HIDE_MEASURES" => $arParams["HIDE_MEASURES"],
							"SECTION_ID" => $_REQUEST["SECTION_ID"],
							"SHOW_ALL_WO_SECTION" => "Y",
							"ADD_SECTIONS_CHAIN" => "N",
							"AJAX_MODE" => "Y"
						),
						$component
					);?>
				<?if($countElements > 1):?>
					</div>
				</div>
			<?endif;?>
		</div>
	<?else:?>
		<style>
			.backToList{
				display: inline-block;
				margin-bottom: 24px;
				float: none;
			}
		</style>
	<?endif;?>
*/?>

<?else:?>

	<?
		if (!defined("ERROR_404"))
		   define("ERROR_404", "Y");

		\CHTTP::setStatus("404 Not Found");

		if ($APPLICATION->RestartWorkarea()) {
		   require(\Bitrix\Main\Application::getDocumentRoot()."/404.php");
		   die();
		}
	?>

<?endif;?>