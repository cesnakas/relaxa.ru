<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$propertyCounter = 0;
$morePhotoCounter = 0;
$countPropertyElements = 7;
global $USER;
?>
<?
$this->AddEditAction($arResult["ID"], $arResult["EDIT_LINK"], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult["ID"], $arResult["DELETE_LINK"], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<style>
    body {
        background-color: #e4e4e4;
    }

    h1.changeName, .rg_hidden {
        display: none;
    }

    .button_color_tovar {
        display: none;
    }

    .buttoms_slider_tovar {
        display: none;
    }

    #detailText {
        padding: 0 24px;
        overflow: auto;
    }
</style>

<div class="page tovar" id="<?= $this->GetEditAreaId($arResult["ID"]); ?>">
    <div class="body_tovar">
        <div class="container">
            <div class="top_block_tovar">
                <div class="title" style="text-transform: uppercase"><h1><?= $arResult['NAME'] ?></h1></div>
                <div class="left_block_tovar">
                    <div class="slider_tovar">


                        <? if (!empty($arResult["PROPERTIES"]["OFFERS"]["VALUE"])): ?>
                            <div class="products">
                                <div class="markerContainer">
                                    <? foreach ($arResult["PROPERTIES"]["OFFERS"]["VALUE"] as $ifv => $marker): ?>
                                        <div class="marker"
                                             style="background-color: <?= strstr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? $arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv] : "#424242" ?>"><?= $marker ?></div>
                                    <? endforeach; ?>
                                </div>
                            </div>
                        <? endif; ?>
                        <? if (!empty($arResult["IMAGES"])): ?>
                            <div id="pictureContainer">
                                <div class="pictureSlider">
                                    <? foreach ($arResult["IMAGES"] as $ipr => $arNextPicture): ?>
                                        <div class="item b_img">
                                            <a href="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>"
                                               title="<?= GetMessage("CATALOG_ELEMENT_ZOOM") ?>" class="zoom"
                                               data-small-picture="<?= $arNextPicture["SMALL_IMAGE"]["SRC"] ?>"
                                               data-large-picture="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>"><img
                                                        src="<?= $arNextPicture["MEDIUM_IMAGE"]["SRC"] ?>" alt=""></a>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                            </div>

                        <? endif; ?>


                        <style>

                            #pictureContainer {
                                width: 600px !important;
                                float: left;
                                overflow: hidden;
                            }

                            .slideBox {
                                width: auto !important;
                            }

                            .slideBox .item {
                                float: left;
                                width: 130px !important;
                                height: 100px;
                            }

                            .slider_tovar .b_img {
                                width: 581px;
                                float: left;
                            }

                            .top_block_tovar > .left_block_tovar > .slider_tovar > .l_imgs {
                                width: 261px;
                                float: left;
                                height: 400px;
                            }

                            .markerContainer {
                                display: none;
                            }

                            @media (max-width: 1202px) {
                                .top_block_tovar > .left_block_tovar > .slider_tovar > .b_img {
                                    width: 100%;
                                }

                                #pictureContainer {
                                    width: auto !important;

                                }
                            }

                            #detailText .heading {
                                border-top: 1px solid #efefef;
                                font-family: 'robotobold';
                                text-transform: uppercase;
                                letter-spacing: 1px;
                                padding: 24px 0px 12px 0;
                                font-weight: 800;
                                font-size: 20px;
                                display: block;
                            }

                            .body_tovar * {
                                -webkit-box-sizing: border-box !important;;
                                -moz-box-sizing: border-box !important;;
                                -ms-box-sizing: border-box !important;;
                                -o-box-sizing: border-box !important;;
                                box-sizing: border-box !important;;
                            }

                            .top_block * {
                                -webkit-box-sizing: border-box !important;;
                                -moz-box-sizing: border-box !important;;
                                -ms-box-sizing: border-box !important;;
                                -o-box-sizing: border-box !important;;
                                box-sizing: border-box !important;;
                            }

                            .slideBox .item:nth-child(n+9) {
                                /*display: none !important;*/
                            }
                        </style>
                        <!--  <div class="b_img">
                              <img src="/bitrix/templates/dresscodeV2/img/tovar_img.jpg" alt="">
                          </div>-->
                        <div class="l_imgs no_adaptive">
                            <div class="img_list">
                                <div id="moreImagesCarousel"<? if (count($arResult["IMAGES"]) <= 1): ?> class="hide"<? endif; ?>>
                                    <div class="carouselWrapper">
                                        <div class="slideBox">
                                            <? if (count($arResult["IMAGES"]) > 1): ?>
                                                <? foreach ($arResult["IMAGES"] as $ipr => $arNextPicture): ?>
                                                    <div class="item">
                                                        <a href="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>"
                                                           data-large-picture="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>"
                                                           data-small-picture="<?= $arNextPicture["SMALL_IMAGE"]["SRC"] ?>">
                                                            <img src="<?= $arNextPicture["SMALL_IMAGE"]["SRC"] ?>"
                                                                 alt="">
                                                        </a>
                                                    </div>
                                                <? endforeach; ?>
                                            <? endif; ?>
                                        </div>
                                    </div>
                                    <div class="controls">
                                        <a href="#" id="moreImagesLeftButton"></a>
                                        <a href="#" id="moreImagesRightButton"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="buttoms_slider_tovar">
                                <p id="rg_prev_slide"><img src="/bitrix/templates/dresscodeV2/img/slider_prev.png"
                                                           alt=""></p>
                                <p id="rg_next_slide"><img src="/bitrix/templates/dresscodeV2/img/slider_next.png"
                                                           alt=""></p>
                            </div>
                        </div>
                        <? if ($arResult['PROPERTIES']['COLOR_SELECT']['VALUE']): ?>
                            <div class="colors_tovar">
                                <div class="button_color_tovar">
                                    <p>ЦВЕТА</p> | <a href="">УВЕЛИЧИТЬ <img
                                                src="/bitrix/templates/dresscodeV2/img/open_img.png" alt=""></a>
                                </div>
                                <div class="color_list_tovar">
                                    <noindex>
                                        <a rel="nofollow" href="http://relaxa.pro/">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_1.jpg"
                                                            alt="">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_2.jpg"
                                                            alt="">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_3.jpg"
                                                            alt="">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_4.jpg"
                                                            alt="">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_5.jpg"
                                                            alt="">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_6.jpg"
                                                            alt="">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_7.jpg"
                                                            alt="">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_8.jpg"
                                                            alt="">
                                            <img src="/bitrix/templates/dresscodeV2/img/tovar_color_9.jpg"
                                                            alt="">
                                        </a>
                                    </noindex>
                                </div>
                            </div>
                        <? endif; ?>
                    </div>
                </div>
                <div class="right_block_tovar">


                    <style>
                        .tovar_right_top_img img {
                            width: 43px;
                        }
                    </style>

                    <div class="tovar_right_top_img">


                        <? foreach ($arResult["PROPERTIES"]["SVOISTVA_KR"]["VALUE"] as $ifv2 => $marker2): ?>
                            <img src="/bitrix/templates/dresscodeV2/img-2/<?= $marker2 ?><? /*=strstr($arResult["PROPERTIES"]["SVOISTVA_KR"]["VALUE_XML_ID"][$ifv2], "#") ? $arResult["PROPERTIES"]["SVOISTVA_KR"]["VALUE_XML_ID"][$ifv2] : "#424242"*/ ?>"
                                 alt="">

                            <!--<div class="marker" style="background-color: <?= strstr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? $arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv] : "#424242" ?>"><?= $marker ?></div>-->
                        <? endforeach; ?>


                        <!--
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_1.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_3.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_2.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_1.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_4.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_2.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_3.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_1.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_2.png" alt="">
                                                <img src="/bitrix/templates/dresscodeV2/img/product_add_1.png" alt="">-->
                    </div>

                    <? if (!empty($arResult["BRAND"]["PICTURE"])): ?>
                        <a href="<?= $arResult["BRAND"]["DETAIL_PAGE_URL"] ?>" class="brandImage"><img
                                    src="<?= $arResult["BRAND"]["PICTURE"]["src"] ?>"
                                    alt="<?= $arResult["BRAND"]["NAME"] ?>"></a>
                    <? endif; ?>




                    <? include($_SERVER["DOCUMENT_ROOT"] . "/" . $templateFolder . "/include/right_section.php"); ?>


                </div>
            </div>
            <div class="tabs_block_tovar">
                <div class="menu_tovar">
                    <ul>
                        <li><a class="scrollto" href="#text_block_tovar">ОПИСАНИЕ</a></li>
                        <li><a class="scrollto" href="#elementProperties">ХАРАКТЕРИСТИКИ</a></li>
                        <li><a class="scrollto" href="#similar_block_tovar">ПОХОЖИЕ ТОВАРЫ</a></li>
                        <li><a class="red scrollto" href="#reviews_block_tovar">ОТЗЫВЫ</a></li>
                    </ul>
                </div>
            </div>

            <style>
                .ppppp1 .container {
                    float: left;
                    width: 50%;
                }

                @media (max-width: 1000px) {
                    .ppppp1 .container {
                        float: left;
                        width: 100%;
                    }
                }
            </style>
            <div class="text_block_tovar" id="text_block_tovar">

                <div id="detailText" class="ppppp1">
                    <div class="container">
                        <div class="heading">Краткое описание:</div>
                        <?= $arResult["PREVIEW_TEXT"] ?>
                    </div>


                    <div class="container">
                        <div style="padding: 0px 0px !important;" class="changePropertiesGroup">
                            <? $APPLICATION->IncludeComponent(
                                "dresscode:catalog.properties.list",
                                "group",
                                array(
                                    "PRODUCT_ID" => $arResult["ID"],
                                    "ELEMENT_LAST_SECTION_ID" => $arResult["LAST_SECTION"]["ID"],
                                    "COMPONENT_TEMPLATE" => "group",
                                    "IBLOCK_TYPE" => "catalog",
                                    "IBLOCK_ID" => "1",
                                    "PROP_NAME" => "",
                                    "PROP_VALUE" => "",
                                    "ELEMENTS_COUNT" => "20",
                                    "POP_LAST_ELEMENT" => "Y",
                                    "SELECT_FIELDS" => array(
                                        0 => "",
                                        1 => "*",
                                    ),
                                    "SORT_PROPERTY_NAME" => "sort",
                                    "SORT_VALUE" => "DESC",
                                    "PICTURE_WIDTH" => "200",
                                    "PICTURE_HEIGHT" => "140",
                                    "CACHE_TYPE" => "A",
                                    "CACHE_TIME" => "360000"
                                ),
                                false
                            ); ?>
                        </div>

                    </div>

                </div>


                <div class="title" style="color: #800000;"><?= $arResult['NAME'] ?></div>


                <? if (!empty($arResult["DETAIL_TEXT"])): ?>
                    <div id="detailText">
                        <div class="heading"><?= GetMessage("CATALOG_ELEMENT_DETAIL_TEXT_HEADING") ?></div>
                        <div class="ttext-ccolor">
                            <div class="changeDescription"
                                 data-first-value='<?= str_replace("'", "", $arResult["~DETAIL_TEXT"]) ?>'><?= $arResult["~DETAIL_TEXT"] ?></div>
                        </div>
                    </div>
                <? endif; ?>


                <!--
                                <div class="media_block_tovar">
                                    <div class="img_tovar">
                                        <img src="/bitrix/templates/dresscodeV2/img/tovar_media_1.jpg" alt="">
                                    </div>
                                    <div class="video_tovar no_adaptive">
                                        <img src="/bitrix/templates/dresscodeV2/img/tovar_media_2.jpg" alt="">
                                    </div>
                                </div>-->


            </div>


            <div class="option_block_tovar" id="option_block_tovar">

            </div>


            <div class="similar_block_tovar" id="similar_block_tovar">


                <? if ($arResult["SHOW_SIMILAR"] == "Y"): ?>
                    <div id="similar">
                        <div class="heading"><?= GetMessage("CATALOG_ELEMENT_SIMILAR") ?>
                            (<?= $arResult["SIMILAR_COUNT"] ?>)
                        </div>
                        <? $APPLICATION->IncludeComponent(
	"bitrix:catalog.section", 
	"squares_act", 
	array(
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
		"CONVERT_CURRENCY" => "N",
		"CURRENCY_ID" => $arParams["CURRENCY_ID"],
		"ADD_SECTIONS_CHAIN" => "N",
		"COMPONENT_TEMPLATE" => "squares_act",
		"SECTION_ID" => $_REQUEST["SECTION_ID"],
		"SECTION_CODE" => $_REQUEST["SECTION_CODE"],
		"SECTION_USER_FIELDS" => array(
			0 => "",
			1 => "",
		),
		"ELEMENT_SORT_FIELD" => "rand",
		"ELEMENT_SORT_ORDER" => "asc",
		"ELEMENT_SORT_FIELD2" => "rand",
		"ELEMENT_SORT_ORDER2" => "desc",
		"FILTER_NAME" => "similarFilter",
		"INCLUDE_SUBSECTIONS" => "Y",
		"SHOW_ALL_WO_SECTION" => "Y",
		"HIDE_NOT_AVAILABLE" => "Y",
		"PAGE_ELEMENT_COUNT" => "8",
		"LINE_ELEMENT_COUNT" => "3",
		"PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_LIMIT" => "5",
		"BACKGROUND_IMAGE" => "-",
		"SECTION_URL" => "#SECTION_CODE#",
		"DETAIL_URL" => "/#IBLOCK_CODE#/#SECTION_CODE_PATH#/#ELEMENT_ID#/",
		"SECTION_ID_VARIABLE" => "CODE",
		"SEF_MODE" => "N",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"CACHE_TYPE" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"SET_TITLE" => "Y",
		"SET_BROWSER_TITLE" => "Y",
		"BROWSER_TITLE" => "-",
		"SET_META_KEYWORDS" => "Y",
		"META_KEYWORDS" => "-",
		"SET_META_DESCRIPTION" => "Y",
		"META_DESCRIPTION" => "-",
		"SET_LAST_MODIFIED" => "N",
		"USE_MAIN_ELEMENT_SECTION" => "N",
		"CACHE_FILTER" => "Y",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRICE_CODE" => array(
			0 => "Розничная",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"BASKET_URL" => "/personal/basket.php",
		"USE_PRODUCT_QUANTITY" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRODUCT_PROPERTIES" => array(
		),
		"PAGER_TEMPLATE" => "round",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "N",
		"PAGER_TITLE" => GetMessage("CATALOG_ELEMENT_SIMILAR"),
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SET_STATUS_404" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"HIDE_MEASURES" => "N",
		"HIDE_NOT_AVAILABLE_OFFERS" => "N",
		"DISPLAY_COMPARE" => "N",
		"COMPATIBLE_MODE" => "Y",
		"DISABLE_INIT_JS_IN_COMPONENT" => "N",
		"SEF_RULE" => "#SECTION_CODE#",
		"SECTION_CODE_PATH" => $_REQUEST["SECTION_CODE_PATH"]
	),
	false
); ?>
                    </div>
                <? endif; ?>


            </div>


            <div id="elementContainer" class="column">

                <? if (!empty($arResult["COMPLECT"]["ITEMS"])): ?>
                    <div id="complect">
                        <span class="heading"><?= GetMessage("ELEMENT_COMPLECT_HEADING") ?></span>
                        <div class="complectList">
                            <? foreach ($arResult["COMPLECT"]["ITEMS"] as $inc => $arNextComplect): ?>
                                <div class="complectListItem">
                                    <div class="complectListItemWrap">
                                        <div class="complectListItemPicture">
                                            <a href="<?= $arNextComplect["DETAIL_PAGE_URL"] ?>"
                                               class="complectListItemPicLink"><img
                                                        src="<?= $arNextComplect["PICTURE"]["src"] ?>"
                                                        alt="<?= $arNextComplect["NAME"] ?>"></a>
                                        </div>
                                        <div class="complectListItemName">
                                            <a href="<?= $arNextComplect["DETAIL_PAGE_URL"] ?>"
                                               class="complectListItemLink"><span
                                                        class="middle"><?= $arNextComplect["NAME"] ?></span></a>
                                        </div>
                                        <a class="complectListItemPrice">
                                            <?= $arNextComplect["PRICE"]["PRICE_FORMATED"] ?>
                                            <? if ($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arNextComplect["CATALOG_MEASURE"]]["SYMBOL_RUS"])): ?>
                                                <span class="measure"> /<? if (!empty($arNextComplect["QUANTITY"]) && $arNextComplect["QUANTITY"] != 1): ?> <?= $arNextComplect["QUANTITY"] ?><? endif; ?> <?= $arResult["MEASURES"][$arNextComplect["CATALOG_MEASURE"]]["SYMBOL_RUS"] ?></span>
                                            <? endif; ?>
                                            <? if ($arNextComplect["PRICE"]["PRICE_DIFF"] > 0): ?>
                                                <s class="discount"><?= $arNextComplect["PRICE"]["BASE_PRICE_FORMATED"] ?></s>
                                            <? endif; ?>
                                        </a>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="complectResult">
                            <?= GetMessage("CATALOG_ELEMENT_COMPLECT_PRICE_RESULT") ?>
                            <div class="complectPriceResult"><?= $arResult["COMPLECT"]["RESULT_PRICE_FORMATED"]; ?></div>
                            <? if ($arResult["COMPLECT"]["RESULT_BASE_DIFF"] > 0): ?>
                                <s class="discount"><?= $arResult["COMPLECT"]["RESULT_BASE_PRICE_FORMATED"]; ?></s>
                                <div class="complectResultEconomy">
                                    <?= GetMessage("CATALOG_ELEMENT_COMPLECT_ECONOMY") ?> <span
                                            class="complectResultEconomyValue"><?= $arResult["COMPLECT"]["RESULT_BASE_DIFF_FORMATED"] ?></span>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                <? endif; ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.set.constructor",
                    ".default",
                    array(
                        "IBLOCK_TYPE_ID" => $arResult["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                        "ELEMENT_ID" => $arResult["ID"],
                        "BASKET_URL" => "/personal/cart/",
                        "CACHE_TYPE" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_GROUPS" => "Y",
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "PRICE_VAT_INCLUDE" => "N",
                        "CONVERT_CURRENCY" => "Y",
                        "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                        "OFFERS_CART_PROPERTIES" => array()
                    ),
                    false
                ); ?>


            </div>


            <div class="reviews_block_tovar" id="reviews_block_tovar">


            </div>


            <style>

                .bx-catalog-tab-list {
                    display: none;
                }

                #elementTools {
                    display: none;
                }

                .bx_soc_comments_div.bx_important .bx_medium.bx_bt_button {
                    height: 27px;
                    line-height: 27px;
                    color: black;
                }

                .bx_soc_comments_div.bx_important .bx_medium.bx_bt_button {
                    text-transform: uppercase;
                    float: right;
                    width: 222px;
                    height: 29px;
                    margin-right: 21px;
                    border: none;
                    color: #fff;
                    font-weight: 600;
                    background-color: #8f2828;
                    cursor: pointer;
                    z-index: 9;
                    position: relative;
                }
            </style>
            <div class="reviews" id="reviews" style="background-color: white">
                <div class="title_wrap">
                    <h2>ОТЗЫВЫ</h2>
                </div>
                <? if ($arParams["SHOW_REVIEW_FORM"]): ?><? endif; ?>

                <? $curPage = $_SERVER['REQUEST_URI']; ?>
                <? if (strpos($curPage, '/massazhnoe-oborudovanie/') !== false or strpos($curPage, '/massazhnoe-oborudovanie/2') !== false) { ?>
                    <? $PahInfoBlok = 1; ?>
                <? } ?>
                <? if (strpos($curPage, '/fitnes/') !== false or strpos($curPage, '/massazhnoe-oborudovanie/2') !== false) { ?>
                    <? $PahInfoBlok = 13; ?>
                <? } ?>
                <? if (strpos($curPage, '/zdorovie-krasota/') !== false or strpos($curPage, '/massazhnoe-oborudovanie/2') !== false) { ?>
                    <? $PahInfoBlok = 12; ?>
                <? } ?>
                <? if (strpos($curPage, '/terapiya/') !== false or strpos($curPage, '/massazhnoe-oborudovanie/2') !== false) { ?>
                    <? $PahInfoBlok = 14; ?>
                <? } ?>
                <? if (strpos($curPage, '/dom-dacha/') !== false or strpos($curPage, '/massazhnoe-oborudovanie/2') !== false) { ?>
                    <? $PahInfoBlok = 15; ?>
                <? } ?>



                <? /*$APPLICATION->IncludeComponent(
                    "bitrix:catalog.comments",
                    "",
                    Array(
                        "AJAX_POST" => "Y",
                        "BLOG_TITLE" => "",
                        "BLOG_URL" => $arParams['BLOG_URL'],
                        "BLOG_USE" => "Y",
                        "CACHE_GROUPS" => $arParams['CACHE_GROUPS'],
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "A",
                        "CHECK_DATES" => "Y",
                        "COMMENTS_COUNT" => "10",
                        "ELEMENT_CODE" => "",
                        "ELEMENT_ID" => $arResult['ID'],
                        "EMAIL_NOTIFY" => "N",
                        "FB_APP_ID" => $arParams['FB_APP_ID'],
                        "FB_COLORSCHEME" => "light",
                        "FB_ORDER_BY" => "reverse_time",
                        "FB_TITLE" => "Facebook",
                        "FB_USE" => "N",
                        "FB_USER_ADMIN_ID" => "",
                        "IBLOCK_ID" => $PahInfoBlok,
                        "IBLOCK_TYPE" => "catalog",
                        "PATH_TO_SMILE" => "",
                        "SHOW_DEACTIVATED" => "N",
                        "SHOW_RATING" => "N",
                        "SHOW_SPAM" => "Y",
                        "TEMPLATE_THEME" => "black",
                        "URL_TO_COMMENT" => "",
                        "VK_API_ID" => $arParams['VK_API_ID'],
                        "VK_TITLE" => "В контакте",
                        "VK_USE" => "N",
                        "WIDTH" => ""
                    ),
                    $component,
                    Array(
                        'HIDE_ICONS' => 'N'
                    )
);*/ ?>
                <ul>
                    <?
                    $iblockReview = 18;
                    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_ID");
                    $arFilter = Array("IBLOCK_ID" => $iblockReview, "PROPERTY_PRODUCT" => $arResult['ID'], "ACTIVE" => "Y");
                    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize" => 50), $arSelect);
                    while ($ob = $res->GetNextElement()) {
                        $i = 1;
                        $arFields = $ob->GetFields();
                        $arFields['PROP'] = $ob->GetProperties();
                        // print_r($arFields);
                        ?>
                        <li>
                            <div class="meta">
                                <span class="author"><?= $arFields['PROP']['NAME']['VALUE']; ?></span>
                                <span class="date"><?= ConvertDateTime($arFields['DATE_ACTIVE_FROM'], "DD.MM, HH:MI", "s1"); ?></span>
                            </div>
                            <?
                            if ($arFields['NAME'] != "Без названия"):?>
                                <h4><?= $arFields['NAME']; ?></h4>
                            <?endif; ?>
                            <div class="rating">
                                <label>
                                    <?
                                    while ($i <= $arFields['PROP']['RATE']['VALUE']):?>
                                        <span class="icon">★</span>
                                        <?
                                        $i++; ?>
                                    <?endwhile; ?>
                                </label>
                            </div>
                            <?
                            if ($arFields['PROP']['ADVANTAGE']['VALUE']['TEXT']):?>
                                <div class="text">
                                    <span>Преимущества:</span>
                                    <?= $arFields['PROP']['ADVANTAGE']['VALUE']['TEXT']; ?>
                                </div>
                            <?endif; ?>
                            <?
                            if ($arFields['PROP']['DISADVANTAGE']['VALUE']['TEXT']):?>
                                <div class="text">
                                    <span>Недостатки:</span>
                                    <?= $arFields['PROP']['DISADVANTAGE']['VALUE']['TEXT']; ?>
                                </div>
                            <?endif; ?>
                            <?
                            if ($arFields['PROP']['COMMENT']['VALUE']['TEXT']):?>
                                <div class="text">
                                    <span>Комментарий:</span>
                                    <?= $arFields['PROP']['COMMENT']['VALUE']['TEXT']; ?>
                                </div>
                            <?endif; ?>
                        </li>
                        <?
                    }
                    ?>
                </ul>
                <div class="center">
                    <a href="#addReview" class="btn modal">Добавить отзыв</a>
                </div>
            </div>

            <div class="modal" id="addReview">
                <div class="closs_th_modal_b"><img src="img/closs_modal.png" alt=""></div>
                <div class="title_modal">
                    <h2>Написать отзыв</h2>
                </div>
                <form action="/ajax/addReview.php" class="js-ajax">
                    <input type="hidden" name="PRODUCT" id="" value="<?= $arResult['ID'] ?>">
                    <div class="rating">
                        <label>
                            <input type="radio" name="RATE" value="113"/>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="RATE" value="114"/>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="RATE" value="115"/>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="RATE" value="116"/>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                        <label>
                            <input type="radio" name="RATE" value="117"/>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                            <span class="icon">★</span>
                        </label>
                    </div>
                    <input type="text" name="NAME_P" id="" placeholder="Заголовок">
                    <input type="text" name="NAME" id="" placeholder="Имя">
                    <textarea name="ADVANTAGE" id="" cols="30" rows="2" placeholder="Преимущества"></textarea>
                    <textarea name="DISADVANTAGE" id="" cols="30" rows="2" placeholder="Недостатки"></textarea>
                    <textarea name="COMMENT" id="" cols="30" rows="2" placeholder="сообщение"></textarea>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6LcdxHYUAAAAAP884zsmT5mseHRbgB-97duvaEoS"></div>
                    </div>
                    <input type="submit" value="Отправить отзыв">
                    <p class="success"></p>
                    <p class="error"></p>
                </form>
            </div>


        </div>
    </div>
