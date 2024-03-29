<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$this->setFrameMode(true);
$propertyCounter = 0;
$morePhotoCounter = 0;
$countPropertyElements = 7;
global $USER;
$arGroups = CUser::GetUserGroup($USER->GetID());
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
?>
<?
$this->AddEditAction($arResult["ID"], $arResult["EDIT_LINK"], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_EDIT"));
$this->AddDeleteAction($arResult["ID"], $arResult["DELETE_LINK"], CIBlock::GetArrayByID($arResult["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
?>

<script type="text/javascript" src="/bitrix/templates/dresscodeV2_new/js/jquery.js"></script>
<script type="text/javascript" src="/bitrix/templates/dresscodeV2_new/js/slick.min.js"></script>
<link rel="stylesheet" href="/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.min.css">
<script type="text/javascript" src="/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.min.js"></script>
<script src="/bitrix/templates/dresscodeV2/components/bitrix/catalog/.default/bitrix/catalog.element/element_with_tabs_new/js/maskinput.js"></script>
<script src="/bitrix/templates/dresscodeV2/components/bitrix/catalog/.default/bitrix/catalog.element/element_with_tabs_new/js/ajax.js"></script>

<script>
    /* Новые скрипты для карточки */
    $(document).ready(function() {
        $('.p-cardslider__big').slick({
            dots: false,
            infinite: true,
            arrows: false,
            slidesToShow: 1,
            fade: true,
            adaptiveHeight: false,
            asNavFor: '.p-cardslider__lite',
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        fade: false,
                        arrows: true,
                        dots: true
                    }
                }
            ]
        });
        $('.p-cardslider__lite').slick({
            slidesToShow: 4,
            slidesToScroll: 1,
            dots: false,
            arrows: true,
            centerMode: false,
            focusOnSelect: true,
            asNavFor: '.p-cardslider__big',
            vertical: true,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.p-prods__slider').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            infinite: false,
            dots: false,
            arrows: true,
            centerMode: false,
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ]
        });

        $('.fb-img-popup').fancybox();
        $('.fb-modal').fancybox();


        $('.p-sort__active').on('click', function() {
            $(this).toggleClass('active');
            $(this).parent('.p-sort').children('.p-sort__toggle').slideToggle(200);
        });

        $('.p-raitingbox__count').on('click', function() {
            $('.p-tabs__item-rev').trigger('click');
            var elementClick = $(this).attr("href");
            var destination = $(elementClick).offset().top;
            jQuery("html:not(:animated),body:not(:animated)").animate({
                scrollTop: destination
            }, 800);
            return false;
        });

        $('.p-cardheader__link-menu').on('click', function() {
            $(this).parent().children('.menu__adaptive__menu').toggle();
            return false;
        });
        $('.p-tabs__op').show();
        $('.p-tabs__item').on('click', function() {
            $('.p-tabs__item').removeClass('active');
            $(this).addClass('active');
            if($(this).hasClass('p-tabs__item-op')) {
                $('.p-tabs__content > div').hide();
                $('.p-tabs__op').show();
            } else if($(this).hasClass('p-tabs__item-pod')) {
                $('.p-tabs__content > div').hide();
                $('.p-tabs__pod').show();
            } else if($(this).hasClass('p-tabs__item-har')) {
                $('.p-tabs__content > div').hide();
                $('.p-tabs__har').show();
            } else if($(this).hasClass('p-tabs__item-rev')) {
                $('.p-tabs__content > div').hide();
                $('.p-tabs__rev').show();
            } else {
                alert('Что то пошло не так');
            }
        });
    });
