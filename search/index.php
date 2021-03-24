<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Поиск по сайту");
$APPLICATION->SetPageProperty("title", "Поиск по сайту | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Найти и купить массажное кресло, массажер или тренажер для фитнеса на сайте интернет-магазина «RELAXA STAR». ☎ Телефон: 8 (800) 333 00 51 ← Звоните прямо сейчас!");
$APPLICATION->SetPageProperty("tags", "Поиск, найти, результаты, информация, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, свинг-машины, батуты, прессотерапия, рефлескотерапия, аренда, столы, стулья");
$APPLICATION->SetPageProperty("keywords", "Поиск, найти, результаты, информация, интернет-магазин, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, свинг-машины, батуты, прессотерапия, рефлескотерапия, аренда, столы, стулья");
?>
    <div class="title_wrap">
          <div class="container">
            <h1>Результат поиска</h1>
          </div>
    </div>
<div class="container">

<?$APPLICATION->IncludeComponent(
	"bitrix:search.page", 
	"clear", 
	array(
		"RESTART" => "Y",
		"CHECK_DATES" => "N",
		"USE_TITLE_RANK" => "Y",
		"DEFAULT_SORT" => "rank",
		"arrFILTER" => array(
			0 => "iblock_catalog",
		),
		"arrFILTER_main" => "",
		"arrFILTER_iblock_services" => array(
			0 => "all",
		),
		"arrFILTER_iblock_news" => array(
			0 => "all",
		),
		"arrFILTER_iblock_catalog" => array(
			0 => "all",
		),
		"SHOW_WHERE" => "N",
		"SHOW_WHEN" => "N",
		"PAGE_RESULT_COUNT" => "25",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_SHADOW" => "Y",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Результаты поиска",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_TEMPLATE" => "arrows",
		"USE_SUGGEST" => "N",
		"SHOW_ITEM_TAGS" => "N",
		"SHOW_ITEM_DATE_CHANGE" => "N",
		"SHOW_ORDER_BY" => "N",
		"SHOW_TAGS_CLOUD" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "clear",
		"STRUCTURE_FILTER" => "structure",
		"NO_WORD_LOGIC" => "N",
		"FILTER_NAME" => "",
		"USE_LANGUAGE_GUESS" => "N",
		"NAME_TEMPLATE" => "",
		"SHOW_LOGIN" => "Y",
		"SHOW_RATING" => "",
		"RATING_TYPE" => "",
		"PATH_TO_USER_PROFILE" => "",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>