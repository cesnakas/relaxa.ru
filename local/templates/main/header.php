<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;
?>
<?
require_once($_SERVER["DOCUMENT_ROOT"]."/settings.php"); // site settings
?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>">
<head>

<?
    $APPLICATION->ShowHead();
    // Meta
    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=0">');

    // CSS
    Asset::getInstance()->addCss('https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;subset=cyrillic');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/roboto/roboto.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/myriadpro/style.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/fonts/ice/ice_kingdom.css');
    Asset::getInstance()->addCss('https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/stylesND.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/adaptive.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/custom.css');
    Asset::getInstance()->addCss('https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/custom-styles.css');
    // Asset::getInstance()->addCss(SITE_TEMPLATE_PATH."/css/media.css");
    // Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/old_styles.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/jquery-ui.min.css');
    // Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/themes/'.$TEMPLATE_THEME_NAME.'/style.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/template_styles.css');
    // Asset::getInstance()->addCss('https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/template_styles.css');
    Asset::getInstance()->addCss(SITE_TEMPLATE_PATH.'/css/main.css');

    // JS
    Asset::getInstance()->addJs('https://code.jquery.com/jquery-3.5.1.min.js');
    Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js');
    Asset::getInstance()->addJs('https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js');
    Asset::getInstance()->addJs('https://unpkg.com/imask');
    // Asset::getInstance()->addJs('https://cdnjs.cloudflare.com/ajax/libs/jquery/1.2.3/jquery.min.js');
    Asset::getInstance()->addJs('https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/jquery-1.11.3.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery.nice-select.min.js");
    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/popper.js");
    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/bootstrap.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery-ui.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/slick.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/main-old.js");
    // Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery-1.11.0.min.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/jquery.easing.1.3.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/rangeSlider.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/system-new.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/topMenu.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/topSearch.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/dwCarousel.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/dwSlider.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/colorSwitcher.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH."/js/dwZoomer.js");
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/new-script.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/new/sku.js');
    Asset::getInstance()->addJs(SITE_TEMPLATE_PATH.'/js/main.js');
?>

    <script>
        $('.roistat_form_call_submit').click(function () {
            var name = $('#roistat_form_call_name').val();
            var phone = $('#roistat_form_call_phone').val();
            if (phone.length > 0) {
                yaCounter13260706.reachGoal("callback");
                gtag("event", "form_callback", {"event_category": "callback", "event_action": "form",});
                console.log('form_callback success');
            }
            $.ajax({
                type: 'POST',
                url: 'http://oto-relax.ru/roistat/roistat-call.php',
                data: {name: name, phone: phone}
            });
        });
        $('.pull-right').click(function () {
            var adress = $('.bx-ui-sls-fake').attr('title');
            var index = $('input[name="ORDER_PROP_4"]').val();
            var name = $('input[name="ORDER_PROP_1"]').val();
            var email = $('input[name="ORDER_PROP_2"]').val();
            var phone = $('input[name="ORDER_PROP_3"]').val();
            var adressdostavka = $('textarea[name="ORDER_PROP_7"]').val();
            var comment = $('textarea[name="ORDER_DESCRIPTION"]').val();
            var dostavka = $('input[name="DELIVERY_ID"]:checked').val();
            var dostavka2;
            var oplata = $('input[name="PAY_SYSTEM_ID"]:checked').val();
            var oplata2;
            if (dostavka == "3") {
                dostavka2 = "Доставка курьером";
            } else if (dostavka == "5") {
                dostavka2 = "Бесплатная доставка";
            } else if (dostavka == "4") {
                dostavka2 = "Доставка транспортными компаниями";
            } else if (dostavka == "2") {
                dostavka2 = "Самовывоз";
            }

            if (oplata == "4") {
                oplata2 = "Безаличная оплата"
            } else if (oplata == "7") {
                oplata2 = "Наложеный платеж";
            } else if (oplata == "2") {
                oplata2 = "Оплата наличными";
            } else if (oplata == "9") {
                oplata2 = "Оплата смартфоном";
            } else if (oplata == "8") {
                oplata2 = "Оплата через онлайн кошелек";
            } else if (oplata == "6") {
                oplata2 = "Онлайн на сайте";
            }
            $.ajax({
                url: "http://oto-relax.ru/roistat/roistat-cart.php",
                type: 'POST',
                data: {
                    name: name,
                    email: email,
                    phone: phone,
                    adress: adress,
                    index: index,
                    adressdostavka: adressdostavka,
                    dostavka2: dostavka2,
                    oplata2: oplata2,
                    comment: comment
                }
            });
        });
        $('#fastBuyFormSubmit').click(function () {
            var name = $('#fastBuyFormName').val();
            var phone = $('#fastBuyFormTelephone').val();
            var message = $('#fastBuyFormMessage').val();

            $.ajax({
                url: 'http://oto-relax.ru/roistat/one-click.php',
                type: 'POST',
                data: {name: name, phone: phone, message: message}
            });
        });
    </script>

    <meta name="title" content="<?$APPLICATION->ShowTitle();?>"/>

    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>

    <? $APPLICATION->ShowProperty("linkPrev"); ?>
    <? $APPLICATION->ShowProperty("linkNext"); ?>

    <title><?$APPLICATION->ShowTitle();?></title>

    <!--//-->

    <meta http-equiv="Content-Type" content="text/html; charset=<? echo LANG_CHARSET; ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, minimum-scale=1.0"/>

    <meta name="google-site-verification" content="G_xceoRt5jBf57eMCLA-y-oXx1O16ntd91Nl1O_7ukA" />
    <meta name="verify-admitad" content="214d5a6c15"/>
    <meta name="yandex-verification" content="3033d92eeb622c11" />

    <!-- <link href="/bitrix/templates/dresscodeV2/template_styles-relax.css" type="text/css" rel="stylesheet"> -->
    <!-- <link href="/bitrix/templates/dresscodeV2_new/template_styles-relax_old.css" type="text/css" rel="stylesheet"> -->

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");
        ym(13260706, "init", {
            id:13260706,
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true,
            ecommerce:"dataLayer"
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/13260706" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148618645-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-148618645-1');
    </script>
    <!-- Google Tag Manager -->
    <script  data-skip-moving='true'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N958G54');</script>
    <!-- End Google Tag Manager -->

    <!--<script type="text/javascript">
        function sendYandex(name, name2 = null) {
            try {
                yaCounter13260706.reachGoal(name);
                if(name2 !== null) {
                    yaCounter13260706.reachGoal(name2);
                }
                console.log('YandexM works');
            } catch(e) {
                console.error('Yandex counter not found');
            }
        }

        function sendGtag(action, category, label) {
            try {
                gtag('event', action, {
                    'event_category': category,
                    'event_action': action,
                    'event_label': label,
                });
                console.log('Gtag works');
            } catch(e) {
                console.error('Gtag not found');
            }
        }
    </script>-->

    <!--<script data-skip-moving="true">
        var isMobile = {
            Android: function() {
                return navigator.userAgent.match(/Android/i);
            },
            BlackBerry: function() {
                return navigator.userAgent.match(/BlackBerry/i);
            },
            iOS: function() {
                return navigator.userAgent.match(/iPhone|iPad|iPod/i);
            },
            Opera: function() {
                return navigator.userAgent.match(/Opera Mini/i);
            },
            Windows: function() {
                return navigator.userAgent.match(/IEMobile/i);
            },
            any: function() {
                return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
            }
        };
    </script>-->

    <!-- Google Tag Manager (noscript) -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-N958G54" height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- End Google Tag Manager (noscript) -->

    <!-- Rating Mail.ru counter -->
    <script type="text/javascript">
        var _tmr = window._tmr || (window._tmr = []);
        _tmr.push({id: "3141754", type: "pageView", start: (new Date()).getTime(), pid: "USER_ID"});
        (function (d, w, id) {
            if (d.getElementById(id)) return;
            var ts = d.createElement("script"); ts.type = "text/javascript"; ts.async = true; ts.id = id;
            ts.src = "https://top-fwz1.mail.ru/js/code.js";
            var f = function () {var s = d.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ts, s);};
            if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); }
        })(document, window, "topmailru-code");
    </script>
    <noscript>
        <div>
            <img src="https://top-fwz1.mail.ru/counter?id=3141754;js=na" style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru" />
        </div>
    </noscript>
    <!-- //Rating Mail.ru counter -->

    <!-- Rating@Mail.ru counter dynamic remarketing appendix -->
    <script type="text/javascript">
        var _tmr = _tmr || [];
        _tmr.push({
            type: 'itemView',
            productid: 'VALUE',
            pagetype: 'VALUE',
            list: 'VALUE',
            totalvalue: 'VALUE'
        });
    </script>
    <!-- // Rating@Mail.ru counter dynamic remarketing appendix -->