</script>
<?
global $actualLink;
$actualLink = "/";
$arPth = explode("/", $APPLICATION->GetCurPage());
$arPthFilter = array_filter($arPth);
$arPthActual = array_pop($arPthFilter);
foreach($arPthFilter as $act) {
    $actualLink.= $act . "/";
}
?>
<div class="page__p-card" id="<?= $this->GetEditAreaId($arResult["ID"]); ?>">
    <div class="page__p-cardheader">
        <div class="p-cardheader new-template-prefix">
            <ul class="p-cardheader__list">
                <li class="p-cardheader__item p-cardheader__item-menu">
                    <a href="#" class="p-cardheader__link p-cardheader__link-menu">
                        <svg width="26" height="22" viewBox="0 0 26 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect y="0.706787" width="26" height="2.94828" rx="1.47414" fill="#0A5A77"/>
                            <rect y="9.55176" width="26" height="2.94828" rx="1.47414" fill="#0A5A77"/>
                            <rect y="18.3965" width="26" height="2.94828" rx="1.47414" fill="#0A5A77"/>
                        </svg>
                    </a>
                    <div class="menu__adaptive__menu">
                        <? $APPLICATION->IncludeComponent("bitrix:menu", "relaxa-middle", array(
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
                <li class="p-cardheader__item">
                    <a href="<?=$actualLink;?>" class="p-cardheader__link p-cardheader__link-home">
                        <svg width="20" height="24" viewBox="0 0 20 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0.939341 13.0607C0.353554 12.4749 0.353554 11.5251 0.939341 10.9393L10.4853 1.3934C11.0711 0.807611 12.0208 0.807611 12.6066 1.3934C13.1924 1.97919 13.1924 2.92893 12.6066 3.51472L4.12132 12L12.6066 20.4853C13.1924 21.0711 13.1924 22.0208 12.6066 22.6066C12.0208 23.1924 11.0711 23.1924 10.4853 22.6066L0.939341 13.0607ZM20 13.5L2 13.5V10.5L20 10.5V13.5Z" fill="#0A5A77"/>
                        </svg>
                    </a>
                </li>
            </ul>
            <ul class="p-cardheader__list">
                <li class="p-cardheader__item">
                    <script>
                        $(document).ready(function() {
                            $('.p-cardheader__link-pod').on('click', function() {
                                $(this).parent().children('.p-cardheader__tog').toggle();
                                return false;
                            });
                        });
                    </script>
                    <div class="p-cardheader__tog" style="display: none;">
                        <script type="text/javascript">(function() {
                                if (window.pluso)if (typeof window.pluso.start == "function") return;
                                if (window.ifpluso==undefined) { window.ifpluso = 1;
                                    var d = document, s = d.createElement('script'), g = 'getElementsByTagName';
                                    s.type = 'text/javascript'; s.charset='UTF-8'; s.async = true;
                                    s.src = ('https:' == window.location.protocol ? 'https' : 'http')  + '://share.pluso.ru/pluso-like.js';
                                    var h=d[g]('body')[0];
                                    h.appendChild(s);
                                }})();</script>
                        <div class="pluso" data-background="#ebebeb" data-options="big,square,line,horizontal,counter,theme=04" data-services="vkontakte,odnoklassniki,facebook,twitter,google,moimir,email,print"></div>
                    </div>
                </li>
                <li class="p-cardheader__item">
                    <a href="/compare/" class="p-cardheader__link p-cardheader__link-srav">
                        <svg width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 22.9995L2 5.74976" stroke="#0A5A77" stroke-width="4"/>
                            <path d="M8.00024 23L8.00024 9.2002" stroke="#0A5A77" stroke-width="4"/>
                            <path d="M13.9998 22.9997L13.9998 0" stroke="#0A5A77" stroke-width="4"/>
                            <path d="M19.9998 23L19.9998 9.2002" stroke="#0A5A77" stroke-width="4"/>
                        </svg>
                    </a>
                </li>
                <li class="p-cardheader__item">
                    <a href="/wishlist/" class="p-cardheader__link p-cardheader__link-izbr" style="padding-left: 0 !important;">

                        <svg width="26" height="24" viewBox="0 0 26 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <mask id="path-1-inside-1" fill="white">
                                <path d="M23.8999 2.22812C22.5385 0.79865 20.736 0.017362 18.8124 0.017362C16.8887 0.017362 15.0808 0.804437 13.7193 2.2339L13.0083 2.98047L12.2862 2.22233C10.9247 0.792862 9.11131 0 7.18763 0C5.26947 0 3.46154 0.787075 2.1056 2.21075C0.744145 3.64022 -0.00548178 5.53846 3.0182e-05 7.55824C3.0182e-05 9.57801 0.755169 11.4705 2.11662 12.8999L12.4681 23.7685C12.6114 23.919 12.8043 24 12.9917 24C13.1791 24 13.3721 23.9248 13.5154 23.7743L23.8889 12.9231C25.2503 11.4936 26 9.59537 26 7.5756C26.0055 5.55582 25.2614 3.65758 23.8999 2.22812ZM22.8416 11.8177L12.9917 22.1191L3.1639 11.8003C2.08355 10.666 1.48826 9.16132 1.48826 7.55824C1.48826 5.95515 2.07804 4.45045 3.15839 3.32192C4.23322 2.19339 5.66633 1.56836 7.18763 1.56836C8.71445 1.56836 10.1531 2.19339 11.2334 3.32771L12.4791 4.63564C12.7713 4.94237 13.2398 4.94237 13.5319 4.63564L14.7666 3.33928C15.8469 2.20497 17.2856 1.57994 18.8069 1.57994C20.3282 1.57994 21.7613 2.20497 22.8416 3.33349C23.922 4.46781 24.5117 5.97251 24.5117 7.5756C24.5173 9.17868 23.922 10.6834 22.8416 11.8177Z"></path>
                            </mask>
                            <path d="M23.8999 2.22812C22.5385 0.79865 20.736 0.017362 18.8124 0.017362C16.8887 0.017362 15.0808 0.804437 13.7193 2.2339L13.0083 2.98047L12.2862 2.22233C10.9247 0.792862 9.11131 0 7.18763 0C5.26947 0 3.46154 0.787075 2.1056 2.21075C0.744145 3.64022 -0.00548178 5.53846 3.0182e-05 7.55824C3.0182e-05 9.57801 0.755169 11.4705 2.11662 12.8999L12.4681 23.7685C12.6114 23.919 12.8043 24 12.9917 24C13.1791 24 13.3721 23.9248 13.5154 23.7743L23.8889 12.9231C25.2503 11.4936 26 9.59537 26 7.5756C26.0055 5.55582 25.2614 3.65758 23.8999 2.22812ZM22.8416 11.8177L12.9917 22.1191L3.1639 11.8003C2.08355 10.666 1.48826 9.16132 1.48826 7.55824C1.48826 5.95515 2.07804 4.45045 3.15839 3.32192C4.23322 2.19339 5.66633 1.56836 7.18763 1.56836C8.71445 1.56836 10.1531 2.19339 11.2334 3.32771L12.4791 4.63564C12.7713 4.94237 13.2398 4.94237 13.5319 4.63564L14.7666 3.33928C15.8469 2.20497 17.2856 1.57994 18.8069 1.57994C20.3282 1.57994 21.7613 2.20497 22.8416 3.33349C23.922 4.46781 24.5117 5.97251 24.5117 7.5756C24.5173 9.17868 23.922 10.6834 22.8416 11.8177Z" fill="#0A5A77"></path>
                        </svg>

                    </a>
                </li>
            </ul>

        </div>
    </div>

        <div class="p-card">
            <div class="p-card__botomfix mob-visible">
                <div class="p-botomfix">

                    <script>
                        $(document).ready(function() {
                            $('.p-botomfix__link-search').on('click', function() {
                                $('header .search-container').toggle();

                            });
                        });
                    </script>

                    <style>
                        .p-botomfix__buy {
                            border: 2px solid #780707;
                        }
                        .p-botomfix__buy-analog {
                            border: 2px solid #0A5A77;
                            background-color: transparent !important;
                            display: flex;
                            align-items: center;
                            justify-content: center;
                            color: #0a5a77;
                            padding-left: 0;
                            padding-right: 34px;
                        }
                        .p-botomfix__buy-analog svg {
                            margin-right: 15px;
                        }
                    </style>
                    <ul class="p-botomfix__list">
                        <li class="p-botomfix__item">
                            <a href="/" class="p-botomfix__link">
                                <svg width="31" height="27" viewBox="0 0 31 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0)">
                                        <path d="M29.0024 12.9792C28.8024 12.9792 28.6024 12.9792 28.4024 12.7792L15.0024 3.17917L1.60241 12.7792C1.00241 12.9792 0.402409 12.9792 0.202409 12.3792C-0.197591 11.9792 0.00240898 11.5792 0.402409 11.1792L14.4024 1.17917C14.6024 0.979175 15.2024 0.979175 15.6024 1.17917L29.6024 11.1792C30.0024 11.5792 30.0024 12.1792 29.8024 12.5792C29.6024 12.7792 29.2024 12.9792 29.0024 12.9792Z" fill="#101820"/>
                                        <path d="M4.00244 6.97913C3.40244 6.97913 3.00244 6.57913 3.00244 5.97913V1.97913C3.00244 1.37913 3.40244 0.979126 4.00244 0.979126H8.00244C8.60244 0.979126 9.00244 1.37913 9.00244 1.97913C9.00244 2.57913 8.40244 2.97913 8.00244 2.97913H5.00244V5.97913C5.00244 6.57913 4.40244 6.97913 4.00244 6.97913Z" fill="#101820"/>
                                        <path d="M24.0024 26.9791H19.0024C18.4024 26.9791 18.0024 26.5791 18.0024 25.9791V18.9791H12.0024V25.9791C12.0024 26.5791 11.4024 26.9791 11.0024 26.9791H6.00244C4.40244 26.9791 3.00244 25.5791 3.00244 23.9791V13.9791C3.00244 13.3791 3.40244 12.9791 4.00244 12.9791C4.60244 12.9791 5.00244 13.3791 5.00244 13.9791V23.9791C5.00244 24.5791 5.40244 24.9791 6.00244 24.9791H10.0024V17.9791C10.0024 17.3791 10.4024 16.9791 11.0024 16.9791H19.0024C19.4024 16.9791 20.0024 17.3791 20.0024 17.9791V24.9791H24.0024C24.6024 24.9791 25.0024 24.5791 25.0024 23.9791V13.9791C25.0024 13.3791 25.4024 12.9791 26.0024 12.9791C26.6024 12.9791 27.0024 13.3791 27.0024 13.9791V23.9791C27.0024 25.5791 25.6024 26.9791 24.0024 26.9791Z" fill="#101820"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0">
                                            <rect x="0.00244141" y="0.979126" width="30" height="26" fill="white"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </li>
                        <li class="p-botomfix__item p-botomfix__item-basket">
                            <script>
                                var basketcount;
                                basketcount = 0;
                                $(document).ready(function() {
                                    basketcount = $('header .stuff__in__basket__header a .count').html();
                                    basketcount = Number(basketcount);
                                    if(basketcount > 0) {
                                        $('.p-botomfix__link-basket-count').show();
                                        $('.p-botomfix__link-basket-count').text(basketcount);
                                    }

                                    $('.p-botomfix__buy').on('click', function() {
                                        setTimeout(function() {
                                            basketcount = $('header .stuff__in__basket__header a .count').html();
                                            basketcount = Number(basketcount);
                                            if(basketcount > 0) {
                                                $('.p-botomfix__link-basket-count').show();
                                                $('.p-botomfix__link-basket-count').text(basketcount);
                                            }
                                        }, 2000);
                                    });
                                    $('.p-prods__addbasket').on('click', function() {
                                        setTimeout(function() {
                                            basketcount = $('header .stuff__in__basket__header a .count').html();
                                            basketcount = Number(basketcount);
                                            if(basketcount > 0) {
                                                $('.p-botomfix__link-basket-count').show();
                                                $('.p-botomfix__link-basket-count').text(basketcount);
                                            }
                                        }, 2000);
                                    });
                                });
                            </script>
                            <style>
                                .p-botomfix__item-basket {
                                    position: relative;
                                    display: block;
                                }
                                .p-botomfix__link-basket {
                                    display: inline-block;
                                }
                                .p-botomfix__link-basket-count {
                                    display: block;
                                    position: absolute;
                                    z-index: 2;
                                    width: 25px;
                                    height: 25px;
                                    border-radius: 50%;
                                    text-align: center;
                                    line-height: 25px;
                                    right: 11px;
                                    top: -11px;
                                    background-color: #780707;
                                    color: #ffffff;
                                }
                            </style>
                            <span class="p-botomfix__link-basket-count" style="display: none;">
                                    0
                                </span>
                            <a href="/personal/cart/" class="p-botomfix__link p-botomfix__link-basket">
                                <svg width="33" height="29" viewBox="0 0 33 29" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.60244 18.2791C9.10244 18.2791 8.60244 17.9791 8.50244 17.3791L6.00244 4.87914C5.70244 3.37914 4.40244 2.27914 2.90244 2.27914H1.10244C0.502441 2.27914 0.00244141 1.87914 0.00244141 1.27914C0.00244141 0.679138 0.502441 0.179138 1.10244 0.179138H2.90244C5.40244 0.179138 7.60244 1.97914 8.10244 4.47914L10.6024 17.0791C10.7024 17.6791 10.4024 18.1791 9.80244 18.3791H9.60244V18.2791Z" fill="#101820"/>
                                    <path d="M10.7025 25.7792H8.70249C6.30249 25.7792 4.30249 23.7792 4.30249 21.3792C4.30249 19.0792 6.00249 17.2792 8.30249 16.9792L27.9025 15.1792L29.6025 6.57915H7.50249C6.90249 6.57915 6.40249 6.07915 6.40249 5.47915C6.40249 4.87915 6.90249 4.37915 7.50249 4.37915H31.0025C31.3025 4.37915 31.6025 4.47915 31.8025 4.77915C31.9025 5.07915 32.0025 5.37915 32.0025 5.77915L29.9025 16.4792C29.8025 16.9792 29.4025 17.2792 29.0025 17.3792L8.50249 19.0792C7.20249 19.1792 6.30249 20.1792 6.30249 21.4792C6.30249 22.7792 7.40249 23.6792 8.70249 23.6792H10.7025C11.3025 23.6792 11.8025 24.1791 11.8025 24.7792C11.7025 25.2792 11.3025 25.7792 10.7025 25.7792Z" fill="#101820"/>
                                    <path d="M26.7023 28.9792C24.3023 28.9792 22.4023 27.0792 22.4023 24.6792C22.4023 22.2792 24.3023 20.3792 26.7023 20.3792C29.1023 20.3792 31.0023 22.2792 31.0023 24.6792C31.0023 27.0792 29.0023 28.9792 26.7023 28.9792ZM26.7023 22.5792C25.5023 22.5792 24.6023 23.5792 24.6023 24.6792C24.6023 25.8792 25.6023 26.7792 26.7023 26.7792C27.9023 26.7792 28.8023 25.7792 28.8023 24.6792C28.8023 23.5792 27.8023 22.5792 26.7023 22.5792Z" fill="#101820"/>
                                    <path d="M13.9025 28.9792C11.5025 28.9792 9.60254 27.0792 9.60254 24.6792C9.60254 22.2792 11.5025 20.3792 13.9025 20.3792C16.3025 20.3792 18.2025 22.2792 18.2025 24.6792C18.2025 27.0792 16.2025 28.9792 13.9025 28.9792ZM13.9025 22.5792C12.7025 22.5792 11.8025 23.5792 11.8025 24.6792C11.8025 25.8792 12.8025 26.7792 13.9025 26.7792C15.0025 26.7792 16.0025 25.7792 16.0025 24.6792C16.0025 23.5792 15.0025 22.5792 13.9025 22.5792Z" fill="#101820"/>
                                    <path d="M23.5024 25.7792H17.1024C16.5024 25.7792 16.0024 25.2792 16.0024 24.6792C16.0024 24.0792 16.5024 23.5792 17.1024 23.5792H23.5024C24.1024 23.5792 24.6024 24.0792 24.6024 24.6792C24.5024 25.2792 24.0024 25.7792 23.5024 25.7792Z" fill="#101820"/>
                                </svg>


                            </a>
                        </li>
                        <li class="p-botomfix__item">

                            <a href="javascript:void(0);" class="p-botomfix__link p-botomfix__link-search">
                                <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M11.0024 22.9791C5.50244 22.9791 1.00244 18.4791 1.00244 12.9791C1.00244 7.47913 5.50244 2.97913 11.0024 2.97913C16.5024 2.97913 21.0024 7.47913 21.0024 12.9791C21.0024 18.4791 16.5024 22.9791 11.0024 22.9791ZM11.0024 4.97913C6.60244 4.97913 3.00244 8.57913 3.00244 12.9791C3.00244 17.3791 6.60244 20.9791 11.0024 20.9791C15.4024 20.9791 19.0024 17.3791 19.0024 12.9791C19.0024 8.57913 15.4024 4.97913 11.0024 4.97913Z" fill="#101820"/>
                                    <path d="M28.0024 30.6792C27.3024 30.6792 26.6024 30.4792 26.1024 29.9792L20.0024 24.8792C18.7024 23.7792 18.6024 21.8792 19.6024 20.6792C20.7024 19.3792 22.6024 19.2792 23.8024 20.2792L29.9024 25.3792C31.2024 26.4792 31.3024 28.3792 30.3024 29.5792C29.7024 30.2792 28.9024 30.6792 28.0024 30.6792ZM21.9024 21.5792C21.3024 21.5792 20.9024 22.0792 20.9024 22.6792C20.9024 22.9792 21.1024 23.1792 21.3024 23.3792L27.4024 28.4792C27.8024 28.8792 28.5024 28.7792 28.8024 28.3792C29.0024 28.1792 29.1024 27.8792 29.0024 27.6792C29.0024 27.3792 28.8024 27.1792 28.6024 26.9792L22.5024 21.8792C22.3024 21.6792 22.1024 21.5792 21.9024 21.5792Z" fill="#101820"/>
                                    <path d="M20.0023 21.9791C19.8023 21.9791 19.5023 21.8791 19.4023 21.7791L17.0023 19.7791C16.6023 19.3791 16.5023 18.7791 16.9023 18.3791C17.3023 17.9791 17.9023 17.8791 18.3023 18.2791L20.6023 20.2791C21.0023 20.6791 21.1023 21.2791 20.7023 21.6791C20.6023 21.8791 20.3023 21.9791 20.0023 21.9791Z" fill="#101820"/>
                                </svg>
                            </a>
                        </li>
                        <li class="p-botomfix__item">
                            <a href="/personal/" class="p-botomfix__link">
                                <svg width="33" height="33" viewBox="0 0 33 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M16.0024 17.9791C11.6024 17.9791 8.00244 14.3791 8.00244 9.97913C8.00244 5.57913 11.6024 1.97913 16.0024 1.97913C20.4024 1.97913 24.0024 5.57913 24.0024 9.97913C24.0024 14.3791 20.4024 17.9791 16.0024 17.9791ZM16.0024 3.97913C12.7024 3.97913 10.0024 6.67913 10.0024 9.97913C10.0024 13.2791 12.7024 15.9791 16.0024 15.9791C19.3024 15.9791 22.0024 13.2791 22.0024 9.97913C22.0024 6.67913 19.3024 3.97913 16.0024 3.97913Z" fill="#101820"/>
                                    <path d="M23.0024 31.9791H9.00244C6.20244 31.9791 4.00244 29.7791 4.00244 26.9791V22.9791C4.00244 22.5791 4.20244 22.2791 4.50244 22.0791L9.50244 19.0791C10.0024 18.8791 10.6024 19.0791 10.8024 19.5791C11.0024 19.9791 10.9024 20.4791 10.5024 20.7791L6.00244 23.5791V26.9791C6.00244 28.6791 7.30244 29.9791 9.00244 29.9791H23.0024C24.7024 29.9791 26.0024 28.6791 26.0024 26.9791V23.5791L21.5024 20.8791C21.0024 20.5791 20.8024 19.9791 21.0024 19.4791C21.2024 18.9791 21.8024 18.7791 22.3024 18.9791C22.4024 18.9791 22.4024 19.0791 22.5024 19.0791L27.5024 22.0791C27.8024 22.2791 28.0024 22.5791 28.0024 22.9791V26.9791C28.0024 29.7791 25.8024 31.9791 23.0024 31.9791Z" fill="#101820"/>
                                </svg>
                            </a>
                        </li>
                    </ul>

                    <?if($arResult["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") {?>
                        <a href="#izgotovnazakaz" class="p-prods__nazakaz fb-modal" data-id="<?= $arResult["ID"] ?>">
                            Изготовление на заказ
                        </a>
                    <?} else {?>
                        <?if($arResult['CATALOG_QUANTITY'] && $arResult['CATALOG_QUANTITY'] > 0 && empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>

                            <?if($url):?>
                                <a href="<?=$url;?>" class="p-botomfix__buy fullbtn addCart changeID changeCart">
                        <span class="p-botomfix__buyleft">
                            Купить
                        </span>
                                    <span class="p-botomfix__buyright">
                            <?= $arResult["MIN_PRICE"]["DISCOUNT_VALUE"]?>
                        </span>
                                </a>
                            <? else: ?>
                                <? if (!empty($arResult["MIN_PRICE"])): ?>
                                    <a href="#" class="p-carddes__addbasket fullbtn addCart changeID changeCart<? if ($arResult["CAN_BUY"] === false || $arResult["CAN_BUY"] === "N"): ?> disabled<? endif; ?>"
                                       data-id="<?= $arResult["ID"] ?>">
                                        <? if (isset($itInBasket)) { //Если этот товар есть в корзине ?>
                                            Добавленно в корзину
                                        <?} else { //Если товара нет (переменная пустая) ?>
                                            Добавить в корзину
                                        <?}?>
                                    </a>
                                    <a href="#" data-id="<?= $arResult["ID"] ?>" class="p-botomfix__buy fullbtn addCart changeID changeCart<? if ($arResult["CAN_BUY"] === false || $arResult["CAN_BUY"] === "N"): ?> disabled<? endif; ?>">
                        <span class="p-botomfix__buyleft">
                            Купить
                        </span>
                                        <span class="p-botomfix__buyright">
                            <?= $arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?>
                        </span>
                                    </a>
                                <? else: ?>
                                    <a href="<?=$url;?>" data-id="<?= $arResult["ID"] ?>" class="p-botomfix__buy changeCart<? if ($arResult["CAN_BUY"] === false || $arResult["CAN_BUY"] === "N"): ?> disabled<? endif; ?>">
                        <span class="p-botomfix__buyleft">
                            Купить
                        </span>
                                        <span class="p-botomfix__buyright">
                            <?= $arResult["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"]?>
                        </span>
                                    </a>
                                <? endif; ?>
                            <? endif; ?>
                            <?
                        } elseif($arResult['CATALOG_QUANTITY'] == 0 && empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <?
                            $res = CIBlockElement::GetByID($arResult['PROPERTIES']['ANALOG_LINK']['VALUE']);
                            if($ar_res = $res->GetNext()) {
                                ?>
                                <a href="<?=$ar_res['DETAIL_PAGE_URL']?>" class="p-botomfix__buy p-botomfix__buy-analog"
                                   data-id="<?= $arResult["ID"] ?>">
                                    <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M9 0C5.07449 0 1.672 2.2351 0 5.5C1.672 8.7649 5.07449 11 9 11C12.9254 11 16.3279 8.7649 18 5.5C16.328 2.2351 12.9254 0 9 0ZM13.4376 2.91679C14.4952 3.57634 15.3913 4.45978 16.0644 5.5C15.3913 6.54022 14.4951 7.42366 13.4376 8.08321C12.1088 8.91196 10.5743 9.35 9 9.35C7.4257 9.35 5.8912 8.91196 4.5624 8.08321C3.5049 7.42362 2.60877 6.54019 1.93563 5.5C2.60873 4.45974 3.5049 3.57631 4.5624 2.91679C4.63127 2.87382 4.70085 2.83219 4.77084 2.79132C4.5958 3.26102 4.5 3.76795 4.5 4.29688C4.5 6.72688 6.51473 8.69687 9 8.69687C11.4852 8.69687 13.5 6.72688 13.5 4.29688C13.5 3.76795 13.4042 3.26102 13.2292 2.79128C13.2991 2.83216 13.3687 2.87382 13.4376 2.91679ZM9 3.74687C9 4.65816 8.24449 5.39687 7.3125 5.39687C6.38051 5.39687 5.625 4.65816 5.625 3.74687C5.625 2.83559 6.38051 2.09687 7.3125 2.09687C8.24449 2.09687 9 2.83559 9 3.74687Z" fill="#0A5A77"></path>
                                    </svg>
                                    <span class="p-botomfix__buyleft">
                            Посмотреть аналог
                        </span>
                                </a>
                                <?
                            }
                            ?>
                            <?
                        } elseif(!empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <a href="<?=$ar_res['DETAIL_PAGE_URL']?>" class="p-botomfix__buy p-botomfix__buy-predzakaz fullbtn fastBack changeID changeCart"
                               data-id="<?= $arResult["ID"] ?>">
                                <span class="p-botomfix__buyleft">
                            Предзаказ
                        </span>
                            </a>
                            <?
                            if(!empty($arResult['PROPERTIES']['ANALOG_LINK']['VALUE'])) {
                                $res = CIBlockElement::GetByID($arResult['PROPERTIES']['ANALOG_LINK']['VALUE']);
                                if($ar_res = $res->GetNext()) {
                                    ?>
                                    <a style="background: #FFFFFF;" href="<?=$ar_res['DETAIL_PAGE_URL']?>" class="p-carddes__buyoneclick p-carddes__buyoneclick p-carddes__buyoneclick-pred"
                                       data-id="<?= $arResult["ID"] ?>">
                                        <svg width="18" height="11" viewBox="0 0 18 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 0C5.07449 0 1.672 2.2351 0 5.5C1.672 8.7649 5.07449 11 9 11C12.9254 11 16.3279 8.7649 18 5.5C16.328 2.2351 12.9254 0 9 0ZM13.4376 2.91679C14.4952 3.57634 15.3913 4.45978 16.0644 5.5C15.3913 6.54022 14.4951 7.42366 13.4376 8.08321C12.1088 8.91196 10.5743 9.35 9 9.35C7.4257 9.35 5.8912 8.91196 4.5624 8.08321C3.5049 7.42362 2.60877 6.54019 1.93563 5.5C2.60873 4.45974 3.5049 3.57631 4.5624 2.91679C4.63127 2.87382 4.70085 2.83219 4.77084 2.79132C4.5958 3.26102 4.5 3.76795 4.5 4.29688C4.5 6.72688 6.51473 8.69687 9 8.69687C11.4852 8.69687 13.5 6.72688 13.5 4.29688C13.5 3.76795 13.4042 3.26102 13.2292 2.79128C13.2991 2.83216 13.3687 2.87382 13.4376 2.91679ZM9 3.74687C9 4.65816 8.24449 5.39687 7.3125 5.39687C6.38051 5.39687 5.625 4.65816 5.625 3.74687C5.625 2.83559 6.38051 2.09687 7.3125 2.09687C8.24449 2.09687 9 2.83559 9 3.74687Z" fill="#0A5A77"/>
                                        </svg>
                                        Посмотреть аналог
                                    </a>
                                    <?
                                }
                            }
                            ?>
                            <?
                        } else {
                            ?>

                            <?
                        }?>
                    <?}?>
                </div>
            </div>
            <div class="p-card__top">
                <div class="wrapper">
                    <h2 class="p-card__title">
                        <?= $arResult['NAME'] ?>
                        <?
                        if(!empty($arResult['PROPERTIES']['ATT_BRAND']['VALUE'])) {
                            $arSelectBr = Array("ID", "NAME", "DATE_ACTIVE_FROM", "DETAIL_PICTURE");
                            $arFilterBr = Array("IBLOCK_ID"=>17, "ID"=>$arResult['PROPERTIES']['ATT_BRAND']['VALUE']);
                            $resBr = CIBlockElement::GetList(Array(), $arFilterBr, false, Array(), $arSelectBr);
                            if($arBrand = $resBr->Fetch())
                            {
                                $resNew = CIBlockElement::GetByID($arResult['PROPERTIES']['ATT_BRAND']['VALUE']);
                                if($ar_resNew = $resNew->GetNext())
                                    ?>
                                    <a href="<?=$ar_resNew['DETAIL_PAGE_URL']?>" class="p-card__title-brand" style="background-image: url(<?=CFile::GetPath($arBrand['DETAIL_PICTURE']);?>);"></a>
                                <?
                            }
                        }
                        ?>
                    </h2>
                    <?/*echo "<pre>"; print_r($arResult['REVIEWS']); echo "</pre>";*/?>
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
                    <?if($arResult["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") {?>
                        <div class="p-carddes__nal p-carddes__nal-zakkres mob-visible">
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
                        <?if($arResult['CATALOG_QUANTITY'] && $arResult['CATALOG_QUANTITY'] > 0 && empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <span class="p-carddes__nal mob-visible">Есть в наличии</span>
                            <?
                        } elseif($arResult['CATALOG_QUANTITY'] == 0 && empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <span class="p-carddes__nal p-prods__nal-snyat mob-visible">Снят с продажи</span>
                            <?
                        } elseif(!empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
                            ?>
                            <span class="p-carddes__nal p-prods__nal-pos mob-visible">Поступит: <?=$arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE']?></span>
                            <?
                        } else {
                            ?>
                            <span class="p-carddes__nal p-prods__nal-no mob-visible">Нет в наличии</span>
                            <?
                        }?>
                    <?}?>
                </div>
            </div>
            <div class="p-card__tov">
                <div class="p-card__wrapper">
                    <div class="p-card__p-cardslider">
                        <div class="p-cardslider">
                            <? if (!empty($arResult["PROPERTIES"]["OFFERS"]["VALUE"])): ?>
                                <div class="p-cardslider__tag">
                                    <?if(is_array($arResult["PROPERTIES"]["OFFERS"]["VALUE"])) {?>
                                        <? foreach ($arResult["PROPERTIES"]["OFFERS"]["VALUE"] as $ifv => $marker): ?>
                                            <?if($marker != "ОБНОВЛЕН") {?>
                                                <?if($marker == "NEW") {?>
                                                    <span class="p-cardslider__new" style="background-color: #37ac09;"><?= $marker ?></span>
                                                <?} elseif($marker == "HIT") {?>
                                                    <span class="p-cardslider__new" style="background-color: #3254AD;"><?= $marker ?></span>
                                                <?} elseif($marker == "PRESALE") {?>
                                                    <span class="p-cardslider__new" style="background-color: #F36525;"><?= $marker ?></span>
                                                <?} elseif($marker == "LOVE") {?>
                                                    <span class="p-cardslider__new" style="background-color: #B710A0;"><?= $marker ?></span>
                                                <?} elseif($marker == "АКЦИЯ") {?>
                                                    <span class="p-cardslider__new" style="background-color: #CC0000;"><?= $marker ?></span>
                                                <?} elseif($marker == "SALE") {?>
                                                    <span class="p-cardslider__new" style="background-color: #7D0483;"><?= $marker ?></span>
                                                <?} elseif($marker == "-5%") {?>
                                                    <span class="p-cardslider__new" style="background-color: #e63244;"><?= $marker ?></span>
                                                <?} elseif($marker == "-10%") {?>
                                                    <span class="p-cardslider__new" style="background-color: #E53744;"><?= $marker ?></span>
                                                <?} elseif($marker == "-15%") {?>
                                                    <span class="p-cardslider__new" style="background-color: #CD4741;"><?= $marker ?></span>
                                                <?} elseif($marker == "-20%") {?>
                                                    <span class="p-cardslider__new" style="background-color: #B50428;"><?= $marker ?></span>
                                                <?} elseif($marker == "-25%") {?>
                                                    <span class="p-cardslider__new" style="background-color: #940123;"><?= $marker ?></span>
                                                <?} elseif($marker == "-7%") {?>
                                                    <span class="p-cardslider__new" style="background-color: #EB3144;"><?= $marker ?></span>
												<?} elseif($marker == "НА ЗАКАЗ") {?>
                                                    <span class="p-cardslider__new" style="background-color: #780707;"><?= $marker ?></span>
												<?} elseif($marker == "ZEN") {?>
                                                    <span class="p-cardslider__new" style="background-color: transparent; color: transparent; background-image: url(https://relaxa.ru//img/svg/zen_gm-03.svg); background-size: 70%; background-repeat: no-repeat; margin-left: 100px; margin-top: 100px; height: 200px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg); transform: rotate(45deg);"><?= $marker ?></span>
                                                <?} else {?>

                                                    <span class="p-cardslider__new marker-<?= strstr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>"
                                                          style="background-color: #<?=strstr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>;"><?= $marker ?></span>

                                                <?}?>
                                            <?} else {?>
                                                <span class="p-cardslider__new" style="background-color: #29bc48;"><?= $marker ?></span>
                                            <?}?>
                                        <? endforeach; ?>
                                    <?} else {?>
                                        <?if($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "NEW") {?>
                                            <span class="p-cardslider__new" style="background-color: #37ac09;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "HIT") {?>
                                            <span class="p-cardslider__new" style="background-color: #3254AD;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "PRESALE") {?>
                                            <span class="p-cardslider__new" style="background-color: #F36525;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "LOVE") {?>
                                            <span class="p-cardslider__new" style="background-color: #B710A0;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "АКЦИЯ") {?>
                                            <span class="p-cardslider__new" style="background-color: #CC0000;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "SALE") {?>
                                            <span class="p-cardslider__new" style="background-color: #7D0483;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "-5%") {?>
                                            <span class="p-cardslider__new" style="background-color: #e63244;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "-10%") {?>
                                            <span class="p-cardslider__new" style="background-color: #E53744;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "-15%") {?>
                                            <span class="p-cardslider__new" style="background-color: #CD4741;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "-20%") {?>
                                            <span class="p-cardslider__new" style="background-color: #B50428;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "-25%") {?>
                                            <span class="p-cardslider__new" style="background-color: #940123;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "-7%") {?>
                                            <span class="p-cardslider__new" style="background-color: #EB3144;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
										<?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "НА ЗАКАЗ") {?>
                                            <span class="p-cardslider__new" style="background-color: #780707;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
										<?} elseif($arResult["PROPERTIES"]["OFFERS"]["VALUE"] == "ZEN") {?>
                                            <span class="p-cardslider__new" style="background-color: transparent; color: transparent; background-image: url(https://relaxa.ru//img/svg/zen_gm-03.svg); background-size: 70%; background-repeat: no-repeat; margin-left: 100px; margin-top: 100px; height: 200px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg); transform: rotate(45deg);"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                        <?} else {?>

                                            <span class="p-cardslider__new marker-<?= strstr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>"
                                                  style="background-color: #<?=strstr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? substr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], 1) : "424242" ?>;"><?= $arResult["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>

                                        <?}?>
                                    <?}?>

                                </div>
                            <? endif; ?>
                            <div class="p-cardslider__bigwrapper" id="cardSliderForZoom">
                                <div class="p-cardslider__big" >
                                    <? if (!empty($arResult["IMAGES"])): ?>
                                        <? foreach ($arResult["IMAGES"] as $ipr => $arNextPicture): ?>
                                            <div class="p-cardslider__bigitem">
                                                <div class="p-cardslider__bigflex">
                                                    <a href="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>"
                                                       title="<?= GetMessage("CATALOG_ELEMENT_ZOOM") ?>" class="fb-img-popup" data-fancybox="card-galery"
                                                       data-small-picture="<?= $arNextPicture["SMALL_IMAGE"]["SRC"] ?>"
                                                       data-large-picture="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>">
                                                    <img class="p-cardslider__bigimg" src="<?= $arNextPicture["LARGE_IMAGE"]["SRC"] ?>" alt="alt">
                                                    </a>
                                                </div>
                                            </div>
                                        <? endforeach; ?>
                                    <? endif; ?>
                                </div>
                            </div>
                            <div class="p-cardslider__lite">
                                <? if (!empty($arResult["IMAGES"])): ?>
                                    <? foreach ($arResult["IMAGES"] as $ipr => $arNextPicture): ?>
                                        <div class="p-cardslider__liteitem">
                                            <div class="p-cardslider__liteimg" style="background-image: url(<?=$arNextPicture["SMALL_IMAGE"]["SRC"]?>)"></div>
                                        </div>
                                    <? endforeach; ?>
                                <? endif; ?>
                            </div>
                            <? if ($arResult['PROPERTIES']['COLOR_SELECT']['VALUE']): ?>
                            <div class="colors_tovar">
                                <div class="button_color_tovar">
                                    <p>ЦВЕТА</p> | <a href="">УВЕЛИЧИТЬ <img
                                                src="/bitrix/templates/dresscodeV2/img/open_img.png" alt=""></a>
                                </div>
                                <div class="button-color-container-v3">
                                    <a class="btn btn_big btn_red btn_radiance" href="<?=(empty($arResult["PROPERTIES"]["LINK_COLOR_FILTER"]["~VALUE"])) ? "http://relaxa.pro/" : $arResult["PROPERTIES"]["LINK_COLOR_FILTER"]["~VALUE"]?>">
                                        <div>Перейти к конфигуратору&nbsp;&nbsp;→<br>
                                        <?//<span>и получить подарок за прохождение теста</span>?></div>
                                    </a>
                                </div>
                                <div class="color_list_tovar">
                                    <noindex>
                                        <a rel="nofollow" href="<?=(empty($arResult["PROPERTIES"]["LINK_COLOR_FILTER"]["~VALUE"])) ? "http://relaxa.pro/" : $arResult["PROPERTIES"]["LINK_COLOR_FILTER"]["~VALUE"]?>">
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
                    <div class="p-card__p-carddes">
                        <div class="p-carddes">
                            <? include($_SERVER["DOCUMENT_ROOT"] . "/" . $templateFolder . "/include/right_section_new.php"); ?>
                        </div>
                    </div>
                </div>
            </div>


            <div class="p-card__infoadd" id="goToSection">
                <div class="wrapper wrapper-new">
                    <div class="p-card__tabs">
                        <div class="p-tabs">
                            <div class="p-tabs__top">
                                <ul class="p-tabs__list">
                                    <li class="p-tabs__item p-tabs__item-op active">
                                        Описание
                                    </li>
                                    <?if(!empty($arResult['PROPERTIES']['POD_LINK']['VALUE'])):?>

                                            <a href="<?=$arResult['PROPERTIES']['POD_LINK']['VALUE']?>" class="p-tabs__item-link" target="_blank">
                                                Подробнее
                                            </a>
                                    <?endif;?>
                                    <li class="p-tabs__item p-tabs__item-har">
                                        Характеристики
                                    </li>
                                    <li class="p-tabs__item p-tabs__item-rev">
                                        Отзывы (<?=count($arResult['REVIEWS'])?>)
                                    </li>
                                </ul>
                            </div>
                            <div class="p-tabs__content">
                                <div class="p-tabs__op tabcontent text_block_tovar" style="display: block;">
                                    <div class="title" style="color: #800000;"><?= $arResult['NAME'] ?></div>
									<?= $arResult["PREVIEW_TEXT"] ?>                                    
                                    <? if (!empty($arResult["DETAIL_TEXT"])): ?>
										<?if($arResult['PROPERTIES']['ZAGOLOVOK1']['VALUE'] == 'Да') {?>                                                                             
										<div class="heading"><?= GetMessage("CATALOG_ELEMENT_DETAIL_TEXT_HEADING") ?></div>
										<?}?>
                                    <div class="ttext-ccolor">
                                        <div class="changeDescription"
                                            data-first-value='<?= str_replace("'", "", $arResult["~DETAIL_TEXT"]) ?>'><?= $arResult["~DETAIL_TEXT"] ?></div>
                                    </div>
                                    <? endif; ?>
                                </div>
                                <!-- <div class="p-tabs__pod" style="display: none;">
                                    <p>
                                        Наверно какой то текст
                                    </p>
                                </div> -->
                                <div class="p-tabs__har" style="display: none;">
                                    <?
                                    global $arPropEl;
                                    $arPropEl = $arParams['PROPERTY_CODE'];
//if($USER->IsAdmin()){echo "<pre>"; print_r($arPropEl);}
                                    ?>
                                    <div style="max-width: 1200px" class="p-har">
                                        <? $APPLICATION->IncludeComponent(
                                            "dresscode:catalog.properties.list",
                                            "group",
                                            array(
                                                "PRODUCT_ID" => $arResult["ID"],
                                                "ELEMENT_LAST_SECTION_ID" => $arResult["LAST_SECTION"]["ID"],
                                                "COMPONENT_TEMPLATE" => "group",
                                                "IBLOCK_TYPE" => "catalog",
                                                "IBLOCK_ID" => "1",
                                                "PROP_NAME" => $arPropEl,
                                                "PROP_VALUE" => "",
                                                "ELEMENTS_COUNT" => "20",
                                                "POP_LAST_ELEMENT" => "Y",
                                                "SELECT_FIELDS" => array(
                                                    0 => $arPropEl, 
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
                                <div class="p-tabs__rev" style="display: none;">
                                    <div class="p-rev">
                                        <div class="p-rev__top">
                                            Сортировать по:
                                            <div class="p-sort">
                                                <div class="p-sort__active" name="data">
                                                    <i class="p-sort__icon">
                                                        <svg width="16" height="10" viewBox="0 0 16 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <line y1="-1" x2="5" y2="-1" transform="matrix(1 0 0 -1 0 8)" stroke="#828282" stroke-width="2"/>
                                                            <line y1="-1" x2="11" y2="-1" transform="matrix(1 0 0 -1 0 4)" stroke="#828282" stroke-width="2"/>
                                                            <line y1="-1" x2="16" y2="-1" transform="matrix(1 0 0 -1 0 0)" stroke="#828282" stroke-width="2"/>
                                                        </svg>
                                                    </i>
                                                    <?if($_GET['sort'] == 'active_from'):?>
                                                        <span>По дате</span>
                                                    <?elseif($_GET['sort'] == 'PROPERTY_RATE'):?>
                                                        <span>По рейтингу</span>
                                                    <?else:?>
                                                        <span>По дате</span>
                                                    <?endif?>
                                                    <i class="p-sort__arrow">
                                                        <svg width="7" height="5" viewBox="0 0 7 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M0.5 1L3.5 3.99674L6.5 1" stroke="#828282"/>
                                                        </svg>
                                                    </i>
                                                </div>
                                                <div class="p-sort__toggle">
                                                    <ul class="p-sort__list">
                                                        <li class="p-sort__item">
                                                            <a href="<?=$APPLICATION->GetCurPageParam('sort=active_from', array("sort"))?>" class="p-sort__link" name="data">
                                                                По дате
                                                            </a>
                                                        </li>
                                                        <li class="p-sort__item">
                                                            <a href="<?=$APPLICATION->GetCurPageParam('sort=PROPERTY_RATE', array("sort"))?>"class="p-sort__link" name="prop2">
                                                                По рейтигну
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
<? if ( in_array(9, $arGroups)) : ?>
                                        <a href="#addReview" class="fancy-form">
										<button class="new_button_reviews"> 
                                        Написать отзыв
										</button>
                                        </a>
                                        
<? endif; ?>
                                        <ul>
                                            <?
                                            $iblockReview = 18;
                                            $arSelect = Array("ID", "NAME", "DATE_ACTIVE_FROM", "IBLOCK_ID");
                                            $sort = 'active_from';
                                            if(isset($_GET['sort'])) {
                                                $sort = $_GET['sort'];
                                            }
                                            $arFilter = Array("IBLOCK_ID" => $iblockReview, "PROPERTY_PRODUCT" => $arResult['ID'], "ACTIVE" => "Y");
                                            $res = CIBlockElement::GetList(Array($sort=>"desc"), $arFilter, false, Array(), $arSelect);
                                            while ($ob = $res->GetNextElement()) {
                                                $i = 1;
                                                $arFields = $ob->GetFields();
                                                $arFields['PROP'] = $ob->GetProperties();
                                                ?>
                                                <li>
                                                     <?
                                                    if ($arFields['NAME'] != "Без названия"):?>
                                                        <h4><?= $arFields['NAME']; ?></h4>
                                                    <?endif; ?>
                                                    <div class="meta">
                                                        <span style="display: block;color: #0A5A77;text-align: left;font-weight: bold;font-size: 15pt;" class="author"><?= $arFields['PROP']['NAME']['VALUE']; ?></span>
                                                        <span class="date"><?= ConvertDateTime($arFields['DATE_ACTIVE_FROM'], "DD.MM, HH:MI", "s1"); ?></span>
                                                    </div>

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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?
            global $similarFilter;
            if($arParams["IBLOCK_ID"] == 15) {

                $similarFilter['ID'] = $arResult['PROPERTY_198'];

            } else if($arParams["IBLOCK_ID"] == 1) {

                $similarFilter['ID'] = $arResult['PROPERTY_15'];

            } else if($arParams["IBLOCK_ID"] == 13) {

                $similarFilter['ID'] = $arResult['PROPERTY_230'];

            } else if($arParams["IBLOCK_ID"] == 21) {

                $similarFilter['ID'] = $arResult['PROPERTY_533'];

            } else if($arParams["IBLOCK_ID"] == 14) {

                $similarFilter['ID'] = $arResult['PROPERTY_262'];

            } else if($arParams["IBLOCK_ID"] == 12) {

                $similarFilter['ID'] = $arResult['PROPERTY_262'];

            }
            /*echo "<pre>"; print_r($arResult); echo "</pre>";*/
            ?>
            <?/*if($USER->isAdmin()) {*/?>

            <?
            global $IBLOCK_VAR;
            $IBLOCK_VAR = $arParams["IBLOCK_ID"];
            ?>


            <?
            if(!empty($arResult['PROPERTIES']['RELATED_PRODUCT']['VALUE'])) {
                global $arrFilter;
                $arrFilter['ID'] = $arResult['PROPERTIES']['RELATED_PRODUCT']['VALUE'];
                ?>
                <div class="p-card__prods">
                    <div class="wrapper">
                        <div class="p-card__p-prods">
                            <b class="p-prods__title">
                                С этим товаром покупают
                            </b>
                            <div class="p-prods__slider">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "buy-with-this-product-new",
                                    Array(
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
                                        "FILTER_NAME" => "arrFilter",
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
                                        "IBLOCK_ID" => "1",
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
                                        "PAGE_ELEMENT_COUNT" => "30",
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
                                        )
                                    )
                                );?>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "buy-with-this-product-new",
                                    Array(
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
                                        "CACHE_TYPE" => "A",
                                        "COMMON_ADD_TO_BASKET_ACTION" => "ADD",
                                        "COMMON_SHOW_CLOSE_POPUP" => "N",
                                        "COMPARE_ELEMENT_SORT_FIELD" => "sort",
                                        "COMPARE_ELEMENT_SORT_ORDER" => "asc",
                                        "COMPARE_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                                        "COMPARE_POSITION" => "bottom left",
                                        "COMPARE_POSITION_FIXED" => "Y",
                                        "COMPARE_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "COMPATIBLE_MODE" => "Y",
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
                                        "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
                                        "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
                                        "DETAIL_PROPERTY_CODE" => array(
                                            0 => "MAX_GRUZ",
                                            1 => "",
                                        ),
                                        "DETAIL_SET_CANONICAL_URL" => "N",
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
                                        "FILTER_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_HIDE_ON_MOBILE" => "N",
                                        "FILTER_NAME" => "arrFilter",
                                        "FILTER_PRICE_CODE" => array(
                                            0 => "Розничная",
                                        ),
                                        "FILTER_PROPERTY_CODE" => array(
                                            0 => "ATT_BRAND",
                                            1 => "FUNKCIA_PROGREV",
                                            2 => "FUNKCIA_RASTYAZHKA",
                                            3 => "FUNKCIA_MULTIMEDIA",
                                            4 => "FUNKCIA_TIP_MASSAG_STOP",
                                            5 => "FUNKCIA_3D_4D",
                                            6 => "FUNKCIA_MASSAG_KOLENEI",
                                            7 => "VID_MASSAGA",
                                            8 => "TIP_MASSAGA_JAGODIC",
                                            9 => "MASSAG_SHEI",
                                            10 => "PROGREV",
                                            11 => "RASM_DSV",
                                            12 => "SKU_COLOR",
                                            13 => "RATING",
                                            14 => "TYPE",
                                            15 => "POWER",
                                            16 => "VOLTAGE",
                                            17 => "",
                                            18 => "",
                                            19 => "",
                                            20 => "",
                                            21 => "",
                                            22 => "",
                                        ),
                                        "FILTER_VIEW_MODE" => "VERTICAL",
                                        "FORUM_ID" => "",
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
                                        "HIDE_MEASURES" => "N",
                                        "HIDE_NOT_AVAILABLE" => "L",
                                        "HIDE_NOT_AVAILABLE_OFFERS" => "L",
                                        "IBLOCK_ID" => "12",
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
                                        "MESSAGES_PER_PAGE" => "5",
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
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "Y",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => "new",
                                        "PAGER_TITLE" => "Товары",
                                        "PAGE_ELEMENT_COUNT" => "30",
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
                                        "REVIEW_IBLOCK_ID" => "",
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
                                        "SEF_FOLDER" => "/zdorovie-krasota/",
                                        "SEF_MODE" => "Y",
                                        "SET_LAST_MODIFIED" => "Y",
                                        "SET_STATUS_404" => "Y",
                                        "SET_TITLE" => "Y",
                                        "SHOW_404" => "Y",
                                        "SHOW_DEACTIVATED" => "Y",
                                        "SHOW_DISCOUNT_PERCENT" => "Y",
                                        "SHOW_LINK_TO_FORUM" => "N",
                                        "SHOW_MAX_QUANTITY" => "N",
                                        "SHOW_OLD_PRICE" => "Y",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "SHOW_SECTION_BANNER" => "N",
                                        "SHOW_TOP_ELEMENTS" => "N",
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
                                        "TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                                        "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                                        "TOP_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
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
                                        "USE_CAPTCHA" => "N",
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
                                        "USE_REVIEW" => "N",
                                        "USE_SALE_BESTSELLERS" => "N",
                                        "USE_STORE" => "N",
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "FILTER_OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "COMPARE_OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "COMPARE_OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_CART_PROPERTIES" => "",
                                        "LIST_OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "LIST_OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "LIST_OFFERS_LIMIT" => "5",
                                        "DETAIL_OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "DETAIL_OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_SORT_FIELD" => "sort",
                                        "OFFERS_SORT_ORDER" => "asc",
                                        "OFFERS_SORT_FIELD2" => "id",
                                        "OFFERS_SORT_ORDER2" => "desc",
                                        "FILE_404" => "",
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
                                        )
                                    )
                                );?>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "buy-with-this-product-new",
                                    Array(
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
                                        "CACHE_TYPE" => "A",
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
                                            0 => "TYPE",
                                            1 => "MODEL",
                                            2 => "MAX_GRUZ",
                                            3 => "POWER",
                                            4 => "VOLTAGE",
                                            5 => "TIMER",
                                            6 => "G_KRESLA",
                                            7 => "G_KOROBKI",
                                            8 => "WEIGHT",
                                            9 => "",
                                        ),
                                        "COMPATIBLE_MODE" => "Y",
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
                                            0 => "",
                                            1 => "",
                                        ),
                                        "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
                                        "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
                                        "DETAIL_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                            2 => "",
                                            3 => "",
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
                                        "FILTER_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_HIDE_ON_MOBILE" => "N",
                                        "FILTER_NAME" => "arrFilter",
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
                                            0 => "TYPE",
                                            1 => "MODEL",
                                            2 => "MAX_GRUZ",
                                            3 => "POWER",
                                            4 => "VOLTAGE",
                                            5 => "TIMER",
                                            6 => "G_KRESLA",
                                            7 => "G_KOROBKI",
                                            8 => "WEIGHT",
                                            9 => "",
                                        ),
                                        "FILTER_VIEW_MODE" => "VERTICAL",
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
                                        "HIDE_MEASURES" => "N",
                                        "HIDE_NOT_AVAILABLE" => "L",
                                        "HIDE_NOT_AVAILABLE_OFFERS" => "L",
                                        "IBLOCK_ID" => "13",
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
                                            0 => "TYPE",
                                            1 => "MODEL",
                                            2 => "MAX_GRUZ",
                                            3 => "POWER",
                                            4 => "VOLTAGE",
                                            5 => "TIMER",
                                            6 => "G_KRESLA",
                                            7 => "G_KOROBKI",
                                            8 => "WEIGHT",
                                            9 => "",
                                        ),
                                        "LIST_PROPERTY_CODE_MOBILE" => "",
                                        "LIST_SHOW_SLIDER" => "Y",
                                        "LIST_SLIDER_INTERVAL" => "3000",
                                        "LIST_SLIDER_PROGRESS" => "N",
                                        "LOAD_ON_SCROLL" => "N",
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
                                        "OFFERS_CART_PROPERTIES" => "",
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
                                        "PAGE_ELEMENT_COUNT" => "30",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
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
                                        "SEF_FOLDER" => "/fitnes/",
                                        "SEF_MODE" => "Y",
                                        "SET_LAST_MODIFIED" => "Y",
                                        "SET_STATUS_404" => "Y",
                                        "SET_TITLE" => "Y",
                                        "SHOW_404" => "Y",
                                        "SHOW_DEACTIVATED" => "Y",
                                        "SHOW_DISCOUNT_PERCENT" => "Y",
                                        "SHOW_MAX_QUANTITY" => "N",
                                        "SHOW_OLD_PRICE" => "Y",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "SHOW_SECTION_BANNER" => "N",
                                        "SHOW_TOP_ELEMENTS" => "N",
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
                                        "TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                                        "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                                        "TOP_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "TOP_PROPERTY_CODE_MOBILE" => "",
                                        "TOP_SHOW_SLIDER" => "Y",
                                        "TOP_SLIDER_INTERVAL" => "3000",
                                        "TOP_SLIDER_PROGRESS" => "N",
                                        "TOP_VIEW_MODE" => "SECTION",
                                        "USER_CONSENT" => "Y",
                                        "USER_CONSENT_ID" => "1",
                                        "USER_CONSENT_IS_CHECKED" => "Y",
                                        "USER_CONSENT_IS_LOADED" => "N",
                                        "USE_ALSO_BUY" => "N",
                                        "USE_BIG_DATA" => "N",
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
                                        "USE_REVIEW" => "N",
                                        "USE_SALE_BESTSELLERS" => "N",
                                        "USE_STORE" => "N",
                                        "COMPONENT_TEMPLATE" => "catalog-tov",
                                        "FILE_404" => "",
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
                                        )
                                    )
                                );?>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "buy-with-this-product-new",
                                    Array(
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
                                        "CACHE_TYPE" => "A",
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
                                            0 => "",
                                            1 => "",
                                        ),
                                        "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
                                        "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
                                        "DETAIL_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "DETAIL_SET_CANONICAL_URL" => "N",
                                        "DETAIL_SET_VIEWED_IN_COMPONENT" => "Y",
                                        "DETAIL_SHOW_POPULAR" => "N",
                                        "DETAIL_SHOW_SLIDER" => "N",
                                        "DETAIL_SHOW_VIEWED" => "Y",
                                        "DETAIL_STRICT_SECTION_CHECK" => "N",
                                        "DETAIL_USE_COMMENTS" => "N",
                                        "DETAIL_USE_VOTE_RATING" => "N",
                                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                        "DISCOUNT_PERCENT_POSITION" => "top-right",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DISPLAY_ELEMENT_SELECT_BOX" => "N",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "ELEMENT_SORT_FIELD" => "sort",
                                        "ELEMENT_SORT_FIELD2" => "name",
                                        "ELEMENT_SORT_ORDER" => "asc",
                                        "ELEMENT_SORT_ORDER2" => "desc",
                                        "FILTER_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_HIDE_ON_MOBILE" => "N",
                                        "FILTER_NAME" => "arrFilter",
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
                                            0 => "",
                                            1 => "",
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
                                        "HIDE_MEASURES" => "N",
                                        "HIDE_NOT_AVAILABLE" => "L",
                                        "HIDE_NOT_AVAILABLE_OFFERS" => "L",
                                        "IBLOCK_ID" => "14",
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
                                        "MESSAGES_PER_PAGE" => "5",
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
                                        "OFFERS_CART_PROPERTIES" => "",
                                        "OFFERS_SORT_FIELD" => "sort",
                                        "OFFERS_SORT_FIELD2" => "id",
                                        "OFFERS_SORT_ORDER" => "asc",
                                        "OFFERS_SORT_ORDER2" => "desc",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "Y",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => "new",
                                        "PAGER_TITLE" => "Товары",
                                        "PAGE_ELEMENT_COUNT" => "30",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
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
                                        "PRODUCT_SUBSCRIPTION" => "Y",
                                        "REVIEW_AJAX_POST" => "Y",
                                        "REVIEW_IBLOCK_ID" => "",
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
                                        "SEF_FOLDER" => "/terapiya/",
                                        "SEF_MODE" => "Y",
                                        "SET_LAST_MODIFIED" => "Y",
                                        "SET_STATUS_404" => "Y",
                                        "SET_TITLE" => "Y",
                                        "SHOW_404" => "Y",
                                        "SHOW_DEACTIVATED" => "N",
                                        "SHOW_DISCOUNT_PERCENT" => "Y",
                                        "SHOW_LINK_TO_FORUM" => "N",
                                        "SHOW_MAX_QUANTITY" => "N",
                                        "SHOW_OLD_PRICE" => "Y",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "SHOW_SECTION_BANNER" => "N",
                                        "SHOW_TOP_ELEMENTS" => "N",
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
                                        "TOP_LINE_ELEMENT_COUNT" => "3",
                                        "TOP_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "TOP_VIEW_MODE" => "SECTION",
                                        "URL_TEMPLATES_READ" => "",
                                        "USER_CONSENT" => "Y",
                                        "USER_CONSENT_ID" => "1",
                                        "USER_CONSENT_IS_CHECKED" => "Y",
                                        "USER_CONSENT_IS_LOADED" => "N",
                                        "USE_ALSO_BUY" => "N",
                                        "USE_BIG_DATA" => "N",
                                        "USE_CAPTCHA" => "N",
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
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "SEF_URL_TEMPLATES" => array(
                                            "sections" => "",
                                            "section" => "#SECTION_CODE_PATH#/",
                                            "element" => "#SECTION_CODE_PATH#/#ELEMENT_ID#/",
                                            "compare" => "compare.php?action=#ACTION_CODE#",
                                            "smart_filter" => "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
                                        ),
                                        "VARIABLE_ALIASES" => array(
                                            "compare" => array(
                                                "ACTION_CODE" => "action",
                                            ),
                                        )
                                    )
                                );?>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "buy-with-this-product-new",
                                    Array(
                                        "ACTION_VARIABLE" => "action",
                                        "ADD_ELEMENT_CHAIN" => "Y",
                                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                                        "ADD_SECTIONS_CHAIN" => "Y",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "BASKET_URL" => "/personal/kart/",
                                        "BIG_DATA_RCM_TYPE" => "personal",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "COMMON_ADD_TO_BASKET_ACTION" => "ADD",
                                        "COMMON_SHOW_CLOSE_POPUP" => "N",
                                        "COMPATIBLE_MODE" => "Y",
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
                                        "DETAIL_DETAIL_PICTURE_MODE" => "POPUP",
                                        "DETAIL_DISPLAY_NAME" => "Y",
                                        "DETAIL_DISPLAY_PREVIEW_TEXT_MODE" => "E",
                                        "DETAIL_IMAGE_RESOLUTION" => "16by9",
                                        "DETAIL_MAIN_BLOCK_PROPERTY_CODE" => "",
                                        "DETAIL_META_DESCRIPTION" => "-",
                                        "DETAIL_META_KEYWORDS" => "-",
                                        "DETAIL_PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
                                        "DETAIL_PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
                                        "DETAIL_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "DETAIL_SET_CANONICAL_URL" => "N",
                                        "DETAIL_SET_VIEWED_IN_COMPONENT" => "Y",
                                        "DETAIL_SHOW_POPULAR" => "Y",
                                        "DETAIL_SHOW_SLIDER" => "N",
                                        "DETAIL_SHOW_VIEWED" => "Y",
                                        "DETAIL_STRICT_SECTION_CHECK" => "N",
                                        "DETAIL_USE_COMMENTS" => "Y",
                                        "DETAIL_USE_VOTE_RATING" => "Y",
                                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "ELEMENT_SORT_FIELD" => "sort",
                                        "ELEMENT_SORT_FIELD2" => "name",
                                        "ELEMENT_SORT_ORDER" => "asc",
                                        "ELEMENT_SORT_ORDER2" => "desc",
                                        "FILTER_HIDE_ON_MOBILE" => "N",
                                        "FILTER_VIEW_MODE" => "VERTICAL",
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
                                        "HIDE_NOT_AVAILABLE" => "L",
                                        "HIDE_NOT_AVAILABLE_OFFERS" => "L",
                                        "IBLOCK_ID" => "15",
                                        "IBLOCK_TYPE" => "catalog",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "INSTANT_RELOAD" => "N",
                                        "LAZY_LOAD" => "N",
                                        "LINE_ELEMENT_COUNT" => "3",
                                        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
                                        "LINK_IBLOCK_ID" => "",
                                        "LINK_IBLOCK_TYPE" => "",
                                        "LINK_PROPERTY_SID" => "",
                                        "LIST_BROWSER_TITLE" => "-",
                                        "LIST_META_DESCRIPTION" => "-",
                                        "LIST_META_KEYWORDS" => "-",
                                        "LIST_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "LOAD_ON_SCROLL" => "N",
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
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => "new",
                                        "PAGER_TITLE" => "Товары",
                                        "PAGE_ELEMENT_COUNT" => "18",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "Y",
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
                                        "PRODUCT_SUBSCRIPTION" => "Y",
                                        "SEARCH_CHECK_DATES" => "Y",
                                        "SEARCH_NO_WORD_LOGIC" => "Y",
                                        "SEARCH_PAGE_RESULT_COUNT" => "50",
                                        "SEARCH_RESTART" => "N",
                                        "SEARCH_USE_LANGUAGE_GUESS" => "Y",
                                        "SECTIONS_SHOW_PARENT_NAME" => "Y",
                                        "SECTIONS_VIEW_MODE" => "TILE",
                                        "SECTION_ADD_TO_BASKET_ACTION" => "ADD",
                                        "SECTION_BACKGROUND_IMAGE" => "-",
                                        "SECTION_COUNT_ELEMENTS" => "Y",
                                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                                        "SECTION_TOP_DEPTH" => "2",
                                        "SEF_FOLDER" => "/dom-dacha/",
                                        "SEF_MODE" => "Y",
                                        "SET_LAST_MODIFIED" => "Y",
                                        "SET_STATUS_404" => "Y",
                                        "SET_TITLE" => "Y",
                                        "SHOW_404" => "Y",
                                        "SHOW_DEACTIVATED" => "Y",
                                        "SHOW_DISCOUNT_PERCENT" => "Y",
                                        "SHOW_MAX_QUANTITY" => "N",
                                        "SHOW_OLD_PRICE" => "Y",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "SHOW_TOP_ELEMENTS" => "N",
                                        "SIDEBAR_DETAIL_SHOW" => "N",
                                        "SIDEBAR_PATH" => "",
                                        "SIDEBAR_SECTION_SHOW" => "Y",
                                        "TEMPLATE_THEME" => "blue",
                                        "TOP_ADD_TO_BASKET_ACTION" => "ADD",
                                        "TOP_ELEMENT_COUNT" => "9",
                                        "TOP_ELEMENT_SORT_FIELD" => "sort",
                                        "TOP_ELEMENT_SORT_FIELD2" => "id",
                                        "TOP_ELEMENT_SORT_ORDER" => "asc",
                                        "TOP_ELEMENT_SORT_ORDER2" => "desc",
                                        "TOP_ENLARGE_PRODUCT" => "STRICT",
                                        "TOP_LINE_ELEMENT_COUNT" => "3",
                                        "TOP_PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                                        "TOP_PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                                        "TOP_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "TOP_PROPERTY_CODE_MOBILE" => "",
                                        "TOP_SHOW_SLIDER" => "Y",
                                        "TOP_SLIDER_INTERVAL" => "3000",
                                        "TOP_SLIDER_PROGRESS" => "N",
                                        "TOP_VIEW_MODE" => "SECTION",
                                        "USER_CONSENT" => "Y",
                                        "USER_CONSENT_ID" => "1",
                                        "USER_CONSENT_IS_CHECKED" => "Y",
                                        "USER_CONSENT_IS_LOADED" => "N",
                                        "USE_BIG_DATA" => "N",
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
                                        "USE_REVIEW" => "N",
                                        "USE_SALE_BESTSELLERS" => "N",
                                        "USE_STORE" => "N",
                                        "COMPONENT_TEMPLATE" => ".default",
                                        "ADD_PICT_PROP" => "-",
                                        "LABEL_PROP" => "-",
                                        "DETAIL_SHOW_MAX_QUANTITY" => "N",
                                        "DETAIL_VOTE_DISPLAY_AS_RATING" => "rating",
                                        "DETAIL_BLOG_USE" => "N",
                                        "DETAIL_VK_USE" => "N",
                                        "DETAIL_FB_USE" => "N",
                                        "FILTER_NAME" => "arrFilter",
                                        "FILTER_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_PRICE_CODE" => array(
                                            0 => "Розничная",
                                        ),
                                        "COMPARE_NAME" => "CATALOG_COMPARE_LIST",
                                        "COMPARE_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "COMPARE_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "COMPARE_ELEMENT_SORT_FIELD" => "sort",
                                        "COMPARE_ELEMENT_SORT_ORDER" => "asc",
                                        "DISPLAY_ELEMENT_SELECT_BOX" => "N",
                                        "COMPARE_POSITION_FIXED" => "Y",
                                        "COMPARE_POSITION" => "bottom left",
                                        "DETAIL_SHOW_BASIS_PRICE" => "Y",
                                        "SECTIONS_HIDE_SECTION_NAME" => "Y",
                                        "USE_ALSO_BUY" => "N",
                                        "HIDE_MEASURES" => "N",
                                        "SHOW_SECTION_BANNER" => "N",
                                        "FILTER_OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "COMPARE_OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "COMPARE_OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_CART_PROPERTIES" => "",
                                        "LIST_OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "LIST_OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "LIST_OFFERS_LIMIT" => "5",
                                        "DETAIL_OFFERS_FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "DETAIL_OFFERS_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "OFFERS_SORT_FIELD" => "sort",
                                        "OFFERS_SORT_ORDER" => "asc",
                                        "OFFERS_SORT_FIELD2" => "id",
                                        "OFFERS_SORT_ORDER2" => "desc",
                                        "SEF_URL_TEMPLATES" => array(
                                            "sections" => "",
                                            "section" => "#SECTION_CODE_PATH#/",
                                            "element" => "#SECTION_CODE_PATH#/#ELEMENT_ID#/",
                                            "compare" => "compare.php?action=#ACTION_CODE#",
                                            "smart_filter" => "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
                                        ),
                                        "VARIABLE_ALIASES" => array(
                                            "compare" => array(
                                                "ACTION_CODE" => "action",
                                            ),
                                        )
                                    )
                                );?>
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "buy-with-this-product-new",
                                    Array(
                                        "ACTION_VARIABLE" => "action",
                                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                                        "ADD_SECTIONS_CHAIN" => "Y",
                                        "ADD_TO_BASKET_ACTION" => "ADD",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "Y",
                                        "BACKGROUND_IMAGE" => "-",
                                        "BASKET_URL" => "/personal/basket.php",
                                        "BROWSER_TITLE" => "-",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "COMPATIBLE_MODE" => "Y",
                                        "CONVERT_CURRENCY" => "N",
                                        "CUSTOM_FILTER" => "",
                                        "DETAIL_URL" => "",
                                        "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                                        "DISPLAY_BOTTOM_PAGER" => "Y",
                                        "DISPLAY_COMPARE" => "N",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "ELEMENT_SORT_FIELD" => "sort",
                                        "ELEMENT_SORT_FIELD2" => "id",
                                        "ELEMENT_SORT_ORDER" => "asc",
                                        "ELEMENT_SORT_ORDER2" => "desc",
                                        "ENLARGE_PRODUCT" => "STRICT",
                                        "FILTER_NAME" => "arrFilter",
                                        "HIDE_MEASURES" => "N",
                                        "HIDE_NOT_AVAILABLE" => "L",
                                        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                                        "IBLOCK_ID" => "21",
                                        "IBLOCK_TYPE" => "catalog",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "LAZY_LOAD" => "N",
                                        "LINE_ELEMENT_COUNT" => "3",
                                        "LOAD_ON_SCROLL" => "N",
                                        "MESSAGE_404" => "",
                                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                                        "MESS_BTN_BUY" => "Купить",
                                        "MESS_BTN_DETAIL" => "Подробнее",
                                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                                        "META_DESCRIPTION" => "-",
                                        "META_KEYWORDS" => "-",
                                        "OFFERS_LIMIT" => "5",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => "new",
                                        "PAGER_TITLE" => "Товары",
                                        "PAGE_ELEMENT_COUNT" => "18",
                                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                                        "PRICE_CODE" => array(
                                            0 => "Розничная",
                                        ),
                                        "PRICE_VAT_INCLUDE" => "Y",
                                        "PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons,compare",
                                        "PRODUCT_ID_VARIABLE" => "id",
                                        "PRODUCT_PROPERTIES" => array(
                                        ),
                                        "PRODUCT_PROPS_VARIABLE" => "prop",
                                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                                        "PRODUCT_SUBSCRIPTION" => "Y",
                                        "PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "RCM_PROD_ID" => $_REQUEST["PRODUCT_ID"],
                                        "RCM_TYPE" => "personal",
                                        "SECTION_CODE" => "",
                                        "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                        "SECTION_ID_VARIABLE" => "SECTION_ID",
                                        "SECTION_URL" => "",
                                        "SECTION_USER_FIELDS" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "SEF_MODE" => "Y",
                                        "SEF_FOLDER" => "/rasprodazha/",
                                        "SET_BROWSER_TITLE" => "Y",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_META_DESCRIPTION" => "Y",
                                        "SET_META_KEYWORDS" => "Y",
                                        "SET_STATUS_404" => "N",
                                        "SET_TITLE" => "Y",
                                        "SHOW_404" => "N",
                                        "SHOW_ALL_WO_SECTION" => "Y",
                                        "SHOW_CLOSE_POPUP" => "N",
                                        "SHOW_DISCOUNT_PERCENT" => "N",
                                        "SHOW_FROM_SECTION" => "N",
                                        "SHOW_MAX_QUANTITY" => "N",
                                        "SHOW_OLD_PRICE" => "N",
                                        "SHOW_PRICE_COUNT" => "1",
                                        "SHOW_SLIDER" => "Y",
                                        "TEMPLATE_THEME" => "blue",
                                        "USE_ENHANCED_ECOMMERCE" => "N",
                                        "USE_MAIN_ELEMENT_SECTION" => "N",
                                        "USE_PRICE_COUNT" => "N",
                                        "USE_PRODUCT_QUANTITY" => "N",
                                        "COMPONENT_TEMPLATE" => "new_llisting",
                                        "SHOW_SECTION_BANNER" => "N",
                                        "USER_CONSENT" => "N",
                                        "USER_CONSENT_ID" => "0",
                                        "USER_CONSENT_IS_CHECKED" => "Y",
                                        "USER_CONSENT_IS_LOADED" => "N",
                                        "DETAIL_STRICT_SECTION_CHECK" => "N",
                                        "ADD_ELEMENT_CHAIN" => "Y",
                                        "COMPOSITE_FRAME_MODE" => "A",
                                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                                        "USE_FILTER" => "Y",
                                        "USE_REVIEW" => "N",
                                        "USE_COMPARE" => "N",
                                        "PRICE_VAT_SHOW_VALUE" => "N",
                                        "SHOW_TOP_ELEMENTS" => "Y",
                                        "TOP_ELEMENT_COUNT" => "9",
                                        "TOP_LINE_ELEMENT_COUNT" => "3",
                                        "TOP_ELEMENT_SORT_FIELD" => "sort",
                                        "TOP_ELEMENT_SORT_ORDER" => "asc",
                                        "TOP_ELEMENT_SORT_FIELD2" => "id",
                                        "TOP_ELEMENT_SORT_ORDER2" => "desc",
                                        "TOP_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "SECTION_COUNT_ELEMENTS" => "Y",
                                        "SECTION_TOP_DEPTH" => "2",
                                        "LIST_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "LIST_META_KEYWORDS" => "-",
                                        "LIST_META_DESCRIPTION" => "-",
                                        "LIST_BROWSER_TITLE" => "-",
                                        "SECTION_BACKGROUND_IMAGE" => "-",
                                        "DETAIL_PROPERTY_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "DETAIL_META_KEYWORDS" => "-",
                                        "DETAIL_META_DESCRIPTION" => "-",
                                        "DETAIL_BROWSER_TITLE" => "-",
                                        "DETAIL_SET_CANONICAL_URL" => "N",
                                        "DETAIL_CHECK_SECTION_ID_VARIABLE" => "N",
                                        "DETAIL_BACKGROUND_IMAGE" => "-",
                                        "SHOW_DEACTIVATED" => "N",
                                        "LINK_IBLOCK_TYPE" => "",
                                        "LINK_IBLOCK_ID" => "",
                                        "LINK_PROPERTY_SID" => "",
                                        "LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
                                        "USE_ALSO_BUY" => "N",
                                        "USE_GIFTS_DETAIL" => "Y",
                                        "USE_GIFTS_SECTION" => "Y",
                                        "USE_GIFTS_MAIN_PR_SECTION_LIST" => "Y",
                                        "GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
                                        "GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
                                        "GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
                                        "GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
                                        "GIFTS_SECTION_LIST_PAGE_ELEMENT_COUNT" => "4",
                                        "GIFTS_SECTION_LIST_HIDE_BLOCK_TITLE" => "N",
                                        "GIFTS_SECTION_LIST_BLOCK_TITLE" => "Подарки к товарам этого раздела",
                                        "GIFTS_SECTION_LIST_TEXT_LABEL_GIFT" => "Подарок",
                                        "GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
                                        "GIFTS_SHOW_OLD_PRICE" => "Y",
                                        "GIFTS_SHOW_NAME" => "Y",
                                        "GIFTS_SHOW_IMAGE" => "Y",
                                        "GIFTS_MESS_BTN_BUY" => "Выбрать",
                                        "GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
                                        "GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
                                        "GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
                                        "USE_STORE" => "N",
                                        "USE_ELEMENT_COUNTER" => "Y",
                                        "DETAIL_SET_VIEWED_IN_COMPONENT" => "N",
                                        "SEF_URL_TEMPLATES" => array(
                                            "sections" => "",
                                            "section" => "#SECTION_CODE_PATH#/",
                                            "element" => "#SECTION_CODE_PATH#/#ELEMENT_ID#/",
                                            "compare" => "compare.php?action=#ACTION_CODE#",
                                            "smart_filter" => "#SECTION_CODE#/filter/#SMART_FILTER_PATH#/apply/",
                                        ),
                                        "VARIABLE_ALIASES" => array(
                                            "compare" => array(
                                                "ACTION_CODE" => "action",
                                            ),
                                        )
                                    )
                                );?>
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
                            <div class="p-prods__slider">
                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:catalog.section",
                                    "buy-with-this-product-new",
                                    Array(
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
                                        "FILTER_NAME" => "arrFilter",
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
                                        "IBLOCK_ID" => $arParams["IBLOCK_ID"],
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
                                        "PAGE_ELEMENT_COUNT" => "9",
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
                                        )
                                    )
                                );?>
                            </div>
                        </div>
                    </div>
                </div>
            <?}?>

            <?global $TovId;
            $TovId = $arResult['ID']?>

                <?$APPLICATION->IncludeComponent(
                    "bitrix:catalog.products.viewed",
                    "fix",
                    Array(
                        "ACTION_VARIABLE" => "action_cpv",
                        "ADDITIONAL_PICT_PROP_1" => "-",
                        "ADDITIONAL_PICT_PROP_12" => "-",
                        "ADDITIONAL_PICT_PROP_13" => "-",
                        "ADDITIONAL_PICT_PROP_14" => "-",
                        "ADDITIONAL_PICT_PROP_15" => "-",
                        "ADDITIONAL_PICT_PROP_21" => "-",
                        "ADDITIONAL_PICT_PROP_5" => "-",
                        "ADD_PROPERTIES_TO_BASKET" => "Y",
                        "ADD_TO_BASKET_ACTION" => "ADD",
                        "BASKET_URL" => "/personal/basket.php",
                        "CACHE_GROUPS" => "Y",
                        "CACHE_TIME" => "3600",
                        "CACHE_TYPE" => "N",
                        "CART_PROPERTIES_1" => array("",""),
                        "CART_PROPERTIES_12" => array("",""),
                        "CART_PROPERTIES_13" => array("",""),
                        "CART_PROPERTIES_14" => array("",""),
                        "CART_PROPERTIES_15" => array("",""),
                        "CART_PROPERTIES_21" => array("",""),
                        "CART_PROPERTIES_5" => array("",""),
                        "COMPOSITE_FRAME_MODE" => "A",
                        "COMPOSITE_FRAME_TYPE" => "AUTO",
                        "CONVERT_CURRENCY" => "N",
                        "DEPTH" => "2",
                        "DISPLAY_COMPARE" => "N",
                        "ENLARGE_PRODUCT" => "STRICT",
                        "HIDE_NOT_AVAILABLE" => "N",
                        "HIDE_NOT_AVAILABLE_OFFERS" => "N",
                        "IBLOCK_ID" => "",
                        "IBLOCK_MODE" => "multi",
                        "IBLOCK_TYPE" => "catalog",
                        "LABEL_PROP_1" => array(),
                        "LABEL_PROP_12" => array(),
                        "LABEL_PROP_13" => array(),
                        "LABEL_PROP_14" => array(),
                        "LABEL_PROP_15" => array(),
                        "LABEL_PROP_21" => array(),
                        "LABEL_PROP_MOBILE_1" => array(),
                        "LABEL_PROP_MOBILE_12" => array(),
                        "LABEL_PROP_MOBILE_13" => array(),
                        "LABEL_PROP_MOBILE_14" => array(),
                        "LABEL_PROP_MOBILE_15" => array(),
                        "LABEL_PROP_POSITION" => "top-left",
                        "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                        "MESS_BTN_BUY" => "Купить",
                        "MESS_BTN_DETAIL" => "Подробнее",
                        "MESS_BTN_SUBSCRIBE" => "Подписаться",
                        "MESS_NOT_AVAILABLE" => "Нет в наличии",
                        "OFFER_TREE_PROPS_5" => array(),
                        "PAGE_ELEMENT_COUNT" => "9",
                        "PARTIAL_PRODUCT_PROPERTIES" => "N",
                        "PRICE_CODE" => array("Розничная"),
                        "PRICE_VAT_INCLUDE" => "Y",
                        "PRODUCT_BLOCKS_ORDER" => "buttons,price,props,sku,quantityLimit,quantity",
                        "PRODUCT_ID_VARIABLE" => "id",
                        "PRODUCT_PROPS_VARIABLE" => "prop",
                        "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                        "PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
                        "PRODUCT_SUBSCRIPTION" => "Y",
                        "PROPERTY_CODE_1" => array("",""),
                        "PROPERTY_CODE_12" => array("",""),
                        "PROPERTY_CODE_13" => array("",""),
                        "PROPERTY_CODE_14" => array("",""),
                        "PROPERTY_CODE_15" => array("",""),
                        "PROPERTY_CODE_21" => array("",""),
                        "PROPERTY_CODE_5" => array("",""),
                        "PROPERTY_CODE_52" => array("",""),						
                        "PROPERTY_CODE_MOBILE_1" => array(),
                        "PROPERTY_CODE_MOBILE_12" => array(),
                        "PROPERTY_CODE_MOBILE_13" => array(),
                        "PROPERTY_CODE_MOBILE_14" => array(),
                        "PROPERTY_CODE_MOBILE_15" => array(),
                        "PROPERTY_CODE_MOBILE_21" => array(),
                        "PROPERTY_CODE_MOBILE_52" => array(),						
                        "SECTION_CODE" => "",
                        "SECTION_ELEMENT_CODE" => "",
                        "SECTION_ELEMENT_ID" => $GLOBALS["CATALOG_CURRENT_ELEMENT_ID"],
                        "SECTION_ID" => $GLOBALS["CATALOG_CURRENT_SECTION_ID"],
                        "SHOW_CLOSE_POPUP" => "N",
                        "SHOW_DISCOUNT_PERCENT" => "N",
                        "SHOW_FROM_SECTION" => "N",
                        "SHOW_MAX_QUANTITY" => "N",
                        "SHOW_OLD_PRICE" => "N",
                        "SHOW_PRICE_COUNT" => "1",
                        "SHOW_PRODUCTS_1" => "Y",
                        "SHOW_PRODUCTS_12" => "Y",
                        "SHOW_PRODUCTS_13" => "Y",
                        "SHOW_PRODUCTS_14" => "Y",
                        "SHOW_PRODUCTS_15" => "Y",
                        "SHOW_PRODUCTS_21" => "Y",
                        "SHOW_PRODUCTS_52" => "Y",						
                        "SHOW_SLIDER" => "Y",
                        "SLIDER_INTERVAL" => "3000",
                        "SLIDER_PROGRESS" => "N",
                        "TEMPLATE_THEME" => "blue",
                        "USE_ENHANCED_ECOMMERCE" => "N",
                        "USE_PRICE_COUNT" => "N",
                        "USE_PRODUCT_QUANTITY" => "N"
                    )
                );?>


            <?/*
            <div class="p-card__prods p-card__prods2" style="display: none;">
                <div class="wrapper">
                    <div class="p-card__p-prods">
                        <b class="p-prods__title">
                            Вы недавно смотрели
                        </b>
                        <?$APPLICATION->IncludeComponent(
                            "dresscode:catalog.viewed.products",
                            "cache-prods",
                            Array(
                                'IBLOCK_MODE' => 'multi',

                            )
                        );?>
                    </div>
                </div>
            </div>
            */?>
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

