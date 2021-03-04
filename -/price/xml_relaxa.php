<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

function barCodeGen( $productID ) {
   $kod = "46007071";
   if ( $productID > 9999 ) {
      $kod .= $productID % 10000;
   }
   else {
      $kod .= sprintf("%04s", $productID);
   }

  $weightflag = true;
  $sum = 0;
  for ($i = strlen($kod) - 1; $i >= 0; $i--) {
     $sum += (int)$kod[$i] * ($weightflag?3:1);
     $weightflag = !$weightflag;
  }
  $kod .= (10 - ($sum % 10)) % 10;

   return $kod;
}


   header("Content-type: text/plain");
   header("Content-Disposition: attachment; filename=relaxa_price.xml");
   header("Pragma: no-cache");
   header("Expires: 0");

CModule::IncludeModule("currency");
CModule::IncludeModule("iblock");

$NL = "\r\n";
$ymlContent = '<?xml version="1.0" encoding="UTF-8"?><!DOCTYPE yml_catalog SYSTEM "shops.dtd">'.$NL;
$ymlContent .= '<yml_catalog date="'.date("Y-m-d H:i").'">'.$NL;
$ymlContent .= '<shop>'.$NL;
$ymlContent .= '<name>Relaxa</name>'.$NL;
$ymlContent .= '<company>relaxa.ru</company>'.$NL;
$ymlContent .= '<url>http://relaxa.ru</url>'.$NL;


$ymlContent .= '<currencies>'.$NL;
$lcur = CCurrency::GetList(($by="sort"), ($order="asc"), LANGUAGE_ID);
while($lcur_res = $lcur->Fetch()) {

   $ymlContent .= '<currency id="'.$lcur_res["CURRENCY"].'" rate="'.$lcur_res["AMOUNT"].'" />'.$NL;
}
$ymlContent .= '</currencies>'.$NL;




