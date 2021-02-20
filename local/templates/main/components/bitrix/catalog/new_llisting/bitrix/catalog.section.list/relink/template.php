<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<? if (empty($arResult["SECTIONS_RELINK"]) === false): 
?>
    <div class="relink">
        <div class="relink_cat">
            <? foreach ($arResult["SECTIONS_RELINK"] as $value): ?>
                <? if (empty($value["UF_RELINK"]) === false && $value["UF_RELINK"] == 1): ?>
                    <div class="relink_cat-item">
                        <a href="<?= $value["SECTION_PAGE_URL"]?>"><? 
                                if (empty($value["UF_NAME_RELINK"]) === false) {
                                    echo $value["UF_NAME_RELINK"];
                                } else {
                                    echo $value["NAME"];
                                }
						
                            ?><sup><?=$value["ELEMENT_CNT"];?></sup></a>
                    </div>
                <? endif ?>
            <? endforeach; ?>
        </div>
    </div>

    <div class="clear"></div>
<? endif; ?>