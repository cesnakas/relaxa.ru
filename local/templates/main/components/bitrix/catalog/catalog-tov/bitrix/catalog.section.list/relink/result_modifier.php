<?
if(!empty($arResult["SECTIONS"])){
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
			$arResult["SECTIONS_RELINK"][] = $arSections;
		}
	}
}
