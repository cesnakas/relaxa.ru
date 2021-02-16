<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetPageProperty("description", "Купить массажное кресло, массажер, беговую дорожку, тренажер для фитнеса в интернет-магазине «RELAXA STAR». ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!");
$APPLICATION->SetTitle("«RELAXA STAR» - Массажные кресла, массажеры, массажные подушки, массажные накидки, беговые дорожки, тренажеры для фитнеса купить с бесплатной доставкой");
?>

<?//if (isset($_GET['new_design'])&&($_GET['new_design']=='Y')){?>
<?if (true){?>
	<? require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/mainpageND.php"); ?>

<?}else{?>
	<? require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/mainpage.php"); ?>
<?}?>

    <? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>
