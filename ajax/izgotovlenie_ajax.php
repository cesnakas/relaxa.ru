<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
?>
<script>  
    var onloadCallback = function() {  
  var mysitekey = '6Lcdw-MUAAAAANewuNvmQb0ikgc-2OKf9AfjMYW_'  
  if ( $('#recaptcha1').length ) {
    grecaptcha.render('recaptcha1', {
      'sitekey' : mysitekey
    });
  }
  if ( $('#recaptcha2').length ) {
    grecaptcha.render('recaptcha2', {
      'sitekey' : mysitekey
    });
  }
  if ( $('#recaptcha3').length ) {
    grecaptcha.render('recaptcha3', {
      'sitekey' : mysitekey
    });
  }
  if ( $('#recaptcha4').length ) {
    grecaptcha.render('recaptcha4', {
      'sitekey' : mysitekey
    });
  }  
    };  
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
    async defer>
</script>
<?
global $arUser;

$produkt_id = $_POST['PROD'];

if($USER->IsAuthorized()) {
    $data = CUser::GetList(($by="ID"), ($order="ASC"),
        array(
            'ID' => $USER->GetID(),
            'ACTIVE' => 'Y'
        )
    );
    if($arUser = $data->Fetch()) {}
}

/* Получаем все инфоблоки из типа изготовление на заказ */

/* Список по порядку
 *
 * 44
 * 45
 * 46
 * 47
 * 48
 * 49
 * 50
 *
 * */
global $arPropList;
global $arFieldsTov;
$arPropList = array();
$arIBlockPropertys = array(44, 45, 46, 47, 48, 49, 50);

$arSelectTov = Array("ID", "NAME", "PROPERTY_PROD", "PROPERTY_TYPEO", "PROPERTY_TYPEC", "PROPERTY_TYPEP", "PROPERTY_TYPEM", "PROPERTY_TYPEOP", "PROPERTY_TYPEPOD", "PROPERTY_TYPEAC", "PROPERTY_RATING", "PROPERTY_ATT_BRAND");
$arFilterTov = Array("IBLOCK_ID"=>1,"ID"=>$produkt_id, "ACTIVE"=>"Y");
$resTov = CIBlockElement::GetList(Array(), $arFilterTov, false, Array(), $arSelectTov);
if($arFieldsTov = $resTov->Fetch()) {}
foreach($arIBlockPropertys as $elIBlock) {

    $resL = CIBlock::GetByID($elIBlock);

    if($arBlock = $resL->GetNext()){}

    $arSelect = Array("ID", "NAME", "PROPERTY_PRICE");
    $arFilter = Array("IBLOCK_ID"=>$elIBlock, "ID"=>$arFieldsTov['PROPERTY_' . $arBlock['CODE'] . '_VALUE'], "ACTIVE"=>"Y");
    $res = CIBlockElement::GetList(Array(), $arFilter, false, Array(), $arSelect);
    while($arFields = $res->Fetch()) {
        $arPropList[$elIBlock][] = $arFields;
    }
}

/* Вносим отзывы в массив arResult */
global $arResult;
$iblockReview = 18;
$arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_ID");
$sort = 'active_from';
if(isset($_GET['sort'])) {
    $sort = $_GET['sort'];
}
$arFilter = Array("IBLOCK_ID" => $iblockReview, "PROPERTY_PRODUCT" => $produkt_id, "ACTIVE" => "Y");
$res = CIBlockElement::GetList(Array($sort=>"desc"), $arFilter, false, Array(), $arSelect);
while ($ob = $res->GetNextElement()) {
    $i = 1;
    $arFields = $ob->GetFields();
    $arResult['REVIEWS'][] = $ob->GetProperties();
}

/* Дружим старые и новые отзывы */
$revRaiting = 0;
foreach($arResult['REVIEWS'] as $rev) {
    $numberStars = (int) $rev['RATE']['VALUE'];
    $revRaiting += $numberStars;
}
$arResult['OLD_RAITING'] = round($revRaiting / count($arResult['REVIEWS']));


?>

