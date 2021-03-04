<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Расширенная гарантия");
$APPLICATION->SetPageProperty("title", "Расширенная гарантия | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Условия расширенной гарантии на товары в интернет-магазине «RELAXA STAR». Сервисный центр осуществляет ремонт и реставрацию массажных кресел и массажеров. ☎ Телефон: 8 (495) 191-08-17");
$APPLICATION->SetPageProperty("tags", "Массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, интернет-магазин, условия, гарантия, расширенная, большая, длительная, дополнительная, сервис, центр, ремонт, реставрация, перетяжка, замена, починка, срок, эксплуатация, стоимость");
$APPLICATION->SetPageProperty("keywords", "Массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, интернет-магазин, условия, гарантия, расширенная, большая, длительная, дополнительная, сервис, центр, ремонт, реставрация, перетяжка, замена, починка, срок, эксплуатация, стоимость");
?><div class="static_relaxa_page">
 <img width="100%" alt="regbuy2.jpeg" src="/upload/medialibrary/947/947dd15c7d07ace9587bdfe899698e06.jpeg" title="regbuy2.jpeg"><br>
	<div class="ttext-ccolor">
		<div style="text-align: center;">
			<h1><?=$APPLICATION->ShowTitle(false)?></h1>
		</div>
	</div>
	<h3>Для предоставления расширенной гарантии заполните следующие поля</h3>
	 <?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"regbuy",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPONENT_TEMPLATE" => ".default",
		"EDIT_URL" => "",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => array("WEB_FORM_ID"=>"WEB_FORM_ID","RESULT_ID"=>"RESULT_ID",),
		"WEB_FORM_ID" => "1"
	)
);?>
	<p>
		<br>
	</p>
	<p>
		 Внимание!
	</p>
	<ul>
		<li>Расширенная гарантия оформляется только на те товары, которые имеют уникальный серийный номер.</li>
		<li>На демонстрационные товары, а также уцененные товары расширенная гарантия не распространяется.&nbsp;</li>
		<li>Расширенная гарантия предоставляется на сервисное обслуживание и услуги сервисного центра, которые предоставляются бесплатно. Стоимость&nbsp;запчастей оплачивается покупателем отдельно.&nbsp;</li>
	</ul>
 <br>
	<p>
 <img width="100%" alt="handshake1[1].jpg" src="/upload/medialibrary/9a6/9a632b7dc9f137ad9225619cf2f8b4f0.jpg" title="handshake1[1].jpg">
	</p>
	<div class="ttext-ccolor">
		<div style="text-align: center;">
			<h3>Предоставление расширенной гарантии</h3>
		</div>
	</div>
	<ul>
		<li>Для получения расширенной гарантии и облегчения процесса сервисного обслуживания требуется зарегистрировать покупку на данной странице.</li>
		<li>Пожалуйста полностью введите данные о приобретенном товаре и свои координаты для связи.</li>
	</ul>
	<p>
		 В течение гарантийного срока продавец берет на себя обязательства по бесплатному устранению всех неисправностей, возникших по вине завода производителя, при соблюдении правил эксплуатации, изложенных в инструкции по эксплуатации.
	</p>
</div><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>