</head>
<?$APPLICATION->ShowPanel();?>
<body>

    <header>
        <div class="wrapper">

            <div class="header__block__h_001">
                <div class="geo__position">
                    <ul class="geo_wrapper">
                        <?$APPLICATION->IncludeComponent(
                            "dresscode:sale.geo.positiion",
                            "",
                            array(),
                            false,
                            array(
                                "ACTIVE_COMPONENT" => "Y"
                            )
                        );?>
                    </ul>
                </div>
                <div class="top__menu">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top_right",
                        array(
                            "ALLOW_MULTI_SELECT" => "N",
                            "CHILD_MENU_TYPE" => "",
                            "DELAY" => "N",
                            "MAX_LEVEL" => "1",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MENU_CACHE_TIME" => "3600",
                            "MENU_CACHE_TYPE" => "Y",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "ROOT_MENU_TYPE" => "top_new",
                            "USE_EXT" => "N",
                            "COMPONENT_TEMPLATE" => "top_right"
                        ),
                        false
                    ); ?>
                </div>
                <div class="consult__header">
                    <a href="/installment/"  class="take__consult" data-id="6">Беспроцентная рассрочка</a>
                </div>
                <div class="header__personal">
                    <a href="/personal/" class="personal__link">Мой кабинет</a>
                </div>
            </div>

            <div class="header__block__h_002">
                <div class="logo__header">
                    <? if ($APPLICATION->GetCurPage(true) == '/index.php'): ?>
                    <img src="<?=SITE_TEMPLATE_PATH;?>/img/logo.svg" alt="Эксклюзивный дистрибьютор мировых производителей массажного оборудования"/>
                    <? else: ?>
                    <a href="<?=SITE_DIR;?>" title="Эксклюзивный дистрибьютор мировых производителей массажного оборудования">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/img/logo.svg" alt=""/>
                    </a>
                    <? endif; ?>
                </div>
                <div class="txt__header__001"><a href="https://www.relaxa.ru/about/">Эксклюзивный дистрибьютор<br> мировых производителей<br> массажного оборудования</a></div>
                <div class="phones__header">
                    <div class="s__phone__header">
                        <span class="phone__icon__header">
                            <img src="<?=SITE_TEMPLATE_PATH?>/images/ND/phone__header__icon.svg">
                        </span>
                        <a href="tel:88003330051" class="phone__link__header">8 (800) 333 00 51</a>
                    </div>
                    <div class="s__phone__header"><span class="phone__icon__header">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/ND/phone__header__icon.svg"></span>
                        <a href="tel:84957899174" class="phone__link__header">8 (495) 789 91 74</a>
                    </div>
                    <div class="txt__phone__header">Бесплатный звонок по России</div>
                </div>
                <div class="favs__header">
                    <a class="compare white-listing" href="/compare/">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/scales.svg" />
                    </a>
                    <a href="/wishlist/">
                        <img src="<?=SITE_TEMPLATE_PATH?>/images/ND/favs__header__icon.svg">
                    </a>
                </div>
                <div class="basket__header">
                    <div id="flushTopCart">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.line",
                            "topCart5",
                            array(
                                "HIDE_ON_BASKET_PAGES" => "N",
                                "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                                "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                                "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                                "PATH_TO_REGISTER" => SITE_DIR . "login/",
                                "POSITION_FIXED" => "N",
                                "SHOW_AUTHOR" => "N",
                                "SHOW_EMPTY_VALUES" => "Y",
                                "SHOW_NUM_PRODUCTS" => "Y",
                                "SHOW_PERSONAL_LINK" => "N",
                                "SHOW_PRODUCTS" => "Y",
                                "SHOW_TOTAL_PRICE" => "Y",
                                "COMPONENT_TEMPLATE" => "topCart5",
                                "SHOW_DELAY" => "N",
                                "SHOW_NOTAVAIL" => "N",
                                "SHOW_SUBSCRIBE" => "N",
                                "SHOW_IMAGE" => "Y",
                                "SHOW_PRICE" => "Y",
                                "SHOW_SUMMARY" => "Y"
                            ),
                            false
                        ); ?>
                    </div>
                </div>
            </div>
        </div>

        <?
        if (CModule::IncludeModule("sale")) {
            $arBasketItems = array();
            $dbBasketItems = CSaleBasket::GetList(
                array("NAME" => "ASC", "ID" => "ASC"),
                array("FUSER_ID" => CSaleBasket::GetBasketUserID(), "LID" => SITE_ID, "ORDER_ID" => "NULL"),
                false,
                false,
                array("ID", "MODULE", "PRODUCT_ID", "QUANTITY", "CAN_BUY", "PRICE"));
            while ($arItems = $dbBasketItems->Fetch()) {
                $arItems = CSaleBasket::GetByID($arItems["ID"]);
                $arBasketItems[] = $arItems;
                $cart_num += $arItems['QUANTITY'];
                $cart_sum += $arItems['PRICE'] * $arItems['QUANTITY'];
            }
            if (empty($cart_num))
                $cart_num = "0";
            if (empty($cart_sum))
                $cart_sum = "0";
            ?>
            <!--В вашей корзине  <?= $cart_num ?> товаров.На сумму <?= $cart_sum ?> рублей -->
            <?
        }
        ?>

        <div class="adaptive__header">
            <div class="wrapper">
                <div class="adaptive__menu">
                    <div class="menu__adaptive__icon">
                        <span class="mai001"></span>
                        <span class="mai002"></span>
                        <span class="mai003"></span>
                    </div>
                    <div class="menu__adaptive__menu">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:menu",
                            "relaxa-middle",
                            array(
                                "ALLOW_MULTI_SELECT" => "N",
                                "CHILD_MENU_TYPE" => "left",
                                "COMPONENT_TEMPLATE" => "relaxa-middle",
                                "DELAY" => "N",
                                "MAX_LEVEL" => "2",
                                "MENU_CACHE_GET_VARS" => array(),
                                "MENU_CACHE_TIME" => "3600",
                                "MENU_CACHE_TYPE" => "A",
                                "MENU_CACHE_USE_GROUPS" => "Y",
                                "ROOT_MENU_TYPE" => "middle_new",
                                "USE_EXT" => "Y",
                                "MENU_THEME" => "site"
                            ),
                            false
                        ); ?>
                    </div>
                </div>

                <div class="logo__adaptive">
                    <? if ($APPLICATION->GetCurPage(true) == '/index.php'): ?>
                        <img
                            src="<?=SITE_TEMPLATE_PATH;?>/img/logo.png"
                            alt="Интернет-магазин массажных кресел и массажеров в Москве - Relaxa"
                        />
                    <? else: ?>
                        <a href="<?=SITE_DIR;?>" title="Интернет-магазин массажных кресел и массажеров в Москве - Relaxa">
                            <img
                                src="<?=SITE_TEMPLATE_PATH;?>/img/logo.png"
                                alt="Интернет-магазин массажных кресел и массажеров в Москве - Relaxa"
                            />
                        </a>
                    <? endif; ?>
                </div>

                <div class="favs__adaptive">
                    <a href="/index.php/"><img src="<?=SITE_TEMPLATE_PATH;?>/images/ND/home.svg"></a>
                </div>

                <div class="basket__adaptive">
                    <div id="flushTopCart">
                        <? $APPLICATION->IncludeComponent(
                            "bitrix:sale.basket.basket.line",
                            "topCart5",
                            array(
                                "HIDE_ON_BASKET_PAGES" => "N",
                                "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                                "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                                "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                                "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                                "PATH_TO_REGISTER" => SITE_DIR . "login/",
                                "POSITION_FIXED" => "N",
                                "SHOW_AUTHOR" => "N",
                                "SHOW_EMPTY_VALUES" => "Y",
                                "SHOW_NUM_PRODUCTS" => "Y",
                                "SHOW_PERSONAL_LINK" => "N",
                                "SHOW_PRODUCTS" => "Y",
                                "SHOW_TOTAL_PRICE" => "Y",
                                "COMPONENT_TEMPLATE" => "topCart",
                                "SHOW_DELAY" => "N",
                                "SHOW_NOTAVAIL" => "N",
                                "SHOW_SUBSCRIBE" => "N",
                                "SHOW_IMAGE" => "Y",
                                "SHOW_PRICE" => "Y",
                                "SHOW_SUMMARY" => "Y"
                            ),
                            false
                        ); ?>
                    </div>
                </div>

                <div class="search-adaptive-button">
                    <img src="<?=SITE_TEMPLATE_PATH;?>/images/ND/search.svg" alt="">
                </div>

                <div class="search-container">
                    <form id="search-form-mobile" action="/search/" method="GET">
                        <input type="text" name="q" class="search-input" placeholder="Поиск по каталогу">
                        <div class="search-button-mobile">
                            <img src="<?=SITE_TEMPLATE_PATH;?>/images/ND/search.svg" alt="">
                        </div>
                    </form>
                </div>

                <script>
                    $(function(){
                        $('.search-adaptive-button').click(function(){
                            $('.search-container').slideToggle();
                        });
                        $('.search-button-mobile').click(function(){
                            $(this).parent('form').submit();
                        });
                    });
                </script>


                <div class="login__adaptive">
                    <a href="/personal/"><img src="<?=SITE_TEMPLATE_PATH;?>/images/ND/login.svg" alt=""></a>
                </div>

            </div>

    </header>

