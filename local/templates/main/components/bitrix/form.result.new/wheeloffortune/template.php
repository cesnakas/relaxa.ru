<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>

.roulette {
    position: absolute;
    left: -250px;
    bottom: -50px;
}

.roulette-form .webFormTools {
    text-align: center;
}

.roulette-form-fileds {
    margin-top: 100px;
    margin-left: auto;
    margin-right: 20px;
    width: 50%;
}

.roulette-form__title {
    color: #902728;
    font-size: 36px;
    font-weight: bold;
    line-height: 56px;
    margin-top: 60px;
    text-align: center;
}

.roulette-form__submit {
    background: #902728 !important;
    border-radius: 2px;
    color: #FFFFFF !important;
    font-size: 18px !important;
    font-weight: bold;
    min-width: 228px;
    margin: 0 auto;
    height: auto !important;
    padding: 0 !important;
}

.roulette-form__subtitle {
    color: #333333;
    font-size: 24px;
    line-height: 37px;
    text-align: center;
}

.roulette-modal {
    background: url('<?= $this->GetFolder()?>/images/background.png') no-repeat;
    width: 676px !important;
    height: 646px !important;
    position: relative;
    padding: 0 !important;
}

.roulette__wheel {
    background: url('<?= $this->GetFolder() ?>/images/wheel.png') no-repeat;
    width: 489px;
    height: 490px;
}

.roulette__pizza {
    background: url('<?= $this->GetFolder() ?>/images/pizza.png') no-repeat;
    position: absolute;
    width: 82px;
    height: 78px;
    top: calc(50% - 38px);
    left: 455px;
    z-index: 10;
}

.roulette__snow {
    background: url('<?= $this->GetFolder() ?>/images/snow.png') no-repeat;
    position: absolute;
    width: 100px;
    height: 100px;
    top: 205px;
    left: 200px;
    z-index: 10;
}
</style>
<?php
$variants = array_map(function ($variant) {
    return [
        'ID' => $variant['ID'],
        'MESSAGE' => $variant['MESSAGE']
    ];
}, $arResult['QUESTIONS']['SIMPLE_QUESTION_836']['STRUCTURE']);
?>

