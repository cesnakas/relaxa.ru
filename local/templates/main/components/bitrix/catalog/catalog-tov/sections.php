<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

<?
global $titleNew;
$res = CIBlockSection::GetByID($arResult['VARIABLES']['SECTION_ID']);
if($ar_res = $res->GetNext()) {
    $titleNew = $ar_res['NAME'];
}
?>

<?
global $elSectVisible;
$arORDER = Array("SORT"=>"ASC");
$arFILTER = Array(
    "SECTION_ID" =>  $arResult["VARIABLES"]["SECTION_ID"],
    "IBLOCK_ID"=> $arParams["IBLOCK_ID"],
);
$blocklist = CIBlockSection::GetList($arORDER, $arFILTER, false);
while($ar_result = $blocklist->GetNext()) {
    $elSectVisible[] = $ar_result['NAME'];
}
?>
<?
$backPath = '';
$path = $APPLICATION->GetCurPage();
$path = explode('/', $path);
$path = array_filter($path);
$countI = 1;
$countEl = count($path);

foreach($path as $pt) {
    if($countI == $countEl) {

    } else {
        $backPath.= $pt . '/';
    }
    $countI++;
}
?>
<?global $ar_res;?>
<?$res = CIBlock::GetByID($arParams["IBLOCK_ID"]);?>
<?if($ar_res = $res->GetNext()){?><?}?>



<div class="mob-show">
    <div class="catpanel">
        <div class="catpanel__wrapper">
            <div class="catpanel__top">
                <a href="/<?=$backPath?>" class="catpanel__back">
                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.939341 13.0607C0.353554 12.4749 0.353554 11.5251 0.939341 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.939341 13.0607ZM20 13.5L2 13.5V10.5L20 10.5V13.5Z" fill="#0A5A77"></path>
                    </svg>
                </a>
                <?if(count($elSectVisible) > 0) {?>
                    <a href="#" class="catpanel__title">
                        <?if(!empty($ar_res['NAME'])):?><?=$ar_res['NAME']?><?else:?><?=$titleNew?><?endif;?>
                        <svg width="19" height="11" viewBox="0 0 19 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.3002 0.600074L0.500195 9.40007C0.100195 9.70007 0.100195 10.3001 0.500195 10.6001C0.800195 10.9001 1.4002 10.9001 1.7002 10.6001L9.3002 3.00007L16.9002 10.6001C17.2002 10.9001 17.8002 10.9001 18.1002 10.6001C18.4002 10.3001 18.4002 9.70007 18.1002 9.40007L9.3002 0.600074Z" fill="#0A5A77"/>
                        </svg>
                    </a>
                <?} else {?>
                    <p class="catpanel__title" style="padding-right: 0;">
                        <?if(!empty($ar_res['NAME'])):?><?=$ar_res['NAME']?><?else:?><?=$titleNew?><?endif;?>
                    </p>
                <?}?>
            </div>
            <?if(count($elSectVisible) > 0) {?>
                <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.section.list",
                    "relink_new_mob",
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
            <?}?>
        </div>
    </div>
</div>

<div class="toppanel">
    <div class="toppanel__wrapper">
        <div class="toppanel__filter-wp">
            <a href="#" class="toppanel__filter">
                Фильтровать
                <i></i>
            </a>
        </div>
        <div class="toppanel__sort-wp">
            <a href="#" class="toppanel__sort">
                Сортировать
                <i></i>
            </a>
            <ul class="toppanel__sort-list" style="display: none;">
                <li class="toppanel__sort-item">
                    <?if($_GET['price']=='DESC') {?>
                        <a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("price=DESC", array("price","reiting"));?>" class="toppanel__sort-link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png">
                            Цена
                        </a>
                    <?} else {?>
                        <a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("price=ASC", array("price","reiting"));?>" class="toppanel__sort-link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png">
                            Цена
                        </a>
                    <?}?>
                </li>
                <li class="toppanel__sort-item">
                    <?if($_GET['news']=='DESC') {?>
                        <a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("news=ASC", array("price","news"));?>" class="toppanel__sort-link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png">
                            Новизна
                        </a>
                    <?} else {?>
                        <a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("price=DESC", array("price","news"));?>" class="toppanel__sort-link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png">
                            Новизна
                        </a>
                    <?}?>
                </li>
                <li class="toppanel__sort-item">
                    <?if($_GET['reiting']=='ASC') {?>
                        <a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("news=ASC", array("price","reiting"));?>" class="toppanel__sort-link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png">
                            Рейтинг
                        </a>
                    <?} else {?>
                        <a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("price=DESC", array("price","reiting"));?>" class="toppanel__sort-link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png">
                            Рейтинг
                        </a>
                    <?}?>
                </li>
                <li class="toppanel__sort-item">
                    <?if($_GET['popular']=='DESC') {?>
                        <a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("news=ASC", array("price","popular"));?>" class="toppanel__sort-link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png">
                            Популярность
                        </a>
                    <?} else {?>
                        <a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("price=DESC", array("price","popular"));?>" class="toppanel__sort-link">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png">
                            Популярность
                        </a>
                    <?}?>
                </li>
            </ul>
        </div>
        <ul class="toppanel__vid">
            <li class="toppanel__viditem">
                <a href="<?=$APPLICATION->GetCurPage()?>" class="toppanel__vidlink toppanel__vidlink-standart">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.7998 0.800049H17.2998C18.3998 0.800049 19.2998 1.70005 19.2998 2.80005V17.3C19.2998 18.4 18.3998 19.3 17.2998 19.3H2.7998C1.6998 19.3 0.799805 18.4 0.799805 17.3V2.80005C0.799805 1.60005 1.5998 0.800049 2.7998 0.800049Z" fill="white" stroke="#D8D8D8" stroke-miterlimit="10"/>
                        <path d="M15.5 4.09998H4.5V16.1H15.5V4.09998Z" fill="#828282" stroke="#D8D8D8" stroke-miterlimit="10"/>
                    </svg>
                </a>
            </li>
            <li class="toppanel__viditem">
                <a href="<?=$APPLICATION->GetCurPage()?>?vid=2" class="toppanel__vidlink toppanel__vidlink-two">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M2.7002 0.800049H17.2002C18.3002 0.800049 19.2002 1.70005 19.2002 2.80005V17.3C19.2002 18.4 18.3002 19.3 17.2002 19.3H2.7002C1.6002 19.3 0.700195 18.4 0.700195 17.3V2.80005C0.700195 1.60005 1.6002 0.800049 2.7002 0.800049Z" fill="white" stroke="#D8D8D8" stroke-miterlimit="10"/>
                        <path d="M9.1001 2.80005H3.1001V9.00005H9.1001V2.80005Z" fill="#828282" stroke="#D8D8D8" stroke-miterlimit="10"/>
                        <path d="M16.8999 2.80005H10.8999V9.00005H16.8999V2.80005Z" fill="#828282" stroke="#D8D8D8" stroke-miterlimit="10"/>
                        <path d="M9 10.8H3V17H9V10.8Z" fill="#828282" stroke="#D8D8D8" stroke-miterlimit="10"/>
                        <path d="M16.8999 10.8H10.8999V17H16.8999V10.8Z" fill="#828282" stroke="#D8D8D8" stroke-miterlimit="10"/>
                    </svg>
                </a>
            </li>
        </ul>
    </div>
