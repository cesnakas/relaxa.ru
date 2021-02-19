<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>

<? if (true):?>
    <? require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/mainpageND.php"); ?>
<? else: ?>
    <? require_once($_SERVER["DOCUMENT_ROOT"] . "/inc/mainpage.php"); ?>
<? endif; ?>

<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");
?>