<? if ( in_array(9, $arGroups)) : ?>
            <div class="modal" id="addReview">
                <div class="closs_th_modal_b"></div>
				<div class="form-pokaza__close " data-fancybox-close>
                    <span></span>
                    <span></span>
                </div>
                <div class="title_modal">
                    <div class="h2">Написать отзыв</div>
                </div>
                <form action="/ajax/addReview.php" class="js-ajax">
                    <input type="hidden" name="PRODUCT" id="" value="<?= $arResult['ID'] ?>">
                    <div class="rating_form_review">
					<div class="rating">
                        <label>
                            <input type="radio" name="RATE" value="113"/ required>
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
					</div>
                    <input type="text" name="NAME_P" id="" placeholder="Заголовок" required>
                    <input type="text" name="NAME" id="" placeholder="Имя" required>
                    <textarea name="COMMENT" id="" cols="30" rows="2" placeholder="Комментарий" required></textarea>					
                    <textarea name="ADVANTAGE" id="" cols="30" rows="2" placeholder="Преимущества"></textarea>
                    <textarea name="DISADVANTAGE" id="" cols="30" rows="2" placeholder="Недостатки"></textarea>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Lcdw-MUAAAAANewuNvmQb0ikgc-2OKf9AfjMYW_"></div>
                    </div>
                    <input type="submit" value="Отправить отзыв">
                    <p class="success"></p>
                    <p class="error"></p>
                </form>								
            </div>
        <script>
            $(document).ready(function() {
                $('.js-ajax').submit(function() {
				$.fancybox.close();
				setTimeout(function() {
    $.fancybox.open("<div class='modal-ok' id='modalloll-ok' style='display: none;'><a href='#' class='p-izgotov__close'></a><div class='p-izgotov__title'>Спасибо за Ваш отзыв!</div><div class='p-izgotov__subtitle'></div></div>");
    $('.p-izgotov__close').on('click', function() {
        $.fancybox.close();
        return false;
    });

    setTimeout(function() {
        $.fancybox.close();
    }, 2500);
}, 500);
                });
            });
        </script>			
