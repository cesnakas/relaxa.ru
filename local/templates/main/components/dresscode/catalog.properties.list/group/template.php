<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<? $this->setFrameMode(true);?>
<? if (!empty($arResult["DISPLAY_PROPERTIES"])): ?>
    <div id="elementProperties">
        <span class="heading"><?= GetMessage("SPECS") ?></span>
        <table class="stats">
            <tbody>
            <?
            $for_unset = [
                'DEALER_PRICE',
                'VIP_PRICE',
                'VIP_DEMO_PRICE',
                'PREMIUM_PRICE',
                'DO_NOT_SHOW',
                'HIDE_FROM_DILLERS',
                'AV_STATUS',
                'BLOG_POST_ID',
                'INFORM_LINKS',
				'AFP_PRICE',
				'AFP_OLDPRICE',
				'AFP_DISCOUNT_LIST',
				'AFP_DISCOUNT_VALUE',
				'AFP_CHECKSUM',
				'OFFERS',
				'POD_LINK',
				'SMOVIVOZ',
				'DOSTAVKA',
				'RASROCHKA',
				'TRADE_IN',
				'ZAGOLOVOK1',
				'FREE_DELIVERY',
				'SALE_LINK',
				'CASHBACK',
				'BE_AVAILABLE_DATE',
				'GIFTS',
				'STATUS_OUT',
				'ANALOG_LINK',
				'IZGOT_ZAK',
				'TYPEO',
				'TYPEC',
				'TYPEP',
				'TYPEM',
				'TYPEOP',
				'TYPEPOD',
				'TYPEAC',
				'CON_ACT',
				'SVOISTVA_KR',
				'SIMILAR_PRODUCT',
				'RELATED_PRODUCT',
				'RATING',
				'NO_DISCOUNT',
				'FORUM_MESSAGE_CNT',
				'FORUM_TOPIC_ID',
				'URL_RELINK',
				'BLOG_POST_ID',
				'MORE_PHOTO',
				'RECOMMEND',
				'ONLINE',
				'DOP_DISCOUNT',
				'PROMOTIONS',
            ];
            foreach ($arResult["DISPLAY_PROPERTIES_GROUP"] as $arProp):?>
                <? if ((!empty($arProp["VALUE"]) || !empty($arProp["LINK"])) && $arProp["SORT"] <= 5000 && !in_array($arProp['CODE'], $for_unset)):?>
                    <?
                    $set++;
                    $PROP_NAME = $arProp["NAME"];
                    ?>
                    <? if (!empty($arProp["VALUE"]) && gettype($arProp["VALUE"]) == "array") {
                        $arProp["VALUE"] = implode(" / ", $arProp["VALUE"]);
                        $arProp["FILTRABLE"] = false;
                    } ?>
                    <? if (preg_match("/\[.*\]/", trim($arProp["NAME"]), $res, PREG_OFFSET_CAPTURE)): ?>
                        <? $arProp["NAME"] = substr($arProp["NAME"], 0, $res[0][1]); ?>
                        <? if ($res[0][0] != $arResult["OLD_CAP"]): ?>
                            <?
                            $arResult["OLD_CAP"] = $res[0][0];
                            $set = 1;
                            ?>
                            <tr class="cap">
                                <td colspan="2"><?= substr($res[0][0], 1, -1) ?></td>
                                <td class="right"></td>
                            </tr>
                        <? endif; ?>
                        <tr <? if ($set % 2): ?> class="gray"<? endif; ?> >
                            <td class="name">
                                <span><?= preg_replace("/\[.*\]/", "", trim($PROP_NAME)) ?></span><? if (!empty($arProp["HINT"])): ?>
                                    <a href="#" class="question" title="<?= $arProp["HINT"] ?>"
                                       data-description="<?= $arProp["HINT"] ?>"></a><? endif; ?></td>
                            <td>
                            <? if (($arProp["PROPERTY_TYPE"] == "E" || $arProp["PROPERTY_TYPE"] == "S") && empty($arProp["DISPLAY_VALUE"]) === false): ?>
                                <?= $arProp["DISPLAY_VALUE"] ?>
                            <? else: ?>
                                <?= $arProp["VALUE"] ?>
                            <? endif; ?>
                            </td>

                        </tr>
                    <? else: ?>
                        <? 
                        $arSome[] = $arProp; 
                        $printProps = true;
                        ?>
                    <? endif; ?>
                <? endif; ?>
            <? endforeach; ?>
            <? if (!empty($printProps)): ?>
                <? $set = 0; ?>
                <!--<tr class="cap">
                        <td colspan="3"><?= GetMessage("CHARACTERISTICS") ?></td>
                    </tr>-->
                <? foreach ($arResult["ALL_PROPERTIES"] as $arProp):?>
						<? if (in_array($arProp['CODE'], $for_unset)) continue;?>
                    <? $set++ ?>
                    <tr <? if ($set % 2): ?> class="gray"<? endif; ?> >
                        <td class="name">
                            <span><?= $arProp["NAME"] ?></span>
                            <? if (!empty($arProp["HINT"])): ?>
                                <a href="#" class="question" title="<?= $arProp["HINT"] ?>"
                                    data-description="<?= $arProp["HINT"] ?>"></a>
                            <? endif; ?>
                        </td>
                        <td>
                            <? if (($arProp["PROPERTY_TYPE"] == "E" || $arProp["PROPERTY_TYPE"] == "S") && empty($arProp["DISPLAY_VALUE"]) === false): ?>
                                <?= $arProp["DISPLAY_VALUE"] ?>
                            <? else: ?>
                                <?= $arProp["VALUE"] ?>
                            <? endif; ?>
                        </td>
                    </tr>
                <? endforeach; ?>
            <? endif; ?>
            </tbody>
        </table>
    </div>
<? endif; ?>