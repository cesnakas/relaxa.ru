<? if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die(); ?>
</div>
<footer>

    <div id="footer">
        <div class="wrapper">

            <div class="footer__block__001">
                <div class="footer__logo"><a href="https://www.relaxa.ru/about/"><img src="<?=SITE_TEMPLATE_PATH?>/images/svg/logo.svg"></a></div>
                <div class="footer__sub__logo"><a href="https://www.relaxa.ru/about/">Эксклюзивный дистрибьютор<br>мировых производителей<br>массажного оборудования</a></div>
            </div>

            <div class="footer__block__002">
                <div class="footer__block__heading">Информация</div>
                <div class="footer__menu">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "relaxa-bottom",  array(
                        "ROOT_MENU_TYPE" => "info",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "CACHE_SELECTED_ITEMS" => "N",
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "COMPONENT_TEMPLATE" => "relaxa-bottom",
                        "CHILD_MENU_TYPE" => ""
                    ),
                        false
                    );?>
                </div>
            </div>

            <div class="footer__block__003">
                <div class="footer__block__heading">Покупателям</div>
                <div class="footer__menu">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "relaxa-bottom",  array(
                        "ROOT_MENU_TYPE" => "bayers",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "CACHE_SELECTED_ITEMS" => "N",
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "COMPONENT_TEMPLATE" => "relaxa-bottom",
                        "CHILD_MENU_TYPE" => ""
                    ),
                        false
                    );?>
                </div>
            </div>

            <div class="footer__block__004">
                <div class="footer__block__heading">Дополнительно</div>
                <div class="footer__menu">
                    <?$APPLICATION->IncludeComponent("bitrix:menu", "relaxa-bottom",  array(
                        "ROOT_MENU_TYPE" => "additional",
                        "MENU_CACHE_TYPE" => "A",
                        "MENU_CACHE_TIME" => "36000000",
                        "MENU_CACHE_USE_GROUPS" => "Y",
                        "MENU_CACHE_GET_VARS" => array(
                        ),
                        "CACHE_SELECTED_ITEMS" => "N",
                        "MAX_LEVEL" => "1",
                        "USE_EXT" => "N",
                        "DELAY" => "N",
                        "ALLOW_MULTI_SELECT" => "N",
                        "COMPONENT_TEMPLATE" => "relaxa-bottom",
                        "CHILD_MENU_TYPE" => ""
                    ),
                        false
                    );?>
                </div>
            </div>

            <div class="footer__block__005">
                <div class="footer__block__heading">Наши контакты</div>
                <div class="footer__contacts">
                    <div class="footer__phones">
                        <a href="tel:88003330051" class="footer__phone phone__icon"><string class="roistat-phone1">8 (800) 333 00 51</string></a>
                        <a href="tel:84957899174" class="footer__phone">8 (495) 789 91 74</a>
                    </div>
                    <div class="footer__socials">
                        <a href="https://vk.com/relaxamoscow" class="footer__socials__vk">
                            <img src="/bitrix/templates/dresscodeV2_new/images/social/vk.svg" alt="VK">
                        </a>
                        <a href="https://www.instagram.com/relaxastarmoscow/" class="footer__socials__youtube">
                            <img src="/bitrix/templates/dresscodeV2_new/images/social/instagram.svg" alt="instagram">
                        </a>
                        <a href="https://www.facebook.com/RelaxaStar" class="footer__socials__facebook">
                            <img src="/bitrix/templates/dresscodeV2_new/images/social/facebook.svg" alt="Facebook">
                        </a>
                        <a href="https://www.youtube.com/relaxastar" class="footer__socials__youtube">
                            <img src="/bitrix/templates/dresscodeV2_new/images/social/youtube.svg" alt="Youtube">
                        </a>
                        <a href="https://t.me/relaxaru" class="footer__socials__vk">
                            <img src="/bitrix/templates/dresscodeV2_new/images/social/telegram.svg" alt="Telegram">
                        </a>
                        <a href="https://ok.ru/group/56028015558860" class="footer__socials__vk">
                            <img src="/bitrix/templates/dresscodeV2_new/images/social/ok.svg" alt="Одноклассники">
                        </a>
                    </div>
                    <div class="footer__mails">
                        <a href="mailto:web@relaxa.ru" class="footer__mail mail__icon">web@relaxa.ru</a>
                    </div>
                </div>
                <div class="footer__adress">Люберцы, Колхозная улица, 19А</div>
                <div class="footer__adress">Москва, Лермонтовский проспект д. 23, ст. 1 (для навигаторов)</div>
            </div>

        </div>

    </div>
    <div id="subfooter">
        <div class="wrapper">
            <div class="copyright__footer">© <?=date('Y')?>, Интернет-магазин Relaxa Star, Москва</div>
        </div>
    </div>