</div>


<div id="<?= $this->GetEditAreaId($arResult["ID"]); ?>">


    <style>
        @media (min-width: 1100px) {
            .skrivaem-1 {
                display: none !important;
            }
        }
    </style>


    <div style="display: none" id="catalogElement"
         class="item<? if (!empty($arResult["SKU_PRODUCT"])): ?> elementSku<? endif; ?>"
         data-product-id="<?= !empty($arResult["~ID"]) ? $arResult["~ID"] : $arResult["ID"] ?>"
         data-iblock-id="<?= $arResult["SKU_INFO"]["IBLOCK_ID"] ?>"
         data-prop-id="<?= $arResult["SKU_INFO"]["SKU_PROPERTY_ID"] ?>"
         data-hide-measure="<?= $arParams["HIDE_MEASURES"] ?>">
        <!-- <div id="elementSmallNavigation">
            <? if (!empty($arResult["TABS"])): ?>
                <div class="tabs">
                    <? foreach ($arResult["TABS"] as $it => $arTab): ?>
                        <div class="tab<? if ($arTab["ACTIVE"] == "Y"): ?> active<? endif; ?>" data-id="<?= $arTab["ID"] ?>"><a href="<? if (!empty($arTab["LINK"])): ?><?= $arTab["LINK"] ?><? else: ?>#<? endif; ?>"><span><?= $arTab["NAME"] ?></span></a></div>
                    <? endforeach; ?>
                </div>
            <? endif; ?>
        </div>-->
        <div id="tableContainer" style="background-color: transparent">
            <div id="elementNavigation" class="column">
                <? if (!empty($arResult["TABS"])): ?>
                    <div class="tabs">
                        <? foreach ($arResult["TABS"] as $it => $arTab): ?>
                            <div class="tab<? if ($arTab["ACTIVE"] == "Y"): ?> active<? endif; ?>"
                                 data-id="<?= $arTab["ID"] ?>"><a
                                        href="<? if (!empty($arTab["LINK"])): ?><?= $arTab["LINK"] ?><? else: ?>#<? endif; ?>"><?= $arTab["NAME"] ?>
                                    <img src="<?= $arTab["PICTURE"] ?>" alt="<?= $arTab["NAME"] ?>"></a></div>
                        <? endforeach; ?>
                    </div>
                <? endif; ?>
            </div>
            <div id="elementContainer" class="column">
                <div class="mainContainer" id="browse">
                    <div class="col">
                        <? if (!empty($arResult["PROPERTIES"]["OFFERS"]["VALUE"])): ?>
                            <div class="markerContainer">
                                <? foreach ($arResult["PROPERTIES"]["OFFERS"]["VALUE"] as $ifv => $marker): ?>
                                    <div class="marker"
                                         style="background-color: <?= strstr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? $arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv] : "#424242" ?>"><?= $marker ?></div>
                                <? endforeach; ?>
                            </div>
                        <? endif; ?>
                        <!--<? if (!empty($arResult["IMAGES"])): ?>
							<div id="pictureContainer">
								<div class="pictureSlider">
									<? foreach ($arResult["IMAGES"] as $ipr => $arNextPicture): ?>
										<div class="item">
											<a href="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>" title="<?= GetMessage("CATALOG_ELEMENT_ZOOM") ?>"  class="zoom" data-small-picture="<?= $arNextPicture["SMALL_IMAGE"]["SRC"] ?>" data-large-picture="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>"><img src="<?= $arNextPicture["MEDIUM_IMAGE"]["SRC"] ?>" alt=""></a>
										</div>
									<? endforeach; ?>
								</div>
							</div>
								<div id="moreImagesCarousel"<? if (count($arResult["IMAGES"]) <= 1): ?> class="hide"<? endif; ?>>
									<div class="carouselWrapper">
										<div class="slideBox">
											<? if (count($arResult["IMAGES"]) > 1): ?>
												<? foreach ($arResult["IMAGES"] as $ipr => $arNextPicture): ?>
													<div class="item">
														<a href="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>" data-large-picture="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>" data-small-picture="<?= $arNextPicture["SMALL_IMAGE"]["SRC"] ?>">
															<img src="<?= $arNextPicture["SMALL_IMAGE"]["SRC"] ?>" alt="">
														</a>
													</div>
												<? endforeach; ?>
											<? endif; ?>
										</div>
									</div>
									<div class="controls">
										<a href="#" id="moreImagesLeftButton"></a>
										<a href="#" id="moreImagesRightButton"></a>
									</div>
								</div>
						<? endif; ?>-->
                    </div>


                    <div class="col<? if (empty($arResult["PREVIEW_TEXT"]) && empty($arResult["SKU_PRODUCT"]) && empty($arResult["DISPLAY_PROPERTIES"])): ?> hide<? endif; ?> skrivaem-1">


                        <? if (!empty($arResult["BRAND"]["PICTURE"])): ?>
                            <a href="<?= $arResult["BRAND"]["DETAIL_PAGE_URL"] ?>" class="brandImage"><img
                                        src="<?= $arResult["BRAND"]["PICTURE"]["src"] ?>"
                                        alt="<?= $arResult["BRAND"]["NAME"] ?>"></a>
                        <? endif; ?>
                        <!--
                        <? if (!empty($arResult["PREVIEW_TEXT"])): ?>
							<div class="description">
								<div class="heading"><?= GetMessage("CATALOG_ELEMENT_PREVIEW_TEXT_LABEL") ?></div>
								<div class="changeShortDescription" data-first-value='<?= $arResult["PREVIEW_TEXT"] ?>'><?= $arResult["PREVIEW_TEXT"] ?></div>
							</div>
						<? endif; ?>
