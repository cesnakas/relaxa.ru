<style>
.right_block_tovar>form>.tovar_form>.cell>.fullbtn {
width: 100%;
background-color: #959595;
line-height: 27px;
color: #ffffff;
border: none;
}

.callbackkiller {
    left: 1% !important;
}
</style>










<?
$url = (!$arResult['CATALOG_QUANTITY'] and $arResult['PROPERTIES']['URL_NEW']['VALUE']) ? $arResult['PROPERTIES']['URL_NEW']['VALUE'] : '';
?>


<div class="buttoms_tovar_to">
    <div class="cell">
        <a href="#"style="color:#8f2828" class="addCompare label changeID" data-id="<?= $arResult["ID"] ?>">
            <img src="<?= SITE_TEMPLATE_PATH ?>/img/compare.png" alt="<?= GetMessage("COMPARE_LABEL") ?>"  class="icon">
            <?= GetMessage("COMPARE_LABEL") ?></a>
		<?if($arResult['CATALOG_QUANTITY'] && !$arResult['PROPERTIES']['STATUS_OUT']['VALUE']):?>
	        <p class="aviable">ЕСТЬ В НАЛИЧИИ</p>
		<?else:?>
			<?
			$color = '#f80504';
			$text = 'Нет в наличии';
			if($arResult['PROPERTIES']['URL_NEW']['VALUE'])
			{
				$color = '#000299';
				$text = 'Обновлен';
			}
			elseif($arResult['PROPERTIES']['STATUS_OUT']['VALUE'])
			{
				$color = '#f36525';
				$text = 'Предзаказ';
			}
			?>
			<p class="aviable" style="background-color: <?=$color;?>; text-transform: uppercase; height: auto; min-height: 27px;"><?=$text;?></p>
		<?endif?>
    </div>
    <div class="price">
        <!--<span>Старая цена: 50 000 руб.</span>-->
        Цена: <font><? if (!empty($arResult["MIN_PRICE"])): ?>
                <? if ($arResult["COUNT_PRICES"] > 1): ?>
                    <a href="#" class="price changePrice getPricesWindow" data-id="<?= $arResult["ID"] ?>">
                        <span class="priceIcon"></span><?= $arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>
                        <? if ($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arResult["CATALOG_MEASURE"]]["SYMBOL_RUS"])): ?>
                            <span class="measure"> / <?= $arResult["MEASURES"][$arResult["CATALOG_MEASURE"]]["SYMBOL_RUS"] ?></span>
                        <? endif; ?>
                        <? if (!empty($arResult["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arResult["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0): ?>
						<span class="oldPriceLabel"><span class="label"><?= GetMessage("OLD_PRICE_LABEL") ?></span><s
                                        class="discount"><?= $arResult["MIN_PRICE"]["PRINT_VALUE"] ?></s></span>
                        <? endif; ?>
                    </a>
                <? else: ?>
                    <a class="price changePrice"><?= $arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>
                        <? if ($arParams["HIDE_MEASURES"] != "Y" && !empty($arResult["MEASURES"][$arResult["CATALOG_MEASURE"]]["SYMBOL_RUS"])): ?>
                            <span class="measure"> / <?= $arResult["MEASURES"][$arResult["CATALOG_MEASURE"]]["SYMBOL_RUS"] ?></span>
                        <? endif; ?>
                        <? if (!empty($arResult["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arResult["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0): ?>
						<span class="oldPriceLabel"><span class="label"><?= GetMessage("OLD_PRICE_LABEL") ?></span><s
                                        class="discount"><?= $arResult["MIN_PRICE"]["PRINT_VALUE"] ?></s></span>
                        <? endif; ?>
                    </a>
                <? endif; ?>
            <? else: ?>
                <a class="price"><?= GetMessage("REQUEST_PRICE_LABEL") ?></a>
            <? endif; ?></font>
    </div>
   <!-- <div class="tovar_economy">Экономия: 780 руб.</div>-->
    <div class="buy_block">
		<?if($url):?>
            <a href="<?=$url;?>" class="fullbtn addCart changeID changeCart"><img src="<?= SITE_TEMPLATE_PATH ?>/images/incart.png"
                                                     alt="<?= GetMessage("ADDCART_LABEL") ?>"
                                                     class="icon"><?= GetMessage("ADDCART_LABEL") ?></a>
        <? else: ?>
	        <? if (!empty($arResult["MIN_PRICE"])): ?>
	            <a href="#" class="fullbtn addCart changeID changeCart<? if ($arResult["CAN_BUY"] === false || $arResult["CAN_BUY"] === "N"): ?> disabled<? endif; ?>"
	               data-id="<?= $arResult["ID"] ?>"><img src="<?= SITE_TEMPLATE_PATH ?>/images/incart.png"
	                                                     alt="<?= GetMessage("ADDCART_LABEL") ?>"
	                                                     class="icon"><?= GetMessage("ADDCART_LABEL") ?></a>
	        <? else: ?>
	            <a href="#" class="fullbtn addCart changeID changeCart disabled requestPrice" data-id="<?= $arResult["ID"] ?>"><img
	                        src="<?= SITE_TEMPLATE_PATH ?>/images/request.png"
	                        alt="<?= GetMessage("REQUEST_PRICE_BUTTON_LABEL") ?>"
	                        class="icon"><?= GetMessage("REQUEST_PRICE_BUTTON_LABEL") ?></a>
	        <? endif; ?>
        <? endif; ?>
		<?if(in_array($arResult['ID'],$_SESSION['WISHLIST_LIST']['ITEMS'])):?>
		<a href="/wishlist" class="addWishlist label like_tis added" data-id="<?= $arResult["~ID"] ?>" style="wi"><img
                    src="<?= SITE_TEMPLATE_PATH ?>/img/like.png" alt="<?= GetMessage("WISHLIST_LABEL") ?>"
                    class="icon"><?= GetMessage("WISHLIST_LABEL")?></a>
		<?else:?>
        <a href="#" class="addWishlist label like_tis" data-id="<?= $arResult["~ID"] ?>" style="wi"><img
                    src="<?= SITE_TEMPLATE_PATH ?>/img/like.png" alt="<?= GetMessage("WISHLIST_LABEL") ?>"
                    class="icon">Избранное</a>
		<?endif;?>
    </div>
</div>
<form>
    <div class="tovar_form">
        <div class="buy">
            <input type="text" name="phone" placeholder="Номер телефона" class="input">
        </div>
        <div class="cell">
		<?if($url):?>
            <a href="<?=$url;?>" class="fullbtn fastBack label changeID"><img src="<?= SITE_TEMPLATE_PATH ?>/images/fastBack.png"
                                                     alt="<?= GetMessage("FASTBACK_LABEL") ?>"
                                                     class="icon"><?= GetMessage("FASTBACK_LABEL") ?></a>
        <? else: ?>
            <a href="#" class="fullbtn fastBack label changeID<? if (empty($arResult["MIN_PRICE"]) || $arResult["CAN_BUY"] === "N" || $arResult["CAN_BUY"] === false): ?> disabled<? endif; ?>"
               data-id="<?= $arResult["ID"] ?>"><img src="<?= SITE_TEMPLATE_PATH ?>/images/fastBack.png"
                                                     alt="<?= GetMessage("FASTBACK_LABEL") ?>"
                                                     class="icon"><?= GetMessage("FASTBACK_LABEL") ?></a>

        <? endif; ?>
           <!-- <input type="submit" class="fullbtn fastBack" value="Купить в 1 клик">-->
        </div>
    </div>
</form>
<p class="manager_tovar_rext">Наш менеджер сам позвонит вам, уточнит все детали и оформит на вас заказ</p>
<div class="tovar_right_tab">
    <div class="tabs">
        <ul>
			<li class="payment"><a href="/payment/">ОПЛАТА</a></li>
            <li class="dostavka"><a href="/delivery/">ДОСТАВКА</a></li>
            <li class="garantia"><a href="/guarantee/">ГАРАНТИИ</a></li>
        </ul>
    </div>
    <div class="conts">
        <div class="con_payment">
            <div class="imgs">
                <img src="/bitrix/templates/dresscodeV2/img/payment_f_mc.png" alt="">
                <img src="/bitrix/templates/dresscodeV2/img/payment_f_ms.png" alt="">
                <img src="/bitrix/templates/dresscodeV2/img/payment_f_q.png" alt="">
                <img src="/bitrix/templates/dresscodeV2/img/payment_f_v.png" alt="">
                <img src="/bitrix/templates/dresscodeV2/img/payment_f_w.png" alt="">
                <img src="/bitrix/templates/dresscodeV2/img/payment_f_ya.png" alt="">
            </div>
            <div><a href="/payment/">подробнее...</a></div>
            <div class="kredit">
                <a href="/installment/"><img src="/bitrix/templates/dresscodeV2/img/tovar_rastr.png" alt="">
				от <?=round($arResult["MIN_PRICE"]["DISCOUNT_VALUE"]/12)?> руб\мес</a>
            </div>
        </div>
        <div class="con_dostavka">

        </div>
        <div class="con_garantia">

        </div>
    </div>
</div>









<style>
    .right_block_tovar>.tovar_right_tab>.tabs>ul>li{
        width: 31%;
    }
    .right_block_tovar .conts img {
        margin-top: 0px !important;
    }
    @media (max-width: 1700px){
        #elementTools, #elementNavigation {
            width:  400px;
        }
    }
</style>