</footer>

<div class="p-izgotov" id="izgotovnazakaz" style="display: none">

</div>

<script src="/verstka/scripts/jquery.maskedinput.js"></script>
<?if(!CSite::InDir('/index.php')) {?>
    <link rel="stylesheet" href="/assets/js/fancybox/jquery.fancybox.min.css">
    <script src="/assets/js/fancybox/jquery.fancybox.min.js"></script>
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="/assets/js/script.js"></script>
<?} else {?>
    <link rel="stylesheet" href="/assets/css/in-main.css">
    <script src="/assets/js/script.js"></script>
<?}?>

<script>
    $(document).ready(function() {
        if($(window).width() > 767) {
            $('.fb-modal').fancybox({
                touch : false,
                baseTpl:
                    '<div class="fancybox-container" role="dialog" tabindex="-1">' +
                    '<div class="fancybox-bg"></div>' +
                    '<div class="fancybox-inner">' +
                    '<div class="fancybox-infobar"><span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span></div>' +
                    '<div class="fancybox-toolbar">{{buttons}}</div>' +
                    '<div class="fancybox-navigation">{{arrows}}</div>' +
                    '<div class="fancybox-stage"></div>' +
                    '<div class="fancybox-caption"><div class=""fancybox-caption__body"></div></div>' +
                    '</div>' +
                    '</div>'
            });
        } else {
            $('.fb-modal').fancybox({
                touch : false,
                baseTpl:
                    '<div class="fancybox-container" role="dialog" tabindex="-1">' +
                    '<div class="fancybox-bg visible-bg"></div>' +
                    '<div class="fancybox-inner">' +
                    '<div class="fancybox-infobar"><span data-fancybox-index></span>&nbsp;/&nbsp;<span data-fancybox-count></span></div>' +
                    '<div class="fancybox-toolbar">{{buttons}}</div>' +
                    '<div class="fancybox-navigation">{{arrows}}</div>' +
                    '<div class="fancybox-stage"></div>' +
                    '<div class="fancybox-caption"><div class=""fancybox-caption__body"></div></div>' +
                    '</div>' +
                    '</div>'
            });
        }
        $('.fb-modal').on('click', function() {
            var tov = $(this).attr('data-id');
            $.ajax({
                type: 'POST',
                url: '/ajax/izgotovlenie_ajax.php',
                data: {PROD:tov},
                success: function (data) {
                    $('#izgotovnazakaz').html(data);
                }
            });
            return false;
        });
    });
</script>



<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "AREA_FILE_SHOW" => "sect",
        "AREA_FILE_SUFFIX" => "cart",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "AREA_FILE_SHOW" => "sect",
        "AREA_FILE_SUFFIX" => "fastbuy",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    array(
        "AREA_FILE_SHOW" => "sect",
        "AREA_FILE_SUFFIX" => "requestPrice",
        "AREA_FILE_RECURSIVE" => "Y",
        "EDIT_TEMPLATE" => ""
    ),
    false
);

if(preg_match("#PAGEN_\d=(\d*)#", $_SERVER['REQUEST_URI'], $matches)){
    $APPLICATION->SetPageProperty("description", $APPLICATION->GetPageProperty("description") . ". Страница " . $matches[1]);
    $APPLICATION->SetPageProperty("title", $APPLICATION->GetPageProperty("title") . ". Страница " . $matches[1]);
    $APPLICATION->SetTitle( $APPLICATION->GetTitle(false) . '. Страница ' . $matches[1]);
}

?>
<div id="upButton">
    <a href="#"></a>
</div>


<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "personal-discount",
    //"modal",
    Array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHAIN_ITEM_LINK" => "",
        "CHAIN_ITEM_TEXT" => "",
        "COMPONENT_TEMPLATE" => ".default",
        "EDIT_URL" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "LIST_URL" => "",
        "SEF_MODE" => "N",
        "SUCCESS_URL" => "",
        "USE_EXTENDED_ERRORS" => "Y",
        "VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
        "WEB_FORM_ID" => "4"
    )
);?>

