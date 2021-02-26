<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;


$dbBasketItems = CSaleBasket::GetList(
    array(
        "NAME" => "ASC",
        "ID" => "ASC"
    ),
    array(
        "FUSER_ID" => CSaleBasket::GetBasketUserID(),
        "LID" => SITE_ID,
        "ORDER_ID" => "NULL",
        "DELAY" => "N" //Исключая отложенные
    ),
    false,
    false,
    array("PRODUCT_ID")
);
while ($arItemsBasket = $dbBasketItems->Fetch()) {
    $itInBasket = $arItemsBasket['PRODUCT_ID'];
}
?>

<?
global $IBLOCK_VAR;
?>

<?if(!empty($arResult["ITEMS"])) {?>
    <div class="p-card__prods">
    <div class="wrapper">
    <div class="p-card__p-prods">
    <b class="p-prods__title">
        С этим товаром покупают
    </b>


    <div class="p-prods__slider">
        <?
        foreach ($arResult["ITEMS"] as $index => $arElement):?>
            <?
            $this->AddEditAction($arElement["ID"], $arElement["EDIT_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arElement["ID"], $arElement["DELETE_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            $arElement["IMAGE"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width" => 270, "height" => 250), BX_RESIZE_IMAGE_PROPORTIONAL, false);
            if(empty($arElement["IMAGE"])){
                $arElement["IMAGE"]["src"] = SITE_TEMPLATE_PATH."/images/empty.png";
            }
            ?>

            <?/*echo "<pre>"; print_r($arElement); echo "</pre>";*/?>

            <div class="p-prods__item" id="<?=$this->GetEditAreaId($arElement["ID"]);?>">
                <div class="p-prods__itemwp">

                    <?if($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") {?>
                        <div class="p-prods-izgotzak">
                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.4871 14.346L18.7895 15.6484L15.6484 18.7895L14.346 17.4871C13.825 17.7782 13.2887 17.9927 12.7218 18.1613V20H8.27823V18.1613C7.71129 17.9927 7.175 17.7782 6.65403 17.4871L5.35161 18.7895L2.21048 15.6484L3.5129 14.346C3.22177 13.825 3.00726 13.2887 2.83871 12.7218H1V8.27823H2.83871C3.00726 7.71129 3.22177 7.175 3.5129 6.65403L2.21048 5.35161L5.35161 2.21048L6.65403 3.5129C7.175 3.22178 7.71129 3.00726 8.27823 2.83871V1H12.7218V2.83871C13.2887 3.00726 13.825 3.22178 14.346 3.5129L15.6484 2.21048L18.7895 5.35161L17.4871 6.65403C17.7782 7.175 17.9927 7.71129 18.1613 8.27823H20V12.7218H18.1613C17.9927 13.2887 17.7629 13.825 17.4871 14.346ZM19.3871 8.89113H17.6863L17.625 8.66129C17.4565 8.00242 17.196 7.35887 16.8435 6.76129L16.721 6.5621L17.9315 5.35161L15.6637 3.08387L14.4532 4.29435L14.254 4.17177C13.6565 3.81936 13.0129 3.55887 12.354 3.39032L12.1242 3.32903V1.6129H8.90645V3.31371L8.67661 3.375C8.01774 3.54355 7.37419 3.80403 6.77661 4.15645L6.57742 4.27903L5.36694 3.06855L3.08387 5.35161L4.29435 6.5621L4.17177 6.76129C3.81936 7.35887 3.55887 8.00242 3.39032 8.66129L3.32903 8.89113H1.6129V12.1089H3.31371L3.375 12.3387C3.54355 12.9976 3.80403 13.6411 4.15645 14.2387L4.27903 14.4379L3.06855 15.6484L5.33629 17.9161L6.54677 16.7056L6.74597 16.8282C7.34355 17.1806 7.9871 17.4411 8.64597 17.6097L8.87581 17.671V19.3871H12.0935V17.6863L12.3234 17.625C12.9823 17.4565 13.6258 17.196 14.2234 16.8435L14.4226 16.721L15.6331 17.9315L17.9008 15.6637L16.6903 14.4532L16.8129 14.254C17.1653 13.6565 17.4258 13.0129 17.5944 12.354L17.6556 12.1242H19.3871V8.89113Z" fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                <path d="M10.4999 15.4032C7.80313 15.4032 5.59668 13.1967 5.59668 10.5C5.59668 7.8032 7.80313 5.59675 10.4999 5.59675C13.1967 5.59675 15.4031 7.8032 15.4031 10.5C15.4031 13.1967 13.1967 15.4032 10.4999 15.4032ZM10.4999 6.20965C8.14023 6.20965 6.20958 8.1403 6.20958 10.5C6.20958 12.8596 8.14023 14.7903 10.4999 14.7903C12.8596 14.7903 14.7902 12.8596 14.7902 10.5C14.7902 8.1403 12.8596 6.20965 10.4999 6.20965Z" fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                <path d="M12.5838 12.8904L10.4387 10.7299L9.9943 11.1743L9.77979 10.9597L10.2241 10.5154L9.77979 10.071L9.9943 9.85651L10.4387 10.3009L11.7564 8.98312L11.9709 9.19764L10.6532 10.5154L12.7983 12.6605L12.5838 12.8904Z" fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                <path d="M10.7144 14.3153H10.2854V13.9629H10.7144V14.3153Z" fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                <path d="M10.7144 7.15967H10.2854V6.80725H10.7144V7.15967Z" fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                <path d="M13.9017 10.7145H13.5493V10.2854H13.9017V10.7145Z" fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                <path d="M7.35877 10.7145H7.00635V10.2854H7.35877V10.7145Z" fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                            </svg>
                            Закажи своё кресло
                        </div>
                    <?} else {?>
                        <?if($arElement['CATALOG_QUANTITY'] && $arElement['CATALOG_QUANTITY'] > 0 && empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <span class="p-prods__nal">Есть в наличии</span>
                            <?
                        } elseif($arElement['CATALOG_QUANTITY'] == 0 && empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <span class="p-prods__nal p-prods__nal-snyat">Снят с продажи</span>
                            <?
                        } elseif(!empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <span class="p-prods__nal p-prods__nal-pos">Поступит: <?=$arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE']?></span>
                            <?
                        } else {
                            ?>
                            <span class="p-prods__nal p-prods__nal-no">Нет в наличии</span>
                            <?
                        }?>
                    <?}?>



                    <div class="p-prods__imgwp-wp">

                        <a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="p-prods__imgwp" style="display: block; background-image: url(<?=$arElement["IMAGE"]["src"]?>);">

                            <? if (!empty($arElement["PROPERTIES"]["OFFERS"]["VALUE"])): ?>
                                <div class="p-prods__tag">
                                    <?if(is_array($arElement["PROPERTIES"]["OFFERS"]["VALUE"])) {?>
                                        <? foreach ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] as $ifv => $marker): ?>
                                            <?if($marker != "ОБНОВЛЕН") {?>
                                                <?if($marker == "NEW") {?>
                                                    <span class="p-prods__new" style="background-color: #37ac09;"><?= $marker ?></span>
                                                <?} elseif($marker == "HIT") {?>
                                                    <span class="p-prods__new" style="background-color: #3254AD;"><?= $marker ?></span>
                                                <?} elseif($marker == "PRESALE") {?>
                                                    <span class="p-prods__new" style="background-color: #F36525;"><?= $marker ?></span>
                                                <?} elseif($marker == "LOVE") {?>
                                                    <span class="p-prods__new" style="background-color: #B710A0;"><?= $marker ?></span>
                                                <?} elseif($marker == "АКЦИЯ") {?>
                                                    <span class="p-prods__new" style="background-color: #CC0000;"><?= $marker ?></span>
                                                <?} elseif($marker == "SALE") {?>
                                                    <span class="p-prods__new" style="background-color: #7D0483;"><?= $marker ?></span>
                                                <?} elseif($marker == "-5%") {?>
                                                    <span class="p-prods__new" style="background-color: #e63244;"><?= $marker ?></span>
                                                <?} elseif($marker == "-10%") {?>
                                                    <span class="p-prods__new" style="background-color: #E53744;"><?= $marker ?></span>
                                                <?} elseif($marker == "-15%") {?>
                                                    <span class="p-prods__new" style="background-color: #CD4741;"><?= $marker ?></span>
                                                <?} elseif($marker == "-20%") {?>
                                                    <span class="p-prods__new" style="background-color: #B50428;"><?= $marker ?></span>
                                                <?} elseif($marker == "-25%") {?>
                                                    <span class="p-prods__new" style="background-color: #940123;"><?= $marker ?></span>
                                                <?} elseif($marker == "-7%") {?>
                                                    <span class="p-prods__new" style="background-color: #EB3144;"><?= $marker ?></span>
                                                <?} elseif($marker == "НА ЗАКАЗ") {?>
                                                    <span class="p-prods__new" style="background-color: #780707; font-size: 10px !important;"><?= $marker ?></span>
                                                <?} elseif($marker == "ZEN" || $arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "ZEN") {?>
                                                    <span class="p-prods__new" style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/zen_gm-03.svg); background-size: 60%; background-repeat: no-repeat; left: -10px; line-height: 0px !important; top: 1px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $marker ?></span>
                                                <?} else {?>
                                                    <span class="p-prods__new marker-<?= strstr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>" style="background-color: #<?=strstr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>;"><?= $marker ?></span>

                                                <?}?>
                                            <?} else {?>
                                                <span class="p-prods__new" style="background-color: #29bc48;"><?= $marker ?></span>
                                            <?}?>
                                        <? endforeach; ?>
                                    <?} else {?>
                                        <?if($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "NEW") {?>
                                            <span class="p-prods__new" style="background-color: #37ac09;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "HIT") {?>
                                            <span class="p-prods__new" style="background-color: #3254AD;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "PRESALE") {?>
                                            <span class="p-prods__new" style="background-color: #F36525;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "LOVE") {?>
                                            <span class="p-prods__new" style="background-color: #B710A0;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "АКЦИЯ") {?>
                                            <span class="p-prods__new" style="background-color: #CC0000;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "SALE") {?>
                                            <span class="p-prods__new" style="background-color: #7D0483;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-5%") {?>
                                            <span class="p-prods__new" style="background-color: #e63244;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-10%") {?>
                                            <span class="p-prods__new" style="background-color: #E53744;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-15%") {?>
                                            <span class="p-prods__new" style="background-color: #CD4741;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-20%") {?>
                                            <span class="p-prods__new" style="background-color: #B50428;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-25%") {?>
                                            <span class="p-prods__new" style="background-color: #940123;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-7%") {?>
                                            <span class="p-prods__new" style="background-color: #EB3144;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "НА ЗАКАЗ") {?>
                                            <span class="p-prods__new" style="background-color: #780707; font-size: 10px !important;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "ZEN") {?>
                                            <span class="p-prods__new" style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/zen_gm-03.svg); background-size: 60%; background-repeat: no-repeat; left: -10px; line-height: 0px !important; top: 1px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} else {?>
                                            <span class="p-prods__new marker-<?= strstr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>" style="background-color: #<?=strstr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arElement["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>

                                        <?}?>
                                    <?}?>
                                </div>
                            <? endif; ?>

                        </a>
                    </div>
                    <a href="<?=$arElement['DETAIL_PAGE_URL']?>" class="p-prods__title">
                        <?=$arElement['NAME']?>
                    </a>

                    <?if(!empty($arElement['ITEM_PRICES'][0])) {?>
                        <div class="p-prods__prices">
                    <span class="p-prods__price">
                        <?if($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") {?>от <?}?>
                        <?=$arElement['ITEM_PRICES'][0]['PRINT_RATIO_PRICE']?>
                    </span>
                            <?if($arElement['ITEM_PRICES'][0]["DISCOUNT"] > 0):?>
                                <?if($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] != "Y") {?>
                                    <span class="p-prods__priceold">
                                <?=$arElement['ITEM_PRICES'][0]['PRINT_BASE_PRICE']?>
                            </span>
                                <?}?>
                            <?endif;?>
                        </div>
                    <?} else {?>
                        <?if(!empty($arElement["MIN_PRICE"])):?>
                            <div class="p-prods__prices">
                    <span class="p-prods__price">
                        <?if($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") {?>от <?}?>
                        <?=$arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?>
                    </span>
                                <?if(!empty($arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0):?>
                                    <?if($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] != "Y") {?>
                                        <span class="p-prods__priceold">
                                <?=$arElement["MIN_PRICE"]["PRINT_VALUE"]?>
                            </span>
                                    <?}?>
                                <?endif;?>
                            </div>
                        <?else:?>
                            <?
                            $arPrice = CPrice::GetByID($arElement['ID']);
                            ?>
                            <?if(!empty($arPrice)) {?>
                    <div class="p-prods__prices">
                                <span class="p-prods__price">
                                <?=CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]);?>
                    </span>
                    </div>
                            <?} else {?>

                                <?if(!empty($arElement['PROPERTIES']['AFP_PRICE']['VALUE'])) {
                                    ?>
                    <div class="p-prods__prices">
                    <span class="p-prods__price">
                                    <?
                                    echo $arElement['PROPERTIES']['AFP_PRICE']['VALUE'] . "";
                                    ?>
                    </span></div>
                        <?
                                } else {?>
                                    <span class="p-prods__price">
                    <?=GetMessage("REQUEST_PRICE_LABEL")?>
                </span>
                                <?}?>
                                <?if($USER->isAdmin()) {
                                    /*echo "<pre>"; print_r($arElement['PROPERTIES']['AFP_PRICE']['VALUE']); echo "</pre>";*/
                                    /*
                                    $ar_res = CPrice::GetBasePrice($arElement['ID']);
                                    echo "Базовая цена товара с кодом 11 (при приобретении от ".
                                        $ar_res["QUANTITY_FROM"]." до ".
                                        $ar_res["QUANTITY_TO"]." единиц товара) равна ".
                                        $ar_res["PRICE"]." ".$ar_res["CURRENCY"]."<br>";
                                    echo "Отформатированая базовая цена: ".
                                        CurrencyFormat($ar_res["PRICE"], $ar_res["CURRENCY"]);
                                    */
                                }?>


                            <?}?>
                        <?endif;?>
                    <?}?>

                    <?
                    $ar_resTov = "";
                    $ar_resTov = CCatalogProduct::GetByID($arResult["ID"]);
                    ?>

                    <?if($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") {?>
                        <a href="#izgotovnazakaz" class="p-prods__nazakaz fb-modal" data-id="<?= $arElement["ID"] ?>">
                            Изготовление на заказ
                        </a>
                        <a href="#izgotovnazakaz" class="p-prods__sdelzak fb-modal" data-id="<?= $arElement["ID"] ?>">
                            <i class="p-prods__buyoneclick-icon">
                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M7.84617 11.7692C7.65001 11.7692 7.51924 11.7038 7.38847 11.5731L4.77309 8.95769C4.51155 8.69615 4.51155 8.30384 4.77309 8.04231C5.03463 7.78077 5.42693 7.78077 5.68847 8.04231L7.84617 10.2L11.9654 6.08077C12.2269 5.81923 12.6192 5.81923 12.8808 6.08077C13.1423 6.34231 13.1423 6.73461 12.8808 6.99615L8.30386 11.5731C8.17309 11.7038 8.04232 11.7692 7.84617 11.7692Z" fill="#0A5A77"/>
                                    <path d="M8.5 17C3.79231 17 0 13.2077 0 8.5C0 3.79231 3.79231 0 8.5 0C13.2077 0 17 3.79231 17 8.5C17 13.2077 13.2077 17 8.5 17ZM8.5 1.30769C4.51154 1.30769 1.30769 4.51154 1.30769 8.5C1.30769 12.4885 4.51154 15.6923 8.5 15.6923C12.4885 15.6923 15.6923 12.4885 15.6923 8.5C15.6923 4.51154 12.4885 1.30769 8.5 1.30769Z" fill="#0A5A77"/>
                                </svg>
                            </i>
                            Сделать заказ
                        </a>
                    <?} else {?>
                        <?if($arElement['CATALOG_QUANTITY'] && $arElement['CATALOG_QUANTITY'] > 0 && empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <a title="Купить" href="#" class="addCart p-prods__addbasket<? if ($arElement["CAN_BUY"] === false || $arElement["CAN_BUY"] === "N"): ?> disabled<? endif; ?><?if(in_array($arElement['ID'], $itInBasket)) {?> in-basket<?}?>" data-id="<?= $arElement["ID"] ?>" onclick="if (this.text == 'В корзину') this.text = 'В корзине';">
                                <? if (in_array($arElement['ID'], $itInBasket)) { //Если этот товар есть в корзине ?>
                                    В корзине
                                <?} else { //Если товара нет (переменная пустая) ?>
                                    В корзину
                                <?}?>
                            </a>
                            <a href="<?= $url; ?>" class="fastBack p-prods__buyoneclick" data-id="<?=$arElement["ID"]?>">
                                <i class="p-prods__buyoneclick-icon">
                                    <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3.00118 2.63792C3.00118 1.52414 3.93912 0.586176 5.05292 0.586176C6.16673 0.586176 7.10463 1.52411 7.10463 2.63792V4.27929C7.45639 3.81033 7.69084 3.22412 7.69084 2.63792C7.69081 1.17241 6.5184 0 5.05289 0C3.58739 0 2.41498 1.17241 2.41498 2.63792C2.41498 3.28276 2.64946 3.86897 3.00118 4.27929V2.63792Z" fill="#0A5A77"/>
                                        <path d="M12.0871 7.03443C11.7354 7.03443 11.4423 7.15167 11.2078 7.32752C11.2078 6.50683 10.563 5.86202 9.7423 5.86202C9.39058 5.86202 9.03889 5.97926 8.74577 6.21374C8.51128 5.62754 7.98368 5.27581 7.39748 5.27581C7.04575 5.27581 6.75266 5.39305 6.51815 5.5689V2.63787C6.51815 1.81718 5.87334 1.17236 5.05265 1.17236C4.23196 1.17236 3.58715 1.81721 3.58715 2.63787V7.85509C2.41473 6.79992 1.12508 5.97923 0.304386 6.79992C-0.868028 7.97233 1.59404 10.2585 3.4699 13.7172C4.81819 16.1206 6.69406 16.9999 8.56989 16.9999C11.3251 16.9999 13.5526 14.7723 13.5526 12.0172V8.49993C13.5526 7.67928 12.9078 7.03443 12.0871 7.03443ZM12.9664 9.78962V12.0172C12.9664 14.3034 10.9734 16.4138 8.56986 16.4138C6.34227 16.4138 5.05262 15.1828 3.99744 13.4827C1.76986 9.61377 0.128478 7.85515 0.714685 7.21031C1.3595 6.5655 2.94227 7.97239 4.17329 9.26205V2.63787C4.17329 2.1689 4.58362 1.75854 5.05262 1.75854C5.52158 1.75854 5.93194 2.1689 5.93194 2.63787V8.79302H6.51815V6.74128C6.51815 6.27232 6.92851 5.86196 7.39748 5.86196C7.86647 5.86196 8.2768 6.27232 8.2768 6.74128V8.20678H8.86301V7.32746C8.86301 6.85849 9.27337 6.44813 9.74233 6.44813C10.2113 6.44813 10.6217 6.85849 10.6217 7.32746V8.79296H11.2079V8.49987C11.2079 8.03091 11.6182 7.62055 12.0872 7.62055C12.5562 7.62055 12.9665 8.03091 12.9665 8.49987V9.78962H12.9664Z" fill="#0A5A77"/>
                                    </svg>

                                </i>
                                Купить в 1 клик
                            </a>
                            <?
                        } elseif($arElement['CATALOG_QUANTITY'] == 0 && empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <a href="#" class="p-prods__snyat" onclick="event.preventDefault()">
                                Снят с продажи
                            </a>
                            <?
                            $res = CIBlockElement::GetByID($arElement['PROPERTIES']['ANALOG_LINK']['VALUE']);
                            if($ar_res = $res->GetNext()) {
                                ?>
                                <a href="<?=$ar_res['DETAIL_PAGE_URL']?>" class="p-prods__buyoneclick">
                                    <i class="p-prods__buyoneclick-icon">
                                        <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.5 0C4.22874 0 1.39333 1.90491 0 4.6875C1.39333 7.47009 4.22874 9.375 7.5 9.375C10.7712 9.375 13.6066 7.47009 15 4.6875C13.6067 1.90491 10.7712 0 7.5 0ZM11.198 2.4859C12.0793 3.04802 12.8261 3.80095 13.387 4.6875C12.8261 5.57405 12.0792 6.32698 11.198 6.8891C10.0907 7.59542 8.81188 7.96875 7.5 7.96875C6.18809 7.96875 4.90934 7.59542 3.802 6.8891C2.92075 6.32695 2.17397 5.57402 1.61303 4.6875C2.17395 3.80092 2.92075 3.04799 3.802 2.4859C3.85939 2.44928 3.91737 2.4138 3.9757 2.37896C3.82983 2.77928 3.75 3.21132 3.75 3.66211C3.75 5.73313 5.42895 7.41211 7.5 7.41211C9.57103 7.41211 11.25 5.73313 11.25 3.66211C11.25 3.21132 11.1702 2.77928 11.0243 2.37894C11.0826 2.41377 11.1406 2.44928 11.198 2.4859ZM7.5 3.19336C7.5 3.97002 6.87041 4.59961 6.09375 4.59961C5.31709 4.59961 4.6875 3.97002 4.6875 3.19336C4.6875 2.4167 5.31709 1.78711 6.09375 1.78711C6.87041 1.78711 7.5 2.4167 7.5 3.19336Z" fill="#0A5A77"/>
                                        </svg>


                                    </i>
                                    Посмотреть аналог
                                </a>
                                <?
                            }
                            ?>
                            <?
                        } elseif(!empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <a href="<?= $url; ?>" class="fastBack pred p-prods__predzak" data-id="<?=$arElement["ID"]?>">
                                Предзаказ
                            </a>
                            <?
                            $res = CIBlockElement::GetByID($arElement['PROPERTIES']['ANALOG_LINK']['VALUE']);
                            if($ar_res = $res->GetNext()) {
                                ?>
                                <a href="<?=$ar_res['DETAIL_PAGE_URL']?>" class="p-prods__buyoneclick">
                                    <i class="p-prods__buyoneclick-icon">
                                        <svg width="15" height="10" viewBox="0 0 15 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M7.5 0C4.22874 0 1.39333 1.90491 0 4.6875C1.39333 7.47009 4.22874 9.375 7.5 9.375C10.7712 9.375 13.6066 7.47009 15 4.6875C13.6067 1.90491 10.7712 0 7.5 0ZM11.198 2.4859C12.0793 3.04802 12.8261 3.80095 13.387 4.6875C12.8261 5.57405 12.0792 6.32698 11.198 6.8891C10.0907 7.59542 8.81188 7.96875 7.5 7.96875C6.18809 7.96875 4.90934 7.59542 3.802 6.8891C2.92075 6.32695 2.17397 5.57402 1.61303 4.6875C2.17395 3.80092 2.92075 3.04799 3.802 2.4859C3.85939 2.44928 3.91737 2.4138 3.9757 2.37896C3.82983 2.77928 3.75 3.21132 3.75 3.66211C3.75 5.73313 5.42895 7.41211 7.5 7.41211C9.57103 7.41211 11.25 5.73313 11.25 3.66211C11.25 3.21132 11.1702 2.77928 11.0243 2.37894C11.0826 2.41377 11.1406 2.44928 11.198 2.4859ZM7.5 3.19336C7.5 3.97002 6.87041 4.59961 6.09375 4.59961C5.31709 4.59961 4.6875 3.97002 4.6875 3.19336C4.6875 2.4167 5.31709 1.78711 6.09375 1.78711C6.87041 1.78711 7.5 2.4167 7.5 3.19336Z" fill="#0A5A77"/>
                                        </svg>


                                    </i>
                                    Посмотреть аналог
                                </a>
                                <?
                            } else {
                                ?>
                                <a href="<?= $url; ?>" class="fastBack p-prods__buyoneclick-pred" data-id="<?=$arElement["ID"]?>">
                                    <i class="p-prods__buyoneclick-icon">
                                        <svg width="14" height="17" viewBox="0 0 14 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3.00118 2.63792C3.00118 1.52414 3.93912 0.586176 5.05292 0.586176C6.16673 0.586176 7.10463 1.52411 7.10463 2.63792V4.27929C7.45639 3.81033 7.69084 3.22412 7.69084 2.63792C7.69081 1.17241 6.5184 0 5.05289 0C3.58739 0 2.41498 1.17241 2.41498 2.63792C2.41498 3.28276 2.64946 3.86897 3.00118 4.27929V2.63792Z" fill="#0A5A77"/>
                                            <path d="M12.0871 7.03443C11.7354 7.03443 11.4423 7.15167 11.2078 7.32752C11.2078 6.50683 10.563 5.86202 9.7423 5.86202C9.39058 5.86202 9.03889 5.97926 8.74577 6.21374C8.51128 5.62754 7.98368 5.27581 7.39748 5.27581C7.04575 5.27581 6.75266 5.39305 6.51815 5.5689V2.63787C6.51815 1.81718 5.87334 1.17236 5.05265 1.17236C4.23196 1.17236 3.58715 1.81721 3.58715 2.63787V7.85509C2.41473 6.79992 1.12508 5.97923 0.304386 6.79992C-0.868028 7.97233 1.59404 10.2585 3.4699 13.7172C4.81819 16.1206 6.69406 16.9999 8.56989 16.9999C11.3251 16.9999 13.5526 14.7723 13.5526 12.0172V8.49993C13.5526 7.67928 12.9078 7.03443 12.0871 7.03443ZM12.9664 9.78962V12.0172C12.9664 14.3034 10.9734 16.4138 8.56986 16.4138C6.34227 16.4138 5.05262 15.1828 3.99744 13.4827C1.76986 9.61377 0.128478 7.85515 0.714685 7.21031C1.3595 6.5655 2.94227 7.97239 4.17329 9.26205V2.63787C4.17329 2.1689 4.58362 1.75854 5.05262 1.75854C5.52158 1.75854 5.93194 2.1689 5.93194 2.63787V8.79302H6.51815V6.74128C6.51815 6.27232 6.92851 5.86196 7.39748 5.86196C7.86647 5.86196 8.2768 6.27232 8.2768 6.74128V8.20678H8.86301V7.32746C8.86301 6.85849 9.27337 6.44813 9.74233 6.44813C10.2113 6.44813 10.6217 6.85849 10.6217 7.32746V8.79296H11.2079V8.49987C11.2079 8.03091 11.6182 7.62055 12.0872 7.62055C12.5562 7.62055 12.9665 8.03091 12.9665 8.49987V9.78962H12.9664Z" fill="#0A5A77"/>
                                        </svg>

                                    </i>
                                    Заказать в 1 клик
                                </a>
                                <?
                            }
                            ?>
                            <?
                        } else {}?>
                    <?}?>
                </div>
            </div>
        <?endforeach;?>
    </div>
    </div>
    </div>
    </div>
