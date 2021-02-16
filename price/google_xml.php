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


header("Content-type: text/xml");
header("Content-Disposition: attachment; filename=google_xml_rss2.xml");
header("Pragma: no-cache");
header("Expires: 0");

CModule::IncludeModule("currency");
CModule::IncludeModule("iblock");

$NL = "\r\n";
$ymlContent = '<?xml version="1.0"?>'.$NL;
$ymlContent .= '<rss xmlns:g="http://base.google.com/ns/1.0" version="2.0">'.$NL;
$ymlContent .= '<channel>'.$NL;
$ymlContent .= '<title>Relaxa</title>'.$NL;
$ymlContent .= '<link>https://relaxa.ru</link>'.$NL;
$ymlContent .= '<description>Relaxa.ru - массажные кресла, массажеры для ног, массажеры для спины, массажные подушки купить в Москве</description>'.$NL;

$brands = CIBlockElement::GetList(array(), array('IBLOCK_ID' => 17, '!PROPERTY_HIDE_IN_PRICE' => 'Y', 'ACTIVE' => ''), false, false, array('ID', 'NAME'));
if ($brands->SelectedRowsCount()) {
    while ($brand = $brands->Fetch()) {
        $arBrands[$brand['ID']] = $brand['NAME'];
    }
}

$categories = array();
$iBlocks = CIBlock::GetList(array(), array('TYPE' => 'catalog', 'ACTIVE' => 'Y'), false);
while( $iBlock = $iBlocks->Fetch() ) {
            $arFilter = array('IBLOCK_ID' => $iBlock['ID'], 'ACTIVE' => 'Y', '!PROPERTY_DO_NOT_SHOW' => 'Y');
            if( in_array(6, $arGroups) || in_array(8, $arGroups) ) $arFilter = array_merge( $arFilter, array('!PROPERTY_HIDE_FROM_DILLERS' => 'Y') );

   $arFilter = array('IBLOCK_ID' => $iBlock["ID"], 'ACTIVE' => 'Y', 'ELEMENT_SUBSECTIONS' => 'Y', 'CNT_ACTIVE' => 'Y');
   $arSelect = array('ID', 'NAME', 'IBLOCK_SECTION_ID');
   $rsSection = CIBlockSection::GetList(array("SORT" => "ASC", "ID" => "ASC"), $arFilter, false, $arSelect); 
   while($arSection = $rsSection->Fetch()) {
      if( !$arSection["IBLOCK_SECTION_ID"] ) $categories[$arSection["ID"]] = array('name' => $arSection["NAME"]);
      else $categories[$arSection["ID"]] = array('name' => $arSection["NAME"], 'parent' => $arSection["IBLOCK_SECTION_ID"]);
   }
}