<? endif; ?>	
		
		<?/*<script src='https://www.google.com/recaptcha/api.js'></script>

             Сдай старое получи новое 
                <div class="c-modal" id="sdai-star-pol-nov" style="display: none;">
                    <div class="c-modal__wrapper">
                        <div class="c-modal__top">
                            <div class="c-modal__title">
                                Сдай старое - получи новое!
                            </div>
                            <p class="c-modal__prevtext">
                                Поменяйте свое старое оборудование на новое.
                                Заполните данную форму для расчета вашей выгоды.
                                Бесплатная доставка действует по умолчанию.
                            </p>
                            <div class="c-modal__wplink">
                                <a href="/trade-in" class="c-modal__link">
                                    Условия акции
                                </a>
                            </div>
                            <form action="" method="post" id="trade_in_form" class="c-modal__form">
                                <div class="c-modal__row">
                                    <div style="color: red; font-size: 24px" class="error-msg">
                                    </div>
                                </div>
                                <div class="c-modal__row">
                                    <b class="c-modal__label">
                                        Ваше имя
                                    </b>
                                    <input id="trade_in_name" name="name" type="text" class="c-modal__input" placeholder="Введите имя">
                                </div>
                                <div class="c-modal__row">
                                    <b class="c-modal__label">
                                        Номер телефона
                                    </b>
                                    <input id="trade_in_phone" name="phone_number" type="text" class="c-modal__input" placeholder="+7(___)___-__-__">
                                </div>
                                <div class="c-modal__row">
                                    <b class="c-modal__label">
                                        e-mail
                                    </b>
                                    <input id="trade_in_email" name="email" type="text" class="c-modal__input" placeholder="example@email.ru">
                                </div>
                                <div class="c-modal__row">
                                    <textarea id="trade_in_text" name="textarea" class="c-modal__textarea"></textarea>
                                </div>
                                <div class="c-modal__row c-modal__row-sogl">
                                    <input name="check" type="checkbox" id="cb2">
                                    <label for="cb2">
                                        Согласие на обработку персональных данных
                                    </label>
                                </div>
                                <div class="c-modal__row">
                                    <div class="form-group">
                                        <div class="g-recaptcha" data-sitekey="6LcdxHYUAAAAAP884zsmT5mseHRbgB-97duvaEoS"></div>
                                    </div>
                                </div>
                                <div class="c-modal__btnwp">
                                    <button name="submit" id="trade_in_submit" type="submit" class="c-modal__btn">
                                        Отправить
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(function($){
                        $("#trade_in_phone").mask("+7(999) 999-99-99");
                    });
                </script> */?>

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
    