<?} else {?>
    <div class="p-card__prods">
        <div class="wrapper">
            <div class="p-card__p-prods">
                <b class="p-prods__title">
                    С этим товаром покупают
                </b>
                <? $APPLICATION->IncludeComponent(
                    "bitrix:catalog.section",
                    "buy-with-this-product",
                    array(
                        "ACTION_VARIABLE" => "action",
                        "ADD_ELEMENT_CHAIN" => "Y",
                        "ADD_PICT_PROP" => "-",
                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                        "ADD_SECTIONS_CHAIN" => "Y",
                        "AJAX_MODE" => "N",
                        "AJAX_OPTION_ADDITIONAL" => "",
                        "AJAX_OPTION_HISTORY" => "N",
                        "AJAX_OPTION_JUMP" => "N",
                        "AJAX_OPTION_STYLE" => "Y",
                        "BASKET_URL" => "/personal/cart/",
                        "BIG_DATA_RCM_TYPE" => "personal",
                        "CACHE_FILTER" => "N",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "36000000",
                        "CACHE_TYPE" => "N",
                        "COMMON_ADD_TO_BASKET_ACTION" => "ADD",
                        "COMMON_SHOW_CLOSE_POPUP" => "N",
                        "COMPARE_ELEMENT_SORT_FIELD" => "sort",
                        "COMPARE_ELEMENT_SORT_ORDER" => "asc",
                        "COMPARE_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                        "COMPARE_OFFERS_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "COMPARE_OFFERS_PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "COMPARE_POSITION" => "bottom left",
                        "COMPARE_POSITION_FIXED" => "Y",
                        "COMPARE_PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "COMPATIBLE_MODE" => "Y",
                        "COMPONENT_TEMPLATE" => "catalog-tov",
                        "CONVERT_CURRENCY" => "N",
                        "DETAIL_ADD_DETAIL_TO_SLIDER" => "Y",
                        "DETAIL_ADD_TO_BASKET_ACTION" => array(
                            0 => "BUY",
                        ),
                        "DETAIL_ADD_TO_BASKET_ACTION_PRIMARY" => array(
                            0 => "BUY",
                        ),
                        "DETAIL_BACKGROUND_IMAGE" => "-",
                        "DETAIL_BRAND_USE" => "N",
                        "DETAIL_BROWSER_TITLE" => "-",
                        "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
                        "DETAIL_DETAIL_PICTURE_MODE" => array(
                            0 => "POPUP",
                        ),
                        "DETAIL_DISPLAY_NAME" => "Y",
                        "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
                        "DETAIL_IMAGE_RESOLUTION" => "16by9",
                        "DETAIL_MAIN_BLOCK_PROPERTY_CODE" => "",
                        "DETAIL_META_DESCRIPTION" => "-",
                        "DETAIL_META_KEYWORDS" => "-",
                        "DETAIL_OFFERS_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "DETAIL_OFFERS_PROPERTY_CODE" => array(
                            0 => "COLOR_REF",
                            1 => "COLOR_ARM",
                            2 => "",
                        ),
                        "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
                        "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
                        "DETAIL_PROPERTY_CODE" => array(
                            0 => "MODEL",
                            1 => "COLOR",
                            2 => "",
                        ),
                        "DETAIL_SET_CANONICAL_URL" => "Y",
                        "DETAIL_SET_VIEWED_IN_COMPONENT" => "Y",
                        "DETAIL_SHOW_POPULAR" => "N",
                        "DETAIL_SHOW_SLIDER" => "N",
                        "DETAIL_SHOW_VIEWED" => "Y",
                        "DETAIL_STRICT_SECTION_CHECK" => "N",
                        "DETAIL_USE_COMMENTS" => "N",
                        "DETAIL_USE_VOTE_RATING" => "Y",
                        "DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                        "DISCOUNT_PERCENT_POSITION" => "bottom-right",
                        "DISPLAY_BOTTOM_PAGER" => "Y",
                        "DISPLAY_ELEMENT_SELECT_BOX" => "N",
                        "DISPLAY_TOP_PAGER" => "N",
                        "ELEMENT_SORT_FIELD" => "sort",
                        "ELEMENT_SORT_FIELD2" => "name",
                        "ELEMENT_SORT_ORDER" => "asc",
                        "ELEMENT_SORT_ORDER2" => "desc",
                        "FILE_404" => "",
                        "FILTER_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "FILTER_HIDE_ON_MOBILE" => "N",
                        "FILTER_NAME" => "",
                        "FILTER_OFFERS_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "FILTER_OFFERS_PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "FILTER_PRICE_CODE" => array(
                            0 => "Розничная",
                        ),
                        "FILTER_PROPERTY_CODE" => array(
                            0 => "ATT_BRAND",
                            1 => "TYPE",
                            2 => "FUNKCIA_SKAN_ROSTA",
                            3 => "FUNKCIA_MASSAZH_KARETKA",
                            4 => "ZONY_PROGREVA",
                            5 => "FUNKCIA_TIP_MASSAG_STOP",
                            6 => "TIP_MASSAGA_JAGODIC",
                            7 => "FUNKCIA_NEVESOMOSTI",
                            8 => "FUNKCIA_VPLOTNUU_STENE",
                            9 => "FUNKCIA_RASTYAZHKA",
                            10 => "FUNKCIA_MULTIMEDIA",
                            11 => "FUNKCIA_TERAPIA_CVET",
                            12 => "TYPE_MASS_CHAIR",
                            13 => "",
                        ),
                        "FILTER_VIEW_MODE" => "VERTICAL",
                        "FORUM_ID" => "1",
                        "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
                        "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
                        "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
                        "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
                        "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
                        "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
                        "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
                        "GIFTS_MESS_BTN_BUY" => "Выбрать",
                        "GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
                        "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
                        "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
                        "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
                        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                        "GIFTS_SHOW_IMAGE" => "Y",
                        "GIFTS_SHOW_NAME" => "Y",
                        "GIFTS_SHOW_OLD_PRICE" => "Y",
                        "HIDE_AVAILABLE_TAB" => "N",
                        "HIDE_MEASURES" => "Y",
                        "HIDE_NOT_AVAILABLE" => "L",
                        "HIDE_NOT_AVAILABLE_OFFERS" => "L",
                        "IBLOCK_ID" => $IBLOCK_VAR,
                        "IBLOCK_TYPE" => "catalog",
                        "INCLUDE_SUBSECTIONS" => "Y",
                        "INSTANT_RELOAD" => "N",
                        "LABEL_PROP" => "",
                        "LAZY_LOAD" => "N",
                        "LINE_ELEMENT_COUNT" => "3",
                        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
                        "LINK_IBLOCK_ID" => "",
                        "LINK_IBLOCK_TYPE" => "",
                        "LINK_PROPERTY_SID" => "",
                        "LIST_BROWSER_TITLE" => "-",
                        "LIST_ENLARGE_PRODUCT" => "PROP",
                        "LIST_ENLARGE_PROP" => "-",
                        "LIST_META_DESCRIPTION" => "-",
                        "LIST_META_KEYWORDS" => "-",
                        "LIST_OFFERS_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "LIST_OFFERS_LIMIT" => "5",
                        "LIST_OFFERS_PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "LIST_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                        "LIST_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                        "LIST_PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "LIST_PROPERTY_CODE_MOBILE" => "",
                        "LIST_SHOW_SLIDER" => "Y",
                        "LIST_SLIDER_INTERVAL" => "3000",
                        "LIST_SLIDER_PROGRESS" => "N",
                        "LOAD_ON_SCROLL" => "N",
                        "MESSAGES_PER_PAGE" => "10",
                        "MESSAGE_404" => "",
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                        "MESS_BTN_BUY" => "Купить",
                        "MESS_BTN_COMPARE" => "Сравнение",
                        "MESS_BTN_DETAIL" => "Подробнее",
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                        "MESS_COMMENTS_TAB" => "Комментарии",
                        "MESS_DESCRIPTION_TAB" => "Описание",
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                        "MESS_PRICE_RANGES_TITLE" => "Цены",
                        "MESS_PROPERTIES_TAB" => "Характеристики",
                        "OFFERS_CART_PROPERTIES" => array(
                        ),
                        "OFFERS_SORT_FIELD" => "sort",
                        "OFFERS_SORT_FIELD2" => "id",
                        "OFFERS_SORT_ORDER" => "asc",
                        "OFFERS_SORT_ORDER2" => "desc",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => "new",
                        "PAGER_TITLE" => "Товары",
                        "PAGE_ELEMENT_COUNT" => "8",
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                        "PATH_TO_SMILE" => "/bitrix/images/forum/smile/",
                        "PRICE_CODE" => array(
                            0 => "Розничная",
                        ),
                        "PRICE_VAT_INCLUDE" => "N",
                        "PRICE_VAT_SHOW_VALUE" => "N",
                        "PRODUCT_ID_VARIABLE" => "id",
                        "PRODUCT_PROPERTIES" => array(
                        ),
                        "PRODUCT_PROPS_VARIABLE" => "prop",
                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                        "PRODUCT_SUBSCRIPTION" => "N",
                        "REVIEW_AJAX_POST" => "Y",
                        "REVIEW_IBLOCK_ID" => "1",
                        "REVIEW_IBLOCK_TYPE" => "catalog",
                        "SEARCH_CHECK_DATES" => "Y",
                        "SEARCH_NO_WORD_LOGIC" => "Y",
                        "SEARCH_PAGE_RESULT_COUNT" => "10",
                        "SEARCH_RESTART" => "N",
                        "SEARCH_USE_LANGUAGE_GUESS" => "Y",
                        "SECTIONS_HIDE_SECTION_NAME" => "Y",
                        "SECTIONS_SHOW_PARENT_NAME" => "Y",
                        "SECTIONS_VIEW_MODE" => "TILE",
                        "SECTION_ADD_TO_BASKET_ACTION" => "ADD",
                        "SECTION_BACKGROUND_IMAGE" => "-",
                        "SECTION_COUNT_ELEMENTS" => "Y",
                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                        "SECTION_TOP_DEPTH" => "2",
                        "SEF_FOLDER" => "/massazhnoe-oborudovanie/",
                        "SEF_MODE" => "Y",
                        "SET_LAST_MODIFIED" => "Y",
                        "SET_STATUS_404" => "Y",
                        "SET_TITLE" => "Y",
                        "SHOW_404" => "Y",
                        "SHOW_DEACTIVATED" => "N",
                        "SHOW_DISCOUNT_PERCENT" => "Y",
                        "SHOW_LINK_TO_FORUM" => "Y",
                        "SHOW_MAX_QUANTITY" => "N",
                        "SHOW_OLD_PRICE" => "Y",
                        "SHOW_PRICE_COUNT" => "1",
                        "SHOW_SECTION_BANNER" => "N",
                        "SHOW_TOP_ELEMENTS" => "Y",
                        "SIDEBAR_DETAIL_SHOW" => "N",
                        "SIDEBAR_PATH" => "",
                        "SIDEBAR_SECTION_SHOW" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "TOP_ADD_TO_BASKET_ACTION" => "ADD",
                        "TOP_ELEMENT_COUNT" => "9",
                        "TOP_ELEMENT_SORT_FIELD" => "sort",
                        "TOP_ELEMENT_SORT_FIELD2" => "id",
                        "TOP_ELEMENT_SORT_ORDER" => "asc",
                        "TOP_ELEMENT_SORT_ORDER2" => "desc",
                        "TOP_ENLARGE_PRODUCT" => "STRICT",
                        "TOP_LINE_ELEMENT_COUNT" => "3",
                        "TOP_OFFERS_FIELD_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "TOP_OFFERS_LIMIT" => "5",
                        "TOP_OFFERS_PROPERTY_CODE" => array(
                            0 => "",
                            1 => "",
                        ),
                        "TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                        "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                        "TOP_PROPERTY_CODE" => array(
                            0 => "ATT_BRAND",
                            1 => "CML2_ARTICLE",
                            2 => "",
                        ),
                        "TOP_PROPERTY_CODE_MOBILE" => "",
                        "TOP_SHOW_SLIDER" => "Y",
                        "TOP_SLIDER_INTERVAL" => "3000",
                        "TOP_SLIDER_PROGRESS" => "N",
                        "TOP_VIEW_MODE" => "SECTION",
                        "URL_TEMPLATES_READ" => "",
                        "USER_CONSENT" => "Y",
                        "USER_CONSENT_ID" => "1",
                        "USER_CONSENT_IS_CHECKED" => "Y",
                        "USER_CONSENT_IS_LOADED" => "N",
                        "USE_ALSO_BUY" => "N",
                        "USE_BIG_DATA" => "N",
                        "USE_CAPTCHA" => "Y",
                        "USE_COMMON_SETTINGS_BASKET_POPUP" => "N",
                        "USE_COMPARE" => "Y",
                        "USE_ELEMENT_COUNTER" => "Y",
                        "USE_ENHANCED_ECOMMERCE" => "N",
                        "USE_FILTER" => "Y",
                        "USE_GIFTS_DETAIL" => "N",
                        "USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
                        "USE_GIFTS_SECTION" => "N",
                        "USE_MAIN_ELEMENT_SECTION" => "Y",
                        "USE_PRICE_COUNT" => "N",
                        "USE_PRODUCT_QUANTITY" => "Y",
                        "USE_REVIEW" => "Y",
                        "USE_SALE_BESTSELLERS" => "N",
                        "USE_STORE" => "N",
                        "CACHE_NOTES" => "",
                        "SEF_URL_TEMPLATES" => array(
                            "sections" => "",
                            "section" => "#SECTION_CODE_PATH#/",
                            "element" => "#SECTION_CODE_PATH#/#ELEMENT_ID#/",
                            "compare" => "compare.php?action=#ACTION_CODE#",
                            "smart_filter" => "#SECTION_CODE_PATH#/filter/#SMART_FILTER_PATH#/apply/",
                        ),
                        "VARIABLE_ALIASES" => array(
                            "compare" => array(
                                "ACTION_CODE" => "action",
                            ),
                        ),
                    ),
                    false
                ); ?>
            </div>
        </div>
    </div>
