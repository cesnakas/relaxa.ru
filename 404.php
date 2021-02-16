<?
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');
CHTTP::SetStatus("404 Not Found");
@define("ERROR_404", "Y");
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Страница не найдена");
$APPLICATION->SetPageProperty("title", "Страница не найдена | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "К сожалению, запрашиваемая страница не найдена на сайте интернет-магазина «RELAXA STAR». Массажные кресла, массажеры, товары для фитнеса. ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!");
$APPLICATION->SetPageProperty("tags", "404, ошибка, страница, не, найдена, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, свинг-машины, батуты, прессотерапия, рефлескотерапия, аренда, столы, стулья, доставка, гарантия, большая, недорого, производители, известные, надежные, качество");
$APPLICATION->SetPageProperty("keywords", "404, ошибка, страница, не, найдена, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, свинг-машины, батуты, прессотерапия, рефлескотерапия, аренда, столы, стулья, доставка, гарантия, большая, недорого, производители, известные, надежные, качество");
?>
<style>
#error404 {
	min-height: 230px;
}
h1 {
	margin-top: 50px;
}
</style>
<div id="error404">
	<div class="wrapper">
		<h1>К сожалению, запрашиваемая страница не найдена</h1>
		<div class="errorText">Но это не беда!</div>
		<div class="errorText">Вы всегда можете <a href="https://www.relaxa.ru/massazhnoe-oborudovanie/"> поискать информацию в каталоге</a></div>
		<div class="errorText">Или <a href="/">перейти на главную страницу сайта</a></div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>