if (($handle = fopen("google_xml_taxomony.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 256, ";")) !== FALSE) {
		if(!empty($categories[$data[0]])) $categories[$data[0]]['google_category'] = $data[1];
	}
}

$iBlocks = CIBlock::GetList(array(), array('TYPE' => 'catalog', 'ACTIVE' => 'Y'), false);
while( $iBlock = $iBlocks->Fetch() ) {
            $arFilter = array('IBLOCK_ID' => $iBlock['ID'], 'ACTIVE' => 'Y', '!PROPERTY_DO_NOT_SHOW' => 'Y');
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
                )
            );

            if (!$elements->SelectedRowsCount()) continue;

   $arFilter = array('IBLOCK_ID' => $iBlock["ID"], 'ACTIVE' => 'Y', 'ELEMENT_SUBSECTIONS' => 'Y', 'CNT_ACTIVE' => 'Y');
   $arSelect = array('ID', 'NAME');
   $rsSection = CIBlockSection::GetList(array("SORT" => "ASC", "ID" => "ASC"), $arFilter, false, $arSelect); 
   while($arSection = $rsSection->Fetch()) {

            $arFilter = array('IBLOCK_ID' => $iBlock['ID'], 'ACTIVE' => 'Y', 'IBLOCK_SECTION_ID' => $arSection["ID"], '!PROPERTY_DO_NOT_SHOW' => 'Y');
            $elements = CIBlockElement::GetList(
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
                    'PROPERTY_BARCODE',
					'PROPERTY_CONDITION',
					'PROPERTY_COND_DESC',
					'PROPERTY_GIFTS',
					'PROPERTY_MANUFACTURE',
					'PROPERTY_GUARANTEE',
                )
            );
   if (!$elements->SelectedRowsCount()) continue;
      //if( !$arSection["IBLOCK_SECTION_ID"] ) $categories[$arSection["ID"]] = array('name' => $arSection["NAME"]);
      //else $categories[$arSection["ID"]] = array('name' => $arSection["NAME"], 'parent' => $arSection["IBLOCK_SECTION_ID"]);

   while ($element = $elements->GetNext()) {
		if ( !$element["IBLOCK_SECTION_ID"] ) continue;

		$picSrc = CFile::GetPath($element['DETAIL_PICTURE']);
		$price = CCatalogProduct::GetOptimalPrice($element['ID']);

		$ymlContent .= '<item>'.$NL;

		$ymlContent .= '<g:id>'.$element["ID"].'</g:id>'.$NL;
		$ymlContent .= '<g:title>'.$element["NAME"].'</g:title>'.$NL;
		
		$ymlContent .= '<g:description><![CDATA['.$element["PREVIEW_TEXT"].$NL.$NL;
		if($element['PROPERTY_VES_NETTO_VALUE']) $ymlContent .= 'Вес Нетто: '.$element['PROPERTY_VES_NETTO_VALUE'].$NL;
		if($element['PROPERTY_VES_BRUTTO_VALUE']) $ymlContent .= 'Вес Брутто: '.$element['PROPERTY_VES_BRUTTO_VALUE'].$NL;
		$ymlContent .= 'Бесплатная доставка и сборка, подъем бесплатно.'.$NL;
		if($element['PROPERTY_MANUFACTURE_VALUE']) $ymlContent .= 'Страна производителя: '.$element['PROPERTY_MANUFACTURE_VALUE'].$NL;
		if($element['PROPERTY_GUARANTEE_VALUE']) $ymlContent .= 'Гарантия производителя: '.$element['PROPERTY_GUARANTEE_VALUE'].$NL;
		$ymlContent .= ']]></g:description>'.$NL;
		
		$ymlContent .= '<g:link>https://relaxa.ru'.$element['DETAIL_PAGE_URL'].'</g:link>'.$NL;
		$ymlContent .= '<g:image_link>https://relaxa.ru'.$picSrc.'</g:image_link>'.$NL;
		
		if($element['PROPERTY_CONDITION_VALUE']== "Б/У")
			$ymlContent .= '<g:condition>used</g:condition>'.$NL;
		else 
			$ymlContent .= '<g:condition>new</g:condition>'.$NL;
		
		$ymlContent .= '<g:availability>in stock</g:availability>'.$NL;
		
		$ymlContent .=' <g:price>'.$price['PRICE']['PRICE'].' RUB</g:price>'.$NL;
		if(intval($price['DISCOUNT_PRICE']) < intval($price['PRICE']['PRICE'])){
			$ymlContent .=' <g:sale_price>'.$price['DISCOUNT_PRICE'].' RUB</g:sale_price>'.$NL;
		}
		
		
		if($element['PROPERTY_RASM_DSV_VALUE']) $ymlContent .= '<g:size>'.$element['PROPERTY_RASM_DSV_VALUE'].'</g:size>'.$NL;
		//if($element['PROPERTY_VES_NETTO_VALUE']){
		//	$element['PROPERTY_VES_NETTO_VALUE'] = str_replace(array('гр','кг',',',' '), array('g','kg','.',''), $element['PROPERTY_VES_NETTO_VALUE']);
		//	$ymlContent .='<g:unit_​pricing_​measure>'.$element['PROPERTY_VES_NETTO_VALUE'].'</g:unit_​pricing_​measure>'.$NL;
		//}
		if($element['PROPERTY_BARCODE_VALUE'])
			$ymlContent .= '<g:gtin>'.$element['PROPERTY_BARCODE_VALUE'].'</g:gtin>'.$NL;
		else
			$ymlContent .= '<g:gtin>'.barCodeGen( $element['ID'] ).'</g:gtin>'.$NL;
		
		if( $arBrands[$element['PROPERTY_ATT_BRAND_VALUE']])
			$ymlContent .= '<g:brand>'.$arBrands[$element['PROPERTY_ATT_BRAND_VALUE']].'</g:brand>'.$NL;
		
		if($element['PROPERTY_CML2_ARTICLE_VALUE'])
			$ymlContent .= '<g:mpn>'.$element['PROPERTY_CML2_ARTICLE_VALUE'].'</g:mpn>'.$NL;
		
		if(!empty($categories[$element["IBLOCK_SECTION_ID"]]['google_category']))
			$ymlContent .= '<g:google_product_category>'.$categories[$element["IBLOCK_SECTION_ID"]]['google_category'].'</g:google_product_category>'.$NL;
		
		$cur_category = $categories[$element["IBLOCK_SECTION_ID"]]['name'];
		if(!empty($categories[$element["IBLOCK_SECTION_ID"]]['parent']))
			$cur_category = $categories[$categories[$element["IBLOCK_SECTION_ID"]]['parent']]['name'].' &gt; '.$cur_category;
		if(!empty($categories[$categories[$element["IBLOCK_SECTION_ID"]]['parent']]['parent']))
			$cur_category = $categories[$categories[$categories[$element["IBLOCK_SECTION_ID"]]['parent']]['parent']]['name'].' &gt; '.$cur_category;
		$ymlContent .= '<g:product_type id="'.$element["IBLOCK_SECTION_ID"].'">'.$cur_category.'</g:product_type>';
		
		$ymlContent .= '</item>'.$NL;
   }
   }
}

$ymlContent .= '</channel>'.$NL;
$ymlContent .= '</rss>'.$NL;
//file_put_contents("yml.txt", $ymlContent);

//$resStr = mb_convert_encoding($resStr, 'windows-1251', 'UTF-8');
echo $ymlContent;
?>