<div class="catmob-header">
    <ul class="catmob__list">
        <li class="catmob__item catmob__item-home">
            <a href="#" class="catmob__link catmob__menu">
                <svg width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect y="0.706787" width="26" height="2.94828" rx="1.47414" fill="#0A5A77"></rect>
                    <rect y="9.55176" width="26" height="2.94828" rx="1.47414" fill="#0A5A77"></rect>
                    <rect y="18.3965" width="26" height="2.94828" rx="1.47414" fill="#0A5A77"></rect>
                </svg>
            </a>
            <div class="menu__adaptive__menu" style="display: none;">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:menu",
                    "relaxa-middle",
                    array(
                        "ALLOW_MULTI_SELECT" => "N",
                        "CHILD_MENU_TYPE" => "left",
                        "COMPONENT_TEMPLATE" => "relaxa-middle",
                        "DELAY" => "N",
                        "MAX_LEVEL" => "2",
                        "MENU_CACHE_GET_VARS" => array(),
                        "MENU_CACHE_TIME" => "3600",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "ROOT_MENU_TYPE" => "middle_new",
                        "USE_EXT" => "Y",
                        "MENU_THEME" => "site"
                    ),
                    false
                ); ?>
            </div>
        </li>
        <li class="catmob__item">
            <a href="/" class="catmob__link catmob__home">
                <svg width="31" height="27" viewBox="0 0 31 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0)">
                        <path d="M29.0024 12.9792C28.8024 12.9792 28.6024 12.9792 28.4024 12.7792L15.0024 3.17917L1.60241 12.7792C1.00241 12.9792 0.402409 12.9792 0.202409 12.3792C-0.197591 11.9792 0.00240898 11.5792 0.402409 11.1792L14.4024 1.17917C14.6024 0.979175 15.2024 0.979175 15.6024 1.17917L29.6024 11.1792C30.0024 11.5792 30.0024 12.1792 29.8024 12.5792C29.6024 12.7792 29.2024 12.9792 29.0024 12.9792Z" fill="#101820"></path>
                        <path d="M4.00244 6.97913C3.40244 6.97913 3.00244 6.57913 3.00244 5.97913V1.97913C3.00244 1.37913 3.40244 0.979126 4.00244 0.979126H8.00244C8.60244 0.979126 9.00244 1.37913 9.00244 1.97913C9.00244 2.57913 8.40244 2.97913 8.00244 2.97913H5.00244V5.97913C5.00244 6.57913 4.40244 6.97913 4.00244 6.97913Z" fill="#101820"></path>
                        <path d="M24.0024 26.9791H19.0024C18.4024 26.9791 18.0024 26.5791 18.0024 25.9791V18.9791H12.0024V25.9791C12.0024 26.5791 11.4024 26.9791 11.0024 26.9791H6.00244C4.40244 26.9791 3.00244 25.5791 3.00244 23.9791V13.9791C3.00244 13.3791 3.40244 12.9791 4.00244 12.9791C4.60244 12.9791 5.00244 13.3791 5.00244 13.9791V23.9791C5.00244 24.5791 5.40244 24.9791 6.00244 24.9791H10.0024V17.9791C10.0024 17.3791 10.4024 16.9791 11.0024 16.9791H19.0024C19.4024 16.9791 20.0024 17.3791 20.0024 17.9791V24.9791H24.0024C24.6024 24.9791 25.0024 24.5791 25.0024 23.9791V13.9791C25.0024 13.3791 25.4024 12.9791 26.0024 12.9791C26.6024 12.9791 27.0024 13.3791 27.0024 13.9791V23.9791C27.0024 25.5791 25.6024 26.9791 24.0024 26.9791Z" fill="#101820"></path>
                    </g>
                    <defs>
                        <clipPath id="clip0">
                            <rect x="0.00244141" y="0.979126" width="30" height="26" fill="white"></rect>
                        </clipPath>
                    </defs>
                </svg>
            </a>
        </li>
        <li class="catmob__item">
            <a href="/personal/cart/" class="catmob__link catmob__basket">
                <span class="catmob__basket-count">0</span>
                <svg width="33" height="29" viewBox="0 0 33 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.60244 18.2791C9.10244 18.2791 8.60244 17.9791 8.50244 17.3791L6.00244 4.87914C5.70244 3.37914 4.40244 2.27914 2.90244 2.27914H1.10244C0.502441 2.27914 0.00244141 1.87914 0.00244141 1.27914C0.00244141 0.679138 0.502441 0.179138 1.10244 0.179138H2.90244C5.40244 0.179138 7.60244 1.97914 8.10244 4.47914L10.6024 17.0791C10.7024 17.6791 10.4024 18.1791 9.80244 18.3791H9.60244V18.2791Z" fill="#101820"></path>
                    <path d="M10.7025 25.7792H8.70249C6.30249 25.7792 4.30249 23.7792 4.30249 21.3792C4.30249 19.0792 6.00249 17.2792 8.30249 16.9792L27.9025 15.1792L29.6025 6.57915H7.50249C6.90249 6.57915 6.40249 6.07915 6.40249 5.47915C6.40249 4.87915 6.90249 4.37915 7.50249 4.37915H31.0025C31.3025 4.37915 31.6025 4.47915 31.8025 4.77915C31.9025 5.07915 32.0025 5.37915 32.0025 5.77915L29.9025 16.4792C29.8025 16.9792 29.4025 17.2792 29.0025 17.3792L8.50249 19.0792C7.20249 19.1792 6.30249 20.1792 6.30249 21.4792C6.30249 22.7792 7.40249 23.6792 8.70249 23.6792H10.7025C11.3025 23.6792 11.8025 24.1791 11.8025 24.7792C11.7025 25.2792 11.3025 25.7792 10.7025 25.7792Z" fill="#101820"></path>
                    <path d="M26.7023 28.9792C24.3023 28.9792 22.4023 27.0792 22.4023 24.6792C22.4023 22.2792 24.3023 20.3792 26.7023 20.3792C29.1023 20.3792 31.0023 22.2792 31.0023 24.6792C31.0023 27.0792 29.0023 28.9792 26.7023 28.9792ZM26.7023 22.5792C25.5023 22.5792 24.6023 23.5792 24.6023 24.6792C24.6023 25.8792 25.6023 26.7792 26.7023 26.7792C27.9023 26.7792 28.8023 25.7792 28.8023 24.6792C28.8023 23.5792 27.8023 22.5792 26.7023 22.5792Z" fill="#101820"></path>
                    <path d="M13.9025 28.9792C11.5025 28.9792 9.60254 27.0792 9.60254 24.6792C9.60254 22.2792 11.5025 20.3792 13.9025 20.3792C16.3025 20.3792 18.2025 22.2792 18.2025 24.6792C18.2025 27.0792 16.2025 28.9792 13.9025 28.9792ZM13.9025 22.5792C12.7025 22.5792 11.8025 23.5792 11.8025 24.6792C11.8025 25.8792 12.8025 26.7792 13.9025 26.7792C15.0025 26.7792 16.0025 25.7792 16.0025 24.6792C16.0025 23.5792 15.0025 22.5792 13.9025 22.5792Z" fill="#101820"></path>
                    <path d="M23.5024 25.7792H17.1024C16.5024 25.7792 16.0024 25.2792 16.0024 24.6792C16.0024 24.0792 16.5024 23.5792 17.1024 23.5792H23.5024C24.1024 23.5792 24.6024 24.0792 24.6024 24.6792C24.5024 25.2792 24.0024 25.7792 23.5024 25.7792Z" fill="#101820"></path>
                </svg>
            </a>
        </li>
        <li class="catmob__item">
            <a href="#" class="catmob__link catmob__search">
                <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.0024 22.9791C5.50244 22.9791 1.00244 18.4791 1.00244 12.9791C1.00244 7.47913 5.50244 2.97913 11.0024 2.97913C16.5024 2.97913 21.0024 7.47913 21.0024 12.9791C21.0024 18.4791 16.5024 22.9791 11.0024 22.9791ZM11.0024 4.97913C6.60244 4.97913 3.00244 8.57913 3.00244 12.9791C3.00244 17.3791 6.60244 20.9791 11.0024 20.9791C15.4024 20.9791 19.0024 17.3791 19.0024 12.9791C19.0024 8.57913 15.4024 4.97913 11.0024 4.97913Z" fill="#101820"></path>
                    <path d="M28.0024 30.6792C27.3024 30.6792 26.6024 30.4792 26.1024 29.9792L20.0024 24.8792C18.7024 23.7792 18.6024 21.8792 19.6024 20.6792C20.7024 19.3792 22.6024 19.2792 23.8024 20.2792L29.9024 25.3792C31.2024 26.4792 31.3024 28.3792 30.3024 29.5792C29.7024 30.2792 28.9024 30.6792 28.0024 30.6792ZM21.9024 21.5792C21.3024 21.5792 20.9024 22.0792 20.9024 22.6792C20.9024 22.9792 21.1024 23.1792 21.3024 23.3792L27.4024 28.4792C27.8024 28.8792 28.5024 28.7792 28.8024 28.3792C29.0024 28.1792 29.1024 27.8792 29.0024 27.6792C29.0024 27.3792 28.8024 27.1792 28.6024 26.9792L22.5024 21.8792C22.3024 21.6792 22.1024 21.5792 21.9024 21.5792Z" fill="#101820"></path>
                    <path d="M20.0023 21.9791C19.8023 21.9791 19.5023 21.8791 19.4023 21.7791L17.0023 19.7791C16.6023 19.3791 16.5023 18.7791 16.9023 18.3791C17.3023 17.9791 17.9023 17.8791 18.3023 18.2791L20.6023 20.2791C21.0023 20.6791 21.1023 21.2791 20.7023 21.6791C20.6023 21.8791 20.3023 21.9791 20.0023 21.9791Z" fill="#101820"></path>
                </svg>
            </a>
            <div class="search-container search-container-toggle" style="display: none;">
                <form id="search-form-mobile" action="/search/" method="GET">
                    <input type="text" name="q" class="search-input" placeholder="Поиск по каталогу">
                    <div class="search-button-mobile">
                        <img src="<?=SITE_TEMPLATE_PATH;?>/images/new/search.svg" alt="">
                    </div>
                </form>
            </div>
        </li>
    </ul>
    <a href="/personal/" class="catmob__profil">
        <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16.0024 17.9791C11.6024 17.9791 8.00244 14.3791 8.00244 9.97913C8.00244 5.57913 11.6024 1.97913 16.0024 1.97913C20.4024 1.97913 24.0024 5.57913 24.0024 9.97913C24.0024 14.3791 20.4024 17.9791 16.0024 17.9791ZM16.0024 3.97913C12.7024 3.97913 10.0024 6.67913 10.0024 9.97913C10.0024 13.2791 12.7024 15.9791 16.0024 15.9791C19.3024 15.9791 22.0024 13.2791 22.0024 9.97913C22.0024 6.67913 19.3024 3.97913 16.0024 3.97913Z" fill="#101820"></path>
            <path d="M23.0024 31.9791H9.00244C6.20244 31.9791 4.00244 29.7791 4.00244 26.9791V22.9791C4.00244 22.5791 4.20244 22.2791 4.50244 22.0791L9.50244 19.0791C10.0024 18.8791 10.6024 19.0791 10.8024 19.5791C11.0024 19.9791 10.9024 20.4791 10.5024 20.7791L6.00244 23.5791V26.9791C6.00244 28.6791 7.30244 29.9791 9.00244 29.9791H23.0024C24.7024 29.9791 26.0024 28.6791 26.0024 26.9791V23.5791L21.5024 20.8791C21.0024 20.5791 20.8024 19.9791 21.0024 19.4791C21.2024 18.9791 21.8024 18.7791 22.3024 18.9791C22.4024 18.9791 22.4024 19.0791 22.5024 19.0791L27.5024 22.0791C27.8024 22.2791 28.0024 22.5791 28.0024 22.9791V26.9791C28.0024 29.7791 25.8024 31.9791 23.0024 31.9791Z" fill="#101820"></path>
        </svg>
    </a>
