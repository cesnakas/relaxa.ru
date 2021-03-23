<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); $this->setFrameMode(true);
?>


<link href="/bitrix/templates/dresscodeV2/components/dresscode/catalog.compare/styles.css" type="text/css" rel="stylesheet">
<script type="text/javascript" src="/bitrix/templates/dresscodeV2_new/js/jquery.js"></script>
<script type="text/javascript" src="/bitrix/templates/dresscodeV2_new/js/slick.min.js"></script>

<script type="text/javascript" src="/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.min.js"></script>
<script src="/bitrix/templates/dresscodeV2/components/bitrix/catalog/.default/bitrix/catalog.element/element_with_tabs_new/js/maskinput.js"></script>
<script src="/bitrix/templates/dresscodeV2/components/bitrix/catalog/.default/bitrix/catalog.element/element_with_tabs_new/js/ajax.js"></script>


<?
$iBlock['ID'] = 1;
$arFilter = array('IBLOCK_ID' => $iBlock['ID'], 'ACTIVE' => 'Y', 'ID', 'IBLOCK_SECTION_ID' => $arSection["ID"], '!PROPERTY_DO_NOT_SHOW' => 'Y');
$elements = CIBlockElement::GetList (
    array(), $arFilter, false, false, array(
        'ID',
        'NAME',
        'IBLOCK_SECTION_ID',
        'PREVIEW_TEXT',
        'DETAIL_PICTURE',
        'DETAIL_PAGE_URL',
        'PROPERTY_ATT_BRAND',
        'PROPERTY_CML2_ARTICLE',
        'PROPERTY_SERT',
        'PROPERTY_DOCS',
        'PROPERTY_VIP_PRICE',
        'PROPERTY_VIP_DEMO_PRICE',
        'PROPERTY_PREMIUM_PRICE',
        'PROPERTY_DEALER_PRICE',
        'PROPERTY_INFORM_LINKS',
        'PROPERTY_RASM_DSV',
        'PROPERTY_VES_NETTO',
        'PROPERTY_VES_BRUTTO',
        'PROPERTY_AV_STATUS',
        'PROPERTY_CONDITION',
        'PROPERTY_COND_DESC',
        'PROPERTY_GIFTS',
        'PROPERTY_MANUFACTURE',
        'PROPERTY_GUARANTEE',
        'PROPERTY_NO_DISCOUNT',
        'PROPERTY_BARCODE',
        'PROPERTY_TYPE',
        'PROPERTY_NAZNACHENIE',
        'PROPERTY_SERIYA',
        'PROPERTY_MODEL',
        'PROPERTY_GOST',
        'PROPERTY_COMPOSITION',
        'PROPERTY_PLOTNOST',
        'PROPERTY_MATERIAL',
        'PROPERTY_MATERIAL_OBIVKI',
        'PROPERTY_TEST_MARTINDEJLA',
        'PROPERTY_STRANA_PROIZVODITEL',
        'PROPERTY_MANUFACTURER',
        'PROPERTY_PRODAVEC',
        'PROPERTY_GUARANTEE',
        'PROPERTY_OFFERS',
        'PROPERTY_FUNKCIA_SKAN_ROSTA',
        'PROPERTY_FUNKCII_REGULIROVKI',
        'PROPERTY_AIR_BAGS',
        'PROPERTY_UPRAVLENIE',
        'PROPERTY_NAKLON_BLOKA_DLYA_NOG',
        'PROPERTY_AUTO_OFF',
        'PROPERTY_V_MEMORY',
        'PROPERTY_PODGOLOVNIK',
        'PROPERTY_AUTO_RASKLAD',
        'PROPERTY_POVOROTNAYA_BAZA',
        'PROPERTY_UGOL_NAKLONA_KRESLA',
        'PROPERTY_KOLICHESTVO_ROL_BACK',
        'PROPERTY_RECOMMEND_HEIGHT',
        'PROPERTY_INDIKATOR_VREMENI_PROGRAMMY',
        'PROPERTY_FUNKCIA_MASSAZH_KARETKA',
        'PROPERTY_DLINA_HODA_KARETKI',
        'PROPERTY_VID_MASSAGA',
        'PROPERTY_ZONY_MASSAZHA',
        'PROPERTY_ZONY_PROGREVA',
        'PROPERTY_FUNKCIA_NEVESOMOSTI',
        'PROPERTY_FUNKCIA_VPLOTNUU_STENE',
        'PROPERTY_WALL',
        'PROPERTY_FUNKCIA_RASTYAZHKA',
        'PROPERTY_MASSAGE_SHEI',
        'PROPERTY_MASSAGE_NOG',
        'PROPERTY_FUNKCIA_MASSAG_KOLENEI',
        'PROPERTY_VID_MASSAGE_CALF',
        'PROPERTY_FUNKCIA_TIP_MASSAG_STOP',
        'PROPERTY_VID_MASSAGA_JAGODIC',
        'PROPERTY_FUNKCIA_3D_4D',
        'PROPERTY_AUTO_PROGRAMM',
        'PROPERTY_KOLICHESTVO_ROLIKOV',
        'PROPERTY_OPTIONS_COMFORT',
        'PROPERTY_PORT_DLYA_ZARYADKI',
        'PROPERTY_FUNKCIA_MULTIMEDIA',
        'PROPERTY_YAZIK',
        'PROPERTY_TIMER',
        'PROPERTY_POWER',
        'PROPERTY_POTR_MOSH',
        'PROPERTY_VOLTAGE',
        'PROPERTY_PITANIYE',
        'PROPERTY_CHASTOTA',
        'PROPERTY_AIR_COMPRESSION',
        'PROPERTY_SAFE',
        'PROPERTY_NOISE',
        'PROPERTY_ION',
        'PROPERTY_WAIT',
        'PROPERTY_MAX_GRUZ',
        'PROPERTY_KOLICHESTVO_KAMER',
        'PROPERTY_KOLICHESTVO_KANALOV',
        'PROPERTY_KOLICHESTVO_PROGRAMM',
        'PROPERTY_PROGRAMMY',
        'PROPERTY_DAVLENIE',
        'PROPERTY_REGULIROVKA_DAVLENIYA',
        'PROPERTY_SHAG_IZMENENIYA_DAVLENIYA',
        'PROPERTY_OTKLYUCHENIE_DAVLENIYA_V_KAMERAH',
        'PROPERTY_DISPLEJ',
        'PROPERTY_KOMPLEKTACIYA',
        'PROPERTY_VES_KOMPRESSORA',
        'PROPERTY_GABARITN_DS',
        'PROPERTY_GABARUTN_SID',
        'PROPERTY_R_HEIGHT',
        'PROPERTY_R_WIDTH',
        'PROPERTY_G_KRESLA',
        'PROPERTY_G_KOROBKI',
        'PROPERTY_G_KOROBKI2',
        'PROPERTY_G_KOROBKI3',
        'PROPERTY_VESKOROBKI1',
        'PROPERTY_VESKOROBKI2',
        'PROPERTY_VESKOROBKI3',
    )
);
?>