-->

                        <? if (!empty($arResult["SKU_PRODUCT"])): ?>
                            <? if (!empty($arResult["SKU_PROPERTIES"]) && $level = 1): ?>
                                <div class="elementSkuVariantLabel"><?= GetMessage("SKU_VARIANT_LABEL") ?></div>
                                <? foreach ($arResult["SKU_PROPERTIES"] as $propName => $arNextProp): ?>
                                    <? if (!empty($arNextProp["VALUES"])): ?>
                                        <div class="elementSkuProperty" data-name="<?= $propName ?>"
                                             data-level="<?= $level++ ?>"
                                             data-highload="<?= $arNextProp["HIGHLOAD"] ?>">
                                            <div class="elementSkuPropertyName"><?= $arNextProp["NAME"] ?>:</div>
                                            <ul class="elementSkuPropertyList">
                                                <? foreach ($arNextProp["VALUES"] as $xml_id => $arNextPropValue): ?>
                                                    <li class="elementSkuPropertyValue<? if ($arNextPropValue["DISABLED"] == "Y"): ?> disabled<? elseif ($arNextPropValue["SELECTED"] == "Y"): ?> selected<? endif; ?>"
                                                        data-name="<?= $propName ?>"
                                                        data-value="<?= $arNextPropValue["VALUE"] ?>">
                                                        <a href="#" class="elementSkuPropertyLink">
                                                            <? if (!empty($arNextPropValue["IMAGE"])): ?>
                                                                <img src="<?= $arNextPropValue["IMAGE"]["src"] ?>">
                                                            <? else: ?>
                                                                <?= $arNextPropValue["DISPLAY_VALUE"] ?>
                                                            <? endif; ?>
                                                        </a>
                                                    </li>
                                                <? endforeach; ?>
                                            </ul>
                                        </div>
                                    <? endif; ?>
                                <? endforeach; ?>
                            <? endif; ?>
                        <? endif; ?>

                        <!--<div class="changePropertiesNoGroup">
							<? $APPLICATION->IncludeComponent(
                            "dresscode:catalog.properties.list",
                            "no-group",
                            array(
                                "PRODUCT_ID" => $arResult["ID"],
                                "COUNT_PROPERTIES" => $countPropertyElements,
                                "ELEMENT_LAST_SECTION_ID" => $arResult["LAST_SECTION"]["ID"],
                                "COMPONENT_TEMPLATE" => "no-group",
                                "IBLOCK_TYPE" => "catalog",
                                "IBLOCK_ID" => "1",
                                "PROP_NAME" => "",
                                "PROP_VALUE" => "",
                                "ELEMENTS_COUNT" => "20",
                                "POP_LAST_ELEMENT" => "Y",
                                "SELECT_FIELDS" => array(
                                    0 => "",
                                    1 => "*",
                                ),
                                "SORT_PROPERTY_NAME" => "sort",
                                "SORT_VALUE" => "DESC",
                                "PICTURE_WIDTH" => "200",
                                "PICTURE_HEIGHT" => "140",
                                "CACHE_TYPE" => "A",
                                "CACHE_TIME" => "360000"
                            ),
                            false
                        ); ?>
						</div>-->
                    </div>


                </div>
                <? if (!empty($arResult["COMPLECT"]["ITEMS"])): ?>
                    <div id="complect">
                        <span class="heading"><?= GetMessage("ELEMENT_COMPLECT_HEADING") ?></span>
                        <div class="complectList">
                            <? foreach ($arResult["COMPLECT"]["ITEMS"] as $inc => $arNextComplect): ?>
                                <div class="complectListItem">
                                    <div class="complectListItemWrap">
                                        <div class="complectListItemPicture">
                                            <a href="<?= $arNextComplect["DETAIL_PAGE_URL"] ?>"
                                               class="complectListItemPicLink"><img
                                                        src="<?= $arNextComplect["PICTURE"]["src"] ?>"
                                                        alt="<?= $arNextComplect["NAME"] ?>"></a>
                                        </div>
                                        <div class="complectListItemName">
                                            <a href="<?= $arNextComplect["DETAIL_PAGE_URL"] ?>"
                                               class="complectListItemLink"><span
                                                        class="middle"><?= $arNextComplect["NAME"] ?></span></a>
                                        </div>
                                        <a class="complectListItemPrice">
                                            <?= $arNextComplect["PRICE"]["PRICE_FORMATED"] ?>
                                            <? if ($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arNextComplect["CATALOG_MEASURE"]]["SYMBOL_RUS"])): ?>
                                                <span class="measure"> /<? if (!empty($arNextComplect["QUANTITY"]) && $arNextComplect["QUANTITY"] != 1): ?> <?= $arNextComplect["QUANTITY"] ?><? endif; ?> <?= $arResult["MEASURES"][$arNextComplect["CATALOG_MEASURE"]]["SYMBOL_RUS"] ?></span>
                                            <? endif; ?>
                                            <? if ($arNextComplect["PRICE"]["PRICE_DIFF"] > 0): ?>
                                                <s class="discount"><?= $arNextComplect["PRICE"]["BASE_PRICE_FORMATED"] ?></s>
                                            <? endif; ?>
                                        </a>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="complectResult">
                            <?= GetMessage("CATALOG_ELEMENT_COMPLECT_PRICE_RESULT") ?>
                            <div class="complectPriceResult"><?= $arResult["COMPLECT"]["RESULT_PRICE_FORMATED"]; ?></div>
                            <? if ($arResult["COMPLECT"]["RESULT_BASE_DIFF"] > 0): ?>
                                <s class="discount"><?= $arResult["COMPLECT"]["RESULT_BASE_PRICE_FORMATED"]; ?></s>
                                <div class="complectResultEconomy">
                                    <?= GetMessage("CATALOG_ELEMENT_COMPLECT_ECONOMY") ?> <span
                                            class="complectResultEconomyValue"><?= $arResult["COMPLECT"]["RESULT_BASE_DIFF_FORMATED"] ?></span>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                <? endif; ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.set.constructor",
                    ".default",
                    array(
                        "IBLOCK_TYPE_ID" => $arResult["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                        "ELEMENT_ID" => $arResult["ID"],
                        "BASKET_URL" => "/personal/cart/",
                        "CACHE_TYPE" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_GROUPS" => "Y",
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "PRICE_VAT_INCLUDE" => "N",
                        "CONVERT_CURRENCY" => "Y",
                        "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                        "OFFERS_CART_PROPERTIES" => array()
                    ),
                    false
                ); ?>


            </div>
            <div id="elementTools" class="column">
                <div class="fixContainer">
                    <? /* include($_SERVER["DOCUMENT_ROOT"]."/".$templateFolder."/include/right_section.php");*/ ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!--
