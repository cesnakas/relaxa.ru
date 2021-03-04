<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, интернет-магазин, условия, правила, программа, TRADE, IN, TRADEIN, ТРЭЙДИН, трейдин, трейд-ин, центр, возврат, обмен, сдать, получить, старое, новое");
$APPLICATION->SetPageProperty("keywords", "Массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, интернет-магазин, условия, правила, программа, TRADE, IN, TRADEIN, ТРЭЙДИН, трейдин, трейд-ин, центр, возврат, обмен, сдать, получить, старое, новое");
$APPLICATION->SetPageProperty("description", "Условия программы TRADE IN в интернет-магазине «RELAXA STAR». Сдай старое массажное кресло - получи новое! ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!");
$APPLICATION->SetTitle("TRADE IN | Интернет-магазин «RELAXA STAR»");
?><?$APPLICATION->IncludeComponent(
	"uplab:tilda", 
	".default", 
	array(
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"NOJQ" => "N",
		"PAGE" => "16484369",
		"PROJECT" => "2065774",
		"STOP_CACHE" => "N",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>

<style>
.new-template-prefix footer {
    margin-top: 0px;
}
.container {
    width: 100%;
}
</style><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>