<div class="roulette-form">

    <p class="roulette-form__title">Получите подарки и промокоды!</p>
    <p class="roulette-form__subtitle">Испытайте удачу и получите комплимент от relaxa.ru</p>

    <div class="roulette-form-fileds">
        <div class="webFormDw" data-id="<?=$arResult["arForm"]["ID"]?>">
            <?if($arResult["isFormErrors"] == "Y"):?><?=$arResult["FORM_ERRORS_TEXT"];?><?endif;?>

            <?=$arResult["FORM_NOTE"]?>

            <?if($arResult["isFormNote"] != "Y"):?>
            <?=$arResult["FORM_HEADER"]?>

                <?if(!empty($arResult["QUESTIONS"])):?>
                    <div class="webFormItems">
                        <?foreach ($arResult["QUESTIONS"] as $FIELD_SID => $arQuestion):?>
                            <?if ($arQuestion['STRUCTURE'][0]['FIELD_TYPE'] == 'hidden'):?>
                                <?=$arQuestion["HTML_CODE"];?>
                            <?else:?>
                                <div class="webFormItem" id="WEB_FORM_ITEM_<?=$FIELD_SID?>">
                                    <div class="webFormItemCaption">
                                        <?if(!empty($arQuestion["IMAGE"])):?>
                                            <?$imageCaption = CFile::ResizeImageGet($arQuestion["IMAGE"]["ID"], array("width" => 24, "height" => 24), BX_RESIZE_IMAGE_PROPORTIONAL, false);?>
                                            <img src="<?=$imageCaption["src"]?>" class="webFormItemImage" alt="<?=$arQuestion["CAPTION"]?>">
                                        <?endif;?>
                                        <div class="webFormItemLabel"><?=$arQuestion["CAPTION"]?><?if ($arQuestion["REQUIRED"] == "Y"):?><span class="webFormItemRequired">*</span><?endif;?></div>
                                    </div>
                                    <div class="webFormItemError"></div>
                                    <div class="webFormItemField"<?if ($arQuestion["REQUIRED"] == "Y"):?> data-required="Y"<?endif;?>>
                                        <?if($arQuestion["STRUCTURE"]["0"]["FIELD_TYPE"] != "radio"):?>
                                            <?php
                                                if ($arQuestion['STRUCTURE'][0]['ID'] == 223) {
                                                    $arQuestion['HTML_CODE'] = str_replace('>', ' placeholder="Введите имя">', $arQuestion['HTML_CODE']);
                                                } elseif ($arQuestion['STRUCTURE'][0]['ID'] == 224) {
                                                    $arQuestion['HTML_CODE'] = str_replace('>', ' placeholder="Введите номер телефона">', $arQuestion['HTML_CODE']);
                                                }
                                            ?>
                                            <?=$arQuestion["HTML_CODE"]?>
                                        <?endif;?>
                                    </div>
                                </div>
                            <?endif;?>
                        <?endforeach;?>
                        <?if($arResult["isUseCaptcha"] == "Y"):?>
                            <div class="webFormItem">
                                <div class="webFormItemCaption"><?=GetMessage("FORM_CAPTCHA_TABLE_TITLE")?></div>		
                                    <input type="hidden" name="captcha_sid" value="<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" class="webFormCaptchaSid" />
                                    <div class="webFormCaptchaPicture">
                                        <img src="/bitrix/tools/captcha.php?captcha_sid=<?=htmlspecialcharsbx($arResult["CAPTCHACode"]);?>" width="180" height="40" class="webFormCaptchaImage"/>
                                    </div>
                                    <div class="webFormCaptchaLabel">
                                        <?=GetMessage("FORM_CAPTCHA_FIELD_TITLE")?><?=$arResult["REQUIRED_SIGN"];?>
                                    </div>
                                <div class="webFormItemField" data-required="Y">
                                    <input type="text" name="captcha_word" size="30" maxlength="50" value="" class="captcha_word" />
                                </div>
                            </div>
                        <?endif;?>
                    </div>
                <?endif;?>
                <div class="webFormError"></div>
                <div class="webFormTools">
                    <input <?=(intval($arResult["F_RIGHT"]) < 10 ? "disabled=\"disabled\"" : "");?> type="submit" name="web_form_submit" value="<?=htmlspecialcharsbx(strlen(trim($arResult["arForm"]["BUTTON"])) <= 0 ? GetMessage("FORM_ADD") : $arResult["arForm"]["BUTTON"]);?>" class="sendWebFormDw roulette-form__submit" />
                    <input type="hidden" name="web_form_apply" value="Y" />

                    <p><sup>*</sup> запустить карусель можно только 1 раз</p>
                </div>
                <?=$arResult["FORM_FOOTER"]?>
            <?endif;?>
            <div class="webFormMessage" id="webFormMessage_<?=$arResult["arForm"]["ID"]?>">
                <div class="webFormMessageContainer">
                    <div class="webFormMessageMiddle">
                        <div class="webFormMessageHeading"><?=GetMessage("WEB_FORM_SENDED_HEADING")?></div>
                        <div class="webFormMessageDescription"><?=GetMessage("WEB_FORM_SENDED_DESCRIPTION")?></div>
                        <a href="#" class="webFormMessageExit"><?=GetMessage("WEB_FORM_SENDED_CLOSE")?></a>
                    </div>
                </div>
            </div>

            <div class="roulette">
                <div class="roulette__wheel"></div>
                <div class="roulette__pizza"></div>
                <div class="roulette__snow"></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	var webFormAjaxDir = "<?=$templateFolder?>/ajax.php";
	var webFormSiteId = "<?=SITE_ID?>";
</script>

<script>
(() => {
    'use strict';

    let variants = <?= json_encode($variants) ?>;

    let wheel = document.querySelector('.roulette__wheel');
    let rotate = 1;
    let rotateInterval = setInterval(() => {
        rotate++;
        wheel.style.transform = `rotate(-${rotate}deg)`;
    }, 10);

    BX.addCustomEvent('onAjaxSuccess', function() {
        console.log('test');
    });
})(BX);
</script>
