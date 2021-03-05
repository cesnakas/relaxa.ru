<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<ul class="no_s">
<?foreach($arResult as $arItem):?>

	<?if ($arItem["PERMISSION"] > "D"):?>
		<li><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></nobr></a></li>
	<?endif?>

<?endforeach?>

	</ul>
<?endif?>