<? if ($arResult["REVIEWS"] > 0): ?>
	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">

        <meta itemprop="ratingValue" content="5">
        <meta itemprop="reviewCount" content="<?= count($arResult["REVIEWS"]) ?>">

	</div>
<? endif; ?>
	
	
    <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
        <meta itemprop="priceCurrency"
              content="<? if (!empty($arResult["MIN_PRICE"]["CURRENCY"])): ?><?= $arResult["MIN_PRICE"]["CURRENCY"] ?><? else: ?><?= CCurrency::GetBaseCurrency(); ?><? endif; ?>"/>
        <meta itemprop="price" content="<?= $arResult["MIN_PRICE"]["DISCOUNT_VALUE"] ?>"/>
        <? if ($arResult["CATALOG_QUANTITY"] > 0): ?>
            <link itemprop="availability" href="http://schema.org/InStock">
        <? else: ?>
            <link itemprop="availability" href="http://schema.org/OutOfStock">
        <? endif; ?>
		<meta itemprop="priceValidUntil" content="<?= date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 3650 day"));?>">
		<link itemprop="url" href="<?= $arResult["DETAIL_PAGE_URL"] ?>"/>
    </div>
	

        <meta itemprop="description" content="<?=$arResult["META DESCRIPTION"]["ELEMENT_META_DESCRIPTION"]; ?>"/>
		
