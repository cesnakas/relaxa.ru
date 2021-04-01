<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true); ?>
<? /*ob_start();?>
    <?$temp = $APPLICATION->ShowTitle()?>
    <meta name="title" content="<?=$temp?>" />
<?
$script_out = ob_get_contents();
ob_end_clean();
$APPLICATION->AddViewContent('rg_metatitle',$script_out);*/
?>




<? if (!empty($arResult["ITEMS"])): ?>
    <?
    if ($arParams["DISPLAY_TOP_PAGER"]) {
        ?><? echo $arResult["NAV_STRING"]; ?><?
    }

    
    if ($arResult['ACTION']) {
        ?>
        <?
        if ($APPLICATION->GetCurDir() != '/massazhnoe-oborudovanie/') { ?>
            <div style="width: 100%; background-color:white; text-align: center; position: relative; font-size: 125%;">
                <?= $arResult['ACTION']['PREVIEW']; ?><br /><br />
            </div>
            <?
        } ?>
        <div style="width: 100%; background-color:white; text-align: center; display: none; font-size: 125%;"
             class='actionDesc'>
            <?= $arResult['ACTION']['DETAIL']; ?>
        </div>
        <script>
            $(document).ready(function () {
                $('.actionHead').on('click', function () {
                    $('.actionDesc').toggle();
                });
            });
        </script>
        <?
    }
   
    ?>
    <div class="items productList lol"> 
        <?
        $curPage = $APPLICATION->GetCurPage(true);
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

            @media (max-width: 650px) {
                .m_feet_cat div {
                    width: 100%;
                }
            }

            @media (max-width: 1024px) {
                .hide-if-sm-1024 {
                    display: none;
                }
            }

        </style>



        <div class="catalog-products-list">
            <?
            $emptyblocks=count($arResult["ITEMS"]) % 3;
            
            foreach ($arResult["ITEMS"] as $index => $arElement): ?>
                <?
                $this->AddEditAction($arElement["ID"], $arElement["EDIT_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
                $this->AddDeleteAction($arElement["ID"], $arElement["DELETE_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                $arElement["IMAGE"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width" => 270, "height" => 250), BX_RESIZE_IMAGE_PROPORTIONAL, false);
                if (empty($arElement["IMAGE"])) {
                    $arElement["IMAGE"]["src"] = SITE_TEMPLATE_PATH . "/images/empty.png";
                }
                ?>
                <?
                $rate = false;
                $count = 0;
                $iblockReview = 18;
                $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_ID");
                $arFilter = Array("IBLOCK_ID" => $iblockReview, "PROPERTY_PRODUCT" => $arElement['ID'], "ACTIVE" => "Y");
                $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
                while ($ob = $res->GetNextElement()) {
                    $i = 1;
                    $arFields = $ob->GetFields();
                    $arFields['PROP'] = $ob->GetProperties();
                    $count++;
                    $rate = $rate + $arFields['PROP']['RATE']['VALUE'];
                    // print_r($arFields);
                }
                if ($rate)
                    $arElement["PROPERTIES"]["RATING"]["VALUE"] = round($rate / $count);

                ?>
                <div class="item product sku" id="<?= $this->GetEditAreaId($arElement["ID"]); ?>"
                     data-product-id="<?= !empty($arElement["~ID"]) ? $arElement["~ID"] : $arElement["ID"] ?>"
                     data-iblock-id="<?= $arElement["SKU_INFO"]["IBLOCK_ID"] ?>"
                     data-prop-id="<?= $arElement["SKU_INFO"]["SKU_PROPERTY_ID"] ?>" data-product-width="220"
                     data-product-height="200" data-hide-measure="<?= $arParams["HIDE_MEASURES"] ?>"
                     data-price-code="<?= implode("||", $arParams["PRICE_CODE"]) ?>"
                     itemscope itemtype="http://schema.org/Product"
                     >
                    <meta itemprop="description" content="<?php
                    if (empty($arElement["PREVIEW_TEXT"]) === false) {
                        $description = strip_tags($arElement["PREVIEW_TEXT"]);
                        $description = htmlspecialchars($description);
                    } else {
                        $description = $arElement["NAME"];
                    }
                    echo $description;
                    ?>">

                    <div class="tabloid">
                        <a href="#" class="removeFromWishlist" data-id="<?= $arElement["~ID"] ?>"></a>
                        <? if (!empty($arElement["PROPERTIES"]["OFFERS"]["VALUE"])): ?>
                            <div class="markerContainer">
                                <? foreach ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] as $ifv => $marker): ?>
                                    <?if($marker != "ОБНОВЛЕН"):?>

                                        <?if($marker == "NEW"):?>
                                            <div class="marker marker-0066ff"><?= $marker ?></div>
                                        <?elseif($marker == "HIT"):?>
                                            <div class="marker marker-8B0000"><?= $marker ?></div>
                                        <?elseif($marker == "АКЦИЯ"):?>
                                            <div class="marker marker-ff0f16"><?= $marker ?></div>
                                        <?elseif($marker == "SALE"):?>
                                            <div class="marker marker-EE82EE"><?= $marker ?></div>
                                        <?else:?>
                                            <div class="marker marker-<?= strstr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>"
                                             ><?= $marker ?></div>
                                        <?endif;?>

                                    <?endif;?>
                                <? endforeach; ?>
                            </div>
                        <? endif; ?>
                   
                        <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>" class="picture">
                            <img src="<?= (!empty($arElement["IMAGE"]["src"]) ? $arElement["IMAGE"]["src"] : SITE_TEMPLATE_PATH . '/images/empty.png') ?>"
                                 alt="<?= $arElement["NAME"] ?>" itemprop="image">
                            <span class="getFastView"
                                  data-id="<?= $arElement["ID"] ?>"><?= GetMessage("FAST_VIEW_PRODUCT_LABEL") ?></span>
                        </a>
						     <? if (isset($arElement["PROPERTIES"]["RATING"]["VALUE"])): ?>
                            <div class="rating">
                                <i class="m"
                                   style="width:<?= ($arElement["PROPERTIES"]["RATING"]["VALUE"] * 100 / 5) ?>%"></i>
                                <i class="h"></i>
                            </div>
                        <? endif; ?> 
						
						
                        <a href="<?= $arElement["DETAIL_PAGE_URL"] ?>" class="name" ><span
                                    class="middle" itemprop="name"><?= $arElement["NAME"] ?></span></a>
                     

                        <style>
                            .producttitle img {
                                width: 43px;
                            }
                        </style>

                        <?if(false):?>
                        <div class="producttitle">
                            <? foreach ($arElement["PROPERTIES"]["SVOISTVA_KR"]["VALUE"] as $ifv2 => $marker2): ?>
                                <img src="/bitrix/templates/dresscodeV2/img-2/<?= $marker2 ?><? /*=strstr(arElement["PROPERTIES"]["SVOISTVA_KR"]["VALUE_XML_ID"][$ifv2], "#") ? arElement["PROPERTIES"]["SVOISTVA_KR"]["VALUE_XML_ID"][$ifv2] : "#424242"*/ ?>"
                                     alt="">

                                <!--<div class="marker" style="background-color: <?= strstr(arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv2] : "#424242" ?>"><?= $marker ?></div>-->
                            <? endforeach; ?>


                        </div>
                        <?endif;?>


                        <?
                        $url = (!$arElement['CATALOG_QUANTITY'] and $arElement['PROPERTIES']['URL_NEW']['VALUE']) ? $arElement['PROPERTIES']['URL_NEW']['VALUE'] : '';
                        ?>
                        <span itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                            <? if (!empty($arElement["MIN_PRICE"])): ?>
                                <? if ($arElement["COUNT_PRICES"] > 1): ?>
                                    <meta itemprop="price" content="<?php
                                    $price = trim($arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"], "руб.");
                                    $price = str_replace(' ', '', $price);
                                    echo $price;
                                    ?>">
                                    <a href="#" class="price getPricesWindow" data-id="<?= $arElement["ID"] ?>">
                                        <span class="priceIcon"></span><?= $arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>
                                        <? if ($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arElement["CATALOG_MEASURE"]]["SYMBOL_RUS"])): ?>
                                            <span class="measure"> / <?= $arResult["MEASURES"][$arElement["CATALOG_MEASURE"]]["SYMBOL_RUS"] ?></span>
                                        <? endif; ?>
                                        <? if (!empty($arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0): ?>
                                            <s class="discount"><?= $arElement["MIN_PRICE"]["PRINT_VALUE"] ?></s>
                                        <? endif; ?>
                                    </a> 
                                <? else: ?>
                                    <meta itemprop="price" content="<?php
                                    $price = trim($arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"], "руб.");
                                    $price = str_replace(' ', '', $price);
                                    echo $price;
                                    ?>">
                                    <a class="price"><?= $arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>
                                        <? if ($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arElement["CATALOG_MEASURE"]]["SYMBOL_RUS"])): ?>
                                            <span class="measure"> / <?= $arResult["MEASURES"][$arElement["CATALOG_MEASURE"]]["SYMBOL_RUS"] ?></span>
                                        <? endif; ?>
                                        <? if (!empty($arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0): ?>
                                            <s class="discount"><?= $arElement["MIN_PRICE"]["PRINT_VALUE"] ?></s>
                                        <? endif; ?>
                                    </a> <span class="kredit_in_carousel">От <?=intdiv($price, 12);?>/мес.</span>
                                <? endif; ?>
                                <meta itemprop="priceCurrency" content="RUB">
                            </span>
                            <? if (!$url): ?><a title="Купить" href="#"
                                                class="addCart<? if ($arElement["CAN_BUY"] === false || $arElement["CAN_BUY"] === "N"): ?> disabled<? endif; ?>"
                                                data-id="<?= $arElement["ID"] ?>"><img
                                src="<?= SITE_TEMPLATE_PATH ?>/images/incart.png" alt=""
                                class="icon"><?= GetMessage("ADDCART_LABEL") ?></a><? endif; ?>
                        <? else: ?>f
                            <a class="price"><?= GetMessage("REQUEST_PRICE_LABEL") ?></a>
                            <? if (!$url): ?><a href="#" class="addCart disabled requestPrice"
                                                data-id="<?= $arElement["ID"] ?>"><img
                                src="<?= SITE_TEMPLATE_PATH ?>/images/request.png" alt=""
                                class="icon"><?= GetMessage("REQUEST_PRICE_BUTTON_LABEL") ?></a><? endif; ?>
                        <? endif; ?>
						    <a title="Добавить в избраное" href="#" class="addWishlist" data-id="<?= $arElement["~ID"] ?>"><img
                            src="<?= SITE_TEMPLATE_PATH ?>/images/new/wishlist.png" alt=""
                            class="icon"></a>

    					    <?if($arElement['CATALOG_QUANTITY']):?>
                                <span class="inStock label changeAvailable"><img
                                    src="<?= SITE_TEMPLATE_PATH ?>/images/new/inStock.png"
                                    alt="<?= GetMessage("AVAILABLE") ?>"
                                    class="icon"><span><?= GetMessage("AVAILABLE") ?></span></span>
                            <?endif?>
                            
                            <a href="#" class="addCompare" data-id="<?=$arElement["ID"]?>" data-no-label="Y">
                                <img src="/bitrix/templates/dresscodeV2/images/compare.png" alt="" class="icon">
                            </a>
                            <a class="fastBack newlisting-oneclick" data-id="<?=$arElement["ID"]?>" href="#">Купить в 1 клик</a>

                    </div>
                </div>
            <? endforeach; ?>
           <? for ($i = 1; $i <= (3-$emptyblocks); $i++) {?>
    <div style="width: 33%" >
                     
                </div>
<?}?>
            
        </div>
    </div>
    <div class="clear"></div>



    <?
    if ($arParams["DISPLAY_BOTTOM_PAGER"]) {
        ?><? echo $arResult["NAV_STRING"]; ?><?
    }
    ?>




    <?
    if (empty($_GET["PAGEN_1"])):
    
    $this->SetViewTarget("section_description");
    ?>
    
    <div class="listing__description">
	<div class="wrapper">
    <?=$arResult["~DESCRIPTION"];?>
    
    </div>
	</div>
    <?$this->EndViewTarget();
    
         endif; ?>
  
    

  

<? else: ?>
    <div id="empty">
        <div class="emptyWrapper">
            <div class="pictureContainer">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/emptyFolder.png" alt="<?= GetMessage("EMPTY_HEADING") ?>"
                     class="emptyImg">
            </div>
            <div class="info">
                <h3><?= GetMessage("EMPTY_HEADING") ?></h3>
                <p><?= GetMessage("EMPTY_TEXT") ?></p>
                <a href="<?= SITE_DIR ?>" class="back"><?= GetMessage("MAIN_PAGE") ?></a>
            </div>
        </div>
        <? $APPLICATION->IncludeComponent("bitrix:menu", "emptyMenu", Array(
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
        ); ?>
    </div>
<? endif; ?>