<?$APPLICATION->IncludeComponent(
    "bitrix:form.result.new",
    "chair",
    //"modal",
    Array(
        "CACHE_TIME" => "3600",
        "CACHE_TYPE" => "A",
        "CHAIN_ITEM_LINK" => "",
        "CHAIN_ITEM_TEXT" => "",
        "COMPONENT_TEMPLATE" => ".default",
        "EDIT_URL" => "",
        "IGNORE_CUSTOM_TEMPLATE" => "N",
        "LIST_URL" => "",
        "SEF_MODE" => "N",
        "SUCCESS_URL" => "",
        "USE_EXTENDED_ERRORS" => "Y",
        "VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
        "WEB_FORM_ID" => "5"
    )
);?>


<?$APPLICATION->IncludeComponent("bitrix:form.result.new", "consult", array(
    "CACHE_TIME" => "3600",
    "CACHE_TYPE" => "A",
    "CHAIN_ITEM_LINK" => "",
    "CHAIN_ITEM_TEXT" => "",
    "COMPONENT_TEMPLATE" => ".default",
    "EDIT_URL" => "",
    "IGNORE_CUSTOM_TEMPLATE" => "N",
    "LIST_URL" => "",
    "SEF_MODE" => "N",
    "SUCCESS_URL" => "",
    "USE_EXTENDED_ERRORS" => "Y",
    "VARIABLE_ALIASES" => array(
        "WEB_FORM_ID" => "WEB_FORM_ID",
        "RESULT_ID" => "RESULT_ID",
    ),
    "WEB_FORM_ID" => "6"
),
    false,
    array(
        "ACTIVE_COMPONENT" => "N"
    )
);?>
<!-- WebIt.Activity -->
<script type="text/javascript" src="https://relaxa.ru/bitrix/templates/dresscodeV2/js/jquery-site.activity.js"></script>
<script type="text/javascript">
    $("body").activity({
        "achieveTime":60
        ,"testPeriod":10
        ,useMultiMode: 1
        ,loop:1 //
        ,callBack: function (e) {
            //yaCounter13260706.reachGoal('activ_60');
            //gtag('event', 'activ_60', { 'event_category': 'activ_60', 'event_action': 'done', });
            console.log('activ_60 success');
        }
    });
</script>
<!-- /WebIt.Activity -->
<!--ND-->
<link rel="stylesheet" href="https://cdn.envybox.io/widget/cbk.css">
<script type="text/javascript" src="https://cdn.envybox.io/widget/cbk.js?wcb_code=3a1f831bba41e1916d522cf8c2efba9c" charset="UTF-8" async></script>
<!--/ND-->
<?if($APPLICATION->GetCurPage(/*false*/) == "/"):?><?else:?>
<?if($_COOKIE['roulette'] == 'Y' || $_SESSION['roulette'] == 'Y')://if(isset($_COOKIE['roulette']) || isset($_SESSION['roulette'])):?>
<?else:?>
<link rel="stylesheet" href="/bitrix/templates/dresscodeV2/rouletbutton.css">
<style>
    svg {
        width: 75%;
        margin: 0 12.5%;
    }

    .circ0 {
        fill: black;
        stroke: #655;
        stroke-width: 5;
        stroke-dasharray: 0;
    }

    .circ1 {
        fill: none;
        stroke: white;
        stroke-width: 10;
    }

    .circ2 {
        fill: none;
        stroke: red;
        stroke-width: 10;
        stroke-dasharray: 8.5;
    }

    .circ3 {
        fill: none;
        stroke: white;
        stroke-width: 60;
        stroke-dasharray: 5 380;
        opacity: 0.2;
        transform: rotate(-45deg);
        transform-origin: 50% 50%;
    }

    .circ4 {
        fill: gray;
        stroke: #deedee;
        stroke-width: 2;
    }

    .circ5 {
        fill: none;
        stroke: #deedee;
        stroke-width: 2;
    }

    .circ6 {
        fill: none;
        stroke: gold;
        stroke-width: 2;
        stroke-dasharray: 2 8;
        stroke-linecap: round;
    }

    .circ7 {
        fill: none;
        stroke: yellow;
        stroke-width: 1;
    }

    .circ8 {
        fill: none;
        stroke: red;
        stroke-width: 30;
        stroke-dasharray: 63 63;
    }

    .circ9 {
        fill: none;
        stroke: white;
        stroke-dasharray: 1;
        stroke-width: .5;
    }

    .circ10 {
        fill: none;
        stroke: white;
        stroke-dasharray: 1 7.5;
        stroke-width: 11;
    }

    .animateRouletteRotate {
        animation-duration: 10s;
        animation-iteration-count: infinite;
        animation-timing-function: ease-out;
        animation-name: rouletteRotate;
    }

    @keyframes rouletteRotate {
        0% {}
        60% {
            stroke-dashoffset: 900;
        }
        100% {
            stroke-dashoffset: 900;
        }
    }

    @keyframes rouletteFlash {
        0% {}
        100% {
            opacity: 0.2;
        }
    }
    .roulette-form{
        margin-top: 0px;
    }
    .ws-quiz-container {
        position: fixed;
    }

    @media screen and (max-width: 767px) {
        .mobilehide {
            display: none !important;
        }
    }