</div>

<div class="new__catalog__menu">
    <div class="wrapper">
        <div class="new__cat__menu">
            <? $APPLICATION->IncludeComponent(
                "bitrix:menu",
                "relaxa-middle",
                array(
                    "ALLOW_MULTI_SELECT" => "N",
                    "CHILD_MENU_TYPE" => "left",
                    "COMPONENT_TEMPLATE" => "relaxa-middle",
                    "DELAY" => "N",
                    "MAX_LEVEL" => "2",
                    "MENU_CACHE_GET_VARS" => array(),
                    "MENU_CACHE_TIME" => "3600",
                    "MENU_CACHE_TYPE" => "A",
                    "MENU_CACHE_USE_GROUPS" => "Y",
                    "ROOT_MENU_TYPE" => "middle_new",
                    "USE_EXT" => "Y",
                    "MENU_THEME" => "site"
                ),
                false
            ); ?>
        </div>
        <div class="new__search">
            <form method="GET" action="/search/" class="search new__search__form">
                <input id="" type="text" name="q" placeholder="Поиск по каталогу" required>
                <button type="submit"><img src="<?= SITE_TEMPLATE_PATH ?>/images/ND/search__header__icon.svg" alt=""></button>
            </form>
        </div>
    </div>
</div>

<div class="page home<?if(CSite::InDir('/massazhnoe-oborudovanie/') || CSite::InDir('/zdorovie-krasota/') || CSite::InDir('/fitnes/') || CSite::InDir('/terapiya/') || CSite::InDir('/dom-dacha/') || CSite::InDir('/rasprodazha/') || CSite::InDir('/sale/')) {?> wp-catalog<?}?>">
    <? if ($APPLICATION->GetCurPage(true) == '/index.php'): ?>
        <div class="home_top_slider test">
            <div class="<?/*container*/?>">
                <? $APPLICATION->IncludeComponent(
                    "bitrix:news.list",
                    "slider_new",
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
                        "FILTER_NAME" => "",
                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                        "IBLOCK_ID" => "37",
                        "IBLOCK_TYPE" => "content",
                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                        "INCLUDE_SUBSECTIONS" => "N",
                        "MESSAGE_404" => "",
                        "NEWS_COUNT" => "20",
                        "PAGER_BASE_LINK_ENABLE" => "N",
                        "PAGER_DESC_NUMBERING" => "N",
                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                        "PAGER_SHOW_ALL" => "N",
                        "PAGER_SHOW_ALWAYS" => "N",
                        "PAGER_TEMPLATE" => ".default", // TODO: Шаблон иконок
                        "PAGER_TITLE" => "Новости",
                        "PARENT_SECTION" => "",
                        "PARENT_SECTION_CODE" => "",
                        "PREVIEW_TRUNCATE_LEN" => "",
                        "PROPERTY_CODE" => array(
                            0 => "LINK_MOBILE",
                            1 => "ATT_LINK",
                            2 => "",
                        ),
                        "SET_BROWSER_TITLE" => "N",
                        "SET_LAST_MODIFIED" => "N",
                        "SET_META_DESCRIPTION" => "N",
                        "SET_META_KEYWORDS" => "N",
                        "SET_STATUS_404" => "N",
                        "SET_TITLE" => "N",
                        "SHOW_404" => "N",
                        "SORT_BY1" => "SORT",
                        "SORT_BY2" => "NAME",
                        "SORT_ORDER1" => "ASC",
                        "SORT_ORDER2" => "ASC",
                        "STRICT_SECTION_CHECK" => "N",
                        "COMPONENT_TEMPLATE" => "slider_new",
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO"
                    ),
                    false
                ); ?>
            </div><!--  End container for slider  -->
        </div><!--  End home_top_slider  -->
    <? else: ?>
    <div class="container">
        <? endif; ?>

        <? if ($APPLICATION->GetCurPage(true) == '/index.php') {?>
            <style>
                .wrapper > .subr_menu {
                    display: none !important;
                }
            </style>
        <?}?>

        <? //require_once($_SERVER["DOCUMENT_ROOT"] . "/" . SITE_TEMPLATE_PATH . "/headers/" . $TEMPLATE_HEADER . "/template.php"); ?>

        <?$APPLICATION->IncludeComponent(
            "bitrix:breadcrumb",
            "new_llisting",
            array(
                "PATH" => "",
                "SITE_ID" => "s1",
                "START_FROM" => "0",
                "COMPONENT_TEMPLATE" => "new_llisting",
                "COMPOSITE_FRAME_MODE" => "A",
                "COMPOSITE_FRAME_TYPE" => "AUTO"
            ),
            false
        );?>
