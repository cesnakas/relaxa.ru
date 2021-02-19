<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<ul class="catpanel__list" style="display: none;">

    <?foreach ($arResult["LEFT_MENU"]['TYPE'] as $value):?>

        <li class="catpanel__item">
            <a href="<?= $value["SECTION_PAGE_URL"]?>" class="catpanel__link">
                <?echo $value["NAME"];?>
                <span class="catpanel__link-count"><?=$value["ELEMENT_CNT"];?></span>
            </a>
        </li>

    <?endforeach;?>

</ul>