</style>

<script>
    $(document).ready(function() {
        $('.ws-quiz-container').on('click', function() {
            document.getElementsByClassName('roulette-modal')[0].classList.add('roulette-modal_active');
            document.getElementsByClassName('roulette-modal')[0].style.display = 'block';
        });
    });
</script>

<div class="roulette-modal <?if(isset($_GET['newyear-roulette'])):?>roulette-modal_active<?endif?> mobilehide" style="display:<?if(isset($_GET['newyear-roulette'])):?>block<?else:?>none<?endif?>">
    <?php $APPLICATION->includeFile('/local/forms/roulette/form.php', ['theme' => 'default']); ?>
</div>

<div class="ws-quiz-container mobilehide" id="labellabel" <?/*onclick="document.getElementsByClassName('roulette-modal')[0].classList.add('roulette-modal_active'); document.getElementsByClassName('roulette-modal')[0].style.display = 'block'"*/?>>
    <div class="ws-quiz-btn-el-container envy-not-scalling" style="right: -92px; left: auto; top: 318.03px; bottom: auto;">
        <div class="ws-quiz-btn-container ws-quiz-btn-mini-hover quiz-animation-iridescent quiz-corner-smooth ws-quiz-btn-rotate ws-quiz-btn-attach ws-quiz-btn-logo-yes" style="transform: rotate(-270deg); background: #0CA307;">
            <div class="ws-btn-ico">
                <div id="changeText" class="ws-btn-title">ИСПЫТАЙ УДАЧУ</div>
                <div class="ws-quiz-logo">
                    <svg viewBox="0 0 200 200" style="enable-background:new 0 0 200 200;" xml:space="preserve">
						<circle class="circ0" cx="100" cy="100" r="95"/>
                        <circle class="circ1" cx="100" cy="100" r="75"/>
                        <circle class="circ7" cx="100" cy="100" r="59"/>
                        <circle class="circ8 animateRouletteRotate" cx="100" cy="100" r="40"/>
                        <circle class="circ9 animateRouletteRotate" cx="100" cy="100" r="40"/>
                        <circle class="circ5" cx="100" cy="100" r="75"/>
                        <circle class="circ6" cx="100" cy="100" r="75"/>
                        <circle class="circ2 animateRouletteRotate" cx="100" cy="100" r="65"/>
                        <circle class="circ10 animateRouletteRotate" cx="100" cy="100" r="65"/>
                        <circle class="circ3" cx="100" cy="100" r="40"/>
                        <circle class="circ4 " cx="100" cy="100" r="10"/>
					</svg>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        var text = ["СЫГРАЙ В ИГРУ", "ВЫИГРАЙ СКИДКУ", "ИСПЫТАЙ УДАЧУ", "ВЫИГРАЙ БОНУС"];
        var counter = 0;
        var elem = document.getElementById("changeText");
        setInterval(change, 3000);

        function change() {
            elem.innerHTML = text[counter];
            counter++;
            if (counter >= text.length) {
                counter = 0;
            }
        }
    </script>
    <?php endif; ?><?php endif; ?>


    <script type="text/javascript">
        var ajaxPath = "<?=SITE_DIR?>ajax.php";
        var SITE_DIR = "<?=SITE_DIR?>";
        var SITE_ID  = "<?=SITE_ID?>";
        var TEMPLATE_PATH = "<?=SITE_TEMPLATE_PATH?>";
    </script>

    <script type="text/javascript">
        var LANG = {
            BASKET_ADDED: "<?=GetMessage("BASKET_ADDED")?>",
            WISHLIST_ADDED: "<?=GetMessage("WISHLIST_ADDED")?>",
            ADD_COMPARE_ADDED: "<?=GetMessage("ADD_COMPARE_ADDED")?>",
            ADD_CART_LOADING: "<?=GetMessage("ADD_CART_LOADING")?>",
            ADD_BASKET_DEFAULT_LABEL: "<?=GetMessage("ADD_BASKET_DEFAULT_LABEL")?>",
            ADDED_CART_SMALL: "<?=GetMessage("ADDED_CART_SMALL")?>",
            CATALOG_AVAILABLE: "<?=GetMessage("CATALOG_AVAILABLE")?>",
            CATALOG_ON_ORDER: "<?=GetMessage("CATALOG_ON_ORDER")?>",
            CATALOG_NO_AVAILABLE: "<?=GetMessage("CATALOG_NO_AVAILABLE")?>",
            FAST_VIEW_PRODUCT_LABEL: "<?=GetMessage("FAST_VIEW_PRODUCT_LABEL")?>",
            REQUEST_PRICE_LABEL: "<?=GetMessage("REQUEST_PRICE_LABEL")?>",
            REQUEST_PRICE_BUTTON_LABEL: "<?=GetMessage("REQUEST_PRICE_BUTTON_LABEL")?>"
        };
    </script>

    <!-- ROISTAT -->
    <script>
        (function(w, d, s, h, id) {
            w.roistatProjectId = id; w.roistatHost = h;
            var p = d.location.protocol == "https:" ? "https://" : "http://";
            var u = /^.*roistat_visit=[^;]+(.*)?$/.test(d.cookie) ? "/dist/module.js" : "/api/site/1.0/"+id+"/init";
            var js = d.createElement(s); js.charset="UTF-8"; js.async = 1; js.src = p+h+u; var js2 = d.getElementsByTagName(s)[0]; js2.parentNode.insertBefore(js, js2);
        })(window, document, 'script', 'cloud.roistat.com', '2b69848e2e73097cae972600754d2bd5');
    </script>
    <!-- END ROISTAT -->
    <?if($APPLICATION->GetCurPage()=="/personal/" || $APPLICATION->GetCurPage()=="/personal/order/" || $APPLICATION->GetCurPage()=="/personal/profile/" || $APPLICATION->GetCurPage()=="/auth/"):?>
        <script src="/verstka/scripts/jquery.maskedinput.js"></script>
    <?endif?>
    <style>
        #smartFilter input[type="checkbox"]:checked + label:after, #smartFilter input[type="radio"]:checked + label:after {
            top: 5px !important;
            margin-top: 0 !important;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.ui.touch-punch.min.js"></script>

    <script>
        $(document).ready(function() {

            function hidedr() {
                setTimeout(function() {
                    $('#modef').hide();
                }, 2000);
            }
            function showdr() {
                setTimeout(function() {
                    $('#modef').show();
                }, 500);
            }

            $('.paramsBox .checkbox input[type="checkbox"]').change(function() {
                var arrProps = [];
                var filter = $('#smartFilterForm').serialize();
                var arFilter = filter.split('&');
                $.each(arFilter, function(index, value){
                    var arFilter = value.split('=');
                    arrProps[arFilter[0]] = arFilter[1];
                });

                if(Object.keys(arrProps).length == 3 && typeof arrProps['clear_cache'] !== "undefined" && typeof arrProps['arrFilter_1423_MIN'] !== "undefined" && typeof arrProps['arrFilter_1423_MAX'] !== "undefined") {
                    hidedr();
                } else if(Object.keys(arrProps).length == 2 && typeof arrProps['arrFilter_1423_MIN'] !== "undefined" && typeof arrProps['arrFilter_1423_MAX'] !== "undefined") {
                    hidedr();
                } else {
                    showdr();
                }

            });
        });
    </script>
    </body>
    </html>
