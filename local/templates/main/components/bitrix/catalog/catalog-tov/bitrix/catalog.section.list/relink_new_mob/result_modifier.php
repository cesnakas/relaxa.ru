<?
// var_dump($arResult["SECTIONS"]);
if(empty($arResult["SECTIONS"][0])){ 
		$arFilter = Array(
			"IBLOCK_ID" => $arResult["SECTION"]["IBLOCK_ID"],
			"GLOBAL_ACTIVE" => "Y",
			"ACTIVE" => "Y",
			"SECTION_ID" => $arResult["SECTION"]["PATH"][count($arResult["SECTION"]["PATH"])-2]["ID"],
			"CNT_ACTIVE" => "Y"
		);
		$db_list = CIBlockSection::GetList(
			array("SORT"=>"ASC"), 
			$arFilter, 
			true
		);
		while($ar_result = $db_list->GetNext()){
			$arResult["SECTIONS"][] = array(
				"ID" => $ar_result["ID"],
				"SELECTED" => ($arResult["SECTION"]["ID"] == $ar_result["ID"] ? true : false), 
				"SECTION_PAGE_URL" => $ar_result["SECTION_PAGE_URL"], 
				"NAME" => $ar_result["NAME"], 
				"ELEMENT_CNT" => $ar_result["ELEMENT_CNT"]
			);
		}

	}
	$arItems = [];
	$arType = $arResult["SECTIONS"];
	foreach ($arResult["SECTIONS"] as $sectionKey => $section) {
		$dbSections = CIBlockSection::GetList(
			array(),
			array(
				"IBLOCK_ID" => $arResult["SECTION"]["IBLOCK_ID"],
				"ID" => $section["ID"],				
				"CNT_ACTIVE" => "Y",
			),
			true,
			array("IBLOCK_ID", "ID", "SECTION_PAGE_URL", "NAME", "UF_*", "ELEMENT_CNT")
		);
		while($arSections = $dbSections->GetNext()) {
			if (empty($arSections["UF_SHOW_BRAND"]) === false && $arSections["UF_SHOW_BRAND"] == 1) {
				$arBrands[] = [
					"NAME" => $arSections["UF_NAME_BRAND"],
					"SECTION_PAGE_URL" => $arSections["SECTION_PAGE_URL"],
					"ELEMENT_CNT" => $arSections["ELEMENT_CNT"]
				];
				unset($arType[$sectionKey]);
			}
			if (empty($arSections["UF_RELINK"]) === false && $arSections["UF_RELINK"] == 1) {
				unset($arType[$sectionKey]);
			}
		}
	}
	$arResult["LEFT_MENU"] = [];
	if (empty($arType) === false) {
		$arResult["LEFT_MENU"]["TYPE"] = $arType;
	}
	if (empty($arBrands) === false) {
		$arResult["LEFT_MENU"]["BRAND"] = $arBrands;
		$arResult["LEFT_MENU"]["BRAND"]["ANCHOR"] = 'Απενδ';
	}
?>