<script>
    /* Новые скрипты для карточки */
    $(document).ready(function() {

// Подпишемся на ресайз и продиспатчим его для запуска <link rel="stylesheet" href="/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.min.css">
$(window).on('resize', function(e){
  // Переменная, по которой узнаем запущен слайдер или нет.
  // Храним её в data
  var init = $(".responsive").data('init-slider');
  // Если мобильный
  if(window.innerWidth < 768){
    // Если слайдер не запущен
    /*if(init != 1){*/
      // Запускаем слайдер и записываем в data init-slider = 1
      $('.responsive').slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1
      }).data({'init-slider': 1});
	  
	  document.getElementById("fullscreen_left").remove();
   /* }*/
  }
  // Если десктоп
  else {  
    // Если слайдер запущен
   /* if(init == 1){*/
      // Разрушаем слайдер и записываем в data init-slider = 0
      /*$('.responsive').slick('unslick').data({'init-slider': 0});*/
	   $('.responsive').slick({
        infinite: true,
        slidesToShow: 3,
        slidesToScroll: 1,
		variableWidth: true,
      }).data({'init-slider': 0});  
    /*}*/	
  var slideIndex = $(".responsive").length

  $('.responsive').slick('slickRemove', slideIndex - 1);
  }
}).trigger('resize');

		
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
<style>
.p-prods__itemwp {
	width: auto !important;
}