<style>
    .container {
        width: 1230px;
    }
</style>
-->
<div id="elementError">
    <div id="elementErrorContainer">
        <span class="heading"><?= GetMessage("ERROR") ?></span>
        <a href="#" id="elementErrorClose"></a>
        <p class="message"></p>
        <a href="#" class="close"><?= GetMessage("CLOSE") ?></a>
    </div>
</div>

<script type="text/javascript">

    var CATALOG_LANG = {
        REVIEWS_HIDE: "<?=GetMessage("REVIEWS_HIDE")?>",
        REVIEWS_SHOW: "<?=GetMessage("REVIEWS_SHOW")?>",
        OLD_PRICE_LABEL: "<?=GetMessage("OLD_PRICE_LABEL")?>",
    };

    var elementAjaxPath = "<?=$templateFolder . "/ajax.php"?>";

</script>

<div itemscope itemtype="http://schema.org/Product" class="microdata">
    <meta itemprop="name" content="<?= $arResult["NAME"] ?>"/>
    <link itemprop="url" href="<?= $arResult["DETAIL_PAGE_URL"] ?>"/>
    <link itemprop="image" href="<?= $arResult["IMAGES"][0]["LARGE_IMAGE"]["SRC"] ?>"/>
    <meta itemprop="brand" content="<?= $arResult["BRAND"]["NAME"] ?>"/>
    <meta itemprop="model" content="<?= $arResult["PROPERTIES"]["CML2_ARTICLE"]["VALUE"] ?>"/>
    <meta itemprop="productID" content="<?= $arResult["ID"] ?>"/>
    <meta itemprop="category" content="<?= $arResult["SECTION"]["NAME"] ?>"/>
    <div <?php if (empty($arResult["PROPERTIES"]["RATING"]["VALUE"]) === false && count($arResult["REVIEWS"]) > 0): ?>
itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" <?php endif; ?> >
    <?php if (empty($arResult["PROPERTIES"]["RATING"]["VALUE"]) === false && count($arResult["REVIEWS"]) > 0): ?>
        <meta itemprop="ratingValue" content="<?= $arResult["PROPERTIES"]["RATING"]["VALUE"] ?>">
        <meta itemprop="reviewCount" content="<?= count($arResult["REVIEWS"]) ?>">
    <?php endif; ?>
    </div>
    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <meta itemprop="priceCurrency"
              content="<? if (!empty($arResult["MIN_PRICE"]["CURRENCY"])): ?><?= $arResult["MIN_PRICE"]["CURRENCY"] ?><? else: ?><?= CCurrency::GetBaseCurrency(); ?><? endif; ?>"/>
        <meta itemprop="price" content="<?= $arResult["MIN_PRICE"]["VALUE"] ?>"/>
        <? if ($arResult["CATALOG_QUANTITY"] > 0): ?>
            <link itemprop="availability" href="http://schema.org/InStock">
        <? else: ?>
            <link itemprop="availability" href="http://schema.org/OutOfStock">
        <? endif; ?>
    </div>
    <? if (!empty($arResult["PREVIEW_TEXT"])): ?>
        <meta itemprop="description" content='<?= str_replace('  ', ' ', strip_tags($arResult["PREVIEW_TEXT"])) ?>'/>
    <? endif; ?>
    <? if (empty($arResult["PREVIEW_TEXT"]) && !empty($arResult["DETAIL_TEXT"])): ?>
        <meta itemprop="description" content='<?= str_replace('  ', ' ', strip_tags($arResult["DETAIL_TEXT"])) ?>'/>
    <? endif; ?>