</div>

<div class="wrapper">
<div id="catalogColumn_new">

	<div class="leftColumn">


<?$APPLICATION->IncludeComponent(
    "dresscode:cast.smart.filter",
    "new-parent",
    array(
        "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "N",
        "COMPONENT_TEMPLATE" => "new",
        "CONVERT_CURRENCY" => "Y",
        "CURRENCY_ID" => "RUB",
        "FILTER_NAME" => "arrFilter",
        "HIDE_NOT_AVAILABLE" => "Y",
        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "IBLOCK_TYPE" => "catalog",
        "PAGER_PARAMS_NAME" => "arrPager",
        "PAGER_TEMPLATE" => "round",
        "PRICE_CODE" => array(
            0 => "Розничная",
        ),
        "SAVE_IN_SESSION" => "Y",
        "SECTION_CODE" => "",
        "SECTION_DESCRIPTION" => "-",
        "SECTION_ID" => $arCurSection["ID"],
        "SECTION_TITLE" => "-",
        "SEF_MODE" => "N",
        "XML_EXPORT" => "N",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
);?>

<?/*$APPLICATION->IncludeComponent(
    "safrasoft:catalog.smart.filter",
    "filt-fu",
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
);*/?>

</div>

	<div class="rightColumn">
        <div class="mob-hide">

		<h1><?if(!empty($ar_res['NAME'])):?><?=$ar_res['NAME']?><?else:?><?=$titleNew?><?endif;?></h1>
            <?if(count($elSectVisible) > 0) {?>
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
            <?}?>
        </div>
			
			
		
      








       

	
	
	
	
	
	
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
	<div id="catalog"<?if($_GET['vid'] == "2") {?> class="row2vid"<?}?>>
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
			<?if(!empty($arSortFields)):
				//<div class="column mobile__filter">Фильтр</div>
			?>
		
				<div class="column">
					<div class="label sort">
						Сортировать по:
					</div>
					
			<?if($_GET['price']=='DESC'):?><a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("price=ASC", array("price","reiting"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png" /> По цене</a><?else:?>
					<a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("price=DESC", array("price","reiting"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png" />По цене</a><?endif;?>
					
					<?if($_GET['reiting']=='ASC'):?>
						<a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("reiting=DESC", array("price","reiting"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png" /> По рейтингу</a>
					<?else:?>
					<a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("reiting=ASC", array("price","reiting"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png" />По рейтингу</a>
				<?endif;?>

                    <!-- По новизне -->
                    <?if($_GET['news']=='DESC') {?>
                        <a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("news=ASC", array("price","news"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png" /> По новизне</a>
                    <?} else {?>
                        <a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("news=DESC", array("price","news"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png" />По новизне</a>
                    <?}?>

                    <!-- По популярности -->
                    <?if($_GET['popular']=='DESC') {?>
                        <a title="По возрастанию" href="<?=$APPLICATION->GetCurPageParam("popular=ASC", array("price","popular"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortup.png" /> По популярности</a>
                    <?} else {?>
                        <a title="По убыванию" href="<?=$APPLICATION->GetCurPageParam("popular=DESC", array("price","popular"));?>" ><img src="<?=SITE_TEMPLATE_PATH?>/images/new/sortdown.png" />По популярности</a>
                    <?}?>

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

        global $sortNew;

        $sortNew['ELEMENT_SORT_FIELD'] = "sort"; // property_RATING
        $sortNew['ELEMENT_SORT_ORDER'] = "DESC";

            if(!empty($_GET['price'])) {
                if($_GET['price'] == "ASC") {
                    $sortNew['ELEMENT_SORT_FIELD'] = "catalog_PRICE_1";
                    $sortNew['ELEMENT_SORT_ORDER'] = "ASC";
                } else {
                    $sortNew['ELEMENT_SORT_FIELD'] = "catalog_PRICE_1";
                    $sortNew['ELEMENT_SORT_ORDER'] = "DESC";
                }
            }
            if(!empty($_GET['reiting'])) {
                if($_GET['reiting'] == "ASC") {
                    $sortNew['ELEMENT_SORT_FIELD'] = "sort"; // property_RATING
                    $sortNew['ELEMENT_SORT_ORDER'] = "ASC";
                } else {
                    $sortNew['ELEMENT_SORT_FIELD'] = "sort"; // property_RATING
                    $sortNew['ELEMENT_SORT_ORDER'] = "DESC";
                }
            }
            if(!empty($_GET['news'])) {
                if($_GET['news'] == "ASC") {
                    $sortNew['ELEMENT_SORT_FIELD'] = "active_to";
                    $sortNew['ELEMENT_SORT_ORDER'] = "ASC";
                } else {
                    $sortNew['ELEMENT_SORT_FIELD'] = "active_to";
                    $sortNew['ELEMENT_SORT_ORDER'] = "DESC";
                }
            }
            if(!empty($_GET['popular'])) {
                if ($_GET['popular'] == "ASC") {
                    $sortNew['ELEMENT_SORT_FIELD'] = "shows";
                    $sortNew['ELEMENT_SORT_ORDER'] = "ASC";
                } else {
                    $sortNew['ELEMENT_SORT_FIELD'] = "shows";
                    $sortNew['ELEMENT_SORT_ORDER'] = "DESC";
                }
            }

        $arSectChildren = array();
        $arFirst = array();
        $tree = CIBlockSection::GetTreeList(
            $arFilter=Array('IBLOCK_ID' => $arParams["IBLOCK_ID"]),
            $arSelect=Array()
        );
        while($section = $tree->GetNext()) {
            if($arResult["VARIABLES"]["SECTION_ID"] == $section['IBLOCK_SECTION_ID']) {
                $arSectChildren[] = $section['ID'];
            }
        }
        $arSelectAction = Array("ID", "NAME", "IBLOCK_SECTION_ID", "PROPERTY_CON_ACT");
        $arFilterAction = Array("IBLOCK_ID"=>$arParams["IBLOCK_ID"], "IBLOCK_SECTION_ID"=>$arSectChildren, "ACTIVE"=>"Y");
        $resAction = CIBlockElement::GetList(Array(), $arFilterAction, false, Array(), $arSelectAction);
        while($arFieldsAction = $resAction->Fetch())
        {
            if(!empty($arFieldsAction['PROPERTY_CON_ACT_VALUE'])) {
                $arSelectAct = Array("ID", "NAME", "IBLOCK_SECTION_ID", "SORT");
                $arFilterAct = Array("IBLOCK_ID"=>22, "ID"=>$arFieldsAction['PROPERTY_CON_ACT_VALUE'], "ACTIVE"=>"Y");
                $resAct = CIBlockElement::GetList(Array("SORT"=>"desc"), $arFilterAct, false, Array(), $arSelectAct);
                while($arFieldsAct = $resAct->Fetch()) {
                    $arFirst[] = $arFieldsAct['ID'];
                }
            }
        }

        global $actSortFilter;
        $actSortFilter = array("ID" => $arFirst);

        $APPLICATION->IncludeComponent(
	"bitrix:news.list", 
	"action-new", 
	array(
		"ACTIVE_DATE_FORMAT" => "d.m.Y",
		"ADD_SECTIONS_CHAIN" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CHECK_DATES" => "Y",
		"DETAIL_URL" => "",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"DISPLAY_DATE" => "Y",
		"DISPLAY_NAME" => "Y",
		"DISPLAY_PICTURE" => "Y",
		"DISPLAY_PREVIEW_TEXT" => "Y",
		"DISPLAY_TOP_PAGER" => "N",
		"FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"FILTER_NAME" => "actSortFilter",
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"IBLOCK_ID" => "22",
		"IBLOCK_TYPE" => "content",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"INCLUDE_SUBSECTIONS" => "Y",
		"MESSAGE_404" => "",
		"NEWS_COUNT" => "1",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => ".default",
		"PAGER_TITLE" => "Новости",
		"PARENT_SECTION" => "",
		"PARENT_SECTION_CODE" => "",
		"PREVIEW_TRUNCATE_LEN" => "",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"SET_BROWSER_TITLE" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"SET_META_DESCRIPTION" => "Y",
		"SET_META_KEYWORDS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"SHOW_404" => "N",
		"SORT_BY1" => "SORT",
		"SORT_BY2" => "SORT",
		"SORT_ORDER1" => "DESC",
		"SORT_ORDER2" => "DESC",
		"STRICT_SECTION_CHECK" => "N",
		"COMPONENT_TEMPLATE" => "action-new"
	),
	false
);


		$mm =	$APPLICATION->IncludeComponent( "bitrix:catalog.section", 'catalog-item',
			array(
				"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
				"IBLOCK_ID" => $arParams["IBLOCK_ID"],
                "ELEMENT_SORT_FIELD" => $sortNew['ELEMENT_SORT_FIELD'],
                "ELEMENT_SORT_ORDER" =>  $sortNew['ELEMENT_SORT_ORDER'],
                "ELEMENT_SORT_FIELD2" => "sort",
                "ELEMENT_SORT_ORDER2" => "desc",
				"PROPERTY_CODE" => $arParams["LIST_PROPERTY_CODE"],
                "PROPERTY_CODE_MOBILE" => $arParams["LIST_PROPERTY_CODE_MOBILE"],
                "META_KEYWORDS" => $arParams["LIST_META_KEYWORDS"],
                "META_DESCRIPTION" => $arParams["LIST_META_DESCRIPTION"],
                "BROWSER_TITLE" => $arParams["LIST_BROWSER_TITLE"],
                "SET_LAST_MODIFIED" => $arParams["SET_LAST_MODIFIED"],
                "INCLUDE_SUBSECTIONS" => 'Y',
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
                "MESSAGE_404" => $arParams["~MESSAGE_404"],
                "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                "SHOW_404" => $arParams["SHOW_404"],
                "FILE_404" => $arParams["FILE_404"],
                "DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
                "PAGE_ELEMENT_COUNT" => $arParams["PAGE_ELEMENT_COUNT"],
                "LINE_ELEMENT_COUNT" => $arParams["LINE_ELEMENT_COUNT"],
                "PRICE_CODE" => $arParams["~PRICE_CODE"],
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
                "PAGER_TEMPLATE" => $arParams["PAGER_TEMPLATE"],
                "PAGER_DESC_NUMBERING" => $arParams["PAGER_DESC_NUMBERING"],
                "PAGER_DESC_NUMBERING_CACHE_TIME" => $arParams["PAGER_DESC_NUMBERING_CACHE_TIME"],
                "PAGER_SHOW_ALL" => $arParams["PAGER_SHOW_ALL"],
                "PAGER_BASE_LINK_ENABLE" => $arParams["PAGER_BASE_LINK_ENABLE"],
                "PAGER_BASE_LINK" => $arParams["PAGER_BASE_LINK"],
                "PAGER_PARAMS_NAME" => $arParams["PAGER_PARAMS_NAME"],
                "LAZY_LOAD" => $arParams["LAZY_LOAD"],
                "MESS_BTN_LAZY_LOAD" => $arParams["~MESS_BTN_LAZY_LOAD"],
                "LOAD_ON_SCROLL" => $arParams["LOAD_ON_SCROLL"],

                "OFFERS_CART_PROPERTIES" => $arParams["OFFERS_CART_PROPERTIES"],
                "OFFERS_FIELD_CODE" => $arParams["LIST_OFFERS_FIELD_CODE"],
                "OFFERS_PROPERTY_CODE" => $arParams["LIST_OFFERS_PROPERTY_CODE"],
                "OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
                "OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
                "OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
                "OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
                "OFFERS_LIMIT" => $arParams["LIST_OFFERS_LIMIT"],

//                        "SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"],
//                        "SECTION_CODE" => $arResult["VARIABLES"]["SECTION_CODE"],
                "SHOW_ALL_WO_SECTION" => "Y",
                "SECTION_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["section"],
                "DETAIL_URL" => $arResult["FOLDER"] . $arResult["URL_TEMPLATES"]["element"],
                "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
                'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],

                'LABEL_PROP' => $arParams['LABEL_PROP'],
                'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
                'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
                'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
                'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
                'PRODUCT_BLOCKS_ORDER' => $arParams['PRODUCT_BLOCKS_ORDER'],
                'PRODUCT_ROW_VARIANTS' => $arParams['LIST_PRODUCT_ROW_VARIANTS'],
                'ENLARGE_PRODUCT' => $arParams['LIST_ENLARGE_PRODUCT'],
                'ENLARGE_PROP' => isset($arParams['LIST_ENLARGE_PROP']) ? $arParams['LIST_ENLARGE_PROP'] : '',
                'SHOW_SLIDER' => $arParams['LIST_SHOW_SLIDER'],
                'SLIDER_INTERVAL' => isset($arParams['LIST_SLIDER_INTERVAL']) ? $arParams['LIST_SLIDER_INTERVAL'] : '',
                'SLIDER_PROGRESS' => isset($arParams['LIST_SLIDER_PROGRESS']) ? $arParams['LIST_SLIDER_PROGRESS'] : '',

                'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
                'OFFER_TREE_PROPS' => $arParams['OFFER_TREE_PROPS'],
                'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
                'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
                'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
                'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
                'SHOW_MAX_QUANTITY' => $arParams['SHOW_MAX_QUANTITY'],
                'MESS_SHOW_MAX_QUANTITY' => (isset($arParams['~MESS_SHOW_MAX_QUANTITY']) ? $arParams['~MESS_SHOW_MAX_QUANTITY'] : ''),
                'RELATIVE_QUANTITY_FACTOR' => (isset($arParams['RELATIVE_QUANTITY_FACTOR']) ? $arParams['RELATIVE_QUANTITY_FACTOR'] : ''),
                'MESS_RELATIVE_QUANTITY_MANY' => (isset($arParams['~MESS_RELATIVE_QUANTITY_MANY']) ? $arParams['~MESS_RELATIVE_QUANTITY_MANY'] : ''),
                'MESS_RELATIVE_QUANTITY_FEW' => (isset($arParams['~MESS_RELATIVE_QUANTITY_FEW']) ? $arParams['~MESS_RELATIVE_QUANTITY_FEW'] : ''),
                'MESS_BTN_BUY' => (isset($arParams['~MESS_BTN_BUY']) ? $arParams['~MESS_BTN_BUY'] : ''),
                'MESS_BTN_ADD_TO_BASKET' => (isset($arParams['~MESS_BTN_ADD_TO_BASKET']) ? $arParams['~MESS_BTN_ADD_TO_BASKET'] : ''),
                'MESS_BTN_SUBSCRIBE' => (isset($arParams['~MESS_BTN_SUBSCRIBE']) ? $arParams['~MESS_BTN_SUBSCRIBE'] : ''),
                'MESS_BTN_DETAIL' => (isset($arParams['~MESS_BTN_DETAIL']) ? $arParams['~MESS_BTN_DETAIL'] : ''),
                'MESS_NOT_AVAILABLE' => (isset($arParams['~MESS_NOT_AVAILABLE']) ? $arParams['~MESS_NOT_AVAILABLE'] : ''),
                'MESS_BTN_COMPARE' => (isset($arParams['~MESS_BTN_COMPARE']) ? $arParams['~MESS_BTN_COMPARE'] : ''),

                'USE_ENHANCED_ECOMMERCE' => (isset($arParams['USE_ENHANCED_ECOMMERCE']) ? $arParams['USE_ENHANCED_ECOMMERCE'] : ''),
                'DATA_LAYER_NAME' => (isset($arParams['DATA_LAYER_NAME']) ? $arParams['DATA_LAYER_NAME'] : ''),
                'BRAND_PROPERTY' => (isset($arParams['BRAND_PROPERTY']) ? $arParams['BRAND_PROPERTY'] : ''),

                'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
                "ADD_SECTIONS_CHAIN" => "N",
                'ADD_TO_BASKET_ACTION' => $basketAction,
                'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
                'COMPARE_PATH' => $arResult['FOLDER'] . $arResult['URL_TEMPLATES']['compare'],
                'COMPARE_NAME' => $arParams['COMPARE_NAME'],
                'USE_COMPARE_LIST' => 'Y',
                'BACKGROUND_IMAGE' => (isset($arParams['SECTION_BACKGROUND_IMAGE']) ? $arParams['SECTION_BACKGROUND_IMAGE'] : ''),
                'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : ''),
                'DISABLE_INIT_JS_IN_COMPONENT' => (isset($arParams['DISABLE_INIT_JS_IN_COMPONENT']) ? $arParams['DISABLE_INIT_JS_IN_COMPONENT'] : '')

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
<div class="p-card__preim">
    <div class="wrapper">
        <div class="p-card__p-prods">
            <b class="p-prods__title">
                Почему стоит обратиться к нам
            </b>
            <span class="p-prods__subtitle">
                            Мы ценим ваше время и деньги
                        </span>
        </div>
        <div class="p-preim">
            <a href="/shou-rum/" class="p-preim__item">
                <div class="p-preim__top">
                    <i class="p-preim__icon">
                        <svg width="68" height="64" viewBox="0 0 68 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M52.4059 64C56.6113 64 60.0328 60.6054 60.0328 56.4326C60.0328 54.4113 59.2396 52.5115 57.7989 51.0821L50.6903 44.0295L51.9888 35.0106L68 5.93315L57.6422 0L55.7408 3.47589L53.9706 2.46189C51.1162 0.827151 47.454 1.80048 45.8063 4.63194L41.8219 11.4792C40.1701 14.3174 41.1485 17.9405 44.0097 19.5793L46.2354 20.8543L44.0756 24.8022C43.4577 24.587 42.7936 24.4687 42.1026 24.4687H28.024V20.5156H36.126V8.65652H16.0708V20.5156H24.0396V24.4687H22.0474C18.752 24.4687 16.0708 27.1287 16.0708 30.3987V40.2813H12.833C10.2567 40.2813 7.97809 41.9109 7.16306 44.3357L4.47723 52.3298C1.90503 52.9912 0 55.3141 0 58.0705V64H52.4059ZM20.0552 12.6096H32.1417V16.5626H20.0552V12.6096ZM44.3594 60.047H20.0552V36.3283H47.7746L44.3594 60.047ZM54.9813 53.8776C55.6692 54.5601 56.0484 55.4675 56.0484 56.4331C56.0484 58.4256 54.4142 60.047 52.4059 60.047H48.3842L49.9863 48.9213L54.9813 53.8776ZM59.1929 5.45292L62.6377 7.42635L48.8999 32.3747H48.0792V30.3982C48.0792 29.2802 47.7653 28.2333 47.2211 27.3397L59.1929 5.45292ZM46.0019 16.1554C45.0483 15.6098 44.722 14.4018 45.2725 13.4558L49.2568 6.60846C49.8062 5.66447 51.0275 5.3402 51.9785 5.88528L53.8399 6.95126L48.1362 17.3784L46.0019 16.1554ZM20.0552 30.3982C20.0552 29.3085 20.9491 28.4217 22.0474 28.4217H42.1026C43.2009 28.4217 44.0948 29.3085 44.0948 30.3982V32.3747H20.0552V30.3982ZM10.943 45.586C11.2144 44.7774 11.9744 44.2343 12.833 44.2343H16.0708V52.1404H8.74072L10.943 45.586ZM3.98438 60.047V58.0705C3.98438 56.9803 4.87827 56.0939 5.97656 56.0939H16.0708V60.047H3.98438Z" fill="white"/>
                        </svg>
                    </i>
                </div>
                <div class="p-preim__title">
                    Бесплатный тест-драйв
                </div>
                <p class="p-preim__description">
                    Бесплатный тест-драйв оборудования в демонстрационных залах Москвы
                </p>
            </a>
            <a href="/delivery/" class="p-preim__item">
                <div class="p-preim__top">
                    <i class="p-preim__icon">
                        <svg width="80" height="56" viewBox="0 0 80 56" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M60.4207 35.6368C54.8602 35.6368 50.3367 40.2041 50.3367 45.8184C50.3367 51.4326 54.8602 56 60.4207 56C65.9821 56 70.5047 51.4326 70.5047 45.8184C70.5047 40.2041 65.9812 35.6368 60.4207 35.6368ZM60.4207 50.9092C57.6401 50.9092 55.3787 48.6259 55.3787 45.8184C55.3787 43.0109 57.6401 40.7276 60.4207 40.7276C63.2013 40.7276 65.4627 43.0109 65.4627 45.8184C65.4627 48.6261 63.2013 50.9092 60.4207 50.9092Z" fill="white"/>
                            <path d="M25.9669 35.6368C20.4065 35.6368 15.8829 40.2041 15.8829 45.8184C15.8829 51.4326 20.4065 56 25.9669 56C31.5274 56 36.051 51.4326 36.051 45.8184C36.051 40.2041 31.5274 35.6368 25.9669 35.6368ZM25.9669 50.9092C23.1863 50.9092 20.9249 48.6259 20.9249 45.8184C20.9249 43.0109 23.1863 40.7276 25.9669 40.7276C28.7468 40.7276 31.0089 43.0109 31.0089 45.8184C31.0089 48.6261 28.7475 50.9092 25.9669 50.9092Z" fill="white"/>
                            <path d="M67.211 6.49409C66.7824 5.6346 65.911 5.09237 64.958 5.09237H51.6807V10.1832H63.4033L70.268 23.969L74.7739 21.6815L67.211 6.49409Z" fill="white"/>
                            <path d="M52.858 43.3564H33.7824V48.4472H52.858V43.3564Z" fill="white"/>
                            <path d="M18.4034 43.3564H9.66406C8.27156 43.3564 7.14313 44.4959 7.14313 45.9017C7.14313 47.3077 8.27172 48.4471 9.66406 48.4471H18.4036C19.7961 48.4471 20.9245 47.3076 20.9245 45.9017C20.9245 44.4958 19.7959 43.3564 18.4034 43.3564Z" fill="white"/>
                            <path d="M79.4706 27.7957L74.5119 21.3473C74.0355 20.7262 73.3002 20.3631 72.5211 20.3631H54.2018V2.54532C54.2018 1.13935 53.0732 0 51.6808 0H9.66406C8.27156 0 7.14313 1.13951 7.14313 2.54532C7.14313 3.95114 8.27172 5.09065 9.66406 5.09065H49.1598V22.9084C49.1598 24.3144 50.2883 25.4537 51.6807 25.4537H71.2866L74.958 30.2288V43.3563H67.9832C66.5907 43.3563 65.4622 44.4959 65.4622 45.9017C65.4622 47.3076 66.5908 48.447 67.9832 48.447H77.4789C78.8714 48.447 79.9998 47.3075 80 45.9017V29.3569C80 28.7918 79.8134 28.242 79.4706 27.7957Z" fill="white"/>
                            <path d="M18.2347 30.4598H6.63802C5.24552 30.4598 4.11708 31.5993 4.11708 33.0051C4.11708 34.4111 5.24568 35.5504 6.63802 35.5504H18.2346C19.6271 35.5504 20.7555 34.4109 20.7555 33.0051C20.7556 31.5993 19.6271 30.4598 18.2347 30.4598Z" fill="white"/>
                            <path d="M24.0335 20.4476H2.52093C1.12859 20.4476 0 21.5871 0 22.9931C0 24.3991 1.12859 25.5384 2.52093 25.5384H24.0335C25.426 25.5384 26.5545 24.3989 26.5545 22.9931C26.5545 21.5873 25.426 20.4476 24.0335 20.4476Z" fill="white"/>
                            <path d="M28.1506 10.4367H6.63802C5.24552 10.4367 4.11708 11.5763 4.11708 12.9821C4.11708 14.388 5.24568 15.5274 6.63802 15.5274H28.1506C29.5431 15.5274 30.6716 14.3879 30.6716 12.9821C30.6717 11.5763 29.5431 10.4367 28.1506 10.4367Z" fill="white"/>
                        </svg>

                    </i>
                </div>
                <div class="p-preim__title">
                    Доставка за 1 день
                </div>
                <p class="p-preim__description">
                    Экспресс-доставка и сборка по Москве и области в день заказа
                </p>
            </a>
            <a href="/guarantee/" class="p-preim__item">
                <div class="p-preim__top">
                    <i class="p-preim__icon">
                        <svg width="57" height="73" viewBox="0 0 57 73" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M48.9278 8.45898C42.2384 8.45898 35.5881 5.70549 30.6973 0.896365C30.1119 0.321536 29.3217 0 28.5 0C27.6791 0 26.8885 0.320888 26.3032 0.896365C21.4125 5.70548 14.7616 8.45898 8.07221 8.45898H3.11538C1.41061 8.45898 0 9.82206 0 11.5391V35.1501C0 43.5198 2.62825 51.5499 7.59519 58.3649C12.5746 65.196 19.4667 70.204 27.5205 72.8438C27.8379 72.9476 28.1687 73 28.5 73C28.8313 73 29.1628 72.9473 29.4802 72.8435C37.534 70.2038 44.426 65.196 49.4049 58.3648C54.3718 51.5493 57 43.5198 57 35.1501V11.5391C57 9.82206 55.5894 8.45898 53.8846 8.45898H48.9278ZM28.5 66.6588C24.9678 65.3827 21.7494 63.5664 18.9231 61.3268V12.682C22.3729 11.4272 25.6256 9.58772 28.5 7.2355C31.3748 9.58768 34.6271 11.4272 38.0769 12.682V61.3268C35.2506 63.5664 32.0327 65.3827 28.5 66.6588ZM17.7688 61.6515C17.7714 61.659 17.7739 61.6667 17.7764 61.6748C17.7776 61.6788 17.7788 61.6829 17.7801 61.6871C17.7764 61.6746 17.7726 61.6627 17.7688 61.6515ZM17.7809 61.6901C17.7628 61.6752 17.7445 61.6603 17.7261 61.6455L17.7256 61.6451C17.7001 61.6245 17.6745 61.6038 17.6493 61.5828C17.6745 61.6039 17.7001 61.6245 17.7256 61.6451C17.7442 61.6601 17.7627 61.675 17.7809 61.6901ZM8.07221 14.6191C9.62088 14.6191 11.1653 14.5009 12.6923 14.2712V54.8691C8.58576 49.2753 6.23077 42.4263 6.23077 35.1501V14.6191H8.07221ZM50.7692 35.1501C50.7692 42.4263 48.4142 49.2753 44.3077 54.8691V14.2712C45.8349 14.5009 47.3795 14.6191 48.9278 14.6191H50.7692V35.1501Z" fill="white"/>
                        </svg>

                    </i>
                </div>
                <div class="p-preim__title">
                    Бесплатная гарантия до 5 лет
                </div>
                <p class="p-preim__description">
                    Расширенное гарантийное обслуживание в сервисных центрах компании
                </p>
            </a>
            <a href="/installment/" class="p-preim__item">
                <div class="p-preim__top">
                    <i class="p-preim__icon">
                        <svg width="65" height="65" viewBox="0 0 65 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M62.0433 14.8962H48.2166C50.1154 16.5932 51.739 18.5819 53.0113 20.8043H62.0433C63.6752 20.8043 64.9987 19.4822 64.9987 17.8503C64.9987 16.2198 63.6752 14.8962 62.0433 14.8962Z" fill="white"/>
                            <path d="M62.0429 22.3462H53.8089C54.6967 24.1994 55.3522 26.177 55.7325 28.2543H62.0429C63.6748 28.2543 64.9983 26.9321 64.9983 25.3002C64.9983 23.6683 63.6748 22.3462 62.0429 22.3462Z" fill="white"/>
                            <path d="M62.0436 7.44897H40.1722C38.8985 7.44897 37.8267 8.25663 37.4091 9.38238C40.6798 10.0766 43.6891 11.4624 46.3111 13.3571H62.0449C63.6782 13.3571 65.0017 12.0349 65.0017 10.403C65.0017 8.7711 63.6754 7.44897 62.0436 7.44897Z" fill="white"/>
                            <path d="M40.1716 5.90808H62.0429C63.6748 5.90808 64.9983 4.58596 64.9983 2.95404C64.9983 1.32351 63.6748 0 62.0429 0H40.1716C38.5383 0 37.2162 1.32351 37.2162 2.95543C37.2162 4.58734 38.5383 5.90808 40.1716 5.90808Z" fill="white"/>
                            <path d="M62.0429 29.7925H55.9676C56.0686 30.6831 56.1336 31.5834 56.1336 32.5004C56.1336 33.5874 56.0354 34.6537 55.8915 35.7006H62.0415C63.6734 35.7006 64.9969 34.3771 64.9969 32.7451C64.9969 31.1132 63.6748 29.7925 62.0429 29.7925Z" fill="white"/>
                            <path d="M62.0434 37.2407H55.6556C55.2282 39.329 54.5091 41.3039 53.5701 43.1488H62.0434C63.6753 43.1488 64.9988 41.8267 64.9988 40.1948C64.9988 38.5629 63.6753 37.2407 62.0434 37.2407Z" fill="white"/>
                            <path d="M62.0435 44.688H52.7114C51.3575 46.9243 49.6634 48.9241 47.6705 50.5961H62.0435C63.6754 50.5961 64.9989 49.2739 64.9989 47.642C64.9989 46.0101 63.6754 44.688 62.0435 44.688Z" fill="white"/>
                            <path d="M2.95536 35.2076H9.03066C8.92832 34.317 8.86332 33.4167 8.86332 32.4998C8.86332 31.4128 8.96289 30.3479 9.10534 29.2996H2.95536C1.32348 29.3009 0 30.6231 0 32.255C0 33.8855 1.32348 35.2076 2.95536 35.2076Z" fill="white"/>
                            <path d="M2.95536 42.6563H11.1894C10.303 40.8031 9.64607 38.8255 9.26576 36.7496H2.95536C1.32348 36.7496 0 38.0704 0 39.7023C0 41.3342 1.32348 42.6563 2.95536 42.6563Z" fill="white"/>
                            <path d="M2.95536 27.7605H9.34321C9.76915 25.6736 10.4897 23.6973 11.4273 21.8524H2.95536C1.32348 21.851 0 23.1732 0 24.8065C0 26.4398 1.32348 27.7605 2.95536 27.7605Z" fill="white"/>
                            <path d="M2.95536 20.3132H12.2875C13.6414 18.0783 15.3355 16.0772 17.327 14.4052H2.95536C1.32348 14.4052 0 15.7273 0 17.3578C0 18.9897 1.32348 20.3132 2.95536 20.3132Z" fill="white"/>
                            <path d="M2.95536 50.1036H16.7821C14.8833 48.4067 13.2597 46.4193 11.9874 44.1969H2.95536C1.32348 44.1969 0 45.519 0 47.1496C0 48.7829 1.32348 50.1036 2.95536 50.1036Z" fill="white"/>
                            <path d="M2.95536 57.553H24.8267C26.1004 57.553 27.1736 56.7453 27.5898 55.6196C24.3192 54.9253 21.3099 53.5396 18.6892 51.6449H2.95536C1.32348 51.6435 0 52.9656 0 54.5989C0 56.2309 1.32348 57.553 2.95536 57.553Z" fill="white"/>
                            <path d="M24.8267 59.0931H2.95536C1.32348 59.0931 0 60.4139 0 62.0472C0 63.6777 1.32348 64.9998 2.95536 64.9998H24.8267C26.46 64.9998 27.7821 63.6763 27.7821 62.0444C27.7821 60.4125 26.46 59.0931 24.8267 59.0931Z" fill="white"/>
                            <path d="M32.4997 11.8192C21.0959 11.8192 11.819 21.0962 11.819 32.5003C11.819 43.9043 21.0959 53.1827 32.4997 53.1827C43.9035 53.1827 53.1803 43.9057 53.1803 32.5003C53.1803 21.0949 43.9035 11.8192 32.4997 11.8192ZM32.4997 47.2733C24.3541 47.2733 17.727 40.6474 17.727 32.5003C17.727 24.3545 24.3541 17.7273 32.4997 17.7273C40.6466 17.7273 47.2723 24.3545 47.2723 32.5003C47.2723 40.6474 40.6466 47.2733 32.4997 47.2733Z" fill="white"/>
                            <path d="M33.3613 30.5045V25.3985C36.3346 25.4538 36.3125 28.3277 38.0577 28.3277C38.9705 28.3277 39.7546 27.7123 39.7546 26.664C39.7546 24.0308 35.455 22.7155 33.3613 22.6602V21.2288C33.3613 20.7711 33.01 20.3147 32.5508 20.3147C32.0972 20.3147 31.7501 20.7711 31.7501 21.2288V22.6602C28.3923 22.764 25.3554 24.649 25.3554 28.3C25.3554 31.2831 27.7672 33.0298 31.7501 33.7531V39.3694C27.2846 39.1813 29.6245 35.4735 26.6152 35.4735C25.6001 35.4735 24.9515 36.0945 24.9515 37.1663C24.9515 39.2905 27.2099 42.004 31.7501 42.1146V43.7769C31.7501 44.2333 32.0972 44.6897 32.5508 44.6897C33.01 44.6897 33.3613 44.2333 33.3613 43.7769V42.1146C37.3621 41.8726 40.0478 40.0429 40.0478 36.443C40.0478 32.3037 36.9085 31.2582 33.3613 30.5045ZM31.7501 30.2099C29.7352 29.8047 28.7353 29.0288 28.7353 27.6818C28.7353 26.5284 29.9177 25.4525 31.7501 25.3971V30.2099ZM33.3613 39.368V34.0491C34.8078 34.3685 36.6679 34.9065 36.6679 36.732C36.6679 38.505 34.971 39.2615 33.3613 39.368Z" fill="white"/>
                        </svg>

                    </i>
                </div>
                <div class="p-preim__title">
                    Покупка в рассрочку
                </div>
                <p class="p-preim__description">
                    Оплата покупки с помощью рассрочки от 0% до 12 месяцев
                </p>
            </a>
        </div>
    </div>
</div>

<style>
    .wp-catalog {
        padding-left: 380px;
        padding-right: 380px;
    }
    @media(max-width: 1885px) {
        .wp-catalog .wrapper {
            width: 100%;
        }
    }
    @media(max-width: 1589px) {
        .wp-catalog {
            padding-right: 15px !important;
        }
        .p-card__preim > .wrapper {
            margin-left: -182.5px;
        }
    }
    @media(max-width: 1199px) {
        .wp-catalog {
            padding-left: 345px !important;
        }
    }
    @media(max-width: 767px) {
        .subr_menu ul {
            display: none !important;
        }
        body .fancybox-inner {
            bottom: 0 !important;
        }
    }
    @media(max-width: 360px) {
        body .rightColumn #catalogLine {
            display: none !important;
        }
    }
    @media(max-width: 767px) {
        body .p-izgotov__label {
            font-size: 16px !important;
            width: 100% !important;
            display: block !important;
            padding-right: 70px !important;
        }
        body .p-izgotov__label-sub {
            font-size: 16px !important;
            left: auto !important;
            right: 0 !important;
        }
    }
</style>
<script>
    $('#modef_send').on('click', function() {
        $('#set_filter').trigger('click');
        return false;
    });
</script>
<?if($_GET['vid'] == 2) {?>
    <script>
        var links = document.getElementsByTagName("a");
        for (var i = 0; i < links.length; i++) {
            var link = links[i];
            if(link.getAttribute('data-id') == null) {
                link.href = link.href + "?vid=2";
            }
        }
    </script>
<?}?>