<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (defined('SEO_GENERATION_INCLUDED') && SEO_GENERATION_INCLUDED === true) {
    $seoGeneration = new SeoHelper();
    if ($seoGeneration->genCanonical()) {
        $APPLICATION->SetPageProperty("canonical", $seoGeneration->genCanonical());
    }
    if ($arResult["NAVPAGE_COUNT"]) {
        if ($seoGeneration->addNextPrev($arResult["NAVPAGE_COUNT"])) {
            $nextPrevMeta = $seoGeneration->addNextPrev($arResult["NAVPAGE_COUNT"]);
            if (empty($nextPrevMeta["next"]) === false) {
                $APPLICATION->SetPageProperty("linkNext", $nextPrevMeta["next"]);
            }
            if (empty($nextPrevMeta["prev"]) === false) {
                $APPLICATION->SetPageProperty("linkPrev", $nextPrevMeta["prev"]);
            }
        }
    }
}