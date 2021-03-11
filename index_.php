<script type="text/javascript" src="https://relaxa.ru/bitrix/templates/dresscodeV2_new/js/jquery.js"></script>
<link rel="stylesheet" href="https://relaxa.ru/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.css">
<link rel="stylesheet" href="https://relaxa.ru/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.min.css">
<script type="text/javascript" src="https://relaxa.ru/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.min.js"></script>

<link rel="stylesheet" href="https://relaxa.ru/assets/js/fancybox/jquery.fancybox.min.css">
<link rel="stylesheet" href="https://relaxa.ru/assets/js/fancybox/jquery.fancybox.min.css">
<script type="text/javascript" src="https://relaxa.ru/assets/js/fancybox/jquery.fancybox.min.js"></script>

<link rel="stylesheet" href="https://relaxa.ru/bitrix/templates/dresscodeV2/css/prefix-new/main.css">
<link rel="stylesheet" href="https://relaxa.ru/assets/css/style.css">



<script src='https://www.google.com/recaptcha/api.js'></script>

<div class="discount-fix" id="discount-fix">
    <form class="discount-fix__wrap">
        <input type="hidden" name="ID" value="<?=$arResult['ID']?>">
        <input type="hidden" name="IBLOCK_ID" value="<?=$arResult['IBLOCK_ID']?>">
        <div class="form-pokaza__close " data-fancybox-close>
            <span></span>
            <span></span>
        </div>
        <div class="form__title">Зафиксировать скидку</div>
        <div class="form__text">
            Оставьте заявку на предзаказ кресла OTO TITAN <br> по цене 289 000 рублей!
        </div>
        <div class="podrobnee_landing">
            <a href="https://otobodycare.ru/oto_titan" class="c-modal__link">
                Подробнее о кресле...
            </a>
        </div>
        <div class="form-pokaza__item">
            <label>Выберите цвет кресла<span>*</span></label>
            <select class="select">
                <option selected="false" disabled="disabled">Выберите из списка:</option>
                <option>Бежевый</option>
                <option>Коричневый</option>
                <option>Серый</option>
            </select>
            <input style="display: none;" type='text' name="SELECT_CHAIR" id='select_input' value='' required>
        </div>
        <div class="form-pokaza__item">
            <label>Ваше имя<span>*</span></label>
            <input type="text" name="NAME" placeholder="Введите имя" required>
        </div>
        <div class="form-pokaza__item">
            <label>Номер телефона<span>*</span></label>
            <input class="p-izgotov__phone" type="text" name="PHONE" placeholder="+7(___) ___-__-__" required>
        </div>
        <div class="form-pokaza__item">
            <label>Укажите e-mail или мессенджер для связи (не обязательно)</label>
            <input type="text" name="DOP_SVAZ">
        </div>

        <div class="form-pokaza__checkbox">
            <input type="checkbox" name="SOGL__discount-fix" id="form-check__discount-fix" checked required>
            <label for="form-check__discount-fix">Согласие на обработку персональных данных</label>
        </div>

        <div class="g-recaptcha" id="recaptcha1" data-sitekey="6Lcdw-MUAAAAANewuNvmQb0ikgc-2OKf9AfjMYW_"></div>
        <button name="submit" type="submit" class="discount-fix__submite">Отправить</button>
    </form>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $(".fancybox").fancybox();
    });


    $(function(){
        let input = $('#select_input'),
            inpVal = input.val();

        $('.select').on('change', function(){
            input.val(inpVal + $(this).val());
        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.discount-fix__wrap').submit(function() {
            var key = grecaptcha.getResponse();
            if(key == '') {
                alert('Вы не прошли проверку "Я не робот"');
            } else {
                var form = $(this).serialize();
                $.ajax({
                    type: 'POST', // метод
                    url: '/ajax/discount-fix.php', // ссылка на обработчик
                    data: form, // нашы переменные из name
                    success: function(data){
                        console.log(data);
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
            }
            return false;
        });
    });
</script>

<style>
    .podrobnee_landing {
        text-align: center;
        margin-bottom: 18px;
    }
    .podrobnee_landing a{
        display: inline-block;
        font-family: "RobotoBold";
        font-size: 18px;
        line-height: 140%;
        color: #79AABF;
        text-decoration: none;
    }
    select {
        font-size: 18px;
        line-height: 22px;
        color: #000;
        background: #FFFFFF;
        border: 1px solid #C4C4C4;
        box-sizing: border-box;
        border-radius: 2px;
        height: 55px;
        padding: 15px;
    }
    div#discount-fix, div#ny-mk, div#ny-mn {
        display: none;
    }
    form#discount-fix__wrap, form#ny-mk__wrap, form#ny-mn__wrap {
        max-width: 600px;
    }
    .fancybox-slide .fancybox-button svg {
        display: none !important;
    }
    button.discount-fix__submite, button.ny-mk__submite, button.ny-mn__submite {
        margin: 0 auto;
        margin-top: 45px;
        border: 0;
        width: 228px;
        height: 55.85px;
        display: block;
        background: #0A5A77;
        border-radius: 2px;
        font-style: normal;
        font-weight: bold;
        font-size: 18px;
        line-height: 22px;
        display: flex;
        align-items: center;
        text-align: center;
        color: #FFFFFF;
        text-align: center;
        justify-content: center;
        transition: 0.3s all;
        cursor: pointer;
    }
</style>


<?if($USER->isAdmin()) {?>
    <?/*

<a class="fancy-form" style="background: #ffffff; color: #de4404;" href="#ny-mk" data-fancybox>ВРЕМЯ ДАРИТЬ ПОДАРКИ (Массажные кресла)</a>

<a class="fancy-form" style="background: #ffffff; color: #de4404;" href="#ny-mn" data-fancybox>ВРЕМЯ ДАРИТЬ ПОДАРКИ (Массажеры ног)</a>


<div class="ny-mk" id="ny-mk">
            <form id="ny-mk__wrap">
                <input type="hidden" name="ID" value="<?=$arResult['ID']?>">
                <input type="hidden" name="IBLOCK_ID" value="<?=$arResult['IBLOCK_ID']?>">
                <div class="form-pokaza__close " data-fancybox-close>
                    <span></span>
                    <span></span>
                </div>
                <div class="form__title">Получить предложение на скидку</div>
                <div class="form__text">
                    Оставьте заявку на получение уникального предложения <br> на преобретение массажного кресла со скидкой 30%!
                </div>
                <div class="form-pokaza__item">
                    <label>Ваше имя<span>*</span></label>
                    <input type="text" name="NAME" placeholder="Введите имя" required>
                </div>
                <div class="form-pokaza__item">
                    <label>Номер телефона<span>*</span></label>
                    <input class="p-izgotov__phone" type="text" name="PHONE" placeholder="+7(___) ___-__-__" required>
                </div>
				<div class="form-pokaza__item">
                    <label>Укажите e-mail или мессенджер для связи (не обязательно)</label>
                    <input type="text" name="DOP_SVAZ">
                </div>

				<div class="form-pokaza__checkbox">
                    <input type="checkbox" name="SOGL" id="form-check__ny-mk" checked required>
                    <label for="form-check__ny-mk">Согласие на обработку персональных данных</label>
                </div>

                <div class="g-recaptcha" id="recaptcha2" data-sitekey="6Lcdw-MUAAAAANewuNvmQb0ikgc-2OKf9AfjMYW_"></div>
                <button class="ny-mk__submite">Отправить</button>
            </form>
        </div>
<script src='https://www.google.com/recaptcha/api.js'></script>
        <script>
            $(document).ready(function() {
                $('#ny-mk__wrap').submit(function() {
                    var key = grecaptcha.getResponse();
                    if(key == '') {
                        alert('Вы не прошли проверку "Я не робот"');
                    } else {
                        var form = $(this).serialize();
                        $.ajax({
                            type: 'POST', // метод
                            url: '/ajax/ny-mk.php', // ссылка на обработчик
                            data: form, // нашы переменные из name
                            success: function(data){
                                console.log(data);
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
                    }
                    return false;
                });
            });
        </script>

*/?>
<?}?>


<div class="popular__categories">
    <div class="wrapper">
        <h1 class="heading">Популярные категории массажного оборудования</h1>
        <div class="popular__info">Более 3000 товаров для спины, головы, ног и всего тела</div>

        <div class="all__pop__categories">

            <div class="left__section__popular">

                <div class="s__section__001">
                    <a href="/massazhnoe-oborudovanie/massazhery/massazhnye_nakidki/">
                        <span class="s__section__bg"><img src="/bitrix/templates/dresscodeV2_new/images/ND/cat001.png"></span>
                        <span class="s__section__supbg"></span>
                        <span class="s__section__name">Массажеры <br>для спины</span>
                        <span class="s__section__price">от <span class="big__price">3 980</span> руб.</span>
                        <span class="s__section__round">></span>
                    </a>
                </div>


                <div class="s__section__002">
                    <a href="/massazhnoe-oborudovanie/massazhery/massazhnye_podushki/">
                        <span class="s__section__bg"><img src="/bitrix/templates/dresscodeV2_new/images/ND/cat002.png"></span>
                        <span class="s__section__supbg"></span>
                        <span class="s__section__name">Массажные <br>подушки</span>
                        <span class="s__section__price">от <span class="big__price">1 890</span> руб.</span>
                        <span class="s__section__round">></span>
                    </a>
                </div>


            </div>

            <div class="center__section__popular">
                <div class="s__section__003">
                    <a href="/massazhnoe-oborudovanie/massazhnye_kresla/">
                        <span class="s__section__bg"><img src="/bitrix/templates/dresscodeV2_new/images/ND/cat003.png"></span>
                        <span class="s__section__supbg"></span>
                        <span class="s__section__name">Массажные<br>кресла</span>
                        <span class="s__section__price">от <span class="big__price">18 990</span> руб.</span>
                        <span class="s__section__round">></span>
                    </a>
                </div>
            </div>
            <div class="right__section__popular">

                <div class="s__section__004">
                    <a href="/massazhnoe-oborudovanie/massazhery/massazhery_golovy_i_glaz/">
                        <span class="s__section__bg"><img src="/bitrix/templates/dresscodeV2_new/images/ND/cat004.png"></span>
                        <span class="s__section__supbg"></span>
                        <span class="s__section__name">Массажеры<br>для головы</span>
                        <span class="s__section__price">от <span class="big__price">2 490</span> руб.</span>
                        <span class="s__section__round">></span>
                    </a>
                </div>

                <div class="s__section__005">
                    <a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/">
                        <span class="s__section__bg"><img src="/bitrix/templates/dresscodeV2_new/images/ND/cat005.png"></span>
                        <span class="s__section__supbg"></span>
                        <span class="s__section__name">Массажеры<br>для ног</span>
                        <span class="s__section__price">от <span class="big__price">4 890</span> руб.</span>
                        <span class="s__section__round">></span>
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

<!--div class="slider__stuff__main">
	<div class="wrapper">
    <div id="tabs">

        <div class="title_wrap">
            <div class="container" id="">
                <div class="tabs__caption  tabs">
                	<a href="#sale" class="tabs__btn h2 active">
                        РАСПРОДАЖА
                    </a>
                    <a href="#popular" class="tabs__btn h2">
                        ХИТЫ
                    </a>
                    <a href="#new" class="tabs__btn h2">
                        НОВИНКИ
                    </a>

                    <a href="#discont" class="tabs__btn h2">
                        ДИСКОНТ
                    </a>
                </div>
            </div>
        </div>


        <div class="tabs-content">

            <div id="sale">
                <div class="home_popular_item">
                    <div class="container">
                        <? $APPLICATION->IncludeComponent(
    "bitrix:catalog.top",
    "template3",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "-",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "BASKET_URL" => "/personal/basket.php",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:1:17\",\"DATA\":{\"logic\":\"Equal\",\"value\":9}}]}",
        "DETAIL_URL" => "",
        "DISPLAY_COMPARE" => "N",
        "ELEMENT_COUNT" => "",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_NAME" => "",
        "HIDE_NOT_AVAILABLE" => "L",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => "21",
        "IBLOCK_TYPE" => "catalog",
        "LABEL_PROP" => "-",
        "LINE_ELEMENT_COUNT" => "3",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "OFFERS_CART_PROPERTIES" => "",
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_LIMIT" => "3",
        "OFFERS_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(
            0 => "Розничная",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_DISPLAY_MODE" => "N",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(
        ),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_URL" => "",
        "SEF_MODE" => "N",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "TEMPLATE_THEME" => "blue",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "VIEW_MODE" => "SECTION",
        "COMPONENT_TEMPLATE" => "template3",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
); ?>
                    </div>
                </div>
            </div>



            <div id="popular">
                <div class="home_popular_item">
                    <div class="container">
                        <? $APPLICATION->IncludeComponent(
    "bitrix:catalog.top",
    ".default",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "-",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "BASKET_URL" => "/personal/basket.php",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:1:17\",\"DATA\":{\"logic\":\"Equal\",\"value\":8}}]}",
        "DETAIL_URL" => "/#IBLOCK_CODE#/#SECTION_CODE_PATH#/#ELEMENT_ID#/",
        "DISPLAY_COMPARE" => "N",
        "ELEMENT_COUNT" => "3",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_NAME" => "",
        "HIDE_NOT_AVAILABLE" => "L",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "catalog",
        "LABEL_PROP" => "-",
        "LINE_ELEMENT_COUNT" => "3",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "OFFERS_CART_PROPERTIES" => array(
        ),
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_LIMIT" => "5",
        "OFFERS_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(
            0 => "Розничная",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_DISPLAY_MODE" => "N",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(
        ),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_URL" => "/#SECTION_CODE_PATH#/",
        "SEF_MODE" => "N",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "TEMPLATE_THEME" => "blue",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "VIEW_MODE" => "SECTION",
        "COMPONENT_TEMPLATE" => ".default",
        "COMPOSITE_FRAME_MODE" => "A",
        "COMPOSITE_FRAME_TYPE" => "AUTO"
    ),
    false
); ?>
                    </div>
                </div>
            </div>


            <div id="new">
                <div class="home_popular_item">
                    <div class="container">
                        <? $APPLICATION->IncludeComponent(
    "bitrix:catalog.top",
    "template2",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "-",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "BASKET_URL" => "/personal/basket.php",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:1:17\",\"DATA\":{\"logic\":\"Equal\",\"value\":7}}]}",
        "DETAIL_URL" => "",
        "DISPLAY_COMPARE" => "N",
        "ELEMENT_COUNT" => "9",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_NAME" => "",
        "HIDE_NOT_AVAILABLE" => "L",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "catalog",
        "LABEL_PROP" => "-",
        "LINE_ELEMENT_COUNT" => "3",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "OFFERS_CART_PROPERTIES" => array(
        ),
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_LIMIT" => "5",
        "OFFERS_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(
            0 => "Розничная",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_DISPLAY_MODE" => "N",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(
        ),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_URL" => "",
        "SEF_MODE" => "N",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "TEMPLATE_THEME" => "blue",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "VIEW_MODE" => "SECTION",
        "COMPONENT_TEMPLATE" => "template2"
    ),
    false
); ?>
                    </div>
                </div>
            </div>



            <div id="discont">
                <div class="home_popular_item">
                    <div class="container">
                        <? $APPLICATION->IncludeComponent(
    "bitrix:catalog.top",
    "template4",
    array(
        "ACTION_VARIABLE" => "action",
        "ADD_PICT_PROP" => "-",
        "ADD_PROPERTIES_TO_BASKET" => "Y",
        "ADD_TO_BASKET_ACTION" => "ADD",
        "BASKET_URL" => "/personal/basket.php",
        "CACHE_FILTER" => "N",
        "CACHE_GROUPS" => "Y",
        "CACHE_TIME" => "36000000",
        "CACHE_TYPE" => "A",
        "COMPATIBLE_MODE" => "Y",
        "CONVERT_CURRENCY" => "N",
        "CUSTOM_FILTER" => "{\"CLASS_ID\":\"CondGroup\",\"DATA\":{\"All\":\"AND\",\"True\":\"True\"},\"CHILDREN\":[{\"CLASS_ID\":\"CondIBProp:1:17\",\"DATA\":{\"logic\":\"Equal\",\"value\":10}}]}",
        "DETAIL_URL" => "",
        "DISPLAY_COMPARE" => "N",
        "ELEMENT_COUNT" => "9",
        "ELEMENT_SORT_FIELD" => "sort",
        "ELEMENT_SORT_FIELD2" => "id",
        "ELEMENT_SORT_ORDER" => "asc",
        "ELEMENT_SORT_ORDER2" => "desc",
        "FILTER_NAME" => "",
        "HIDE_NOT_AVAILABLE" => "L",
        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
        "IBLOCK_ID" => "1",
        "IBLOCK_TYPE" => "catalog",
        "LABEL_PROP" => "-",
        "LINE_ELEMENT_COUNT" => "3",
        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
        "MESS_BTN_BUY" => "Купить",
        "MESS_BTN_COMPARE" => "Сравнить",
        "MESS_BTN_DETAIL" => "Подробнее",
        "MESS_NOT_AVAILABLE" => "Нет в наличии",
        "OFFERS_CART_PROPERTIES" => array(
        ),
        "OFFERS_FIELD_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_LIMIT" => "5",
        "OFFERS_PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "OFFERS_SORT_FIELD" => "sort",
        "OFFERS_SORT_FIELD2" => "id",
        "OFFERS_SORT_ORDER" => "asc",
        "OFFERS_SORT_ORDER2" => "desc",
        "PARTIAL_PRODUCT_PROPERTIES" => "N",
        "PRICE_CODE" => array(
            0 => "Розничная",
        ),
        "PRICE_VAT_INCLUDE" => "Y",
        "PRODUCT_DISPLAY_MODE" => "N",
        "PRODUCT_ID_VARIABLE" => "id",
        "PRODUCT_PROPERTIES" => array(
        ),
        "PRODUCT_PROPS_VARIABLE" => "prop",
        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
        "PROPERTY_CODE" => array(
            0 => "",
            1 => "",
        ),
        "SECTION_URL" => "",
        "SEF_MODE" => "N",
        "SHOW_CLOSE_POPUP" => "N",
        "SHOW_DISCOUNT_PERCENT" => "N",
        "SHOW_OLD_PRICE" => "N",
        "SHOW_PRICE_COUNT" => "1",
        "TEMPLATE_THEME" => "blue",
        "USE_PRICE_COUNT" => "N",
        "USE_PRODUCT_QUANTITY" => "N",
        "VIEW_MODE" => "SECTION",
        "COMPONENT_TEMPLATE" => "template4"
    ),
    false
); ?>
                    </div>
                </div>
            </div>

        </div>


    </div>


    <script type="text/javascript">
        $(document).ready(function () {
            var tabs = $('#tabs');
            $('.tabs-content > div', tabs).each(function (i) {
                if (i != 0) $(this).hide(0);
            });
            tabs.on('click', '.tabs a', function (e) {
                /* Предотвращаем стандартную обработку клика по ссылке */
                e.preventDefault();

                /* Узнаем значения ID блока, который нужно отобразить */
                var tabId = $(this).attr('href');

                /* Удаляем все классы у якорей и ставим active текущей вкладке */
                $('.tabs a', tabs).removeClass('active');
                $(this).addClass('active');

                /* Прячем содержимое всех вкладок и отображаем содержимое нажатой */
                $('.tabs-content > div', tabs).hide(0);
                $(tabId).show();
            });
        });
    </script>
	</div>