$categories = "";
$offers = "";
$brands = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 17, '!PROPERTY_HIDE_IN_PRICE' => 'Y', 'ACTIVE' => ''), false, false, array('ID', 'NAME'));
if ($brands->SelectedRowsCount()) {
    while ($brand = $brands->Fetch()) {
        $arBrands[$brand['ID']] = $brand['NAME'];
    }
}
$iBlocks = CIBlock::GetList(array(), array('TYPE' => 'catalog', 'ACTIVE' => 'Y'), false);
while( $iBlock = $iBlocks->Fetch() ) {
            $arFilter = array('IBLOCK_ID' => $iBlock['ID'], 'ACTIVE' => 'Y', '!PROPERTY_DO_NOT_SHOW' => 'Y', '!CATALOG_QUANTITY' => '0');
            if( in_array(6, $arGroups) || in_array(8, $arGroups) ) $arFilter = array_merge( $arFilter, array('!PROPERTY_HIDE_FROM_DILLERS' => 'Y') );
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
                    'PROPERTY_VES_NETTO',
                    'PROPERTY_VES_BRUTTO',
                    'PROPERTY_AV_STATUS',
					'PROPERTY_MANUFACTURE',
					'PROPERTY_GUARANTEE',
					'PROPERTY_STATUS_OUT',
					'PROPERTY_IZGOT_ZAK',
                )
            );

            if (!$elements->SelectedRowsCount()) continue;

   $arFilter = array('IBLOCK_ID' => $iBlock["ID"], 'ACTIVE' => 'Y', 'ELEMENT_SUBSECTIONS' => 'Y', 'CNT_ACTIVE' => 'Y');
   $arSelect = array('ID', 'NAME');
   $rsSection = CIBlockSection::GetList(array("SORT" => "ASC", "ID" => "ASC"), $arFilter, false, $arSelect); 
   while($arSection = $rsSection->Fetch()) {

            $arFilter = array('IBLOCK_ID' => $iBlock['ID'], 'ACTIVE' => 'Y', 'ID', 'IBLOCK_SECTION_ID' => $arSection["ID"], '!PROPERTY_DO_NOT_SHOW' => 'Y', '!CATALOG_QUANTITY' => '0');
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
					'PROPERTY_STATUS_OUT',
					'PROPERTY_IZGOT_ZAK',
                )
            );			
	
   if (!$elements->SelectedRowsCount()) continue;
      if( !$arSection["IBLOCK_SECTION_ID"] ) $categories .= '<category id="'.$arSection["ID"].'">'.$arSection["NAME"].'</category>'.$NL;
      else $categories .= '<category id="'.$arSection["ID"].'" parentId="'.$arSection["IBLOCK_SECTION_ID"].'">'.$arSection["NAME"].'</category>'.$NL;
   $stop = '';
 
   while ($element = $elements->GetNext()) {
    if ( !$element["IBLOCK_SECTION_ID"] ) continue;
    //echo "<pre>"; print_r($element); echo "</pre>";
	if ($element['PROPERTY_GIFTS_VALUE'])
	{ 
		$elements_promos[$element['ID']][] = $element['PROPERTY_GIFTS_VALUE'];
		$elements_gift[]= $element['PROPERTY_GIFTS_VALUE'];
	}
	if ($element['ID']!=$stop) {
	  $stop = $element['ID'];	
      $picSrc = CFile::GetPath($element['DETAIL_PICTURE']);
      $price = CCatalogProduct::GetOptimalPrice($element['ID']);
	      
      if(( $element['PROPERTY_STATUS_OUT_VALUE']) || ( $element['PROPERTY_IZGOT_ZAK_VALUE'])){
	  $offers .= '<offer id="'.$element["ID"].'" available="false">'.$NL;	  
	  }
	  else {
      $offers .= '<offer id="'.$element["ID"].'" available="true">'.$NL;
	  }
	  
      $offers .= '<url>https://relaxa.ru'.$element['DETAIL_PAGE_URL'].'</url>'.$NL;
      if ($element['PROPERTY_NO_DISCOUNT_VALUE']) {
         $offers .= '<price>'.$price['DISCOUNT_PRICE'].'</price>'.$NL;
      }
      else {
         $offers .= '<price>'.round($price['DISCOUNT_PRICE'] * 0.95).'</price>'.$NL;
      }
      $offers .= '<currencyId>RUB</currencyId>'.$NL;
      $offers .= '<categoryId>'.$element["IBLOCK_SECTION_ID"].'</categoryId>'.$NL;
      $offers .= '<picture>https://relaxa.ru'.$picSrc.'</picture>'.$NL;

      if ( $arBrands[$element['PROPERTY_ATT_BRAND_VALUE']] ) {
         $offers .= '<vendor>'.$arBrands[$element['PROPERTY_ATT_BRAND_VALUE']].'</vendor>'.$NL;
      }
      $offers .= '<model>'.$element['PROPERTY_CML2_ARTICLE_VALUE'].'</model>'.$NL;
      $offers .= '<name>'.$element["NAME"].'</name>'.$NL;
      $offers .= '<description><![CDATA['.$element["PREVIEW_TEXT"].']]></description>'.$NL;
	  
      if ($element['PROPERTY_CONDITION_VALUE']== "Новое с дефектом") {
         $offers .= '<condition type="likenew"><reason>'.$element['PROPERTY_COND_DESC_VALUE'].'</reason></condition>'.$NL;
	  }
      elseif ($element['PROPERTY_CONDITION_VALUE']== "Б/У") {
		 $offers .= '<condition type="used"><reason>'.$element['PROPERTY_COND_DESC_VALUE'].'</reason></condition>'.$NL;
	  }


	$list_vid_massaga_arr = $element['PROPERTY_VID_MASSAGA_VALUE'];
	$list_vid_massaga =  implode(",", $list_vid_massaga_arr);
	
	$funkcii_regulirovki_arr = $element['PROPERTY_FUNKCII_REGULIROVKI_VALUE'];
	$funkcii_regulirovki =  implode(",", $funkcii_regulirovki_arr);
	
	$upravlenie_arr = $element['PROPERTY_UPRAVLENIE_VALUE'];
	$upravlenie =  implode(",", $upravlenie_arr);	
	
	$zony_massazha_arr = $element['PROPERTY_ZONY_MASSAZHA_VALUE'];
	$zony_massazha =  implode(",", $zony_massazha_arr);	
	
	$zony_progreva_arr = $element['PROPERTY_ZONY_PROGREVA_VALUE'];
	$zony_progreva =  implode(",", $zony_progreva_arr);	
	
	$vid_massage_calf_arr = $element['PROPERTY_VID_MASSAGE_CALF_VALUE'];
	$vid_massage_calf =  implode(",", $vid_massage_calf_arr);		
	
	$funkcia_tip_massag_stop_arr = $element['PROPERTY_FUNKCIA_TIP_MASSAG_STOP_VALUE'];
	$funkcia_tip_massag_stop =  implode(",", $funkcia_tip_massag_stop_arr);

	$vid_massaga_jagodic_arr = $element['PROPERTY_VID_MASSAGA_JAGODIC_VALUE'];
	$vid_massaga_jagodic =  implode(",", $vid_massaga_jagodic_arr);

	$options_comfort_arr = $element['PROPERTY_OPTIONS_COMFORT_VALUE'];
	$options_comfort =  implode(",", $options_comfort_arr);
	
	$yazik_arr = $element['PROPERTY_YAZIK_VALUE'];
	$yazik =  implode(",", $yazik_arr);
	
	$port_z_arr = $element['PROPERTY_PORT_DLYA_ZARYADKI_VALUE'];
	$port_z =  implode(", ", $port_z_arr);

	$mult_arr = $element['PROPERTY_FUNKCIA_MULTIMEDIA_VALUE'];
	$mult =  implode(", ", $mult_arr);
	
	  if( ($element['PROPERTY_STATUS_OUT_VALUE']) && empty($element['PROPERTY_IZGOT_ZAK_VALUE'])) $offers  .= '<param name="Доступен предзаказ">'.$element['PROPERTY_STATUS_OUT_VALUE'].'</param>'.$NL;
	  if( $element['PROPERTY_IZGOT_ZAK_VALUE'] ) $offers  .= '<param name="Изготовление на заказ">'.'Да'.'</param>'.$NL;	  
      if( $element['PROPERTY_CML2_ARTICLE_VALUE'] ) $offers .= '<param name="Артикул">'.$element['PROPERTY_CML2_ARTICLE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_BARCODE_VALUE'] ) $offers .= '<param name="Штрих-код">'.$element['PROPERTY_BARCODE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_TYPE_VALUE'] ) $offers .= '<param name="Тип">'.$element['PROPERTY_TYPE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_NAZNACHENIE_VALUE'] ) $offers .= '<param name="Назначение">'.$element['PROPERTY_NAZNACHENIE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_SERIYA_VALUE'] ) $offers .= '<param name="Серия">'.$element['PROPERTY_SERIYA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_MODEL_VALUE'] ) $offers .= '<param name="Модель">'.$element['PROPERTY_MODEL_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_GOST_VALUE'] ) $offers .= '<param name="ГОСТ">'.$element['PROPERTY_GOST_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_COMPOSITION_VALUE'] ) $offers .= '<param name="Состав">'.$element['PROPERTY_COMPOSITION_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_PLOTNOST_VALUE'] ) $offers .= '<param name="Плотность">'.$element['PROPERTY_PLOTNOST_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_MATERIAL_VALUE'] ) $offers .= '<param name="Материал">'.$element['PROPERTY_MATERIAL_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_MATERIAL_OBIVKI_VALUE'] ) $offers .= '<param name="Материал обивки">'.$element['PROPERTY_MATERIAL_OBIVKI_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_TEST_MARTINDEJLA_VALUE'] ) $offers .= '<param name="Тест Мартиндейла">'.$element['PROPERTY_TEST_MARTINDEJLA_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_STRANA_PROIZVODITEL_VALUE'] ) $offers .= '<param name="Страна изготовления">'.$element['PROPERTY_STRANA_PROIZVODITEL_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_MANUFACTURER_VALUE'] ) $offers .= '<param name="Страна производителя">'.$element['PROPERTY_MANUFACTURER_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_PRODAVEC_VALUE'] ) $offers .= '<param name="Страна продавца">'.$element['PROPERTY_PRODAVEC_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_GUARANTEE_VALUE'] ) $offers .= '<param name="Гарантия производителя">'.$element['PROPERTY_GUARANTEE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_FUNKCIA_SKAN_ROSTA_VALUE'] ) $offers .= '<param name="Сканирование роста">'.$element['PROPERTY_FUNKCIA_SKAN_ROSTA_VALUE'].'</param>'.$NL;
	  	  
      if( $element['PROPERTY_FUNKCII_REGULIROVKI_VALUE'] ) $offers .= '<param name="Функции регулировки">'.$funkcii_regulirovki.'</param>'.$NL;
	  	  
      if( $element['PROPERTY_AIR_BAGS_VALUE'] ) $offers .= '<param name="Количество воздушных подушек">'.$element['PROPERTY_AIR_BAGS_VALUE'].'</param>'.$NL;
	  
      if( $element['PROPERTY_UPRAVLENIE_VALUE'] ) $offers .= '<param name="Управление">'.$upravlenie.'</param>'.$NL;
	  
      if( $element['PROPERTY_NAKLON_BLOKA_DLYA_NOG_VALUE'] ) $offers .= '<param name="Наклон блока для ног">'.$element['PROPERTY_NAKLON_BLOKA_DLYA_NOG_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_AUTO_OFF_VALUE'] ) $offers .= '<param name="Автоматическое отключение">'.$element['PROPERTY_AUTO_OFF_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_V_MEMORY_VALUE'] ) $offers .= '<param name="Возможность памяти">'.$element['PROPERTY_V_MEMORY_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_PODGOLOVNIK_VALUE'] ) $offers .= '<param name="Съемный регулируемый подголовник">'.$element['PROPERTY_PODGOLOVNIK_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_AUTO_RASKLAD_VALUE'] ) $offers .= '<param name="Автоматическое раскладывание">'.$element['PROPERTY_AUTO_RASKLAD_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_POVOROTNAYA_BAZA_VALUE'] ) $offers .= '<param name="Поворотная база">'.$element['PROPERTY_POVOROTNAYA_BAZA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_UGOL_NAKLONA_KRESLA_VALUE'] ) $offers .= '<param name="Угол наклона кресла">'.$element['PROPERTY_UGOL_NAKLONA_KRESLA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_KOLICHESTVO_ROL_BACK_VALUE'] ) $offers .= '<param name="Количество массажных роликов спины">'.$element['PROPERTY_KOLICHESTVO_ROL_BACK_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_RECOMMEND_HEIGHT_VALUE'] ) $offers .= '<param name="Рекомендуемая высота пользователя">'.$element['PROPERTY_RECOMMEND_HEIGHT_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_INDIKATOR_VREMENI_PROGRAMMY_VALUE'] ) $offers .= '<param name="Индикатор времени программы">'.$element['PROPERTY_INDIKATOR_VREMENI_PROGRAMMY_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_FUNKCIA_MASSAZH_KARETKA_VALUE'] ) $offers .= '<param name="Траектория передвижения массажной каретки">'.$element['PROPERTY_FUNKCIA_MASSAZH_KARETKA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_DLINA_HODA_KARETKI_VALUE'] ) $offers .= '<param name="Длина хода массажной каретки">'.$element['PROPERTY_DLINA_HODA_KARETKI_VALUE'].'</param>'.$NL;
	  	  	  
      if( $element['PROPERTY_VID_MASSAGA_VALUE'] ) $offers .= '<param name="Вид массажа">'.$list_vid_massaga.'</param>'.$NL;
	  
      if( $element['PROPERTY_ZONY_MASSAZHA_VALUE'] ) $offers .= '<param name="Зоны массажа">'.$zony_massazha.'</param>'.$NL;	
	  
      if( $element['PROPERTY_ZONY_PROGREVA_VALUE'] ) $offers .= '<param name="Зоны прогрева">'.$zony_progreva.'</param>'.$NL;
	  	  
      if( $element['PROPERTY_FUNKCIA_NEVESOMOSTI_VALUE'] ) $offers .= '<param name="Функция Zero Gravity">'.$element['PROPERTY_FUNKCIA_NEVESOMOSTI_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_FUNKCIA_VPLOTNUU_STENE_VALUE'] ) $offers .= '<param name="Функция Zero Wall">'.$element['PROPERTY_FUNKCIA_VPLOTNUU_STENE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_WALL_VALUE'] ) $offers .= '<param name="Рекомендуемое расстояние от стены">'.$element['PROPERTY_WALL_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_FUNKCIA_RASTYAZHKA_VALUE'] ) $offers .= '<param name="Функция растяжки">'.$element['PROPERTY_FUNKCIA_RASTYAZHKA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_MASSAGE_SHEI_VALUE'] ) $offers .= '<param name="Массаж шеи">'.$element['PROPERTY_MASSAGE_SHEI_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_MASSAGE_NOG_VALUE'] ) $offers .= '<param name="Массаж ног">'.$element['PROPERTY_MASSAGE_NOG_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_FUNKCIA_MASSAG_KOLENEI_VALUE'] ) $offers .= '<param name="Массаж коленей">'.$element['PROPERTY_FUNKCIA_MASSAG_KOLENEI_VALUE'].'</param>'.$NL;
	  
      if( $element['PROPERTY_VID_MASSAGE_CALF_VALUE'] ) $offers .= '<param name="Вид массажа икр">'.$vid_massage_calf.'</param>'.$NL;
	  
      if( $element['PROPERTY_FUNKCIA_TIP_MASSAG_STOP_VALUE'] ) $offers .= '<param name="Вид массажа стоп">'.$funkcia_tip_massag_stop.'</param>'.$NL;
	  
      if( $element['PROPERTY_VID_MASSAGA_JAGODIC_VALUE'] ) $offers .= '<param name="Вид массажа ягодиц">'.$vid_massaga_jagodic.'</param>'.$NL;
	  
      if( $element['PROPERTY_FUNKCIA_3D_4D_VALUE'] ) $offers .= '<param name="Массажный механизм">'.$element['PROPERTY_FUNKCIA_3D_4D_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_AUTO_PROGRAMM_VALUE'] ) $offers .= '<param name="Количество автоматических программ">'.$element['PROPERTY_AUTO_PROGRAMM_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_KOLICHESTVO_ROLIKOV_VALUE'] ) $offers .= '<param name="Количество роликов">'.$element['PROPERTY_KOLICHESTVO_ROLIKOV_VALUE'].'</param>'.$NL;
	  
      if( $element['PROPERTY_OPTIONS_COMFORT_VALUE'] ) $offers .= '<param name="Опции комфорт">'.$options_comfort.'</param>'.$NL;
	  
      if( $element['PROPERTY_PORT_DLYA_ZARYADKI_VALUE'] ) $offers .= '<param name="Порт для зарядки">'.$port_z.'</param>'.$NL;
      if( $element['PROPERTY_FUNKCIA_MULTIMEDIA_VALUE'] ) $offers .= '<param name="Мультимедиа">'.$mult.'</param>'.$NL;
	  
      if( $element['PROPERTY_YAZIK_VALUE'] ) $offers .= '<param name="Язык интерфейса">'.$yazik.'</param>'.$NL;
	  
      if( $element['PROPERTY_TIMER_VALUE'] ) $offers .= '<param name="Таймер">'.$element['PROPERTY_TIMER_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_POWER_VALUE'] ) $offers .= '<param name="Мощность">'.$element['PROPERTY_POWER_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_POTR_MOSH_VALUE'] ) $offers .= '<param name="Потребляемая мощность">'.$element['PROPERTY_POTR_MOSH_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_VOLTAGE_VALUE'] ) $offers .= '<param name="Напряжение питания">'.$element['PROPERTY_VOLTAGE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_PITANIYE_VALUE'] ) $offers .= '<param name="Питание">'.$element['PROPERTY_PITANIYE_VALUE'].'</param>'.$NL;		  
      if( $element['PROPERTY_CHASTOTA_VALUE'] ) $offers .= '<param name="Частота">'.$element['PROPERTY_CHASTOTA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_AIR_COMPRESSION_VALUE'] ) $offers .= '<param name="Давление воздуха">'.$element['PROPERTY_AIR_COMPRESSION_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_SAFE_VALUE'] ) $offers .= '<param name="Степень безопасности">'.$element['PROPERTY_SAFE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_NOISE_VALUE'] ) $offers .= '<param name="Шум">'.$element['PROPERTY_NOISE_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_ION_VALUE'] ) $offers .= '<param name="Концентрация отрицательных ионов">'.$element['PROPERTY_ION_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_WAIT_VALUE'] ) $offers .= '<param name="Потребление во время ожидания">'.$element['PROPERTY_WAIT_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_MAX_GRUZ_VALUE'] ) $offers .= '<param name="Максимальная нагрузка">'.$element['PROPERTY_MAX_GRUZ_VALUE'].'</param>'.$NL;


      if( $element['PROPERTY_KOLICHESTVO_KAMER_VALUE'] ) $offers .= '<param name="Количество камер">'.$element['PROPERTY_KOLICHESTVO_KAMER_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_KOLICHESTVO_KANALOV_VALUE'] ) $offers .= '<param name="Количество каналов">'.$element['PROPERTY_KOLICHESTVO_KANALOV_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_KOLICHESTVO_PROGRAMM_VALUE'] ) $offers .= '<param name="Количество программ">'.$element['PROPERTY_KOLICHESTVO_PROGRAMM_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_PROGRAMMY_VALUE'] ) $offers .= '<param name="Программы">'.$element['PROPERTY_PROGRAMMY_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_DAVLENIE_VALUE'] ) $offers .= '<param name="Давление">'.$element['PROPERTY_DAVLENIE_VALUE'].'</param>'.$NL;	  
      if( $element['PROPERTY_REGULIROVKA_DAVLENIYA_VALUE'] ) $offers .= '<param name="Регулировка давления">'.$element['PROPERTY_REGULIROVKA_DAVLENIYA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_SHAG_IZMENENIYA_DAVLENIYA_VALUE'] ) $offers .= '<param name="Шаг изменения давления">'.$element['PROPERTY_SHAG_IZMENENIYA_DAVLENIYA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_OTKLYUCHENIE_DAVLENIYA_V_KAMERAH_VALUE'] ) $offers .= '<param name="Отключение давления в камерах">'.$element['PROPERTY_OTKLYUCHENIE_DAVLENIYA_V_KAMERAH_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_DISPLEJ_VALUE'] ) $offers .= '<param name="Дисплей">'.$element['PROPERTY_DISPLEJ_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_KOMPLEKTACIYA_VALUE'] ) $offers .= '<param name="Комплектация">'.$element['PROPERTY_KOMPLEKTACIYA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_VES_KOMPRESSORA_VALUE'] ) $offers .= '<param name="Вес компрессора">'.$element['PROPERTY_VES_KOMPRESSORA_VALUE'].'</param>'.$NL;	


      if( $element['PROPERTY_GABARITN_DS_VALUE'] ) $offers .= '<param name="Габаритные размеры (Д х Ш х В)">'.$element['PROPERTY_GABARITN_DS_VALUE'].'</param>'.$NL;	
      if( $element['PROPERTY_GABARUTN_SID_VALUE'] ) $offers .= '<param name="Габаритные размеры сиденья (Д х Ш)">'.$element['PROPERTY_GABARUTN_SID_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_R_HEIGHT_VALUE'] ) $offers .= '<param name="Размеры в вертикальном положении (Д х Ш х В)">'.$element['PROPERTY_R_HEIGHT_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_R_WIDTH_VALUE'] ) $offers .= '<param name="Размеры в горизонтальном положении (Д х Ш х В)">'.$element['PROPERTY_R_WIDTH_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_G_KRESLA_VALUE'] ) $offers .= '<param name="Габариты кресла (Д х Ш х В)">'.$element['PROPERTY_G_KRESLA_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_G_KOROBKI_VALUE'] ) $offers .= '<param name="Габариты коробки №1 (Д х Ш х В)">'.$element['PROPERTY_G_KOROBKI_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_G_KOROBKI2_VALUE'] ) $offers .= '<param name="Габариты коробки №2 (Д х Ш х В)">'.$element['PROPERTY_G_KOROBKI2_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_G_KOROBKI3_VALUE'] ) $offers .= '<param name="Габариты коробки №3 (Д х Ш х В)">'.$element['PROPERTY_G_KOROBKI3_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_VESKOROBKI1_VALUE'] ) $offers .= '<param name="Вес коробки №1 (нетто/брутто)">'.$element['PROPERTY_VESKOROBKI1_VALUE'].'</param>'.$NL;	
      if( $element['PROPERTY_VESKOROBKI2_VALUE'] ) $offers .= '<param name="Вес коробки №2 (нетто/брутто)">'.$element['PROPERTY_VESKOROBKI2_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_VESKOROBKI3_VALUE'] ) $offers .= '<param name="Вес коробки №3 (нетто/брутто)">'.$element['PROPERTY_VESKOROBKI3_VALUE'].'</param>'.$NL;
		 
      if( $element['PROPERTY_RASM_DSV_VALUE'] ) $offers .= '<param name="Размер(Д x Ш x В)">'.$element['PROPERTY_RASM_DSV_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_VES_NETTO_VALUE'] ) $offers .= '<param name="Нетто">'.$element['PROPERTY_VES_NETTO_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_VES_BRUTTO_VALUE'] ) $offers  .= '<param name="Брутто">'.$element['PROPERTY_VES_BRUTTO_VALUE'].'</param>'.$NL;
      if ( $element['PROPERTY_BARCODE_VALUE'] ) {
         $offers .= '<barcode>'.$element['PROPERTY_BARCODE_VALUE'].'</barcode>'.$NL;
      }
      else {
         $offers .= '<barcode>'.barCodeGen( $element['ID'] ).'</barcode>'.$NL;
      }
	  
	  if( $element['PROPERTY_MANUFACTURER_VALUE'] ) $offers .= '<country_of_origin>'.$element['PROPERTY_MANUFACTURER_VALUE'].'</country_of_origin>'.$NL;
      $offers .= '</offer>'.$NL;
	  }
	}

   }
}

$ymlContent .= '<categories>'.$NL;
$ymlContent .= $categories;
$ymlContent .= '</categories>'.$NL;

$ymlContent .= '<offers>'.$NL;
$ymlContent .= $offers;
$ymlContent .= '</offers>'.$NL;

$ymlContent .= '</shop>'.$NL;
$ymlContent .= '</yml_catalog>'.$NL;

echo $ymlContent;
?>