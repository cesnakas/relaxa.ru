<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();
use Bitrix\Main\Page\Asset;
?>
<!DOCTYPE html>
<html lang="<?=LANGUAGE_ID;?>">
<head>

    <?
    $APPLICATION->ShowHead();
    // Meta
    Asset::getInstance()->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>');
    Asset::getInstance()->addString('<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=0">');
    // Verification
    Asset::getInstance()->addString('<meta name="yandex-verification" content="3033d92eeb622c11"/>');
    Asset::getInstance()->addString('<meta name="google-site-verification" content="G_xceoRt5jBf57eMCLA-y-oXx1O16ntd91Nl1O_7ukA"/>');
    Asset::getInstance()->addString('<meta name="verify-admitad" content="214d5a6c15"/>');
    // Fonts
    Asset::getInstance()->addCss('https://fonts.googleapis.com/css?family=Montserrat:400,700&amp;subset=cyrillic'); // TODO: переместить шрифт в css-стили
    // JQuery
    Asset::getInstance()->addJs('https://code.jquery.com/jquery-3.5.1.min.js');
    // CSS
    // JS
    ?>

    <title><?$APPLICATION->ShowTitle();?></title>

    <link rel="icon" href="/favicon.ico" type="image/x-icon"/>

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
    <script data-skip-moving='true'>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-N958G54');</script>
    <!-- End Google Tag Manager -->

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
    <noscript><div><img src="https://top-fwz1.mail.ru/counter?id=3141754;js=na" style="border:0;position:absolute;left:-9999px;" alt="Top.Mail.Ru" /></div></noscript>
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