</div-->

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
    .s__why_a {
        text-decoration: none;
    }
    .p-card__preim > .wrapper {
        width: 100%;
        margin: 0;
        transform: none;
        -webkit-transform: none;
    }
    @media(max-width: 1199px) {
        body .p-card__preim > .wrapper {
            width: 100% !important;
        }
    }
    @media(max-width: 767px) {
        body .p-card__preim {
            display: block !important;
        }
        body .p-preim__item {
            width: 100% !important;
        }
    }
</style>

<div class="economy__main">
    <div class="wrapper">
        <div class="economy__block">
            <div class="left__bg__economy"></div>
            <div class="right__economy">
                <div class="heading__economy"><span class="big__heading__economy">Сэкономь до 50%</span><br>на новом массажном кресле по программе обмена “Trade in”!</div>
                <div class="info__economy">Бесплатно вывезем ваше старое кресло и привезем новое со значительной скидкой</div>
                <div class="get__discount__economy openWebFormModal" data-id="4">Получить скидку</div>
            </div>
        </div>
    </div>
</div>

<!--div class="reviews__main">
	<div class="wrapper">

		<h3 class="heading">Выбор покупателей</h3>
		<div class="slider__rew__main">

				<div class="single__review__main">
					<div class="single__rew__rew">
						<div class="rew__name">
							Алла
						</div>
						<div class="rew__date">
							31.10.2018
						</div>
						<div class="rew__comment">
							Каждая женщина просто обязана следить за собой и за своим телом. Я любительница различных массажей и приятных процедур. Но иногда, в жизни бывают такие моменты, когда я не могу себе это позволить ввиду таких факторов, как финансовые затруднения или недостаточное количество времени. Тогда уж я ищу альтернативу. Этот массажер я рекомендую однозначно...
							<a href="/massazhnoe-oborudovanie/massazhery/massazhery_shei/2180/" class="read__more__rew">Читать весь отзыв</a>
						</div>
					</div>
					<div class="single__rew__product single__rew__product-2135">
						<div class="rew__info__product">
							<div class="rew__brand__logo">
								<img src="/upload/resize_cache/iblock/471/150_250_1/47167373f7c8a3be0c50c076799dadae.png">
							</div>
							<div class="rew__name__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhery_shei/2180/">Массажер для шеи и плеч HANSUN HS108C</a></div>
							<div class="rew__prod__price">
								8 500 руб.
							</div>
														<div class="rew__prods__rating">
								<img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""></div>
						</div>
						<div class="rew__photo__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhery_shei/2180/"><img src="/upload/resize_cache/iblock/52b/500_500_1/52bbf5aa6d0b9ed0c14b64410256a7fa.jpg" alt="Массажер для шеи и плеч HANSUN HS108C"></a></div>
					</div>
				</div>

				<div class="single__review__main">
					<div class="single__rew__rew">
						<div class="rew__name">
							Степан Викторович
						</div>
						<div class="rew__date">
							21.03.2018
						</div>
						<div class="rew__comment">
							Решили купить на семью этот массажер.Пользуемся по мере возможностей.Рекомендуют не больше двух сеансов в день.Ощущения после массажа: это легкость в ногах.И после регулярного использования массажа у меня ноги по утрам перестало сводить.
						</div>
					</div>
					<div class="single__rew__product single__rew__product-2135">
						<div class="rew__info__product">
							<div class="rew__brand__logo">
								<img src="/upload/resize_cache/iblock/1cd/250_50_1/1cdd39609d3bb5f758ea598ef970f3c6.jpg">
							</div>
							<div class="rew__name__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/2145/">Массажер для ног Lotus RF-8650</a></div>
							<div class="rew__prod__price">
								33 000 руб.
							</div>
							<div class="rew__prods__rating">
								<img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt="">
							</div>
						</div>
						<div class="rew__photo__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/2145/"><img src="/upload/resize_cache/iblock/b7e/500_500_1/b7eb308a70c15728876ac449d34b5bf4.jpg" alt="Массажер для ног Lotus RF-8650"></a></div>
					</div>
				</div>

				<div class="single__review__main">
					<div class="single__rew__rew">
						<div class="rew__name">
							Марина
						</div>
						<div class="rew__date">
							24.05
						</div>
						<div class="rew__comment">
							Именно этот матрас меня устроил всеми параметрами. Когда выбирала - искала именно мягкий матрас. Но почти все были частично твердые, неудобные. Хотя матрас должен быть мягким и удобным. Но потом легла на этот.... Это именно он... Мягкий, удобный, гнущийся как нужно. При этом еще и с хорошей вибрацией и компрессией.
						</div>
					</div>
					<div class="single__rew__product single__rew__product-2135">
						<div class="rew__info__product">
							<div class="rew__brand__logo">
								<img src="/upload/resize_cache/iblock/c96/250_50_1/c9615f37fd0905c1c066cdaeb2f271c0.png">
							</div>
							<div class="rew__name__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhnye_matrasy/5452/">Массажное Lounge кресло-матрас EGO Com Forte EG1600</a></div>
							<div class="rew__prod__price">
								 19 900 руб.
							</div>
							<div class="rew__prods__rating">
								<img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""></div>
						</div>
						<div class="rew__photo__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhnye_matrasy/5452/"><img src="/upload/resize_cache/iblock/328/500_500_1/3281fc72e49b6bda063390864846689a.png" alt="Массажное Lounge кресло-матрас EGO Com Forte EG1600"></a></div>
					</div>
				</div>

				<div class="single__review__main">
					<div class="single__rew__rew">
						<div class="rew__name">
							Лариса
						</div>
						<div class="rew__date">

						</div>
						<div class="rew__comment">
							Приобрела этот массажер буквально вчера, сама приехала на Лермонтовский проспект в магазин. Вот сегодня решила написать отзыв, рассказать о покупке. Что ж сказать... Еще в магазине я решила что он- мой. Если сравнивать с другими моделями, именно этот массажер подошел мне идеальней остальных…
							<a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/2147/" class="read__more__rew">Читать весь отзыв</a>
						</div>
					</div>
					<div class="single__rew__product single__rew__product-2135">
						<div class="rew__info__product">
							<div class="rew__brand__logo">
								<img src="/upload/resize_cache/iblock/471/150_250_1/47167373f7c8a3be0c50c076799dadae.png">
							</div>
							<div class="rew__name__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/2147/">Массажер для ног HANSUN FOOT GUA-SHA REFLEXOLOGY PLUS FC1006</a></div>
							<div class="rew__prod__price">
								  34 900 руб.
							</div>
							<div class="rew__prods__rating">
								<img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""></div>
						</div>
						<div class="rew__photo__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/2147/"><img src="/upload/resize_cache/iblock/f27/500_500_1/f275d5da64ad586035a9df4d061af6c6.jpg" alt="Массажер для ног HANSUN FOOT GUA-SHA REFLEXOLOGY PLUS FC1006"></a></div>
					</div>
				</div>

				<div class="single__review__main">
					<div class="single__rew__rew">
						<div class="rew__name">
							Mariya
						</div>
						<div class="rew__date">
							18.09.2018
						</div>
						<div class="rew__comment">
							Заметно и эффективно снимает усталость, особенно после длительных походов по магазинам. Спустя месяц использования хочу так же отметить, что массажер помог мне избавиться от хронической проблемы с замерзанием нижних конечностей
						</div>
					</div>
					<div class="single__rew__product single__rew__product-2135">
						<div class="rew__info__product">
							<div class="rew__brand__logo">
								<img src="/upload/iblock/057/057c7096c51a76a009f6f34d7e931da7.png">
							</div>
							<div class="rew__name__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/2143/">Массажер ног OTO ADORE FOOT WARM AFW-90</a></div>
							<div class="rew__prod__price">
								  21 000 руб.
							</div>
														<div class="rew__prods__rating">
								<img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""></div>
						</div>
						<div class="rew__photo__product"><a href="/massazhnoe-oborudovanie/massazhery/massazhery_nog/2143/"><img src="/upload/resize_cache/iblock/ba8/500_500_1/ba8635c7c26387dc7710562ad9a5d413.jpg" alt="Массажер ног OTO ADORE FOOT WARM AFW-90"></a></div>
					</div>
				</div>

		<?if (false){?>
                    <?
    $iblockReview = 18;
    $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM","IBLOCK_ID");
    $arFilter = Array("IBLOCK_ID"=>$iblockReview, "ACTIVE"=>"Y", "PROPERTY_PRODUCT_VALUE"=>false);
    $res = CIBlockElement::GetList(Array("RAND"=>"ASC"), $arFilter, false, Array("nPageSize"=>5), $arSelect);
    while($ob = $res->GetNextElement())
    {$i = 1;
        $arFields = $ob->GetFields();
        $arFields['PROP'] = $ob->GetProperties();?>

                       		<?//print_r($arFields);?>

                       <div class="single__review__main">
                       		<div class="single__rew__rew">
                       			<div class="rew__name">
                       				<?if(!empty($arFields['PROP']['NAME']['VALUE'])){?>
                       					<?=$arFields['PROP']['NAME']['VALUE']?>
                       				<?}else{?>
                       					Аноним
                       				<?}?>
                       			</div>
                       			<div class="rew__date">

                       				<?
        $string = $arFields['DATE_ACTIVE_FROM'];
        $pattern = "/(\d+).(\d+).00(\d+) (\d+):(\d+):(\d+)/i";
        $replacement = "\$1.\$2.20\$3";
        $rewDate=preg_replace($pattern, $replacement, $string);
        ?>
                       				<?=$rewDate?>

                       			</div>

                       			<div class="rew__comment">
                       				<?if(!empty($arFields['PROP']['COMMENT']['VALUE']['TEXT'])){?>
                       					<?=$arFields['PROP']['COMMENT']['VALUE']['TEXT']?>
                       				<?} else {?>
                       					<?=$arFields['PROP']['ADVANTAGE']['VALUE']['TEXT']?>
                       				<?}?>
                       			</div>

                       		</div>
                       		<div class="single__rew__product single__rew__product-<?=$arFields['PROP']['PRODUCT']['VALUE']?>">

                       			<?
        $resPr = CIBlockElement::GetByID($arFields['PROP']['PRODUCT']['VALUE']);
        while($obPr = $resPr->GetNextElement()){?>


											<?$arFieldsPr = $obPr->GetFields();
            //print_r($arFieldsPr);
            $arPropsPr = $obPr->GetProperties();
            //print_r($arPropsPr);
            //}?>




									<?
            if(!empty($arPropsPr['ATT_BRAND']['VALUE'])){
                $arFilterB = Array("ID" => $arPropsPr['ATT_BRAND']['VALUE'], "ACTIVE" => "Y");
                $resB = CIBlockElement::GetList(Array(), $arFilterB, false, false, array("*"));
                if($resB = $resB->GetNextElement()){
                    $brand = $resB->GetFields();
                    $brand["PICTURE"] = CFile::ResizeImageGet($brand["DETAIL_PICTURE"], array("width" => 250, "height" => 50), BX_RESIZE_IMAGE_PROPORTIONAL, false);
                }
            }
            ?>
									<div class="rew__info__product">
										<div class="rew__brand__logo">
											<img src="<?=$brand['PICTURE']['src'];?>">
										</div>
										<div class="rew__name__product"><a href="<?=$arFieldsPr['DETAIL_PAGE_URL']?>"><?=$arFieldsPr['NAME']?></a></div>
										<div class="rew__prod__price">										<?
            $rsPrices = CPrice::GetList(array(), array('PRODUCT_ID' => $arFields['PROP']['PRODUCT']['VALUE'], 'CATALOG_GROUP_ID' => 1));
            if ($arPrice = $rsPrices->Fetch())
            {
                echo CurrencyFormat($arPrice["PRICE"], $arPrice["CURRENCY"]);
            }
            ?>
										</div>
																	<div class="rew__prods__rating">
								<img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""><img src="/bitrix/templates/dresscodeV2_new/images/ND/gold__star.png" alt=""></div>



									</div>
									<?$prod_pic=CFile::ResizeImageGet($arFieldsPr["DETAIL_PICTURE"], array("width" => 250, "height" => 250), BX_RESIZE_IMAGE_PROPORTIONAL, false);?>
									<div class="rew__photo__product"><a href="<?=$arFieldsPr['DETAIL_PAGE_URL']?>"><img src="<?=$prod_pic['src']?>" alt="<?=$arFieldsPr['NAME']?>"></a></div>

									<?}?>
                       		</div>
                       </div>

                    <?}?>
			<?}?>

		</div>
	</div>
