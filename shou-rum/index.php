<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("tags", "Где, купить, город, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, батуты, беговые, дорожки, купить, недорого, доставка, демозал, шоу-рум, шоурум, посетить, проконсультироваться, получить, консультация");
$APPLICATION->SetPageProperty("keywords", "Где, купить, город, массажеры, массажные, кресла, офисные, качалки, аппараты, терапия, фитнес, тренажеры, батуты, беговые, дорожки, купить, недорого, доставка, демозал, шоу-рум, шоурум, посетить, проконсультироваться, получить, консультация");
$APPLICATION->SetTitle("Где купить | Интернет-магазин «RELAXA STAR»");
$APPLICATION->SetPageProperty("description", "Где купить массажное оборудование от магазина «RELAXA STAR». ☎ Бесплатный номер горячей линии: 8 (800) 333 00 51 ← Звоните прямо сейчас!");
?>

<h1 class="title_blue" style="color: #9d0a0f; font-size: 28pt; text-align: center; font-weight: bold;">Где купить</h1>

<div class="examples">

<div class="choose_city">
<div class="choose_city_title">
<div class="choose_city_title_inner">
Выберете город
</div>
</div>
<div class="choose_city_body">
	<button name="sample1" class="sample1"><span>Москва</span></button>
    <button name="sample2" class="sample2"><span>Санкт-Петербург</span></button>
	<button name="sample3" class="sample3"><span>Ижевск</span></button>
	<button name="sample4" class="sample4"><span>Конаково</span></button>
	<button name="sample5" class="sample5"><span>Нижний Новгород</span></button>
	<button name="sample6" class="sample6"><span>Салават</span></button>
	<button name="sample7" class="sample7"><span>Севастополь</span></button>
	<button name="sample8" class="sample8"><span>Симферополь</span></button>
	<button name="sample9" class="sample9"><span>Стерлитамак</span></button>
	<button name="sample10" class="sample10"><span>Тольятти</span></button>
	<button name="sample11" class="sample11"><span>Тула</span></button>
	<button name="sample12" class="sample12"><span>Ярославль</span></button>	
</div>
</div>

    <script language="javascript" type="text/javascript">
    $('.sample1').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/moscow.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });

    $('.sample2').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/spb.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });

    $('.sample3').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/izhevsk.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });

    $('.sample4').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/konakovo.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });

    $('.sample5').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/n_novgorod.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });

    $('.sample6').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/salavat.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });	

    $('.sample7').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/sevastopol.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });		

    $('.sample8').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/simferopol.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });	
	
    $('.sample9').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/sterlitamak.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });
	
    $('.sample10').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/toljatti.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });

    $('.sample11').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/tula.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });
	
    $('.sample12').click( function() {
        $.ajax({
			url: '/shou-rum/ajax/jaroslavl.php',
          success: function(data) {
            $('.results').html(data);
          }
        });
    });		

    </script>
	
    <script language="javascript" type="text/javascript">
$('.choose_city_title_inner').on('click',function(){
        $(this).parents('.choose_city').find('.choose_city_body').slideToggle(300);
        $(this).toggleClass('open');
        if ($(this).hasClass('show_all')){
                if ($(this).hasClass('open')) {
                    $(this).html('Свернуть все');
                $('.choose_city_title_inner:not(.open)').trigger('click');
            }	else {
                $(this).html('Смотреть все');
                $('.choose_city_inner.open').trigger('click');
            }
        }
    });

$('.choose_city button').on('click',function(){
if (document.documentElement.clientWidth < 900) {
    $(this).parents('.choose_city').find('.choose_city_body').slideToggle(300);
        if ($(this).hasClass('show_all')){
                if ($(this).hasClass('open')) 
        $('.choose_city_title_inner:not(.open)').trigger('click');
    };
}		
});
    </script>



</div>
<div class="results">
<?require($_SERVER["DOCUMENT_ROOT"]."/shou-rum/ajax/moscow.php");?>
</div>	


<?php

switch ($_REQUEST['action']) {
    case 'sample1':
        echo '000';
        break;
}

?>

<br>


<div class="city_bottom_block">

</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>