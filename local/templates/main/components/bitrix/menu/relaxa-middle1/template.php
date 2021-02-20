<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<style>
	.drop__item .drop__item{
display: none;
	}
</style>
<?if (!empty($arResult)):?>

	<ul class="no_s">

		<?
		$previousLevel = 0;
		foreach($arResult as $arItem):?>
		<? $saleStyle = $arItem['LINK'] === '/rasprodazha/' ? 'sale' : '';?>
			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

	<?if ($arItem["IS_PARENT"]):?>

		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="dropdown"><a href="<?=$arItem["LINK"]?>" class="<?=$saleStyle?><?if($arItem['PARAMS']['linkStyle'] == 'Yes') echo ' linkForCatalog'?>"><?=$arItem["TEXT"]?></a>
				<ul class="drop">
		<?else:?>
			<li class="drop__item"><a href="<?=$arItem["LINK"]?>" class="drop__link"><?=$arItem["TEXT"]?></a>
				<ul>
		<?endif?>

	<?else:?>

		<?if ($arItem["PERMISSION"] > "D"):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="dropdown"><a href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li class="drop__item"><a href="<?=$arItem["LINK"]?>" class="drop__link"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?else:?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="drop__item"><a href="" class="drop__link" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?else:?>
				<li><a href="" class="denied" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>"><?=$arItem["TEXT"]?></a></li>
			<?endif?>

		<?endif?>

	<?endif?>

	<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

<?endforeach?>

<?if ($previousLevel > 1)://close last item tags?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?endif?>

</ul>
<?endif?>
<div id="clrFix"></div>	