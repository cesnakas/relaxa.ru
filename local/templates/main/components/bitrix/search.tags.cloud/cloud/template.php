<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
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
?>

<?php if (is_array($arResult['SEARCH']) && !empty($arResult['SEARCH'])): ?>
<div class="b-tag-weight">
    <h3>Подборки</h3>
    <ul class="list5b">
    <?php foreach ($arResult['SEARCH'] as $arItem): ?>
        <a href="https://relaxa.ru/news/index.php?arrTags_ff%5BTAGS%5D=<?= $arItem['NAME']; ?>&set_filter=Y"><li><?= $arItem['NAME']; ?></li></a>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>