.slick-list draggable{
	padding: 0;
}
</style>
<?if(!empty($arResult["ITEMS"])):?>
<div id="compare">
<?if($USER->isAdmin()) :?>


	<div id="compareBlock">
		<table>
			<tr>				
				<td class="right">
					<div id="scrollTable">
					
					
					
				<div class="left" id="fullscreen_left">
					<div class="wrap">					
						<div class="headingTools">
						<div class="headingTools_comprare_img"></div>
						<div class="all_tools">
							<div class="leftTools">
								<a href="#" class="all"><?=GetMessage("ALLFEATURES");?></a>
								<a href="#" class="different"><?=GetMessage("DISTINGUISHED");?></a>
							</div>
							<div id="compareTools">
								<a href="#" class="hide"><?=GetMessage("HIDE");?></a>
								<a href="#" class="show"><?=GetMessage("SHOW");?></a>
							</div>
						</div>
						</div>
						<div class="checks_prop">
							<div class="checks_prop_all">
							<input type="checkbox" class="allcheckbox">
							<label>Отметить/снять все</label>
							</div>
						<ul class="propList" id="compareCheck">
							<?if(!empty($arResult["PROPERTIES"])):?>
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
				'VIDEO_CONTENT',
				'GIFT_LINK',
				'FIELD',
];
								foreach ($arResult["PROPERTIES"] as $key => $arValues):?>
								<? if (($arValues["SORT"] <= 5000) && !in_array($arValues['CODE'], $for_unset)):?>								
								<li data-id="<?=$arValues["ID"]?>">								
									<input type="checkbox" name="<?=$arValues["ID"]?>" id="<?=$arValues["ID"]?>" value="Y">
									<label data-id="<?=$arValues["ID"]?>" title="<?=$arValues["NAME"]?>"><?=$arValues["NAME"]?></label>
								</li>								
								<?endif;?>	
								<?endforeach;?>
							<?endif;?>
						</ul>	
						
						
						</div>
					</div>
				</div>					


					
				<ul class="responsive">
				<li class="left">
					<div class="wrap">					
						<div class="headingTools">
						<div class="headingTools_comprare_img"></div>
						<div class="all_tools">
							<div class="leftTools">
								<a href="#" class="all"><?=GetMessage("ALLFEATURES");?></a>
								<a href="#" class="different"><?=GetMessage("DISTINGUISHED");?></a>
							</div>
							<div id="compareTools">
								<a href="#" class="hide"><?=GetMessage("HIDE");?></a>
								<a href="#" class="show"><?=GetMessage("SHOW");?></a>
							</div>
						</div>
						</div>
						<div class="checks_prop">
							<div class="checks_prop_all">
							<input type="checkbox" class="allcheckbox">
							<label>Отметить/снять все</label>
							</div>
						<ul class="propList" id="compareCheck">
							<?if(!empty($arResult["PROPERTIES"])):?>
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
				'VIDEO_CONTENT',
				'GIFT_LINK',
				'FIELD',
];
								foreach ($arResult["PROPERTIES"] as $index => $arValues):?>
								<? if (($arValues["SORT"] <= 5000) && !in_array($arValues['CODE'], $for_unset)):?>
								<li data-id="<?=$arValues["ID"]?>">
									<input type="checkbox" name="<?=$arValues["ID"]?>" id="<?=$arValues["ID"]?>" value="Y">
									<label data-id="<?=$arValues["ID"]?>" title="<?=$arValues["NAME"]?>"><?=$arValues["NAME"]?></label>
								</li>
								<?endif;?>	
								<?endforeach;?>
							<?endif;?>
						</ul>
						</div>
					</div>
				</li>						
						
                    <?foreach($arResult["ITEMS"] as $index => $arElement):?>
					<?  $this->AddEditAction($arElement["ID"], $arElement["EDIT_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_EDIT"));
                        $this->AddDeleteAction($arElement["ID"], $arElement["DELETE_LINK"], CIBlock::GetArrayByID($arElement["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
                        $arElement["IMAGE"] = CFile::ResizeImageGet($arElement["DETAIL_PICTURE"], array("width" => 270, "height" => 250), BX_RESIZE_IMAGE_PROPORTIONAL, false);
                            if (empty($arElement["IMAGE"])) {
                                $arElement["IMAGE"]["src"] = SITE_TEMPLATE_PATH . "/images/empty.png";
								}
					?>
						<li>
                            <div class="p-prods__item" id="<?= $this->GetEditAreaId($arElement["ID"]); ?>">							
                                <div class="p-prods__itemwp" id="p-prods__itemwp__compare">
								<ins data-id="<?=$arElement["ID"]?>"></ins>
                                    <? if ($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") { ?>
                                        <div class="p-prods-izgotzak">
                                            <svg width="21" height="21" viewBox="0 0 21 21" fill="none"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M17.4871 14.346L18.7895 15.6484L15.6484 18.7895L14.346 17.4871C13.825 17.7782 13.2887 17.9927 12.7218 18.1613V20H8.27823V18.1613C7.71129 17.9927 7.175 17.7782 6.65403 17.4871L5.35161 18.7895L2.21048 15.6484L3.5129 14.346C3.22177 13.825 3.00726 13.2887 2.83871 12.7218H1V8.27823H2.83871C3.00726 7.71129 3.22177 7.175 3.5129 6.65403L2.21048 5.35161L5.35161 2.21048L6.65403 3.5129C7.175 3.22178 7.71129 3.00726 8.27823 2.83871V1H12.7218V2.83871C13.2887 3.00726 13.825 3.22178 14.346 3.5129L15.6484 2.21048L18.7895 5.35161L17.4871 6.65403C17.7782 7.175 17.9927 7.71129 18.1613 8.27823H20V12.7218H18.1613C17.9927 13.2887 17.7629 13.825 17.4871 14.346ZM19.3871 8.89113H17.6863L17.625 8.66129C17.4565 8.00242 17.196 7.35887 16.8435 6.76129L16.721 6.5621L17.9315 5.35161L15.6637 3.08387L14.4532 4.29435L14.254 4.17177C13.6565 3.81936 13.0129 3.55887 12.354 3.39032L12.1242 3.32903V1.6129H8.90645V3.31371L8.67661 3.375C8.01774 3.54355 7.37419 3.80403 6.77661 4.15645L6.57742 4.27903L5.36694 3.06855L3.08387 5.35161L4.29435 6.5621L4.17177 6.76129C3.81936 7.35887 3.55887 8.00242 3.39032 8.66129L3.32903 8.89113H1.6129V12.1089H3.31371L3.375 12.3387C3.54355 12.9976 3.80403 13.6411 4.15645 14.2387L4.27903 14.4379L3.06855 15.6484L5.33629 17.9161L6.54677 16.7056L6.74597 16.8282C7.34355 17.1806 7.9871 17.4411 8.64597 17.6097L8.87581 17.671V19.3871H12.0935V17.6863L12.3234 17.625C12.9823 17.4565 13.6258 17.196 14.2234 16.8435L14.4226 16.721L15.6331 17.9315L17.9008 15.6637L16.6903 14.4532L16.8129 14.254C17.1653 13.6565 17.4258 13.0129 17.5944 12.354L17.6556 12.1242H19.3871V8.89113Z"
                                                      fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                                <path d="M10.4999 15.4032C7.80313 15.4032 5.59668 13.1967 5.59668 10.5C5.59668 7.8032 7.80313 5.59675 10.4999 5.59675C13.1967 5.59675 15.4031 7.8032 15.4031 10.5C15.4031 13.1967 13.1967 15.4032 10.4999 15.4032ZM10.4999 6.20965C8.14023 6.20965 6.20958 8.1403 6.20958 10.5C6.20958 12.8596 8.14023 14.7903 10.4999 14.7903C12.8596 14.7903 14.7902 12.8596 14.7902 10.5C14.7902 8.1403 12.8596 6.20965 10.4999 6.20965Z"
                                                      fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                                <path d="M12.5838 12.8904L10.4387 10.7299L9.9943 11.1743L9.77979 10.9597L10.2241 10.5154L9.77979 10.071L9.9943 9.85651L10.4387 10.3009L11.7564 8.98312L11.9709 9.19764L10.6532 10.5154L12.7983 12.6605L12.5838 12.8904Z"
                                                      fill="#17A502" stroke="#17A502" stroke-miterlimit="10"/>
                                                <path d="M10.7144 14.3153H10.2854V13.9629H10.7144V14.3153Z"
                                                      fill="#17A502"
                                                      stroke="#17A502" stroke-miterlimit="10"/>
                                                <path d="M10.7144 7.15967H10.2854V6.80725H10.7144V7.15967Z"
                                                      fill="#17A502"
                                                      stroke="#17A502" stroke-miterlimit="10"/>
                                                <path d="M13.9017 10.7145H13.5493V10.2854H13.9017V10.7145Z"
                                                      fill="#17A502"
                                                      stroke="#17A502" stroke-miterlimit="10"/>
                                                <path d="M7.35877 10.7145H7.00635V10.2854H7.35877V10.7145Z"
                                                      fill="#17A502"
                                                      stroke="#17A502" stroke-miterlimit="10"/>
                                            </svg>
                                            Закажи своё кресло
                                        </div>
                                    <? } else { ?>
                                        <? if ($arElement['CATALOG_QUANTITY'] && $arElement['CATALOG_QUANTITY'] > 0 && empty($arElement['PROPERTIES']['STATUS_OUT']['VALUE'])) {
                                            ?>
                                            <span class="p-prods__nal">Есть в наличии</span>
                                            <?
                                        } elseif ($arElement['CATALOG_QUANTITY'] == 0 && empty($arElement['PROPERTIES']['STATUS_OUT']['VALUE'])) {
                                            ?>
                                            <span class="p-prods__nal p-prods__nal-snyat">Нет в наличии</span>
                                            <?
                                        } elseif(!empty($arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE']) && !empty($arElement['PROPERTIES']['STATUS_OUT']['VALUE'])) {
                                            ?>
                                            <span class="p-prods__nal p-prods__nal-pos">Поступит: <?= $arElement['PROPERTIES']['BE_AVAILABLE_DATE']['VALUE'] ?></span>
                                            <?
                                        } else {
                                            ?>
                                            <span class="p-prods__nal p-prods__nal-no">Доступен предзаказ</span>
                                            <?
                                        } ?>
                                        <?
                                    } ?>


                                    <div class="p-prods__imgwp-wp">

                                        <a href="<?= $arElement['DETAIL_PAGE_URL'] ?>" class="p-prods__imgwp"
                                           style="display: block; background-image: url(<?= $arElement["IMAGE"]["src"] ?>);">
                                                <div class="p-prods__tag">
                                                    <? if (is_array($arElement["PROPERTIES"]["OFFERS"]["VALUE"])) { ?>
                                                        <? foreach ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] as $ifv => $marker): ?>
                                                            <?if(empty($arElement["PROPERTIES"]["STATUS_OUT"]["VALUE"])) {?>
                                                                <? if ($marker == "NEW") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #37ac09;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "HIT") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #3254AD;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "LOVE") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #B710A0;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "АКЦИЯ") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #CC0000;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "SALE") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #7D0483;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "-5%") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #e63244;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "-10%") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #E53744;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "-15%") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #CD4741;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "-20%") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #B50428;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "-25%") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #940123;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "-7%") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #EB3144;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "НА ЗАКАЗ") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="background-color: #780707; font-size: 10px !important;"><?= $marker ?></span>
                                                                <? } elseif ($marker == "ZEN" || $arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "ZEN") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/zen_gm-03.svg); background-size: 60%; background-repeat: no-repeat; left: -10px; line-height: 0px !important; top: 1px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $marker ?></span>
																<? } elseif ($marker == "NOVEMBER" || $arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "NOVEMBER") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/generous_nov.svg); background-size: 45%; background-repeat: no-repeat; line-height: 0px !important; top: 1px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $marker ?></span>
																<? } elseif ($marker == "NY" || $arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "NY") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/ny30.svg); background-size: 54%; background-repeat: no-repeat; line-height: 0px !important; top: -2px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $marker ?></span>
																<? } elseif ($marker == "NY GIFT" || $arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "NY GIFT") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/ny_gift.svg); background-size: 54%; background-repeat: no-repeat; line-height: 0px !important; top: -2px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $marker ?></span>
																<? } elseif ($marker == "FROZEN" || $arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "FROZEN") { ?>
                                                                    <span class="p-prods__new"
                                                                          style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/frozen.svg); background-size: 54%; background-repeat: no-repeat; line-height: 0px !important; top: -2px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $marker ?></span>			  
                                                                <?}?>
																	<?} elseif(!empty($arElement["PROPERTIES"]["STATUS_OUT"]["VALUE"])){?>
																		<span class="p-prods__new" style="background-color: #F36525;"><?=  "PRESALE"  ?></span>
																	<?}?>
													<? endforeach; ?>
                                                    <? } else { ?>
													<?if(empty($arElement["PROPERTIES"]["STATUS_OUT"]["VALUE"])) {?>
                                                        <? if ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "NEW") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #37ac09;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "HIT") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #3254AD;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "PRESALE") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #F36525;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "LOVE") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #B710A0;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "АКЦИЯ") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #CC0000;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "SALE") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #7D0483;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-5%") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #e63244;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-10%") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #E53744;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-15%") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #CD4741;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-20%") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #B50428;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-25%") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #940123;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "-7%") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #EB3144;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "НА ЗАКАЗ") { ?>
                                                            <span class="p-prods__new"
                                                                  style="background-color: #780707; font-size: 10px !important;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
                                                        <? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "ZEN") { ?>
                                                            <span class="p-prods__new"
                                                                  style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/zen_gm-03.svg); background-size: 60%; background-repeat: no-repeat; left: -10px; line-height: 0px !important; top: 1px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
														<? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "NOVEMBER") { ?>
                                                            <span class="p-prods__new"
                                                                  style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/generous_nov.svg); background-size: 45%; background-repeat: no-repeat; line-height: 0px !important; top: 1px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
														<? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "NY") { ?>
                                                            <span class="p-prods__new"
                                                                  style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/ny30.svg); background-size: 54%; background-repeat: no-repeat; line-height: 0px !important; top: -2px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
														<? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "NY GIFT") { ?>
                                                            <span class="p-prods__new"
                                                                  style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/ny_gift.svg); background-size: 54%; background-repeat: no-repeat; line-height: 0px !important; top: -2px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>
														<? } elseif ($arElement["PROPERTIES"]["OFFERS"]["VALUE"] == "FROZEN") { ?>
                                                            <span class="p-prods__new"
                                                                  style="font-size: 24px !important; position: absolute; background-color: transparent; color: transparent; background-image: url(/img/svg/frozen.svg); background-size: 54%; background-repeat: no-repeat; line-height: 0px !important; top: -2px; margin-top: 10px; height: 100px !important; -webkit-transform: rotate(45deg); -moz-transform: rotate(45deg); -ms-transform: rotate(45deg); -o-transform: rotate(45deg) !important; transform: rotate(45deg) !important;"><?= $arElement["PROPERTIES"]["OFFERS"]["VALUE"] ?></span>	
                                                       <?}?>
														<?} elseif(!empty($arElement["PROPERTIES"]["STATUS_OUT"]["VALUE"])){?>
															<span class="p-cardslider__new" style="background-color: #F36525;"><?=  "PRESALE"  ?></span>
														<?}?>
													<?}?>	
                        </div>
                                        </a>
                                    </div>
                                    <a href="<?= $arElement['DETAIL_PAGE_URL'] ?>" class="p-prods__title">
                                        <?= $arElement['NAME'] ?>
                                    </a>
									

									<?
									$oldprice = $arElement['PROPERTIES']['AFP_OLDPRICE']['VALUE'];
									$oldprice_format = number_format( $oldprice, 0, ',', ' ' ) . ' руб.';
									?>									
									
									
                                    <? if (!empty($arElement['PRICE'])) { ?>
											<div class="p-prods__prices">
											<span class="p-prods__price">
											<? if ($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") { ?>от <? } ?>
											<?= $arElement['PRICE']?>
											</span>
											<span class="p-prods__priceold">											
											<?/*= $arElement['PROPERTIES']['OLD_PRICE']["VALUE"]*/?>
											<? if ($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] != "Y") { ?>
											<?= $oldprice_format?>
											<? } ?>
											</span>
                                            <? if ($arElement['DISCOUNT_PRICE'] > 0): ?>
                                            <? if ($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] != "Y") { ?>
                                            <span class="p-prods__priceold">
											<?= $arElement['DISCOUNT_PRICE'] ?>
											</span>
                                            <? } ?>
                                            <? endif; ?>
											</div>
											<? } else { ?>
											<? if (!empty($arElement["MIN_PRICE"])): ?>
                                            <div class="p-prods__prices">
											<span class="p-prods__price">
											<? if ($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") { ?>от <? } ?>
											<?= $arElement["MIN_PRICE"]["PRINT_DISCOUNT_VALUE"] ?>
											</span>
                                            <? if (!empty($arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"]) && $arElement["MIN_PRICE"]["PRINT_DISCOUNT_DIFF"] > 0): ?>
                                            <? if ($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] != "Y") { ?>
                                            <span class="p-prods__priceold">
											<?= $arElement["MIN_PRICE"]["PRINT_VALUE"] ?>
											</span>
                                             <? } ?>
                                             <? endif; ?>
                                            </div>
                                            <?else:?>
                                            <span class="p-prods__price">
											<?=GetMessage("REQUEST_PRICE_LABEL")?>
											</span>
                                        <? endif; ?>
                                        <? } ?>

                                    <?
                                    $ar_resTov = "";
                                    $ar_resTov = CCatalogProduct::GetByID($arResult["ID"]);
                                    ?>

                                    <? if ($arElement["PROPERTIES"]['IZGOT_ZAK']['VALUE'] == "Y") { ?>
                                        <a href="#izgotovnazakaz" class="p-prods__nazakaz fb-modal"
                                           data-id="<?= $arElement["ID"] ?>">
                                            Изготовление на заказ
                                        </a>
                                        <a href="#izgotovnazakaz" class="p-prods__sdelzak fb-modal"
                                           data-id="<?= $arElement["ID"] ?>">
                                            <i class="p-prods__buyoneclick-icon">
                                                <svg width="17" height="17" viewBox="0 0 17 17" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M7.84617 11.7692C7.65001 11.7692 7.51924 11.7038 7.38847 11.5731L4.77309 8.95769C4.51155 8.69615 4.51155 8.30384 4.77309 8.04231C5.03463 7.78077 5.42693 7.78077 5.68847 8.04231L7.84617 10.2L11.9654 6.08077C12.2269 5.81923 12.6192 5.81923 12.8808 6.08077C13.1423 6.34231 13.1423 6.73461 12.8808 6.99615L8.30386 11.5731C8.17309 11.7038 8.04232 11.7692 7.84617 11.7692Z"
                                                          fill="#0A5A77"/>
                                                    <path d="M8.5 17C3.79231 17 0 13.2077 0 8.5C0 3.79231 3.79231 0 8.5 0C13.2077 0 17 3.79231 17 8.5C17 13.2077 13.2077 17 8.5 17ZM8.5 1.30769C4.51154 1.30769 1.30769 4.51154 1.30769 8.5C1.30769 12.4885 4.51154 15.6923 8.5 15.6923C12.4885 15.6923 15.6923 12.4885 15.6923 8.5C15.6923 4.51154 12.4885 1.30769 8.5 1.30769Z"
                                                          fill="#0A5A77"/>
                                                </svg>
                                            </i>
                                            Сделать заказ
                                        </a>
                                    <? } else { ?>
                                        <? if ($arElement['CATALOG_QUANTITY'] && $arElement['CATALOG_QUANTITY'] > 0 && empty($arElement['PROPERTIES']['STATUS_OUT']['VALUE'])) {
                                            ?>
                                            <a title="Купить" href="#"
                                               class="addCart p-prods__addbasket<?if(!$arElement["ADDCART"]):?> disabled<? endif; ?><? if (in_array($arElement['ID'], $itInBasket)) { ?> in-basket<? } ?>"
                                               data-id="<?= $arElement["ID"] ?>"
                                               onclick="if (this.text == 'В корзину') this.text = 'В корзине';">
                                                <? if (in_array($arElement['ID'], $itInBasket)) { //Если этот товар есть в корзине ?>
                                                    В корзине
                                                <? } else { //Если товара нет (переменная пустая) ?>
                                                    В корзину
                                                <? } ?>
                                            </a>
                                            <a href="<?= $url; ?>" class="fastBack p-prods__buyoneclick"
                                               data-id="<?= $arElement["ID"] ?>">
                                                <i class="p-prods__buyoneclick-icon">
                                                    <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M3.00118 2.63792C3.00118 1.52414 3.93912 0.586176 5.05292 0.586176C6.16673 0.586176 7.10463 1.52411 7.10463 2.63792V4.27929C7.45639 3.81033 7.69084 3.22412 7.69084 2.63792C7.69081 1.17241 6.5184 0 5.05289 0C3.58739 0 2.41498 1.17241 2.41498 2.63792C2.41498 3.28276 2.64946 3.86897 3.00118 4.27929V2.63792Z"
                                                              fill="#0A5A77"/>
                                                        <path d="M12.0871 7.03443C11.7354 7.03443 11.4423 7.15167 11.2078 7.32752C11.2078 6.50683 10.563 5.86202 9.7423 5.86202C9.39058 5.86202 9.03889 5.97926 8.74577 6.21374C8.51128 5.62754 7.98368 5.27581 7.39748 5.27581C7.04575 5.27581 6.75266 5.39305 6.51815 5.5689V2.63787C6.51815 1.81718 5.87334 1.17236 5.05265 1.17236C4.23196 1.17236 3.58715 1.81721 3.58715 2.63787V7.85509C2.41473 6.79992 1.12508 5.97923 0.304386 6.79992C-0.868028 7.97233 1.59404 10.2585 3.4699 13.7172C4.81819 16.1206 6.69406 16.9999 8.56989 16.9999C11.3251 16.9999 13.5526 14.7723 13.5526 12.0172V8.49993C13.5526 7.67928 12.9078 7.03443 12.0871 7.03443ZM12.9664 9.78962V12.0172C12.9664 14.3034 10.9734 16.4138 8.56986 16.4138C6.34227 16.4138 5.05262 15.1828 3.99744 13.4827C1.76986 9.61377 0.128478 7.85515 0.714685 7.21031C1.3595 6.5655 2.94227 7.97239 4.17329 9.26205V2.63787C4.17329 2.1689 4.58362 1.75854 5.05262 1.75854C5.52158 1.75854 5.93194 2.1689 5.93194 2.63787V8.79302H6.51815V6.74128C6.51815 6.27232 6.92851 5.86196 7.39748 5.86196C7.86647 5.86196 8.2768 6.27232 8.2768 6.74128V8.20678H8.86301V7.32746C8.86301 6.85849 9.27337 6.44813 9.74233 6.44813C10.2113 6.44813 10.6217 6.85849 10.6217 7.32746V8.79296H11.2079V8.49987C11.2079 8.03091 11.6182 7.62055 12.0872 7.62055C12.5562 7.62055 12.9665 8.03091 12.9665 8.49987V9.78962H12.9664Z"
                                                              fill="#0A5A77"/>
                                                    </svg>

                                                </i>
                                                Купить в 1 клик
                                            </a>
                                            <?
                                        } elseif ($arElement['CATALOG_QUANTITY'] == 0 && empty($arElement['PROPERTIES']['STATUS_OUT']['VALUE'])) {
                                            ?>
                                            <a href="#" class="p-prods__snyat" onclick="event.preventDefault()">
                                                Снят с продажи
                                            </a>
                                            <?
                                            $res = CIBlockElement::GetByID($arElement['PROPERTIES']['ANALOG_LINK']['VALUE']);
                                            if ($ar_res = $res->GetNext()) {
                                                ?>
                                                <a href="<?= $ar_res['DETAIL_PAGE_URL'] ?>"
                                                   class="p-prods__buyoneclick">
                                                    <i class="p-prods__buyoneclick-icon">
                                                        <svg width="15" height="10" viewBox="0 0 15 10" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7.5 0C4.22874 0 1.39333 1.90491 0 4.6875C1.39333 7.47009 4.22874 9.375 7.5 9.375C10.7712 9.375 13.6066 7.47009 15 4.6875C13.6067 1.90491 10.7712 0 7.5 0ZM11.198 2.4859C12.0793 3.04802 12.8261 3.80095 13.387 4.6875C12.8261 5.57405 12.0792 6.32698 11.198 6.8891C10.0907 7.59542 8.81188 7.96875 7.5 7.96875C6.18809 7.96875 4.90934 7.59542 3.802 6.8891C2.92075 6.32695 2.17397 5.57402 1.61303 4.6875C2.17395 3.80092 2.92075 3.04799 3.802 2.4859C3.85939 2.44928 3.91737 2.4138 3.9757 2.37896C3.82983 2.77928 3.75 3.21132 3.75 3.66211C3.75 5.73313 5.42895 7.41211 7.5 7.41211C9.57103 7.41211 11.25 5.73313 11.25 3.66211C11.25 3.21132 11.1702 2.77928 11.0243 2.37894C11.0826 2.41377 11.1406 2.44928 11.198 2.4859ZM7.5 3.19336C7.5 3.97002 6.87041 4.59961 6.09375 4.59961C5.31709 4.59961 4.6875 3.97002 4.6875 3.19336C4.6875 2.4167 5.31709 1.78711 6.09375 1.78711C6.87041 1.78711 7.5 2.4167 7.5 3.19336Z"
                                                                  fill="#0A5A77"/>
                                                        </svg>


                                                    </i>
                                                    Посмотреть аналог
                                                </a>
                                                <?
                                            }
                                            ?>
                                            <?
                                        } elseif (!empty($arElement['PROPERTIES']['STATUS_OUT']['VALUE'])) {
                                            ?>
                                            <a href="<?= $url; ?>" class="fastBack pred p-prods__predzak"
                                               data-id="<?= $arElement["ID"] ?>">
                                                Предзаказ
                                            </a>
                                            <?
                                            $res = CIBlockElement::GetByID($arElement['PROPERTIES']['ANALOG_LINK']['VALUE']);
                                            if ($ar_res = $res->GetNext()) {
                                                ?>
                                                <a href="<?= $ar_res['DETAIL_PAGE_URL'] ?>"
                                                   class="p-prods__buyoneclick">
                                                    <i class="p-prods__buyoneclick-icon">
                                                        <svg width="15" height="10" viewBox="0 0 15 10" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M7.5 0C4.22874 0 1.39333 1.90491 0 4.6875C1.39333 7.47009 4.22874 9.375 7.5 9.375C10.7712 9.375 13.6066 7.47009 15 4.6875C13.6067 1.90491 10.7712 0 7.5 0ZM11.198 2.4859C12.0793 3.04802 12.8261 3.80095 13.387 4.6875C12.8261 5.57405 12.0792 6.32698 11.198 6.8891C10.0907 7.59542 8.81188 7.96875 7.5 7.96875C6.18809 7.96875 4.90934 7.59542 3.802 6.8891C2.92075 6.32695 2.17397 5.57402 1.61303 4.6875C2.17395 3.80092 2.92075 3.04799 3.802 2.4859C3.85939 2.44928 3.91737 2.4138 3.9757 2.37896C3.82983 2.77928 3.75 3.21132 3.75 3.66211C3.75 5.73313 5.42895 7.41211 7.5 7.41211C9.57103 7.41211 11.25 5.73313 11.25 3.66211C11.25 3.21132 11.1702 2.77928 11.0243 2.37894C11.0826 2.41377 11.1406 2.44928 11.198 2.4859ZM7.5 3.19336C7.5 3.97002 6.87041 4.59961 6.09375 4.59961C5.31709 4.59961 4.6875 3.97002 4.6875 3.19336C4.6875 2.4167 5.31709 1.78711 6.09375 1.78711C6.87041 1.78711 7.5 2.4167 7.5 3.19336Z"
                                                                  fill="#0A5A77"/>
                                                        </svg>


                                                    </i>
                                                    Посмотреть аналог
                                                </a>
                                                <?
                                            } /*else {
                                                ?>
                                                <a href="<?= $url; ?>" class="fastBack p-prods__buyoneclick-pred"
                                                   data-id="<?= $arElement["ID"] ?>">
                                                    <i class="p-prods__buyoneclick-icon">
                                                        <svg width="14" height="17" viewBox="0 0 14 17" fill="none"
                                                             xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.00118 2.63792C3.00118 1.52414 3.93912 0.586176 5.05292 0.586176C6.16673 0.586176 7.10463 1.52411 7.10463 2.63792V4.27929C7.45639 3.81033 7.69084 3.22412 7.69084 2.63792C7.69081 1.17241 6.5184 0 5.05289 0C3.58739 0 2.41498 1.17241 2.41498 2.63792C2.41498 3.28276 2.64946 3.86897 3.00118 4.27929V2.63792Z"
                                                                  fill="#0A5A77"/>
                                                            <path d="M12.0871 7.03443C11.7354 7.03443 11.4423 7.15167 11.2078 7.32752C11.2078 6.50683 10.563 5.86202 9.7423 5.86202C9.39058 5.86202 9.03889 5.97926 8.74577 6.21374C8.51128 5.62754 7.98368 5.27581 7.39748 5.27581C7.04575 5.27581 6.75266 5.39305 6.51815 5.5689V2.63787C6.51815 1.81718 5.87334 1.17236 5.05265 1.17236C4.23196 1.17236 3.58715 1.81721 3.58715 2.63787V7.85509C2.41473 6.79992 1.12508 5.97923 0.304386 6.79992C-0.868028 7.97233 1.59404 10.2585 3.4699 13.7172C4.81819 16.1206 6.69406 16.9999 8.56989 16.9999C11.3251 16.9999 13.5526 14.7723 13.5526 12.0172V8.49993C13.5526 7.67928 12.9078 7.03443 12.0871 7.03443ZM12.9664 9.78962V12.0172C12.9664 14.3034 10.9734 16.4138 8.56986 16.4138C6.34227 16.4138 5.05262 15.1828 3.99744 13.4827C1.76986 9.61377 0.128478 7.85515 0.714685 7.21031C1.3595 6.5655 2.94227 7.97239 4.17329 9.26205V2.63787C4.17329 2.1689 4.58362 1.75854 5.05262 1.75854C5.52158 1.75854 5.93194 2.1689 5.93194 2.63787V8.79302H6.51815V6.74128C6.51815 6.27232 6.92851 5.86196 7.39748 5.86196C7.86647 5.86196 8.2768 6.27232 8.2768 6.74128V8.20678H8.86301V7.32746C8.86301 6.85849 9.27337 6.44813 9.74233 6.44813C10.2113 6.44813 10.6217 6.85849 10.6217 7.32746V8.79296H11.2079V8.49987C11.2079 8.03091 11.6182 7.62055 12.0872 7.62055C12.5562 7.62055 12.9665 8.03091 12.9665 8.49987V9.78962H12.9664Z"
                                                                  fill="#0A5A77"/>
                                                        </svg>

                                                    </i>
                                                    Заказать в 1 клик
                                                </a>
                                                <?
                                            }*/
                                            ?>
                                            <?
                                        } else {
                                        } ?>
                                        <?
                                    } ?>
                                </div>
                            </div>
									<ul class="propList check">
										<?if(!empty($arElement["PROPERTIES"])):?>
											<?foreach ($arElement["PROPERTIES"] as $index => $arProp):?>
											<?if (($arProp["SORT"] <= 5000) && !in_array($arProp['CODE'], $for_unset)):?>
											
											<?if(is_array($arProp["DISPLAY_VALUE"])):?>
											<li data-id="<?=$arProp["ID"]?>"><?=implode("&nbsp;/&nbsp;", $arProp["DISPLAY_VALUE"]);?></li>																						
											<?else:?>
											<li data-id="<?=$arProp["ID"]?>"><?=$arProp["DISPLAY_VALUE"]?></li>
											<?endif?>

												
											<?endif;?>	
											<?endforeach;?>
										<?endif;?>
									</ul>
						</li>
							<?endforeach;?>
						</ul>
					</div>
				</td>
			</tr>
		</table>
</div>




<?// echo "<pre>"; print_r($arElement["PROPERTIES"]); echo "</pre>"; ?>



<?else:?>
<h2>Страница находится в разработке</h2>
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
<?endif;?>
</div>
<?else:?>
	<div id="empty">
		<div class="emptyWrapper">
			<div class="pictureContainer">
				<img src="<?=SITE_TEMPLATE_PATH?>/images/emptyFolder.png" alt="<?=GetMessage("EMPTY_HEADING")?>" class="emptyImg">
			</div>
			<div class="info">
				<h3><?=GetMessage("EMPTY_HEADING")?></h3>
				<p><?=GetMessage("EMPTY_TEXT")?></p>
				<a href="<?=SITE_DIR?>" class="back"><?=GetMessage("MAIN_PAGE")?></a>
			</div>
		</div>
		<?$APPLICATION->IncludeComponent(
            "bitrix:menu",
            "emptyMenu",
            Array(
			"ROOT_MENU_TYPE" => "left",
				"MENU_CACHE_TYPE" => "N",
				"MENU_CACHE_TIME" => "3600",
				"MENU_CACHE_USE_GROUPS" => "Y",
				"MENU_CACHE_GET_VARS" => "",
				"MAX_LEVEL" => "1",
				"CHILD_MENU_TYPE" => "left",
				"USE_EXT" => "Y",
				"DELAY" => "N",
				"ALLOW_MULTI_SELECT" => "N",
			),
			false
		);?>
	</div>
<?endif;?>