</div-->

<div class="health__care__main">
    <div class="wrapper">
        <h3 class="heading">Более 27 лет окружаем своих покупателей заботой о здоровье</h3>
        <div class="healt__care__l__info">Поможем выбрать идеальное массажное оборудование</div>
        <div class="healt__care__b__info">
            <p>Relaxa Star - интернет - магазин массажного оборудования, кресел, товаров для здоровья и дома. Наша компания более 27 лет является официальным дистрибьютором всемирно известных брендов массажного и оздоровительного оборудования - EGO, Ogawa, Hansun и OTO.</p>
            <p>В нашем шоу-руме вы найдете  более 3000 наименований профессионального массажного оборудования терапевтического, расслабляющего и оздоровительного эффекта. На все товары, представленные на сайте, распространяется расширенная гарантия от 1 до 5 лет.</p>
            <p>Уже более 27 лет мы имеем свою собственную производственную базу и сервисный центр массажных вендинг кресел и тренажеров, а также занимаемся созданием и поставкой качественных товаров для спорта и фитнеса, доступных людям с любыми финансовыми возможностями.</p>
        </div>
    </div>
</div>

<div class="main__brands__slider">
    <div class="wrapper">

        <h3 class="heading">Официальный представитель мировых брендов</h3>

        <div class="home_brand_slider">
            <?
            global $arrFilterBrands;
            $arrFilterBrands = array("!PREVIEW_PICTURE" => false, "PROPERTY_HIDE_IN_PRICE"=>"N");
            ?>
            <? $APPLICATION->IncludeComponent(
                "bitrix:news.list",
                "brand-slider-pah",
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
                    "DISPLAY_BOTTOM_PAGER" => "N",
                    "DISPLAY_DATE" => "N",
                    "DISPLAY_NAME" => "Y",
                    "DISPLAY_PICTURE" => "Y",
                    "DISPLAY_PREVIEW_TEXT" => "Y",
                    "DISPLAY_TOP_PAGER" => "N",
                    "FIELD_CODE" => array(
                        0 => "",
                        1 => "",
                    ),
                    "FILTER_NAME" => "arrFilterBrands",
                    "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                    "IBLOCK_ID" => "17",
                    "IBLOCK_TYPE" => "info",
                    "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                    "INCLUDE_SUBSECTIONS" => "N",
                    "MESSAGE_404" => "",
                    "NEWS_COUNT" => "15",
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
                        1 => "SHOW_ON_MAIN",
                        2 => "",
                    ),
                    "SET_BROWSER_TITLE" => "N",
                    "SET_LAST_MODIFIED" => "N",
                    "SET_META_DESCRIPTION" => "N",
                    "SET_META_KEYWORDS" => "N",
                    "SET_STATUS_404" => "Y",
                    "SET_TITLE" => "N",
                    "SHOW_404" => "N",
                    "SORT_BY1" => "SORT",
                    "SORT_BY2" => "ACTIVE_FROM",
                    "SORT_ORDER1" => "ASC",
                    "SORT_ORDER2" => "DESC",
                    "STRICT_SECTION_CHECK" => "N",
                    "COMPONENT_TEMPLATE" => "brand-slider-pah"
                ),
                false
            ); ?>




        </div>
    </div>
</div>