</div>

<meta property="og:title" content="<?= $arResult["NAME"] ?>"/>
<meta property="og:description" content="<?=$arResult["META DESCRIPTION"]["ELEMENT_META_DESCRIPTION"]; ?>"/>
<meta property="og:url" content="<?= $arResult["DETAIL_PAGE_URL"] ?>"/>
<meta property="og:type" content="website"/>
<? if (!empty($arResult["IMAGES"][0]["LARGE_IMAGE"]["SRC"])): ?>
    <meta property="og:image" content="<?= $arResult["IMAGES"][0]["LARGE_IMAGE"]["SRC"] ?>"/>
<? endif; ?>

<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
<script src="//yastatic.net/share2/share.js"></script>


<div style="display: none;">
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
                                    <div class="button-color-container-v3">
                                        <a class="btn btn_big btn_red btn_radiance" href="<?=(empty($arResult["PROPERTIES"]["LINK_COLOR_FILTER"]["~VALUE"])) ? "http://relaxa.pro/" : $arResult["PROPERTIES"]["LINK_COLOR_FILTER"]["~VALUE"]?>">
                                            <div>Перейти к конфигуратору&nbsp;&nbsp;→<br>
                                                <?//<span>и получить подарок за прохождение теста</span>?></div>
                                        </a>
                                    </div>

                                    <div class="color_list_tovar">
                                        <noindex>
                                            <a rel="nofollow" href="<?=(empty($arResult["PROPERTIES"]["LINK_COLOR_FILTER"]["~VALUE"])) ? "http://relaxa.pro/" : $arResult["PROPERTIES"]["LINK_COLOR_FILTER"]["~VALUE"]?>">
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
                        <div class="tovar_right_top_img">
                            <? foreach ($arResult["PROPERTIES"]["SVOISTVA_KR"]["VALUE"] as $ifv2 => $marker2): ?>
                                <img src="/bitrix/templates/dresscodeV2/img-2/<?= $marker2 ?><? /*=strstr($arResult["PROPERTIES"]["SVOISTVA_KR"]["VALUE_XML_ID"][$ifv2], "#") ? $arResult["PROPERTIES"]["SVOISTVA_KR"]["VALUE_XML_ID"][$ifv2] : "#424242"*/ ?>"
                                     alt="">

                                <!--<div class="marker" style="background-color: <?= strstr($arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv], "#") ? $arResult["PROPERTIES"]["OFFERS"]["VALUE_XML_ID"][$ifv] : "#424242" ?>"><?= $marker ?></div>-->
                            <? endforeach; ?>
                        </div>
                        <? if (!empty($arResult["BRAND"]["PICTURE"])): ?>
                            <a href="<?= $arResult["BRAND"]["DETAIL_PAGE_URL"] ?>" class="brandImage"><img
                                        src="<?= $arResult["BRAND"]["PICTURE"]["src"] ?>"
                                        alt="<?= $arResult["BRAND"]["NAME"] ?>"></a>
                        <? endif; ?>
                        <? include($_SERVER["DOCUMENT_ROOT"] . "/" . $templateFolder . "/include/right_section.php"); ?>
                    </div>
                </div>
                <?
                $show_ship_and_pay = $arResult["PROPERTIES"]["SHIPPING_AND_PAYMENT"]["VALUE"] ? true : false;
                $show_guarantees = $arResult["PROPERTIES"]["GUARANTEES"]["VALUE"] ? true : false;
                $show_exc_and_ret = $arResult["PROPERTIES"]["EXCHANGE_AND_RETURN"]["VALUE"] ? true : false;
                ?>
                <!-- Tab links -->
                <div class="tab">
                    <button id="defaultOpen" class="tablinks" onclick="openTab(event, 'description')">Описание</button>
                    <button class="tablinks" onclick="openTab(event, 'params')">Характеристики</button>
                    <?php if ($show_ship_and_pay): ?>
                        <button class="tablinks" onclick="openTab(event, 'shipping_and_payment')">Доставка и оплата</button>
                    <?php endif ?>
                    <?php if ($show_guarantees): ?>
                        <button class="tablinks" onclick="openTab(event, 'guarantees')">Гарантии</button>
                    <?php endif ?>
                    <?php if ($show_exc_and_ret): ?>
                        <button class="tablinks" onclick="openTab(event, 'return')">Обмен и возврат</button>
                    <?php endif ?>
                    <button class="tablinks" onclick="openTab(event, 'reviews_tab')">Отзывы</button>
                </div>

                <!-- Tab content -->
                <div id="description" class="tabcontent text_block_tovar">
                    <div class="heading">Краткое описание:</div>
                    <?= $arResult["PREVIEW_TEXT"] ?>
                    <div class="title" style="color: #800000;"><?= $arResult['NAME'] ?></div>
                    <? if (!empty($arResult["DETAIL_TEXT"])): ?>
                        <div class="heading"><?= GetMessage("CATALOG_ELEMENT_DETAIL_TEXT_HEADING") ?></div>
                        <div class="ttext-ccolor">
                            <div class="changeDescription"
                                 data-first-value='<?= str_replace("'", "", $arResult["~DETAIL_TEXT"]) ?>'><?= $arResult["~DETAIL_TEXT"] ?></div>
                        </div>
                    <? endif; ?>
                </div>

                <div id="params" class="tabcontent">
                    <div class="changePropertiesGroup">
                        <?if($USER->IsAdmin()){echo "<pre>"; print_r($arPropEl);} $APPLICATION->IncludeComponent(
                            "dresscode:catalog.properties.list",
                            "group",
                            array(
                                "PRODUCT_ID" => $arResult["ID"],
                                "ELEMENT_LAST_SECTION_ID" => $arResult["LAST_SECTION"]["ID"],
                                "COMPONENT_TEMPLATE" => "group",
                                "IBLOCK_TYPE" => "catalog",
                                "IBLOCK_ID" => "1",
                                "PROP_NAME" => $arPropEl,
                                "PROP_VALUE" => "",
                                "ELEMENTS_COUNT" => "20",
                                "POP_LAST_ELEMENT" => "Y",
                                "SELECT_FIELDS" => array(
                                    0 => $arPropEl,
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
                <?php if ($show_ship_and_pay): ?>
                    <div id="shipping_and_payment" class="tabcontent text_block_tovar">
                        <div class="heading">Доставка и оплата:</div>
                        <?=$arResult["PROPERTIES"]["SHIPPING_AND_PAYMENT"]["~VALUE"]["TEXT"]?>
                    </div>
                <?php endif ?>
                <?php if ($show_guarantees): ?>
                    <div id="guarantees" class="tabcontent">
                        <div class="heading">Гарантии:</div>
                        <?=$arResult["PROPERTIES"]["GUARANTEES"]["~VALUE"]["TEXT"]?>
                    </div>
                <?php endif ?>
                <?php if ($show_exc_and_ret): ?>
                    <div id="return" class="tabcontent">
                        <div class="heading">Обмен и возврат:</div>
                        <?=$arResult["PROPERTIES"]["EXCHANGE_AND_RETURN"]["~VALUE"]["TEXT"]?>
                    </div>
                <?php endif ?>

                <div id="reviews_tab" class="tabcontent">
                    <div class="heading">Отзывы:</div>
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
<? if ( in_array(9, $arGroups)) : ?>
                    <div class="center">
                        <a href="#addReview" class="fancy-form">Добавить отзыв</a>
                    </div>
<? endif; ?>
                </div>
                <script>
                    function openTab(evt, cityName) {
                        // Declare all variables
                        var i, tabcontent, tablinks;

                        // Get all elements with class="tabcontent" and hide them
                        tabcontent = document.getElementsByClassName("tabcontent");
                        for (i = 0; i < tabcontent.length; i++) {
                            tabcontent[i].style.display = "none";
                        }

                        // Get all elements with class="tablinks" and remove the class "active"
                        tablinks = document.getElementsByClassName("tablinks");
                        for (i = 0; i < tablinks.length; i++) {
                            tablinks[i].className = tablinks[i].className.replace(" active", "");
                        }

                        // Show the current tab, and add an "active" class to the button that opened the tab
                        document.getElementById(cityName).style.display = "block";
                        evt.currentTarget.className += " active";
                    }
                    document.getElementById("defaultOpen").click();
                </script>
                <div class="similar_block_tovar">
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
				
<? if ( in_array(9, $arGroups)) : ?>
            <div class="modal" id="addReview">
                <div class="closs_th_modal_b"></div>
				<div class="form-pokaza__close " data-fancybox-close>
                    <span></span>
                    <span></span>
                </div>
                <div class="title_modal">
                    <div class="h2">Написать отзыв</div>
                </div>
                <form action="/ajax/addReview.php" class="js-ajax">
                    <input type="hidden" name="PRODUCT" id="" value="<?= $arResult['ID'] ?>">
                    <div class="rating_form_review">
					<div class="rating">
                        <label>
                            <input type="radio" name="RATE" value="113"/ required>
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
					</div>
                    <input type="text" name="NAME_P" id="" placeholder="Заголовок" required>
                    <input type="text" name="NAME" id="" placeholder="Имя" required>
                    <textarea name="COMMENT" id="" cols="30" rows="2" placeholder="Комментарий" required></textarea>					
                    <textarea name="ADVANTAGE" id="" cols="30" rows="2" placeholder="Преимущества"></textarea>
                    <textarea name="DISADVANTAGE" id="" cols="30" rows="2" placeholder="Недостатки"></textarea>
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="6Lcdw-MUAAAAANewuNvmQb0ikgc-2OKf9AfjMYW_"></div>
                    </div>
                    <input type="submit" value="Отправить отзыв">
                    <p class="success"></p>
                    <p class="error"></p>
                </form>								
            </div>
        <script>
            $(document).ready(function() {
                $('.js-ajax').submit(function() {
				$.fancybox.close();
				setTimeout(function() {
    $.fancybox.open("<div class='modal-ok' id='modalloll-ok' style='display: none;'><a href='#' class='p-izgotov__close'></a><div class='p-izgotov__title'>Спасибо за Ваш отзыв!</div><div class='p-izgotov__subtitle'></div></div>");
    $('.p-izgotov__close').on('click', function() {
        $.fancybox.close();
        return false;
    });

    setTimeout(function() {
        $.fancybox.close();
    }, 2500);
}, 500);
                });
            });
        </script>			
<? endif; ?>

            </div>
        </div>
    </div>
    <div id="<?= $this->GetEditAreaId($arResult["ID"]); ?>">
        <div style="display: none" id="catalogElement"
             class="item<? if (!empty($arResult["SKU_PRODUCT"])): ?> elementSku<? endif; ?>"
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
                        </div>
                        <div class="col<? if (empty($arResult["PREVIEW_TEXT"]) && empty($arResult["SKU_PRODUCT"]) && empty($arResult["DISPLAY_PROPERTIES"])): ?> hide<? endif; ?> skrivaem-1">
                            <? if (!empty($arResult["BRAND"]["PICTURE"])): ?>
                                <a href="<?= $arResult["BRAND"]["DETAIL_PAGE_URL"] ?>" class="brandImage"><img
                                            src="<?= $arResult["BRAND"]["PICTURE"]["src"] ?>"
                                            alt="<?= $arResult["BRAND"]["NAME"] ?>"></a>
                            <? endif; ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
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

<? if ($arResult["REVIEWS"] > 0): ?>
	<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">

        <meta itemprop="ratingValue" content="5">
        <meta itemprop="reviewCount" content="<?= count($arResult["REVIEWS"]) ?>">

	</div>
<? endif; ?>
	
        <div itemprop="offers" itemscope itemtype="http://schema.org/Offer">
            <meta itemprop="priceCurrency"
                  content="<? if (!empty($arResult["MIN_PRICE"]["CURRENCY"])): ?><?= $arResult["MIN_PRICE"]["CURRENCY"] ?><? else: ?><?= CCurrency::GetBaseCurrency(); ?><? endif; ?>"/>
            <meta itemprop="price" content="<?= $arResult["MIN_PRICE"]["DISCOUNT_VALUE"] ?>"/>
            <? if ($arResult["CATALOG_QUANTITY"] > 0): ?>
                <link itemprop="availability" href="http://schema.org/InStock">
            <? else: ?>
                <link itemprop="availability" href="http://schema.org/OutOfStock">
            <? endif; ?>
			<meta itemprop="priceValidUntil" content="<?= date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 3650 day"));?>">
			<link itemprop="url" href="<?= $arResult["DETAIL_PAGE_URL"] ?>"/>			
        </div>
							
		<meta itemprop="description" content="<?=$arResult["META DESCRIPTION"]["ELEMENT_META_DESCRIPTION"]; ?>"/>		
		
    </div>

    <meta property="og:title" content="<?= $arResult["NAME"] ?>"/>
    <meta property="og:description" content="<?=$arResult["META DESCRIPTION"]["ELEMENT_META_DESCRIPTION"]; ?>"/>
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
                                "techbox:catalog.section",
                                "squares",
                                array(
                                    "IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
                                    "IBLOCK_ID" => [1,12,13,14,15,21],
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
</div>
<?if($arResult['CATALOG_QUANTITY'] && $arResult['CATALOG_QUANTITY'] > 0 && empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
    ?>
    <script>
        $(document).ready(function() {
            $('.heading-modal-js').text('Купить в один клик');
            $('.title-modal-js').text('Заполните данные для заказа');
        });
    </script>
    <?
} elseif($arResult['CATALOG_QUANTITY'] == 0 && empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
    ?>

    <?
} elseif(!empty($arResult['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'])) {
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
}?>
<script>
    $(document).ready(function() {
        $('.p-cardheader__link-srav').on('click', function() {
            $(this).children('svg').children('path').attr('stroke', '#F93');
            $('.p-carddes__subbtnlink.addCompare').trigger('click');
            $(this).on('click', function() {
                var url = $(this).attr('href');
                $(location).attr('href',url);
            });
            return false;
        });
        $('.p-cardheader__link-izbr').on('click', function() {
            $(this).html('<svg width="26" height="24" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 22 20" style="enable-background:new 0 0 22 20;" xml:space="preserve"> <g id="Layer_54"> <path d="M11,19.2c-0.6,0-1.1-0.2-1.5-0.6l-7.5-7.5C0.8,9.9,0.1,8.3,0.1,6.6c0-3.2,2.7-5.8,5.9-5.8c0,0,0,0,0,0 c1.6,0,3.1,0.6,4.2,1.7L11,3.2l0.6-0.6l0,0c2.1-2.2,5.5-2.5,8-0.6c2.6,2,3.1,5.8,1.1,8.4c-0.2,0.2-0.3,0.4-0.5,0.6l-7.6,7.6 C12.1,19,11.5,19.2,11,19.2z" fill="#F93" stroke="#ffffff" /> </g> </svg>');
            $('.p-carddes__subbtnlink.addWishlist').trigger('click');
            $(this).on('click', function() {
                var url = $(this).attr('href');
                $(location).attr('href',url);
            });
            return false;
        });
    });
</script>

<script>
    /*
    $(document).ready(function(){
        var $element = $('.p-card__infoadd');
        var newheight = $element.height();
        let counter = 0;
        $(window).scroll(function() {
            var scroll = $(window).scrollTop() + $(window).height();
            //Если скролл до конца елемента
            //var offset = $element.offset().top + $element.height();
            //Если скролл до начала елемента
            var offset = $element.offset().top + newheight;

            if (scroll > offset && counter == 0) {
                $('.p-botomfix').hide();
            } else {
                $('.p-botomfix').show();
            }
        });

        $('.p-tabs__item').on('click', function() {
            var $element = $('.p-card__infoadd');
            var newheight = $element.height();
            let counter = 0;
            $(window).scroll(function() {
                var scroll = $(window).scrollTop() + $(window).height();
                //Если скролл до конца елемента
                //var offset = $element.offset().top + $element.height();
                //Если скролл до начала елемента
                var offset = $element.offset().top + newheight;

                if (scroll > offset && counter == 0) {
                    $('.p-botomfix').hide();
                } else {
                    $('.p-botomfix').show();
                }
            });
        });
    });
    */
</script>
<style>
    @media(max-width: 767px) {
        body .p-izgotov__label {
            font-size: 16px !important;
            width: 100% !important;
            display: block !important;
            padding-right: 70px !important;
        }
        body .p-izgotov__label-sub {
            font-size: 16px !important;
            left: auto !important;
            right: 0 !important;
        }
    }
   
</style>
