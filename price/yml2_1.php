<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
// if (!$GLOBALS["USER"]->IsAdmin()) {   exit();}

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
   header("Content-Disposition: attachment; filename=relaxaPrice.yml");
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
$ymlContent .= '<platform>1C-Bitrix</platform>'.$NL;


$ymlContent .= '<currencies>'.$NL;
$lcur = CCurrency::GetList(($by="sort"), ($order="asc"), LANGUAGE_ID);
while($lcur_res = $lcur->Fetch()) {
   //echo "<pre>"; print_r($lcur_res); echo "</pre>";
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
					'PROPERTY_MANUFACTURER',
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
					'PROPERTY_MANUFACTURER',
					'PROPERTY_GUARANTEE',
					'PROPERTY_NO_DISCOUNT',
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

      $offers .= '<offer id="'.$element["ID"].'" available="true">'.$NL;
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
      //$offers .= '<vat>6</vat>'.$NL;
      if ( $arBrands[$element['PROPERTY_ATT_BRAND_VALUE']] ) {
         $offers .= '<vendor>'.$arBrands[$element['PROPERTY_ATT_BRAND_VALUE']].'</vendor>'.$NL;
      }
      $offers .= '<model>'.$element['PROPERTY_CML2_ARTICLE_VALUE'].'</model>'.$NL;
      $offers .= '<name>'.$element["NAME"].'</name>'.$NL;	
	  $offers .= '<shop-sku>'.$element['PROPERTY_CML2_ARTICLE_VALUE'].'</shop-sku>'.$NL;	  
      $offers .= '<description><![CDATA['.$element["PREVIEW_TEXT"].']]></description>'.$NL;
      if ($element['PROPERTY_CONDITION_VALUE']== "Новое с дефектом") 
         $offers .= '<condition type="likenew"><reason>'.$element['PROPERTY_COND_DESC_VALUE'].'</reason></condition>'.$NL;
      elseif ($element['PROPERTY_CONDITION_VALUE']== "Б/У")
		 $offers .= '<condition type="used"><reason>'.$element['PROPERTY_COND_DESC_VALUE'].'</reason></condition>'.$NL;
      if( $element['PROPERTY_RASM_DSV_VALUE'] ) $offers .= '<param name="Размер(ДxШxВ)">'.$element['PROPERTY_RASM_DSV_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_VES_NETTO_VALUE'] ) $offers .= '<param name="Нетто">'.$element['PROPERTY_VES_NETTO_VALUE'].'</param>'.$NL;
      if( $element['PROPERTY_VES_BRUTTO_VALUE'] ) $offers  .= '<param name="Брутто">'.$element['PROPERTY_VES_BRUTTO_VALUE'].'</param>'.$NL;
      if ( $element['PROPERTY_BARCODE_VALUE'] ) {
         $offers .= '<barcode>'.$element['PROPERTY_BARCODE_VALUE'].'</barcode>'.$NL;
      }
      else {
         $offers .= '<barcode>'.barCodeGen( $element['ID'] ).'</barcode>'.$NL;
      }
	  
	  if( $element['PROPERTY_MANUFACTURER_VALUE'] ) $offers .= '<country_of_origin>'.$element['PROPERTY_MANUFACTURER_VALUE'].'</country_of_origin>'.$NL;
	  if( $element['PROPERTY_GUARANTEE_VALUE'] ) $offers .= '<manufacturer_warranty>true</manufacturer_warranty>'.$NL;
	  $offers .= '<sales_notes>Бесплатная доставка и сборка, подъем бесплатно.</sales_notes>';
	  
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
$ymlContent  .= '<gifts>'.$NL;
foreach ($elements_gift as $element_gift)
{
$res = CIBlockElement::GetByID($element_gift);
	if($ar_res = $res->GetNext()) {
		$picSrc = CFile::GetPath($ar_res['DETAIL_PICTURE']);
		//echo "<pre>"; print_r($ar_res); echo "</pre>";
		$ymlContent .= 
			  '<gift id="'.$ar_res['ID'].'">
				<name>'.$ar_res['NAME'].'</name>
				<picture>https://relaxa.ru'.$picSrc.'</picture>
			  </gift>'.$NL;
	}
}
$ymlContent  .= '</gifts>'.$NL;
//echo "<pre>"; print_r($elements_gift); echo "</pre>";
$ymlContent .= '<promos>'.$NL;
$ymlContent .= '<promo id="PromoGift" type="gift with purchase">'.$NL;
foreach ($elements_promos as $element_promo => $value)
{
		$ymlContent .='<purchase>'.$NL;
		$ymlContent .='<product offer-id="'.$element_promo.'"/>'.$NL;
		$ymlContent .='</purchase>'.$NL;
		$ymlContent .='<promo-gifts>'.$NL;
		foreach ($value as $promo)
		{
			$ymlContent .='<promo-gift gift-id="'.$promo.'"/>'.$NL;
		}
		$ymlContent .='</promo-gifts>'.$NL;
}
$ymlContent .= '</promo>'.$NL;
$ymlContent .= '</promos>'.$NL;

//$ymlContent .= ''.$NL;
$ymlContent .= '</shop>'.$NL;
$ymlContent .= '</yml_catalog>'.$NL;
//file_put_contents("yml.txt", $ymlContent);

//$resStr = mb_convert_encoding($resStr, 'windows-1251', 'UTF-8');
echo $ymlContent;
?>