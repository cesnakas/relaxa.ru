<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetPageProperty("tags", "Массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, купить, недорого, доставка, производители, известные, надежные, качество, интернет-магазин, прайс, продукция, цены, опт, розница");
$APPLICATION->SetPageProperty("keywords", "Массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, купить, недорого, доставка, производители, известные, надежные, качество, интернет-магазин, прайс, продукция, цены, опт, розница");
$APPLICATION->SetTitle("Прайс | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description",  "Прайс-лист компании «RELAXA STAR».  Огромный выбор качественных массажеров, массажных кресел, аппаратов для терапии, фитнес тренажеров. Большая гарантия, бесплатная доставка, акции, скидки.  ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!"); 
CModule::IncludeModule('iblock');
if (!empty($_GET['MODE'])) {
    $mode = $_GET['MODE'];
    switch ($mode) {
        case 'xls':
            header('Content-Type: text/html; charset=utf-8');
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Cache-Control: post-check=0, pre-check=0', FALSE);
            header('Pragma: no-cache');
            header('Content-transfer-encoding: binary');
            header('Content-Disposition: attachment; filename=relaxaPrice.xls');
            header('Content-Type: application/x-unknown');
            break;
        case 'xls2':
            header('Content-Type: text/html; charset=utf-8');
            header('Cache-Control: no-store, no-cache, must-revalidate');
            header('Cache-Control: post-check=0, pre-check=0', FALSE);
            header('Pragma: no-cache');
            header('Content-transfer-encoding: binary');
            header('Content-Disposition: attachment; filename=relaxaPrice.xls');
            header('Content-Type: application/x-unknown');
            break;
        case 'csv':
            header("content-type:application/vnd.ms-excel;charset=windows-1251;");
            header("Content-Disposition: attachment; filename=relaxaPrice.csv;charset=windows-1251;");
            header("Pragma: no-cache");
            header("Expires: 0");
            break;
        case 'pic':
            include_once 'showImages.php';
            exit();
    }
} else {
$linkStr = '<a href="?MODE=xls">XLS</a> <a href="?MODE=xls2">XLS_с_ценами</a> <a href="?MODE=csv">CSV</a> <a href="xml.php">XML</a> <a href="yml.php" target="_blank">YML</a> ';
// global $USER;
// $arGroups = CUser::GetUserGroup($USER->GetID());
if ($GLOBALS["USER"]->IsAdmin()) {
   $linkStr = '<a href="?MODE=xls">XLS</a> <a href="?MODE=xls2">XLS_с_ценами</a> <a href="?MODE=csv">CSV</a> <a href="xml.php">XML</a> <a href="xml2.php">XML-2</a> <a href="xml_goods.php">XML-GOODS</a> <a href="yml.php" target="_blank">YML</a> <a href="yml2.php" target="_blank">YML-2</a> ';
}
?>

<? if( !$mode ): ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

<script>
   function alterTableWidths() {
      var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
      $('.floatHeader').width( $('.priceTable').width() + 2 );
      if( isChrome ) $('.floatHeader').find('table').width( $('.priceTable').width() + 2 );
      else $('.floatHeader').find('table').width( $('.priceTable').width() );
      $('.floatHeader').find('td').each(function(index) {
         $(this).height( $('.priceTable').find('td').eq(index).height() );
         $(this).width( $('.priceTable').find('td').eq(index).width() );
      });
   }
   function switchDesc( button ) {
      if( jQuery(button).html() == "Подробнее" ) {
         jQuery(button).parent().find('.previewTextHide').css({"max-height": "10000px"});
         jQuery(button).html("Скрыть");
      }
      else {
         jQuery(button).parent().find('.previewTextHide').css({"max-height": "90px"});
         jQuery(button).html("Подробнее");
      }
   }

   $(document).ready(function() {
      var isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
      $('.floatHeader').width( $('.priceTable').width() + 2 );
      if( isChrome ) $('.floatHeader').find('table').width( $('.priceTable').width() + 2 ).append( $('.tableHead').clone() );
      else $('.floatHeader').find('table').width( $('.priceTable').width() ).append( $('.tableHead').clone() );
      $('.floatHeader').find('td').each(function(index) {
         $(this).height( $('.priceTable').find('td').eq(index).height() );
         $(this).width( $('.priceTable').find('td').eq(index).width() );
      });

      $( window ).scroll(function() {
         $('.floatHeader').css({"position": "fixed", "left": -$(this).scrollLeft()});
      });
      $( window ).on("resize", function() {
         alterTableWidths();
      });

      $('.itemRow').each(function(index) {
         if( index % 2 == 1 ) $(this).addClass('itemRowGray');
      });
      $('.previewTextHide').each(function(index) {
         if( $(this).height() > 90 ) {
            $(this).css({"max-height": "90px"}).parent().append(' <div class="detailDesc" onclick="switchDesc(this)">Подробнее</div> ');
         }
      });
   });
</script>

<style>
	html, body {
		margin: 0;
		padding: 0;
	}
	table td:not(.previewText) {
		text-align: center;
	}
	table td {
		padding: 5px;
		font-family: Verdana;
		font-size: 12px;
	}
	a {
		font-family: Verdana;
		font-size: 12px;
	}
	h3 {
		font-family: Verdana;
		font-size: 20px;
                padding-top: 15px;
	}
	h4 {
		font-family: Verdana;
		font-size: 16px;
                padding-top: 15px;
	}
	.tableHead td {
		font-weight: bold;
	}
	.floatHeader {
		position: absolute;
		background: #fff;
	}

   .column1 {
      width: 90px;
      min-width: 65px;
   }
   .column2 {
      width: 95px;
      min-width: 70px;
   }
   .column3 {
      width: 102px;
      min-width: 102px;
   }
   .column3 img {
      max-width: 100px;
   }
   .column4 {
      width: 146px;
   }
   .column5 {
      width: 55px;
      min-width: 55px;
   }
   .column6 {
      width: auto;
      min-width: 180px;
   }
   .column7 {
      width: 110px;
   }
   .column8 {
      width: 220px;
   }
   .column9 {
      width: 70px;
   }

    .price{
        text-align: center;
        vertical-align: center;
        font-size: 12px;
        padding: 0;
    }
   .priceItem {
      display: table;
      border-bottom: 1px dashed #999;
      width: 100%;
      height: 30px;
      clear: both;
   }
   .priceItem:last-child {
      border-bottom: none;
   }
   .priceName {
      display: table-cell;
      vertical-align: middle;
      width: 50%;
      height: 30px;
      text-align: right;
   }
   .priceValue {
      display: table-cell;
      vertical-align: middle;
      width: 50%;
      height: 30px;
      text-align: center;
      font-size: 18px;
   }

   .itemRowGray td {
      background-color: #efefef;
   }
   .previewTextHide {
      max-height: 10000px;
      overflow: hidden;
   }
   ul {
      margin-top: 0;
      margin-bottom: 0;
   }
   .detailDesc {
      cursor: pointer;
      float: right;
      width: 60px;
      margin-right: 20px;
      margin-top: 10px;
      text-align: right;
      color: #00e;
   }
   .priceColor1 {
      color: #00a000;
   }
   .priceColor2 {
      color: #0000FF;
   }
   .priceColor3 {
      color: #a000a0;
   }
   .priceColor4 {
      color: #aa0000;
   }
</style>
<? endif; ?>
<html>
<head>
<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetPageProperty("tags", "Массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, купить, недорого, доставка, производители, известные, надежные, качество, интернет-магазин, прайс, продукция, цены, опт, розница");
$APPLICATION->SetPageProperty("keywords", "Массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, купить, недорого, доставка, производители, известные, надежные, качество, интернет-магазин, прайс, продукция, цены, опт, розница");
$APPLICATION->SetTitle("Прайс | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description",  "Прайс-лист компании «RELAXA STAR».  Огромный выбор качественных массажеров, массажных кресел, аппаратов для терапии, фитнес тренажеров. Большая гарантия, бесплатная доставка, акции, скидки.  ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!");
?>
</head>
<body>
<?php
}
$iBlocks = CIBlock::GetList(array("ID" => "ASC", "SORT" => "ASC"), array('TYPE' => 'catalog', 'ACTIVE' => 'Y'), false);
$brands = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 17, '!PROPERTY_HIDE_IN_PRICE' => 'Y', 'ACTIVE' => 'Y'), false, false, array('ID', 'NAME'));
if ($brands->SelectedRowsCount()) {
    while ($brand = $brands->Fetch()) {
        $arBrands[$brand['ID']] = $brand['NAME'];
    }
}
if ($iBlocks->SelectedRowsCount()) {
    global $USER;
    $col = 9;
    $arGroups = CUser::GetUserGroup($USER->GetID());
    $priceHeader = '';
    foreach ($arGroups as $group) {
        switch ($group) {
            case 1:
			case 12:
                $priceHeader = '<td class="column5">Дилерская цена (руб.)</td><td class="column5">Премиум (руб.)</td><td class="column5">Дроп Шиппинг (руб.)</td><td class="column5">ВИП (руб.)</td>';
                $col += 4;
                $arPriceTypes[] = 'all';
                break 2;
            case 6:
                $priceHeader .= '<td class="column5">ВИП (руб.)</td>';
                $col++;
                $arPriceTypes[] = 'vip_demo';
                break;
            case 8:
                $priceHeader .= '<td class="column5">Дилерская цена (руб.)</td><td class="column5">Премиум (руб.)</td><td class="column5">Дроп Шиппинг (руб.)</td>';
                $col += 3;
                $arPriceTypes[] = 'dialer';
                break;
            case 11:
                $priceHeader .= '<td class="column5">Дроп Шиппинг (руб.)</td>';
                $col += 1;
                $arPriceTypes[] = 'drop';
                break;				
        }
    }
    if ( $mode != 'csv' ) {
       $col = 9;
    }
    else {
       $col += 4;
    }
    ?>

<? if( !$mode ): ?>
<div class="floatHeader">
<? echo $linkStr; ?>
	<table style="width: 100%; border-left-width: 1px; border-right-width: 1px;" border>
	</table>
</div>
<? endif; ?>

<?
    echo $linkStr;
    ob_start();
?>
	<table class="priceTable" style="width: 100%;" border>
        <tr class="tableHead">
			<td class="column1">
                Бренд
            </td>
            <td class="column2">
                Артикул
            </td>
            <td class="column3">
                Изображение
            </td>
            <td class="column4">
                Название
            </td>
            <td class="column5">
                Цена
            </td>
            <?
   if ( $mode == 'csv' || $mode == 'xls2' ) {
      echo $priceHeader;}		
			?>

            <td class="column6">
                Описание
            </td>
		
			
			<? if(( in_array(1, $arGroups) || in_array(6, $arGroups) || in_array(8, $arGroups) || in_array(12, $arGroups) ) && ( $mode != 'csv' )): ?>
            <td class="column7">
                Информация и ссылки
            </td>
			<? elseif ( $mode == 'csv' ): ?>
            <td class="column7">
                Штрихкод
            </td>						
			<? endif; ?>
			<? if( $mode == 'csv' ): ?>
                           <td>Размер упаковки (Д x Ш x В)</td>
                           <td>Коробка №1 (Д х Ш х В)</td>
                           <td>Коробка №2 (Д х Ш х В)</td>
                           <td>Коробка №3 (Д х Ш х В)</td>						   
                           <td>Вес коробки №1 (нетто/брутто)</td>
                           <td>Вес коробки №2 (нетто/брутто)</td>
                           <td>Вес коробки №3 (нетто/брутто)</td>						   
                           <td>Вес нетто</td>
                           <td>Вес брутто</td>
			<? else: ?>
            <td class="column8">
                Упаковка
            </td>
			<? endif; ?>
			<? if( in_array(1, $arGroups) || in_array(6, $arGroups) || in_array(8, $arGroups) || in_array(11, $arGroups)  || in_array(12, $arGroups) ): ?>
            <td class="column9">
                Наличие
            </td>

	<? endif; ?>
        </tr>
        <?php
        while ($iBlock = $iBlocks->Fetch()) {
            $arFilter = array('IBLOCK_ID' => $iBlock['ID'], 'ACTIVE' => 'Y', '!PROPERTY_DO_NOT_SHOW' => 'Y');
            if( in_array(6, $arGroups) || in_array(8, $arGroups)  || in_array(12, $arGroups) ) $arFilter = array_merge( $arFilter, array('!PROPERTY_HIDE_FROM_DILLERS' => 'Y') );
            $elements = CIBlockElement::GetList(
                array(), $arFilter, false, false, array(
                    'ID',
                    'NAME',
                    'PREVIEW_TEXT',
                    'PREVIEW_PICTURE',
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
					'PROPERTY_G_KOROBKI',
					'PROPERTY_G_KOROBKI2',
					'PROPERTY_G_KOROBKI3',
					'PROPERTY_VESKOROBKI1',
					'PROPERTY_VESKOROBKI2',
					'PROPERTY_VESKOROBKI3',
                    'PROPERTY_VES_NETTO',
                    'PROPERTY_VES_BRUTTO',
                    'PROPERTY_AV_STATUS',
                )
            );

            if (!$elements->SelectedRowsCount()) continue;
            ?>
            <tr>
                <td style="text-align: center; background-color: white;" colspan=<?= $col ?>>
                    <h3><?= $iBlock['NAME'] ?></h3>
                </td>
            </tr>
            <?php

   $arFilter = array('IBLOCK_ID' => $iBlock["ID"], 'ACTIVE' => 'Y', 'ELEMENT_SUBSECTIONS' => 'Y', 'CNT_ACTIVE' => 'Y');
   $arSelect = array('ID', 'NAME');
   $rsSection = CIBlockSection::GetList(array("SORT" => "ASC", "ID" => "ASC"), $arFilter, false, $arSelect); 
   while($arSection = $rsSection->Fetch()) {
//echo "<pre>"; print_r($arSection); echo "</pre>";
            $arFilter = array('IBLOCK_ID' => $iBlock['ID'], 'ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' => $arSection["ID"], '!PROPERTY_DO_NOT_SHOW' => 'Y');
            if( in_array(6, $arGroups) || in_array(8, $arGroups)  || in_array(12, $arGroups) ) $arFilter = array_merge( $arFilter, array('!PROPERTY_HIDE_FROM_DILLERS' => 'Y') );
            $elements = CIBlockElement::GetList(
                array("NAME" => "ASC"), $arFilter, false, false, array(
                    'ID',
                    'NAME',
                    'PREVIEW_TEXT',
                    'PREVIEW_PICTURE',
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
					'PROPERTY_G_KOROBKI',
					'PROPERTY_G_KOROBKI2',
					'PROPERTY_G_KOROBKI3',
					'PROPERTY_VESKOROBKI1',
					'PROPERTY_VESKOROBKI2',
					'PROPERTY_VESKOROBKI3',
                    'PROPERTY_VES_NETTO',
                    'PROPERTY_VES_BRUTTO',
                    'PROPERTY_AV_STATUS',
                    'PROPERTY_BARCODE',
                )
            );

if ($arSection["ID"] == 197) {
//echo "<pre>"; print_r($elements); echo "</pre>";
//echo "<pre>"; print_r($arFilter); echo "</pre>";
}
            if ($elements->SelectedRowsCount()) {
            ?>
            <tr>
                <td style="text-align: center; background-color: white;" colspan=<?= $col ?>>
                    <h4><?= $arSection['NAME'] ?></h4>
                </td>
            </tr>
            <?php
                while ($element = $elements->GetNext()) {
					//echo "<pre>"; print_r($element); echo "</pre>";
                    $picSrc = CFile::GetPath($element['PREVIEW_PICTURE']);
                    $price = CCatalogProduct::GetOptimalPrice($element['ID']);
                    $product = CCatalogProduct::GetByID($element['ID']);
                    $instructionsList = '';
                    if (!empty($element['PROPERTY_DOCS_VALUE'])) {
                        $instructionsList = 'Инструкции: <ul>';
                        foreach ($element['PROPERTY_DOCS_VALUE'] as $instructionID) {
                            $arInstFile = CFile::GetFileArray($instructionID);
                            $instructionsList .= "<li><a href=\"{$arInstFile['SRC']}\">{$arInstFile['ORIGINAL_NAME']}</a></li>";
                        }
                        $instructionsList .= '<ul>';
                    }
                    $certificatesList = '';
                    if (!empty($element['PROPERTY_CERT_VALUE'])) {
                        $certificatesList = 'Сертификаты: <ul>';
                        foreach ($element['PROPERTY_CERT_VALUE'] as $certificateID) {
                            $arCertFile = CFile::GetFileArray($certificateID);
                            $certificatesList .= "<li><a href=\"{$arCertFile['SRC']}\">{$arCertFile['ORIGINAL_NAME']}</a></li>";
                        }
                        $certificatesList .= '<ul>';
                    }
/*
                    $priceStr = '';
                    foreach ($arPriceTypes as $priceType) {
                        switch ($priceType) {
                            case 'all':
                                $priceStr = "<td class='price column5'>{$element['PROPERTY_DEALER_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_PREMIUM_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_DEMO_PRICE_VALUE']}</td>";
                                break;
                            case 'vip':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_DEALER_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_PREMIUM_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>";
                                break;
                            case 'vip_demo':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_VIP_DEMO_PRICE_VALUE']}</td>";
                                break;
                            case 'premium':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_DEALER_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_PREMIUM_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>";
                                break;
                            case 'dialer':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_DEALER_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_PREMIUM_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>";
                                break;
                        }
                    }
*/
   if ( $mode == 'csv' || $mode == 'xls2' ) {
                    $priceStr = '';
                    if ( $mode == 'csv' || $mode == 'xls2' ) $priceStr = "<td class='price column5'>{$price['DISCOUNT_PRICE']}</td>";
                    foreach ($arPriceTypes as $priceType) {
                        switch ($priceType) {
                            case 'all':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_DEALER_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_PREMIUM_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_DEMO_PRICE_VALUE']}</td>";
                                break;
                            case 'vip':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_DEALER_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_PREMIUM_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>";
                                break;
                            case 'vip_demo':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_VIP_DEMO_PRICE_VALUE']}</td>";
                                break;
                            case 'premium':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_DEALER_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_PREMIUM_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>";
                                break;
                            case 'dialer':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_DEALER_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_PREMIUM_PRICE_VALUE']}</td>"
                                    . "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>";
                                break;
                            case 'drop':
                                $priceStr .= "<td class='price column5'>{$element['PROPERTY_VIP_PRICE_VALUE']}</td>";
                                break;								
                        }
                    }
   }
   else {
                    $priceStr = "<div class='priceItem'><div class='priceName'>РРЦ</div><div class='priceValue'>".$price['DISCOUNT_PRICE']."</div></div>";
                    foreach ($arPriceTypes as $priceType) {
                        switch ($priceType) {
                            case 'all':
                                $priceStr .= "<div class='priceItem'><div class='priceName'>Дилерская цена</div><div class='priceValue priceColor1'>".$element['PROPERTY_DEALER_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>Премиум</div><div class='priceValue priceColor2'>".$element['PROPERTY_PREMIUM_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>Дроп Шиппинг</div><div class='priceValue priceColor3'>".$element['PROPERTY_VIP_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>ВИП</div><div class='priceValue priceColor4'>".$element['PROPERTY_VIP_DEMO_PRICE_VALUE']."</div></div>";
                                break;
                            case 'vip':
                                $priceStr .= "<div class='priceItem'><div class='priceName'>Дилерская цена</div><div class='priceValue priceColor1'>".$element['PROPERTY_DEALER_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>Премиум</div><div class='priceValue priceColor2'>".$element['PROPERTY_PREMIUM_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>Дроп Шиппинг</div><div class='priceValue priceColor3'>".$element['PROPERTY_VIP_PRICE_VALUE']."</div></div>";
                                break;
                            case 'vip_demo':
                                $priceStr .= "<div class='priceItem'><div class='priceName'>ВИП</div><div class='priceValue priceColor4'>".$element['PROPERTY_VIP_DEMO_PRICE_VALUE']."</div></div>";
                                break;
                            case 'premium':
                                $priceStr .= "<div class='priceItem'><div class='priceName'>Дилерская цена</div><div class='priceValue priceColor1'>".$element['PROPERTY_DEALER_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>Премиум</div><div class='priceValue priceColor2'>".$element['PROPERTY_PREMIUM_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>Дроп Шиппинг</div><div class='priceValue priceColor3'>".$element['PROPERTY_VIP_PRICE_VALUE']."</div></div>";
                                break;
                            case 'dialer':
                                $priceStr .= "<div class='priceItem'><div class='priceName'>Дилерская цена</div><div class='priceValue priceColor1'>".$element['PROPERTY_DEALER_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>Премиум</div><div class='priceValue priceColor2'>".$element['PROPERTY_PREMIUM_PRICE_VALUE']."</div></div>"
                                    . "<div class='priceItem'><div class='priceName'>Дроп Шиппинг</div><div class='priceValue priceColor3'>".$element['PROPERTY_VIP_PRICE_VALUE']."</div></div>";
                                break;
                        }
                    }
   }

                    ?>
                    <tr class="itemRow">
                        <td class="column1">
                            <?= $arBrands[$element['PROPERTY_ATT_BRAND_VALUE']] ?>
                        </td>
                        <td class="column2">
                            <?= $element['PROPERTY_CML2_ARTICLE_VALUE'] ?>
                        </td>
                            <? if( ( $mode == 'xls' ) ||  ( $mode == 'xls2' ) ): ?>
                        <td>
                            https://<?=SITE_SERVER_NAME . $picSrc?>                            
                            <? elseif ( $mode == 'csv' ): ?>
                        <td class="column3">
                            https://<?=SITE_SERVER_NAME . $picSrc?>
                            <? else: ?>
                        <td class="column3">
                            <a href="https://www.relaxa.ru<?=$element['DETAIL_PAGE_URL']?>?MODE=pic&ID=<?=$element['ID']?>&IBLOCK_ID=<?=$element['IBLOCK_ID']?>"><img src="<?=$picSrc?>" /></a>
                            <? endif; ?>
                        </td>
                        <td class="column4">
                            <a href="https://www.relaxa.ru<?=$element['DETAIL_PAGE_URL']?>"><?=$element['NAME']?></a>
                        </td>
			<? if( $mode == 'csv' || $mode == 'xls2' ): ?>
                            <?= $priceStr ?>
			<? else: ?>
                        <td class='price' align="center" valign="top">
                            <?//= $price['DISCOUNT_PRICE'] ?>
                            <?= $priceStr ?>
                        </td>
			<? endif; ?>
                        <td class="previewText column6">
						<? if ( $mode == 'xls' ): ?>
							<?= $element['~PREVIEW_TEXT'] ?>						   
						<? elseif ( $mode == 'csv' ): ?> 
							<?= $element['PREVIEW_TEXT'] ?>	
                        <? else: ?>
							<div class="previewTextHide"><?= $element['~PREVIEW_TEXT'] ?></div>
                        <? endif; ?>
                        </td>

						
			<? if(( in_array(1, $arGroups) || in_array(6, $arGroups) || in_array(8, $arGroups)  || in_array(12, $arGroups) ) && ( $mode != 'csv' )): ?>
                        <td class="column7">
						<?= $element['~PROPERTY_INFORM_LINKS_VALUE']['TEXT'] ?> 
						<br>
						<?=($element['PROPERTY_BARCODE_VALUE'] ? "штрихкод EAN13: " . $element['PROPERTY_BARCODE_VALUE'] : "") ?>
						</td>
			<? elseif ( $mode == 'csv' ): ?>
            <td class="column7">
                <?= $element['PROPERTY_BARCODE_VALUE'] ?>
            </td>					
			<? endif; ?>

			
			<? if( $mode == 'csv' ): ?>
                        <? 
                             $element['PROPERTY_RASM_DSV_VALUE'] = str_replace("мм", "", $element['PROPERTY_RASM_DSV_VALUE']);
                             $dimValues = explode("x", $element['PROPERTY_RASM_DSV_VALUE']); 
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("х", $element['PROPERTY_RASM_DSV_VALUE']); 
                             }
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("*", $element['PROPERTY_RASM_DSV_VALUE']); 
                             }
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("X", $element['PROPERTY_RASM_DSV_VALUE']); 
                             }
                        ?>
                        <? 
                             $element['PROPERTY_G_KOROBKI_VALUE'] = str_replace("мм", "", $element['PROPERTY_G_KOROBKI_VALUE']);
                             $dimValues = explode("x", $element['PROPERTY_G_KOROBKI_VALUE']); 
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("х", $element['PROPERTY_G_KOROBKI_VALUE']); 
                             }
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("*", $element['PROPERTY_G_KOROBKI_VALUE']); 
                             }
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("X", $element['PROPERTY_G_KOROBKI_VALUE']); 
                             }
                        ?>
                        <? 
                             $element['PROPERTY_G_KOROBKI2_VALUE'] = str_replace("мм", "", $element['PROPERTY_G_KOROBKI2_VALUE']);
                             $dimValues = explode("x", $element['PROPERTY_G_KOROBKI2_VALUE']); 
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("х", $element['PROPERTY_G_KOROBKI2_VALUE']); 
                             }
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("*", $element['PROPERTY_G_KOROBKI2_VALUE']); 
                             }
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("X", $element['PROPERTY_G_KOROBKI2_VALUE']); 
                             }
                        ?>
                        <? 
                             $element['PROPERTY_G_KOROBKI3_VALUE'] = str_replace("мм", "", $element['PROPERTY_G_KOROBKI3_VALUE']);
                             $dimValues = explode("x", $element['PROPERTY_G_KOROBKI3_VALUE']); 
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("х", $element['PROPERTY_G_KOROBKI3_VALUE']); 
                             }
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("*", $element['PROPERTY_G_KOROBKI3_VALUE']); 
                             }
                             if ( count( $dimValues) != 3 ) {
                                $dimValues = explode("X", $element['PROPERTY_G_KOROBKI3_VALUE']); 
                             }
                        ?>							
                      <?/* <td><?=trim($dimValues[0])?></td>
                           <td><?=trim($dimValues[1])?></td>
                           <td><?=trim($dimValues[2])?></td> */?>
						   <td><?=$element['PROPERTY_RASM_DSV_VALUE']?></td>
						   
						   <td><?=$element['PROPERTY_G_KOROBKI_VALUE']?></td>
						   <td><?=$element['PROPERTY_G_KOROBKI2_VALUE']?></td>
						   <td><?=$element['PROPERTY_G_KOROBKI3_VALUE']?></td>
						   
						   <td><?=$element['PROPERTY_VESKOROBKI1_VALUE']?></td>
						   <td><?=$element['PROPERTY_VESKOROBKI2_VALUE']?></td>
						   <td><?=$element['PROPERTY_VESKOROBKI3_VALUE']?></td>	
					   
                           <td><?=$element['PROPERTY_VES_NETTO_VALUE']?></td>
                           <td><?=$element['PROPERTY_VES_BRUTTO_VALUE']?></td>
                        <? else :?>
                        <td class="column8">
							<? if( 1 == 2 ): ?>
                            <?= "Размер(ДxШxВ): {$product['LENGTH']}x{$product['WIDTH']}x{$product['HEIGHT']}<br>Вес: {$product['WEIGHT']}" ?>
							<? endif; ?>
							<?=( $element['PROPERTY_RASM_DSV_VALUE'] ? "Размер (Д x Ш x В):<br /> {$element['PROPERTY_RASM_DSV_VALUE']}<br />" : "" )?>
							<?=( $element['PROPERTY_G_KOROBKI_VALUE'] ? "Коробка №1 (Д х Ш х В):<br /> {$element['PROPERTY_G_KOROBKI_VALUE']}<br />" : "" )?>
							<?=( $element['PROPERTY_G_KOROBKI2_VALUE'] ? "Коробка №2 (Д х Ш х В):<br /> {$element['PROPERTY_G_KOROBKI2_VALUE']}<br />" : "" )?>
							<?=( $element['PROPERTY_G_KOROBKI3_VALUE'] ? "Коробка №3 (Д х Ш х В):<br /> {$element['PROPERTY_G_KOROBKI3_VALUE']}<br />" : "" )?>
							<?=( $element['PROPERTY_VESKOROBKI1_VALUE'] ? "Вес коробки №1 (нетто/брутто):<br /> {$element['PROPERTY_VESKOROBKI1_VALUE']}<br />" : "" )?>
							<?=( $element['PROPERTY_VESKOROBKI2_VALUE'] ? "Вес коробки №2 (нетто/брутто):<br /> {$element['PROPERTY_VESKOROBKI2_VALUE']}<br />" : "" )?>
							<?=( $element['PROPERTY_VESKOROBKI3_VALUE'] ? "Вес коробки №3 (нетто/брутто):<br /> {$element['PROPERTY_VESKOROBKI3_VALUE']}<br />" : "" )?>							
							<?=( $element['PROPERTY_VES_NETTO_VALUE'] ? "Нетто: {$element['PROPERTY_VES_NETTO_VALUE']}<br />" : "" )?>
							<?=( $element['PROPERTY_VES_BRUTTO_VALUE'] ? "Брутто: {$element['PROPERTY_VES_BRUTTO_VALUE']}<br />" : "" )?>
                        </td>
                        <? endif; ?>

			<? if( in_array(1, $arGroups) || in_array(6, $arGroups) || in_array(8, $arGroups) || in_array(11, $arGroups)  || in_array(12, $arGroups) ): ?>
                        <td class="column9">
                            <?= $element['PROPERTY_AV_STATUS_VALUE'] ?>
                        </td>
			<? endif; ?>
                    </tr>
                    <?php
                }
            }
           } //--- Sections
        }
        ?>
    </table>
    <?php
    $resStr = ob_get_contents();
    if ($mode == 'csv') $resStr = mb_convert_encoding($resStr, 'windows-1251', 'UTF-8');
    ob_end_clean();
    if ($mode == 'csv') {
        $out = fopen('php://output', 'w');
        $resStr = strip_tags($resStr, '<tr><td>');
		$resStr = str_replace('"', '`', $resStr);
		$resStr = str_replace(';', ',', $resStr);
		$resStr = str_replace('</li>', '   ', $resStr);
		$resStr = str_replace('</td>', ';', $resStr);
        $resStr = str_replace('</tr>', "|", $resStr);
        $resStr = strip_tags($resStr);
        $arr = explode("|", trim($resStr));
        array_walk($arr, 'trim_value');
        foreach ($arr as &$str) {
            $fArr = explode(';', $str);
            array_walk($fArr, 'trim_value');
            //$str = join('";"', $fArr);
            fputcsv($out, $fArr, ";");
        }
        die();
    } else {
        echo $resStr;
    }
}
?>
</body>
</html>