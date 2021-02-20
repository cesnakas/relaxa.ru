<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>
<?/*ob_start();?>
    <?$temp = $APPLICATION->ShowTitle()?>
    <meta name="title" content="<?=$temp?>" />
<?
$script_out = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('rg_metatitle',$script_out);*/
?>

<?if (!empty($arResult["ITEMS"])):?>
<?
	if ($arParams["DISPLAY_TOP_PAGER"]){
		?><? echo $arResult["NAV_STRING"]; ?><?
	}
?>
	<div class="items productList">
    <?
    $curPage =$APPLICATION->GetCurPage(true);
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
            margin-left: 5px;
			margin-right: 5px;
            margin-bottom: 5px;
			min-height: 230px;
        }

        .m_equ_cat > div {
            float: left;
            margin-left: 21px;
            margin-bottom: 19px;
            box-shadow: 0px 0px 11px #ccc;
        }

        .m_equ_cat > div > img {
            margin-bottom: -6px;
        }

        .m_equ_cat a {
            float: left;
        }

    @media (max-width: 650px){
        .m_feet_cat div {
            width: 100%;
        }
    }
 	    @media (max-width: 1024px){
        .hide-if-sm-1024 {
				display: none;
        }
    }

    </style>


    <? if (strpos($curPage, '/massazhnoe-oborudovanie/index.php0000') !== false or strpos($curPage, '/massazhnoe-oborudovanie/index.php0000') !== false) { ?>
        <div class="container page top_menu_cat_page">
            <div class="m_equ_cat">
                <a href="/massazhnoe-oborudovanie/17/">
                    <div class="item_one">
                        <img src="/bitrix/templates/dresscodeV2/img/cat_5_1.png" alt="">
                    </div>
                </a>

                <a href="/massazhnoe-oborudovanie/14/">
                    <div class="item_to">
                        <img src="/bitrix/templates/dresscodeV2/img/cat_5_2.png" alt="">
                    </div>
                </a>
                <a href="/massazhnoe-oborudovanie/15/">
                    <div class="item_tr">
                        <img src="/bitrix/templates/dresscodeV2/img/cat_5_3.png" alt="">
                    </div>
                </a>
                <a href="/massazhnoe-oborudovanie/21/">
                    <div class="item_qt">
                        <img src="/bitrix/templates/dresscodeV2/img/cat_5_4.png" alt="">
                    </div>
                </a>
                <a href="/massazhnoe-oborudovanie/16/" style="float: right;">
                    <div class="item_st">
                        <img src="/bitrix/templates/dresscodeV2/img/cat_5_5.png" alt="">
                    </div>
                </a>
                <a href="/massazhnoe-oborudovanie/18/">
                    <div class="item_se">
                        <img src="/bitrix/templates/dresscodeV2/img/cat_5_6.png" alt="">
                    </div>
                </a>
                <a href="/massazhnoe-oborudovanie/23/">
                    <div class="item_tt">
                        <img src="/bitrix/templates/dresscodeV2/img/cat_5_7.png" alt="">
                    </div>
                </a>
                <div class="text_cat_mobile_m">
                    <ul>
                        <li><a href="">Масажные кресла для офиса</a></li>
                        <li><a href="">Масажные кресла для дома</a></li>
                        <li><a href="">Японскые Масажные кресла</a></li>
                        <li><a href="">Вендинговые Масажные кресла</a></li>
                        <li><a href="">Сингапурские Масажные кресла</a></li>
                        <li><a href="">Масажные кресла-качалки</a></li>
                        <li><a href="">Аксесуары Масажных кресел</a></li>
                    </ul>
                </div>
            </div>
        </div>


    <? } else if (strpos($curPage, '/fitnes/index.php') !== false) { ?>
        <style>
            .m_feet_cat {
                max-width: 900px;
                margin: 0 auto;
    			padding-left: 0px;
   				 margin-left: 0px;
            }
        </style>
        <div class="m_feet_cat overflov hide-if-sm-1024 ">
            <a href="/fitnes/steppery/">
                <div class="item_one f_l">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_10_1.png" alt="">
                </div>
            </a>
            <a href="/fitnes/velotrenazhery/">
                <div class="item_to f_l">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_10_2.png" alt="">
                </div>
            </a>
            <a href="/fitnes/vibroplatformy/">
                <div class="item_tr f_r">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_10_3.png" alt="">
                </div>
            </a>
            <a href="/fitnes/silovye-trenazhery/">
                <div class="item_qt f_l">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_10_4.png" alt="">
                </div>
            </a>
            <a href="/fitnes/imitatory-verkhovoy-ezdy/">
                <div class="item_st f_l">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_10_5.png" alt="">
                </div>
            </a>
        </div>


    <? } else if (strpos($curPage, '/zdorovie-krasota/index.php') !== false) { ?>
        <style>
        .m_feet_cat {
        max-width: 910px;
        margin: 0 auto;
        }
        </style>
        <div class="m_feet_cat overflov hide-if-sm-1024 ">
            <a href="/zdorovie-krasota/ultrazvukovye-apparaty/">
            <div class="item_one f_l">
                <img src="/bitrix/templates/dresscodeV2/img/cat_11_1.png" alt="">
            </div>
            </a>
                <a href="/zdorovie-krasota/kosmetologicheskie-apparaty/">
            <div class="item_to f_l">
                <img src="/bitrix/templates/dresscodeV2/img/cat_11_2.png" alt="">
            </div>
                </a>
                    <a href="/zdorovie-krasota/darsonval/">
            <div class="item_tr f_r">
                <img src="/bitrix/templates/dresscodeV2/img/cat_11_3.png" alt="">
            </div>
                    </a>
                        <a href="/zdorovie-krasota/spa-protsedury/">
            <div class="item_qt f_l">
                <img src="/bitrix/templates/dresscodeV2/img/cat_11_4.png" alt="">
            </div>
                        </a>
        </div>


    <? } else if (strpos($curPage, '/terapiya/index.php') !== false) { ?>
        <style>
            .m_equ_cat {
                max-width: 910px;
                margin: 0 auto;
            }
        </style>
        <div class="m_equ_cat">
            <a href="/terapiya/elektroterapiya/">
                <div class="item_one">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_8_1.png" alt="">
                </div>
            </a>
            <a href="/terapiya/sving-mashiny/">
                <div class="item_to">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_8_2.png" alt="">
                </div>
            </a>
            <a href="/terapiya/teplovaya-terapiya/">
                <div class="item_tr">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_8_3.png" alt="">
                </div>
            </a>
            <a href="/terapiya/pressoterpiya/">
                <div class="item_qt">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_8_4.png" alt="">
                </div>
            </a>
            <a href="/terapiya/aksessuary-dlya-terapii-/">
                <div class="item_st">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_8_5.png" alt="">
                </div>
            </a>
        </div>


    <? } else if (strpos($curPage, '/dom-dacha/index.php') !== false) { ?>
        <style>
            .m_feet_cat {
                max-width: 930px;
                margin: 0 auto;
            }
        </style>
        <div class="m_feet_cat overflov hide-if-sm-1024 ">
            <div class="item_one f_l">
                <a href="/dom-dacha/aktivnyy-otdykh/">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_9_1.png" alt="">
            </div>
            </a>
            <a href="/dom-dacha/kresla-kachalki/">
                <div class="item_to f_l">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_9_2.png" alt="">
                </div>
            </a>
            <a href="/dom-dacha/batuty/">
                <div class="item_tr f_r m_non">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_9_3.png" alt="">
                </div>
            </a>
            <a href="/dom-dacha/kresla-dlya-otdykha/">
                <div class="item_qt f_l">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_9_4.png" alt="">
                </div>
            </a>
            <a href="/dom-dacha/gamaki/">
                <div class="item_st f_l">
                    <img src="/bitrix/templates/dresscodeV2/img/cat_9_5.png" alt="">
                </div>
            </a>
        </div>


    <? } ?>










		<div class="catalog-products-list">
		<?foreach ($arResult["ITEMS"] as $index => $arElement):?>
			<?
				$this->AddEditAction($arElement["ID"], $arElement["EDIT_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arElement["ID"], $arElement["DELETE_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				$arElement["IMAGE"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width" => 270, "height" => 250), BX_RESIZE_IMAGE_PROPORTIONAL, false);
				if(empty($arElement["IMAGE"])){
					$arElement["IMAGE"]["src"] = SITE_TEMPLATE_PATH."/images/empty.png";
				}
			?>
<?
$rate = false;
$count = 0;
$iblockReview = 18;
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","IBLOCK_ID");
$arFilter = Array("IBLOCK_ID"=>$iblockReview, "PROPERTY_PRODUCT"=>$arElement['ID'], "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>50), $arSelect);
while($ob = $res->GetNextElement())
{$i = 1;
 $arFields = $ob->GetFields();
 $arFields['PROP'] = $ob->GetProperties();
	$count++;
	$rate = $rate + $arFields['PROP']['RATE']['VALUE'];
	// print_r($arFields);
}
if($rate)
$arElement["PROPERTIES"]["RATING"]["VALUE"] = round($rate/$count);

?>
			<div class="item product sku" id="<?=$this->GetEditAreaId($arElement["ID"]);?>" data-product-id="<?=!empty($arElement["~ID"]) ? $arElement["~ID"] : $arElement["ID"]?>" data-iblock-id="<?=$arElement["SKU_INFO"]["IBLOCK_ID"]?>" data-prop-id="<?=$arElement["SKU_INFO"]["SKU_PROPERTY_ID"]?>" data-product-width="220" data-product-height="200" data-hide-measure="<?=$arParams["HIDE_MEASURES"]?>" data-price-code="<?=implode("||", $arParams["PRICE_CODE"])?>">


				<div class="tabloid">
					<a href="#" class="removeFromWishlist" data-id="<?=$arElement["~ID"]?>"></a>
					<?if(!empty($arElement["PROPERTIES"]["OFFERS"]["VALUE"])):?>
						<div class="markerContainer">
							<?foreach ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] as $ifv => $marker):?>
							    <div class="marker" style="background-color: <?=strstr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? $arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv] : "#424242"?>"><?=$marker?></div>
							<?endforeach;?>
						</div>
					<?endif;?>
					<?if(isset($arElement["PROPERTIES"]["RATING"]["VALUE"])):?>
					    <div class="rating">
					      <i class="m" style="width:<?=($arElement["PROPERTIES"]["RATING"]["VALUE"] * 100 / 5)?>%"></i>
					      <i class="h"></i>
					    </div>
				    <?endif;?>
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="picture">
						<img src="<?=(!empty($arElement["IMAGE"]["src"]) ? $arElement["IMAGE"]["src"] : SITE_TEMPLATE_PATH.'/images/empty.png')?>" alt="<?=$arElement["NAME"]?>">
						<span class="getFastView" data-id="<?=$arElement["ID"]?>"><?=GetMessage("FAST_VIEW_PRODUCT_LABEL")?></span>
					</a>
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>" class="name"><span class="middle"><?=$arElement["NAME"]?></span></a>
					<?if($count>1):?>
					<a href="<?=$arElement["DETAIL_PAGE_URL"]?>#reviews" class="link">Читать отзывы (<?=$count?>)</a>
<?endif;?>

                    <style>
                        .producttitle img{
                            width: 43px;
                        }
                    </style>

<div class="producttitle">
       <?foreach ($arElement["PROPERTIES"]["SVOISTVA_KR"]["VALUE"] as $ifv2 => $marker2):?>
        <img src="/bitrix/templates/dresscodeV2/img-2/<?=$marker2?><?/*=strstr(arElement["PROPERTIES"]["SVOISTVA_KR"]["VALUE_XML_ID"][$ifv2], "#") ? arElement["PROPERTIES"]["SVOISTVA_KR"]["VALUE_XML_ID"][$ifv2] : "#424242"*/?>" alt="">

        <!--<div class="marker" style="background-color: <?=strstr(arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv2] : "#424242"?>"><?=$marker?></div>-->
    <?endforeach;?>


    
</div>



<?
$url = (!$arElement['CATALOG_QUANTITY'] and $arElement['PROPERTIES']['URL_NEW']['VALUE']) ? $arElement['PROPERTIES']['URL_NEW']['VALUE'] : '';
?>
					<?if(!empty($arElement["MIN_PRICE"])):?>
						<?if($arElement["COUNT_PRICES"] > 1):?>
							<a href="#" class="price getPricesWindow" data-id="<?=$arElement["ID"]?>">
								<span class="priceIcon"></span><?=$arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?>
								<?if($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arElement["CATALOG_MEASURE"]]["SYMBOL_RUS"])):?>
									<span class="measure"> / <?=$arResult["MEASURES"][$arElement["CATALOG_MEASURE"]]["SYMBOL_RUS"]?></span>
								<?endif;?>
								<?if(!empty($arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0):?>
									<s class="discount"><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></s>
								<?endif;?>
							</a>
						<?else:?>
							<a class="price"><?=$arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?>
								<?if($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arElement["CATALOG_MEASURE"]]["SYMBOL_RUS"])):?>
									<span class="measure"> / <?=$arResult["MEASURES"][$arElement["CATALOG_MEASURE"]]["SYMBOL_RUS"]?></span>
								<?endif;?>
								<?if(!empty($arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0):?>
									<s class="discount"><?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?></s>
								<?endif;?>
							</a>
						<?endif;?>
						<?if(!$url):?><a href="#" class="addCart<?if($arElement["CAN_BUY"] === false || $arElement["CAN_BUY"] === "N"):?> disabled<?endif;?>" data-id="<?=$arElement["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/incart.png" alt="" class="icon"><?=GetMessage("ADDCART_LABEL")?></a><?endif;?>
					<?else:?>
						<a class="price"><?=GetMessage("REQUEST_PRICE_LABEL")?></a>
						<?if(!$url):?><a href="#" class="addCart disabled requestPrice" data-id="<?=$arElement["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/request.png" alt="" class="icon"><?=GetMessage("REQUEST_PRICE_BUTTON_LABEL")?></a><?endif;?>
					<?endif;?>
<?if($url):?>
	<div class="optional">
						<div class="row">
						<a href="<?=$url;?>" class="addCart"><img src="<?=SITE_TEMPLATE_PATH?>/images/incart.png" alt="" class="icon"><?=GetMessage("ADDCART_LABEL")?></a>
							<a href="<?=$url;?>" class="fastBack label"><img src="<?=SITE_TEMPLATE_PATH?>/images/fastBack.png" alt="" class="icon"><?=GetMessage("FASTBACK_LABEL")?></a>
							<a href="#" class="addCompare label" data-id="<?=$arElement["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/compare.png" alt="" class="icon"><?=GetMessage("COMPARE_LABEL")?></a>
	</div></div>
<? else: ?>
					<div class="optional">
						<div class="row">
							<a href="#" class="fastBack label<?if(empty($arElement["MIN_PRICE"]) || $arElement["CAN_BUY"] === "N" || $arElement["CAN_BUY"] === false):?> disabled<?endif;?>" data-id="<?=$arElement["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/fastBack.png" alt="" class="icon"><?=GetMessage("FASTBACK_LABEL")?></a>
							<a href="#" class="addCompare label" data-id="<?=$arElement["ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/compare.png" alt="" class="icon"><?=GetMessage("COMPARE_LABEL")?></a>
						</div>
						<div class="row">
							<a href="#" class="addWishlist label" data-id="<?=$arElement["~ID"]?>"><img src="<?=SITE_TEMPLATE_PATH?>/images/wishlist.png" alt="" class="icon"><?=GetMessage("WISHLIST_LABEL")?></a>
							<?if($arElement["CATALOG_QUANTITY"] > 0):?>
								<?if(!empty($arElement["STORES"])):?>
									<a href="#" data-id="<?=$arElement["ID"]?>" class="inStock label changeAvailable getStoresWindow"><img src="<?=SITE_TEMPLATE_PATH?>/images/inStock.png" alt="<?=GetMessage("AVAILABLE")?>" class="icon"><span><?=GetMessage("AVAILABLE")?></span></a>
								<?else:?>
									<span class="inStock label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/inStock.png" alt="<?=GetMessage("AVAILABLE")?>" class="icon"><span><?=GetMessage("AVAILABLE")?></span></span>
								<?endif;?>
							<?else:?>
								<?if($arElement["CAN_BUY"] === true || $arElement["CAN_BUY"] === "Y"):?>
									<a class="onOrder label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/onOrder.png" alt="" class="icon"><?=GetMessage("ON_ORDER")?></a>
								<?else:?>
									<a class="outOfStock label changeAvailable"><img src="<?=SITE_TEMPLATE_PATH?>/images/outOfStock.png" alt="" class="icon"><?=GetMessage("NOAVAILABLE")?></a>
								<?endif;?>
							<?endif;?>
						</div>						
					</div>
					<?if(!empty($arElement["SKU_PRODUCT"])):?>
						<?if(!empty($arElement["SKU_PROPERTIES"]) && $level = 1):?>
							<?foreach ($arElement["SKU_PROPERTIES"] as $propName => $arNextProp):?>
								<?if(!empty($arNextProp["VALUES"])):?>
									<div class="skuProperty" data-name="<?=$propName?>" data-level="<?=$level++?>" data-highload="<?=$arNextProp["HIGHLOAD"]?>">
										<div class="skuPropertyName"><?=$arNextProp["NAME"]?></div>
										<ul class="skuPropertyList">
											<?foreach ($arNextProp["VALUES"] as $xml_id => $arNextPropValue):?>
												<li class="skuPropertyValue<?if($arNextPropValue["DISABLED"] == "Y"):?> disabled<?elseif($arNextPropValue["SELECTED"] == "Y"):?> selected<?endif;?>" data-name="<?=$propName?>" data-value="<?=$arNextPropValue["VALUE"]?>">
													<a href="#" class="skuPropertyLink">
														<?if(!empty($arNextPropValue["IMAGE"])):?>
															<img src="<?=$arNextPropValue["IMAGE"]["src"]?>" alt="">
														<?else:?>
															<?=$arNextPropValue["DISPLAY_VALUE"]?>
														<?endif;?>
													</a>
												</li>
											<?endforeach;?>
										</ul>
									</div>
								<?endif;?>
							<?endforeach;?>
						<?endif;?>
					<?endif;?>
<?endif;?>
				</div>
			</div>
		<?endforeach;?>
		</div>
		<div class="clear"></div>
	</div>

	<?
		if ($arParams["DISPLAY_BOTTOM_PAGER"]){
			?><? echo $arResult["NAV_STRING"]; ?><?
		}
	?>

	<?if(empty($_GET["PAGEN_1"])):?>
		<div><?=$arResult["~DESCRIPTION"]?></div>
	<?endif;?>

<?else:?>
	<div id="empty">
		<div class="emptyWrapper">
			<div class="pictureContainer">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/emptyFolder.png" alt="<?=GetMessage("EMPTY_HEADING")?>" class="emptyImg">
			</div>
			<div class="info">
				<h3><?=GetMessage("EMPTY_HEADING")?></h3>
				<p><?=GetMessage("EMPTY_TEXT")?></p>
				<a href="<?=SITE_DIR?>" class="back"><?=GetMessage("MAIN_PAGE")?></a>
			</div>
		</div>
		<?$APPLICATION->IncludeComponent("bitrix:menu", "emptyMenu", Array(
			"ROOT_MENU_TYPE" => "left",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_CACHE_GET_VARS" => "",
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "Y",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N",
			),
			false
		);?>
	</div>
<?endif;?>