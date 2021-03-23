<?$APPLICATION->SetAdditionalCSS($templateFolder."/css/review.css");?>
<?$APPLICATION->SetAdditionalCSS($templateFolder."/css/media.css");?>
<?$APPLICATION->SetAdditionalCSS($templateFolder."/css/set.css");?>

<?$APPLICATION->AddHeadScript($templateFolder."/js/morePicturesCarousel.js");?>
<?$APPLICATION->AddHeadScript($templateFolder."/js/pictureSlider.js");?>
<?$APPLICATION->AddHeadScript($templateFolder."/js/zoomer.js");?>
<?$APPLICATION->AddHeadScript($templateFolder."/js/tabs.js");?>
<?$APPLICATION->AddHeadScript($templateFolder."/js/sku.js");?>

<?
	/* Что, блин, здесь происходит? */
	if(!empty($templateData["CANONICAL_URL"]) ){
		$APPLICATION->AddHeadString('<link href="'.$templateData["CANONICAL_URL"].'" rel="canonical" />', true);
	}elseif($arResult['DETAIL_PAGE_URL'] !== $arResult['DETAIL_PAGE_URL_TMP']){
		$APPLICATION->AddHeadString('<link href="'.$arResult['DETAIL_PAGE_URL'].'" rel="canonical" />', true);
	}


	if (empty($arResult["PROPERTIES"]["CANONICAL_URL"]["VALUE"]) === false) {
		$canonical = $arResult["PROPERTIES"]["CANONICAL_URL"]["VALUE"];
		$toValidate = 'https://' . $_SERVER["HTTP_HOST"] . $canonical;
		if(filter_var($toValidate, FILTER_VALIDATE_URL, FILTER_FLAG_PATH_REQUIRED) !== false) {
			$APPLICATION->AddHeadString('<link  rel="canonical" href="https://' .  $_SERVER["HTTP_HOST"] . $canonical . '"/>');
		}
	}
?>