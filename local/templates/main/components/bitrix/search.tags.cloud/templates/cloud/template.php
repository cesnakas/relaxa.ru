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
    <h3>Облако тегов</h3>
    <ul>
    <?php foreach ($arResult['SEARCH'] as $arItem): ?>
        <li><a href="<?= $arItem['URL']; ?>"><?= $arItem['NAME']; ?></a></li>
    <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>