<div class="p-izgotov__wrapper">
    <div class="p-izgotov__tovtop">

        <?

        ?>

        <h2 class="p-card__title">
            <?=$arFieldsTov['NAME']?>
            <?
            if(!empty($arFieldsTov['PROPERTY_ATT_BRAND_VALUE'])) {
                $arSelectBr = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PICTURE", "DETAIL_PAGE_URL");
                $arFilterBr = Array("IBLOCK_ID"=>17, "ID"=>$arFieldsTov['PROPERTY_ATT_BRAND_VALUE']);
                $resBr = CIBlockElement::GetList(Array(), $arFilterBr, false, Array(), $arSelectBr);
                if($arBrand = $resBr->Fetch())
                {
                    $resNew = CIBlockElement::GetByID($arFieldsTov['PROPERTY_ATT_BRAND_VALUE']);
                    if($ar_resNew = $resNew->GetNext())
                        ?>
                        <a href="<?=$ar_resNew['DETAIL_PAGE_URL']?>" class="p-card__title-brand" style="background-image: url(<?=CFile::GetPath($arBrand['DETAIL_PICTURE']);?>);"></a>
                        <?
                }
            }
            ?>
        </h2>
        <div class="p-card__p-raitingbox">
            <ul class="p-raitingbox__stars">
                <?
                $sumRait;
                if($arResult['OLD_RAITING'] > 0) {
                    if($arResult['PROPERTIES']['RATING']['VALUE'] > 0) {
                        $sumRait = round(($arResult['PROPERTIES']['RATING']['VALUE'] + $arResult['OLD_RAITING']) / 2);
                    } else {
                        $sumRait = $arResult['OLD_RAITING'];
                    }
                }?>
                <?for ($i=0; $i<$sumRait; $i++):?>
                    <li class="p-raitingbox__star">
                        <svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 0L17.1432 9.67376H27.3148L19.0858 15.6525L22.229 25.3262L14 19.3475L5.77101 25.3262L8.9142 15.6525L0.685208 9.67376H10.8568L14 0Z" fill="#F6BC00"/>
                        </svg>
                    </li>
                <?endfor?>
                <?for ($i=0; $i<5-$sumRait; $i++):?>
                    <li class="p-raitingbox__star">
                        <svg width="28" height="26" viewBox="0 0 28 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path stroke="black" stroke-width="1" stroke-linecap="round" d="M14 0L17.1432 9.67376H27.3148L19.0858 15.6525L22.229 25.3262L14 19.3475L5.77101 25.3262L8.9142 15.6525L0.685208 9.67376H10.8568L14 0Z" fill="#fff"/>
                        </svg>
                    </li>
                <?endfor?>
            </ul>
            <a href="#goToSection" class="p-raitingbox__count">
                <?=count($arResult['REVIEWS'])?> отзывов
            </a>
        </div>
    </div>
    <div class="p-izgotov__top">
        <a href="#" class="p-izgotov__close"></a>
        <div class="p-izgotov__title">
            Изготовление на заказ
        </div>
        <p class="p-izgotov__subtitle">
            Создайте кресло своей мечты!
        </p>
       <!-- <a href="/usloviya/" class="p-izgotov__yslov">
            Условия изготовления изделий на заказ
        </a> -->
    </div>
    <div class="p-izgotov__contant">
        <form method="post" id="oform-izgot">

            <input type="hidden" value="<?=$produkt_id?>" name="PROD">

            <?
            global $i;
            $i = 1;
            $b = 1;
            foreach($arPropList as $key => $elProp) {

                if(count($elProp) > 0) {
                    $arBlock = array();
                    $res = CIBlock::GetByID($key);

                    if($arBlock = $res->GetNext()){

                        ?>
                        <div class="p-izgotov<?=$i?> p-izgotov-required">
                            <div class="p-izgotov__sel">
                                <div class="p-izgotov__wptoggle">
                                    <a href="#" class="p-izgotov__toggle">
                                        <?=$arBlock['NAME']?>
                                    </a>
                                </div>
                                <div class="p-izgotov__wplist">
                                    <ul class="p-izgotov__list">
                                        <?
                                        foreach($elProp as $elItem) {
                                            ?>
                                            <li class="p-izgotov__item">
                                                <input type="radio" name="<?=$arBlock['CODE']?>" class="p-izgotov__radio" id="p-izgotov__radio<?=$elItem['PROPERTY_PRICE_VALUE_ID']?>" value="<?=$elItem['ID']?>" required>
                                                <label class="p-izgotov__label" for="p-izgotov__radio<?=$elItem['PROPERTY_PRICE_VALUE_ID']?>">
                                                    <?=$elItem['NAME']?>
                                                    <span class="p-izgotov__label-sub">
                                            <?=$elItem['PROPERTY_PRICE_VALUE']?>
                                        </span>
                                                </label>
                                            </li>
                                            <?
                                        }
                                        ?>
                                        <li class="p-izgotov__item">
                                            <input type="radio" name="<?=$arBlock['CODE']?>" class="p-izgotov__radio" id="p-izgotov__radio<?=$b?>" value="Свой вариант" required>
                                            <label class="p-izgotov__label" for="p-izgotov__radio<?=$b?>">
                                                Свой вариант
                                            </label>
                                            <br>
                                            <input type="text" name="<?=$arBlock['CODE']?>_TEXT" class="p-izgotov__svoi" placeholder="Впишите свой вариант" style="display: none;">
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="p-izgotov__bottom mob-show"<?if($i == 1) {?> style="justify-content: flex-end"<?}?>>
                                <?if($i != 1) {?>
                                    <a href="#" class="p-izgotov__prev" onclick="iz_prev(this, <?=$i?>, true)">
                                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.939341 13.0607C0.353554 12.4749 0.353554 11.5251 0.939341 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.939341 13.0607ZM20 13.5L2 13.5V10.5L20 10.5V13.5Z" fill="#0A5A77"></path>
                                        </svg>
                                        Назад
                                    </a>
                                <?}?>
                                <a href="#" class="p-izgotov__next" onclick="iz_next(this, <?=$i?>, true)">
                                    Далее
                                    <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.939341 13.0607C0.353554 12.4749 0.353554 11.5251 0.939341 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.939341 13.0607ZM20 13.5L2 13.5V10.5L20 10.5V13.5Z" fill="#0A5A77"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <?
                        $i++;
                        $b++;
                    }
                }

            }
            ?>

            <div class="p-izgotov<?=$i?>">
                <div class="p-izgotov__doptreb">
                    <div class="p-izgotov__name">
                        Дополнительные требования к заказу
                    </div>
                    <textarea name="TREB" id="" cols="30" rows="10" class="p-izgotov__textarea" placeholder="Впишите требования к заказу, если это необходимо"></textarea>
                </div>
                <div class="p-izgotov__bottom mob-show">
                    <a href="#" class="p-izgotov__prev" onclick="iz_prev(this, <?=$i?>, false)">
                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.939341 13.0607C0.353554 12.4749 0.353554 11.5251 0.939341 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.939341 13.0607ZM20 13.5L2 13.5V10.5L20 10.5V13.5Z" fill="#0A5A77"></path>
                        </svg>
                        Назад
                    </a>
                    <a href="#" class="p-izgotov__next" onclick="iz_next(this, <?=$i?>, false)">
                        Далее
                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.939341 13.0607C0.353554 12.4749 0.353554 11.5251 0.939341 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.939341 13.0607ZM20 13.5L2 13.5V10.5L20 10.5V13.5Z" fill="#0A5A77"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <?$i++;?>

            <!-- SHAG 5 -->
            <div class="p-izgotov<?=$i?>">
                <div class="p-izgotov__row">
                    <p class="p-izgotov__inputtitle">
                        Ваше имя<span>*</span>
                    </p>
                    <input type="text" name="NAME" class="p-izgotov__input" onkeyup="checkParams()" placeholder="Введите имя" value="<?=$arUser['NAME'];?>" required>
                </div>
                <div class="p-izgotov__row">
                    <p class="p-izgotov__inputtitle">
                        Номер телефона<span>*</span>
                    </p>
                    <input type="text" name="PHONE" class="p-izgotov__input p-izgotov__phone" onkeyup="checkParams()" value="<?=$arUser['PERSONAL_PHONE']?>" placeholder="+7(___)___-__-__" required>
                </div>
                <div class="p-izgotov__row">
                    <p class="p-izgotov__inputtitle">
                        e-mail
                    </p>
                    <input type="email" name="EMAIL" class="p-izgotov__input" value="<?=$arUser['EMAIL']?>" placeholder="example@email.ru">
                </div>
                <div class="p-izgotov__sogl">
                    <input type="checkbox" name="SOGL" class="p-izgotov__soglinput" onkeyup="checkParams()" id="sogl" checked required>
                    <label for="sogl" class="p-izgotov__sogllabel">
                        Согласие на обработку персональных данных
                    </label>
                </div>
                <div class="p-izgotov__capcha">
                    <div id="recaptcha1"></div>
                    <div class="text-danger" style="display: block;"></div>
                </div>

                <div class="p-izgotov__bottom mob-show">
                    <a href="#" class="p-izgotov__prev" onclick="iz_prev(this, <?=$i?>, false)">
                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.939341 13.0607C0.353554 12.4749 0.353554 11.5251 0.939341 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.939341 13.0607ZM20 13.5L2 13.5V10.5L20 10.5V13.5Z" fill="#0A5A77"></path>
                        </svg>
                        Назад
                    </a>
                    <div class="p-izgotov__btns">
                        <input type="submit" class="p-izgotov__submit" value="Отправить" disabled>
                    </div>
                </div>

                <div class="p-izgotov__btns hidden-mob">
                    <input type="submit" class="p-izgotov__submit_hidden" value="Отправить">
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    function checkParams() {
/*        
        var PROD = $('input[name="PROD"]').val();
        var TYPEO = $('input[name="TYPEO"]').val();
        var TYPEC = $('input[name="TYPEC"]').val();
        var TYPEP = $('input[name="TYPEP"]').val();
        var TYPEM = $('input[name="TYPEM"]').val();
        var TYPEOP = $('input[name="TYPEOP"]').val();
        var TYPEPOD = $('input[name="TYPEPOD"]').val();
        var TYPEAC = $('input[name="TYPEAC"]').val();
        
        var NAME = $('input[name="NAME"]').val();
        var PHONE = $('input[name="PHONE"]').val();
        var SOGL = $('input[name="SOGL"]').val();
*/
        if(
/*            
            PROD.length != 0 &&
            TYPEO.length != 0 &&
            TYPEC.length != 0 &&
            TYPEP.length != 0 &&
            TYPEM.length != 0 &&
            TYPEOP.length != 0 &&
            TYPEPOD.length != 0 &&
            TYPEAC.length != 0 &&
*/            
            NAME.length != 0 &&
            PHONE.length != 0 &&
            SOGL.length != 0
        ) {
            $('.p-izgotov__submit').removeAttr('disabled');
        } else {
            $('.p-izgotov__submit').attr('disabled', 'disabled');
        }
    }

    $('.p-izgotov__close').on('click', function() {
        $.fancybox.close();
        return false;
    });

    $('.p-izgotov__phone').mask("+7(999)999-99-99");

    if($(window).width() < 768) {
        $('.p-izgotov__label').on('click', function() {
            $(this).parent().children('.p-izgotov__radio').addClass('chek');
        });
    }

    $('.p-izgotov__radio').change(function() {
        $el = $(this).val();
        if($el == 'Свой вариант') {
            $(this).parent().children('.p-izgotov__svoi').show();
        } else {
            $(this).parent().parent().children('.p-izgotov__item:last-child').children('.p-izgotov__svoi').hide();
        }
    });

    /* MOB STEPS */
    function iz_prev(element, step, req) {
        var prev = step - 1;
        if(req == true) {
            var rad = $('.p-izgotov' + step + ' input');
            if(rad.hasClass('chek')) {
                $('.p-izgotov' + step).hide();
                $('.p-izgotov' + prev).show();
            } else {
                alert('Выберите значение чтоб перейти к следующему шагу');
            }
        } else {
            $('.p-izgotov' + step).hide();
            $('.p-izgotov' + prev).show();
        }
        return false;
    }
    function iz_next(element, step, req) {
        var next = step + 1;
        if(req == true) {
            var rad = $('.p-izgotov' + step + ' input');
            if(rad.hasClass('chek')) {
                $('.p-izgotov' + step).hide();
                $('.p-izgotov' + next).show();
            } else {
                alert('Выберите значение чтоб перейти к следующему шагу');
            }
        } else {
            $('.p-izgotov' + step).hide();
            $('.p-izgotov' + next).show();
        }
        return false;
    }

    if ($(window).width() > 767) {
        $('.p-izgotov__toggle').on('click', function() {
            $(this).toggleClass('active');
            $(this).parent().parent().children('.p-izgotov__wplist').slideToggle(150);
            return false;
        });
    } else {
        $('.p-izgotov__toggle').on('click', function() {
            return false;
        });
    }

    /* ORDER */
    $('#oform-izgot').submit(function() {
        let key = grecaptcha.getResponse();
        if(key == '') {
            $('.p-izgotov__contant .text-danger').text('* Вы не прошли проверку "Я не робот"');
            return false;
        } else {
            let form = $(this).serialize();
            $.ajax({
                type: 'POST',
                url: '/ajax/izgotovlenie_order.php',
                data: form,
                success: function (data) {
                    $.fancybox.close();
                    setTimeout(function() {
                        $.fancybox.open("<div class='modal-ok' id='modalloll-ok' style='display: none;'><a href='#' class='p-izgotov__close'></a><div class='p-izgotov__title'>Спасибо за заявку!</div><div class='p-izgotov__subtitle'>Наши менеджеры свяжутся с Вами в ближайшее время.</div></div>");
                        $('.p-izgotov__close').on('click', function() {
                            $.fancybox.close();
                            return false;
                        });
                        setTimeout(function() {
                        $.fancybox.close();
                        }, 2500);
                    }, 500);
                }
            });
            return false;
        }
    });
</script>