</div>

<meta property="og:title" content="<?= $arResult["NAME"] ?>"/>
<meta property="og:description" content="<?= str_replace('  ', ' ', strip_tags($arResult["~PREVIEW_TEXT"])) ?>"/>
<meta property="og:url" content="<?= $arResult["DETAIL_PAGE_URL"] ?>"/>
<meta property="og:type" content="website"/>
<? if (!empty($arResult["IMAGES"][0]["LARGE_IMAGE"]["SRC"])): ?>
    <meta property="og:image" content="<?= $arResult["IMAGES"][0]["LARGE_IMAGE"]["SRC"] ?>"/>
<? endif; ?>

<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>


<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$propertyCounter = 0;
$morePhotoCounter = 0;
$countPropertyElements = 7;
global $USER;
?>
<?
$this->AddEditAction($arResult["ID"], $arResult["EDIT_LINK"], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult["ID"], $arResult["DELETE_LINK"], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>
<div id="<?= $this->GetEditAreaId($arResult["ID"]); ?>">
    <div id="catalogElement" class="item<? if (!empty($arResult["SKU_PRODUCT"])): ?> elementSku<? endif; ?>"
         data-product-id="<?= !empty($arResult["~ID"]) ? $arResult["~ID"] : $arResult["ID"] ?>"
         data-iblock-id="<?= $arResult["SKU_INFO"]["IBLOCK_ID"] ?>"
         data-prop-id="<?= $arResult["SKU_INFO"]["SKU_PROPERTY_ID"] ?>"
         data-hide-measure="<?= $arParams["HIDE_MEASURES"] ?>">

        <div id="tableContainer" style="background-color: transparent">
            <div id="elementNavigation" class="column">
                <? if (!empty($arResult["TABS"])): ?>
                    <div class="tabs">
                        <? foreach ($arResult["TABS"] as $it => $arTab): ?>
                            <div class="tab<? if ($arTab["ACTIVE"] == "Y"): ?> active<? endif; ?>"
                                 data-id="<?= $arTab["ID"] ?>"><a
                                        href="<? if (!empty($arTab["LINK"])): ?><?= $arTab["LINK"] ?><? else: ?>#<? endif; ?>"><?= $arTab["NAME"] ?>
                                    <img src="<?= $arTab["PICTURE"] ?>" alt="<?= $arTab["NAME"] ?>"></a></div>
                        <? endforeach; ?>
                    </div>
                <? endif; ?>
            </div>
            <div id="elementContainer" class="column">


                <? if (!empty($arResult["COMPLECT"]["ITEMS"])): ?>
                    <div id="complect">
                        <span class="heading"><?= GetMessage("ELEMENT_COMPLECT_HEADING") ?></span>
                        <div class="complectList">
                            <? foreach ($arResult["COMPLECT"]["ITEMS"] as $inc => $arNextComplect): ?>
                                <div class="complectListItem">
                                    <div class="complectListItemWrap">
                                        <div class="complectListItemPicture">
                                            <a href="<?= $arNextComplect["DETAIL_PAGE_URL"] ?>"
                                               class="complectListItemPicLink"><img
                                                        src="<?= $arNextComplect["PICTURE"]["src"] ?>"
                                                        alt="<?= $arNextComplect["NAME"] ?>"></a>
                                        </div>
                                        <div class="complectListItemName">
                                            <a href="<?= $arNextComplect["DETAIL_PAGE_URL"] ?>"
                                               class="complectListItemLink"><span
                                                        class="middle"><?= $arNextComplect["NAME"] ?></span></a>
                                        </div>
                                        <a class="complectListItemPrice">
                                            <?= $arNextComplect["PRICE"]["PRICE_FORMATED"] ?>
                                            <? if ($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arNextComplect["CATALOG_MEASURE"]]["SYMBOL_RUS"])): ?>
                                                <span class="measure"> /<? if (!empty($arNextComplect["QUANTITY"]) && $arNextComplect["QUANTITY"] != 1): ?> <?= $arNextComplect["QUANTITY"] ?><? endif; ?> <?= $arResult["MEASURES"][$arNextComplect["CATALOG_MEASURE"]]["SYMBOL_RUS"] ?></span>
                                            <? endif; ?>
                                            <? if ($arNextComplect["PRICE"]["PRICE_DIFF"] > 0): ?>
                                                <s class="discount"><?= $arNextComplect["PRICE"]["BASE_PRICE_FORMATED"] ?></s>
                                            <? endif; ?>
                                        </a>
                                    </div>
                                </div>
                            <? endforeach; ?>
                        </div>
                        <div class="complectResult">
                            <?= GetMessage("CATALOG_ELEMENT_COMPLECT_PRICE_RESULT") ?>
                            <div class="complectPriceResult"><?= $arResult["COMPLECT"]["RESULT_PRICE_FORMATED"]; ?></div>
                            <? if ($arResult["COMPLECT"]["RESULT_BASE_DIFF"] > 0): ?>
                                <s class="discount"><?= $arResult["COMPLECT"]["RESULT_BASE_PRICE_FORMATED"]; ?></s>
                                <div class="complectResultEconomy">
                                    <?= GetMessage("CATALOG_ELEMENT_COMPLECT_ECONOMY") ?> <span
                                            class="complectResultEconomyValue"><?= $arResult["COMPLECT"]["RESULT_BASE_DIFF_FORMATED"] ?></span>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                <? endif; ?>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.set.constructor",
                    ".default",
                    array(
                        "IBLOCK_TYPE_ID" => $arResult["IBLOCK_TYPE"],
                        "IBLOCK_ID" => $arResult["IBLOCK_ID"],
                        "ELEMENT_ID" => $arResult["ID"],
                        "BASKET_URL" => "/personal/cart/",
                        "CACHE_TYPE" => "N",
                        "CACHE_TIME" => "36000000",
                        "CACHE_GROUPS" => "Y",
                        "PRICE_CODE" => $arParams["PRICE_CODE"],
                        "PRICE_VAT_INCLUDE" => "N",
                        "CONVERT_CURRENCY" => "Y",
                        "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                        "OFFERS_CART_PROPERTIES" => array()
                    ),
                    false
                ); ?>


                <? if ($arResult["SHOW_RELATED"] == "Y"): ?>
                    <div id="related">
                        <div class="heading"><?= GetMessage("CATALOG_ELEMENT_ACCEESSORIES") ?>
                            (<?= $arResult["RELATED_COUNT"] ?>)
                        </div>
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:catalog.section",
                            "squares",
                            array(
                                "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                "IBLOCK_ID" => $arParams["IBLOCK_ID"],
                                "CONVERT_CURRENCY" => $arParams["CONVERT_CURRENCY"],
                                "CURRENCY_ID" => $arParams["CURRENCY_ID"],
                                "ADD_SECTIONS_CHAIN" => "N",
                                "COMPONENT_TEMPLATE" => "squares",
                                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                "SECTION_CODE" => "",
                                "SECTION_USER_FIELDS" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "ELEMENT_SORT_FIELD" => "sort",
                                "ELEMENT_SORT_ORDER" => "asc",
                                "ELEMENT_SORT_FIELD2" => "id",
                                "ELEMENT_SORT_ORDER2" => "desc",
                                "FILTER_NAME" => "relatedFilter",
                                "INCLUDE_SUBSECTIONS" => "Y",
                                "SHOW_ALL_WO_SECTION" => "Y",
                                "HIDE_NOT_AVAILABLE" => $arParams["HIDE_NOT_AVAILABLE_ELEMENT"],
                                "PAGE_ELEMENT_COUNT" => "8",
                                "LINE_ELEMENT_COUNT" => "3",
                                "PROPERTY_CODE" => array(
                                    0 => "",
                                    1 => "",
                                ),
                                "OFFERS_LIMIT" => "5",
                                "BACKGROUND_IMAGE" => "-",
                                "SECTION_URL" => "",
                                "DETAIL_URL" => "",
                                "SECTION_ID_VARIABLE" => "SECTION_ID",
                                "SEF_MODE" => "N",
                                "AJAX_MODE" => "N",
                                "AJAX_OPTION_JUMP" => "N",
                                "AJAX_OPTION_STYLE" => "Y",
                                "AJAX_OPTION_HISTORY" => "N",
                                "AJAX_OPTION_ADDITIONAL" => "undefined",
                                "CACHE_TYPE" => "Y",
                                "CACHE_TIME" => "36000000",
                                "CACHE_GROUPS" => "Y",
                                "SET_TITLE" => "Y",
                                "SET_BROWSER_TITLE" => "Y",
                                "BROWSER_TITLE" => "-",
                                "SET_META_KEYWORDS" => "Y",
                                "META_KEYWORDS" => "-",
                                "SET_META_DESCRIPTION" => "Y",
                                "META_DESCRIPTION" => "-",
                                "SET_LAST_MODIFIED" => "N",
                                "USE_MAIN_ELEMENT_SECTION" => "N",
                                "CACHE_FILTER" => "Y",
                                "ACTION_VARIABLE" => "action",
                                "PRODUCT_ID_VARIABLE" => "id",
                                "PRICE_CODE" => $arParams["PRICE_CODE"],
                                "USE_PRICE_COUNT" => "N",
                                "SHOW_PRICE_COUNT" => "1",
                                "PRICE_VAT_INCLUDE" => "Y",
                                "BASKET_URL" => "/personal/basket.php",
                                "USE_PRODUCT_QUANTITY" => "N",
                                "PRODUCT_QUANTITY_VARIABLE" => "undefined",
                                "ADD_PROPERTIES_TO_BASKET" => "Y",
                                "PRODUCT_PROPS_VARIABLE" => "prop",
                                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                "PRODUCT_PROPERTIES" => array(),
                                "PAGER_TEMPLATE" => "round",
                                "DISPLAY_TOP_PAGER" => "N",
                                "DISPLAY_BOTTOM_PAGER" => "N",
                                "PAGER_TITLE" => GetMessage("CATALOG_ELEMENT_ACCEESSORIES"),
                                "PAGER_SHOW_ALWAYS" => "N",
                                "PAGER_DESC_NUMBERING" => "N",
                                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                "PAGER_SHOW_ALL" => "N",
                                "PAGER_BASE_LINK_ENABLE" => "N",
                                "SET_STATUS_404" => "N",
                                "SHOW_404" => "N",
                                "MESSAGE_404" => ""
                            ),
                            false
                        ); ?>
                    </div>
                <? endif; ?>





                <? if ($USER->IsAuthorized()): ?>

                <? endif; ?>

            </div>

        </div>
    </div>
</div>