<?}?>
    <script>
        $(document).ready(function() {
            $('.p-prods__predzak').on('click', function() {
                $('.heading-modal-js').text('Предзаказ');
                $('.title-modal-js').text('Заполните данные для предзаказа');
                $('#fastBuyFormSubmit').html('Предзаказ');
            });
            $('.p-prods__buyoneclick').on('click', function() {
                $('.heading-modal-js').text('Купить в один клик');
                $('.title-modal-js').text('Заполните данные для заказа');
                $('#fastBuyFormSubmit').html('Купить в один клик');
            });
            $('.p-prods__buyoneclick-pred').on('click', function() {
                $('.heading-modal-js').text('Заказать в один клик');
                $('.title-modal-js').text('Заполните данные для заказа');
                $('#fastBuyFormSubmit').html('Заказать в один клик');
            });
            $('.p-carddes__buyoneclick').on('click', function() {
                $('.heading-modal-js').text('Купить в один клик');
                $('.title-modal-js').text('Заполните данные для заказа');
                $('#fastBuyFormSubmit').html('Купить в один клик');
            });
            $('.p-carddes__buyoneclick-pred').on('click', function() {
                $('.heading-modal-js').text('Заказать в один клик');
                $('.title-modal-js').text('Заполните данные для заказа');
                $('#fastBuyFormSubmit').html('Заказать в один клик');
            });
            $('.p-carddes__addbasket-pred').on('click', function() {
                $('.heading-modal-js').text('Предзаказ');
                $('.title-modal-js').text('Заполните данные для предзаказа');
                $('#fastBuyFormSubmit').html('Предзаказ');
            });
        });
    </script>

<?/*if($arElement['CATALOG_QUANTITY'] && $arElement['CATALOG_QUANTITY'] > 0 && empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
    ?>
    <script>
        $(document).ready(function() {
            $('.heading-modal-js').text('Заказать в один клик');
            $('.title-modal-js').text('Заполните данные для заказа');
        });
    </script>
    <?
} elseif($arElement['CATALOG_QUANTITY'] == 0 && empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
    ?>

    <?
} elseif(!empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
    ?>
    <script>
        $(document).ready(function() {
            $('.heading-modal-js').text('Предзаказ');
            $('.title-modal-js').text('Заполните данные для предзаказа');
            $('#fastBuyFormSubmit').html('Предзаказ');
        });
    </script>

    <?
} else {
    ?>

    <?
}*/?>