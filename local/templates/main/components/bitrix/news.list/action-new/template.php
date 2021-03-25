<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
global $actionN;
?>
<?/*
<style>
    .page__p-stocks {
        margin-bottom: 40px;
    }
    .p-stocks {
        display: block;
        background-color: #ACE0FC;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
    }
    .p-stocks__top {
        display: block;
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 26px;
        padding-top: 30px;
        text-align: center;
    }
    .p-stocks__title {
        color: #9D0A0F;
        font-size: 22px;
        line-height: 26px;
        text-transform: uppercase;
        display: inline-block;
        padding-right: 42px;
        position: relative;
        font-family: 'Myriad Pro Regular';
        font-weight: 800;
    }
    .p-stocks__title svg {
        position: absolute;
        right: 0;
        top: 4px;
        transform: rotate(90deg);
        -webkit-transform: rotate(90deg);
        height: 18px;
        margin: 0;
        width: auto;
    }
    .p-stocks__title.active svg {
        transform: rotate(-90deg);
        -webkit-transform: rotate(-90deg);
    }
    .p-stocks__content {
        padding-left: 10px;
        padding-right: 10px;
        padding-bottom: 30px;
        font-weight: normal;
        font-size: 22px;
        line-height: 26px;
        text-align: center;
        color: #0A5A77;
        font-family: 'Myriad Pro Bold';
    }
    .p-stocks__content a {
        text-decoration: none;
        color: #9D0A0F;
    }
    .p-stocks__content a:hover {
        text-decoration: underline;
        color: #9D0A0F;
    }
</style>
<script>
    $(document).ready(function() {
        $('.p-stocks__top').on('click', function() {
            $(this).children('p-stocks__title').toggleClass('active');
            return false;
        });
    });
</script>


<div class="page__p-stocks">
    <div class="p-stocks">
        <a href="#" class="p-stocks__top">
            <span class="p-stocks__title">
                АКЦИЯ: КУПИ ИЗ ДОМА +5% СКИДКа
                <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="chevron-right" class="svg-inline--fa fa-chevron-right fa-w-10" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="#780707" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg>
            </span>
        </a>
        <div class="p-stocks__content" style="display: none;">
            <p>
                Мы стремимся сделать доставку безопасной, а покупку выгодной.<br>
                • На товары ОТО, UNO, EGO, FUJIMO, HANSUN доставка 0 руб.<br>
                • При оплате онлайн вводится дополнительная скидка +5%<br>
                <a href="https://www.relaxa.ru/articles/pokupat_iz_doma_vygodnee/?roistat_visit=423067">Посмотреть подробности акции</a><br>
            </p>
        </div>
    </div>
</div>
*/?>

<div class="news-list">
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>
    <?$i = 1;?>




<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    if($i == 1) {
        if(!empty($actionN) && $arItem['ID'] == $actionN) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="news-catalog" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?echo $arItem["PREVIEW_TEXT"];?>
            </div>
            <style>
                .news-catalog {
                    margin-bottom: 40px;
                    margin-top: -10px;
                }
            </style>

            <?
            $i++;
        }
    }
	?>
<?endforeach;?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
        <?if($i == 1) {
            $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
            $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
            ?>
            <div class="news-catalog" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
                <?echo $arItem["PREVIEW_TEXT"];?>
            </div>
            <style>
                .news-catalog {
                    margin-bottom: 40px;
                    margin-top: -10px;
                }
            </style>

            <?
            $i++;
        }?>
    <?endforeach;?>


</div>
