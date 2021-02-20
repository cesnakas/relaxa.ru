<?
/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 */
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>
<?session_start();?>

<?
global $USER;
$rsUser = CUser::GetByID($USER->GetID());
$arUser = $rsUser->Fetch();
//echo "<pre>"; print_r($arUser); echo "</pre>";
?>




<?if($_GET['edit']!='y'):?>

<!-- Styles and scripts for personal_area -->
<link rel="stylesheet" href="/verstka/style/personal_area.css">
<link rel="stylesheet" href="/verstka/style/modal.css">
<link rel="stylesheet" href="/verstka/style/media.css">
    <script src="/bitrix/templates/dresscodeV2/js/fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript">
        /*
        $(document).ready(function() {

            alert('test');
            $('.new-wrap-link').fancybox();
        });*/
    </script>

<script src="/verstka/scripts/personal_area.js"></script>
<!-- End for personal_area -->

<?if($arUser["PERSONAL_PHOTO"]>0):?>
	<?
	$arPhotoSmall = CFile::ResizeImageGet(
	   	$arUser["PERSONAL_PHOTO"], 
	   	array(
	      	'width'=>291,
	      	'height'=>291
	   	), 
	   	BX_RESIZE_IMAGE_EXACT,
	   	Array(
	      	"name" => "sharpen", 
	      	"precision" => 0
	   	)
	);
	?>
<?endif;?>

<section class="personal">
    
        <?/*<div class="close close_order close_mobile">
            <a href="<?if(('http://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER'] || 'https://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=""):?><?=$_SERVER['HTTP_REFERER']?><?else:?>/<?endif;?>">
                <img src="/verstka/img/close/close.png" alt="" class="close_img">
            </a>
        </div>


        <div class="back">
            <a href="<?if(('http://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER'] || 'https://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=""):?><?=$_SERVER['HTTP_REFERER']?><?else:?>/<?endif;?>">
                <img src="/verstka/img/mobile/back.png" alt="" class="back_img">
            </a>
        </div>*/?>

    <div class="personal_title">
	<div class="back">
            <a href="<?if(('http://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER'] || 'https://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=""):?><?=$_SERVER['HTTP_REFERER']?><?else:?>/<?endif;?>">
                <img src="/verstka/img/mobile/back.png" alt="" class="back_img">
            </a>
        </div>
        <h1 class="personal_h1">Мой кабинет</h1>
    </div>
    <div class="personal_wrapper personal_wrapper__us-de">
        <div class="profile">
            <div class="personal_content personal_content__login">
                <div class="profile_big profile_big__us-de">
                    <div class="profile_top">
                        <p class="profile_title"><?=$arUser["LOGIN"]?></p>
                        <?/*
                        <div class="profile_status">
                            <div class="profile_circle"></div>
                            <p class="profile_subtitle">В сети</p>
                        </div>
                        */?>
                    </div>
                    <div class="profile_main">
                        <div class="profile_picture">
                        	<?if($arUser["PERSONAL_PHOTO"]>0):?>
                            	<img src="<?=$arPhotoSmall["src"]?>" alt="" class="profile_img">
                            <?endif;?>
                        </div>
                        <div class="profile_mobile">
                            <p class="profile_mobile-text"><?=$arUser["PERSONAL_PHONE"]?></p>
                            <p class="profile_mobile-text"><?=$arUser["EMAIL"]?></p>
                        </div>
                        <div class="profile_forUser">
                            <a href="?logout=yes">
                                <p class="profile_title">Выход</p>
                            </a>
                            <div class="profile_settings">
                            	<a href="?edit=y">
                                	<img src="/verstka/img/profile/settings.svg" alt="" class="profile_img">
                                </a>
                            </div>
                            <div class="help">
                                <div class="help_content">
                                    <p class="help_p">Редактировать профиль</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="personal_content personal_content__bottom">
                <div class="profile_small">
                    <div class="profile_bottom">
                        <div class="profile_registration profile_registration__border">
                            <p class="profile_subtitle-sm">Зарегистрирован</p>
                            <p class="profile_title-sm"><?=$arUser["DATE_REGISTER"]?></p>
                        </div>
                        <div class="profile_registration profile_registration__padding">
                            <p class="profile_subtitle-sm">Последнее посещение</p>
                            <p class="profile_title-sm"><?=$arUser["LAST_LOGIN"]?></p>
                        </div>
						
                    </div>
                </div>
            </div>
<?
$arGroups = CUser::GetUserGroup($USER->GetID());
?>  
        <?if(in_array("1",$arGroups) || in_array("10",$arGroups) || in_array("6",$arGroups) || in_array("8",$arGroups) || in_array("9",$arGroups)):?>
            <?if(in_array("6",$arGroups) || in_array("8",$arGroups) || in_array("10",$arGroups)):?>			
			<div class="personal_content personal_content__bottom">
                <div class="profile_small">                   
                        <p class="profile_title">Дополнительная информация<p>
							<ul>
								<li><a href="https://relaxa.ru/guarantee/">Гарантии</a></li>
								<li><a href="https://relaxa.ru/about/privacy/">Конфиденциальность</a></li>
								<?/*<li>Дилерская оферта</li>
								<li>Условия работы</li>*/?>
							</ul>                   
                </div>
            </div>
			<?else:?>	
			<div class="personal_content personal_content__bottom">
                <div class="profile_small">                   
                        <p class="profile_title">Дополнительная информация<p>
							<ul>
								<li><a href="https://relaxa.ru/delivery/">Доставка</a></li>
								<li><a href="https://relaxa.ru/guarantee/">Гарантии</a></li>								
								<li><a href="https://relaxa.ru/oferta/">Публичная оферта</a></li>
								<li><a href="https://relaxa.ru/about/privacy/">Конфиденциальность</a></li>
							</ul>                   
                </div>
            </div>
			<?endif;?>
        <?endif;?>
        </div>
        <div class="contacts">
            <div class="personal_content personal_content__contacts">
                <div class="profile_top profile_top__contacts">
                    <p class="profile_title">Контактная информация</p>
                    <?/*<a href="?logout=yes">
                        <p class="profile_title">Выход</p>
                    </a>*/?>
                </div>
				
                <div class="profile_main">
				<? if ($arUser["NAME"]):?>
                    <div class="profile_item">
                        <p class="profile_subtitle-sm">Имя</p>
                        <p class="profile_title"><?=$arUser["NAME"]?></p>
                    </div>
				<?endif; ?>	
				<? if ($arUser["LAST_NAME"]):?>	
                    <div class="profile_item">
                        <p class="profile_subtitle-sm">Фамилия</p>
                        <p class="profile_title"><?=$arUser["LAST_NAME"]?></p>
                    </div>
				<?endif; ?>	
				<? if ($arUser["PERSONAL_BIRTHDAY"]):?>	
                    <div class="profile_item">
                        <p class="profile_subtitle-sm">Дата рождения</p>
                        <p class="profile_title"><?=$arUser["PERSONAL_BIRTHDAY"]?></p>
                    </div>
				<?endif; ?>	
				<? if ($arUser["PERSONAL_PHONE"]):?>	
                    <div class="profile_item">
                        <p class="profile_subtitle-sm">Контактный телефон</p>
                        <a href="tel:<?=$arUser["PERSONAL_PHONE"]?>" class="personal_ttl__a"><?=$arUser["PERSONAL_PHONE"]?></a>
                    </div>
				<?endif; ?>	
				<? if ($arUser["EMAIL"]):?>	
                    <div class="profile_item">
                        <p class="profile_subtitle-sm">E-mail</p>
                        <?/*<a href="mailto: adress@mail.ru" class="personal_ttl__a"><?=$arUser["EMAIL"]?></a>*/?>
                        <p class="profile_title"><?=$arUser["EMAIL"]?></p>
                    </div>
				<?endif; ?>	
				<? if ($arUser["PERSONAL_STREET"]):?>	
                    <div class="profile_item">
                        <p class="profile_subtitle-sm">Адрес</p>
                        <p class="profile_title"><?=$arUser["PERSONAL_STREET"]?></p>
                    </div>
				<?endif; ?>	
                </div>
            </div>
            <?/*<div class="personal_content personal_content__additional first">
                <div class="profile_top profile_top__additional">
                    <p class="profile_title">Дополнительная информация</p>
                </div>
                <div class="profile_additional">
                    <p class="profile_title"><?=$arUser["PERSONAL_NOTES"]?></p>
                </div>
            </div>*/?>
<?
$arGroups = CUser::GetUserGroup($USER->GetID());
?>  
        <?if(in_array("1",$arGroups) || in_array("10",$arGroups) || in_array("6",$arGroups) || in_array("8",$arGroups) || in_array("9",$arGroups)):?>
            <?if(in_array("1",$arGroups) || in_array("6",$arGroups) || in_array("8",$arGroups) || in_array("10",$arGroups)):?>
             <div class="personal_content personal_content__additional">
                 <div class="profile-order_picture">
                     <img src="/verstka/img/profile/services.svg" alt="" class="profile-order_img">
                 </div>
                 <div class="profile_top profile_top__additional">
                     <p class="profile_title">Заказы</p>
                 </div>
                <div class="application_content">
                    <div class="application_item">
                        <a href="#zay-na-domzal" class="new-wrap-link-testdem">
                            <div class="application_image">
                                <img src="/verstka/img/application/demo.svg" alt="" class="application_img">
                            </div>
                            <p class="application_p">Заявка на тест в демозал</p>
                            <div class="application_picture">
                                <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                            </div>
                        </a>
                    </div>
                    <div class="application_item">
                        <a href="#zay-na-domzal" class="new-wrap-link-zaktoc">
                            <div class="application_image">
                                <img src="/verstka/img/application/ztovar.svg" alt="" class="application_img">
                            </div>
                            <p class="application_p">Заявка на заказ товара</p>
                            <div class="application_picture">
                                <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                            </div>
                        </a>
                    </div>
                    <div class="application_item">
                        <div class="application_image">
                            <img src="/verstka/img/application/shipping.svg" alt="" class="application_img">
                        </div>
                        <p class="application_p _drop">Заказ дропшиппинг</p>
                        <div class="application_picture">
                            <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                        </div>
                    </div>
                    <div class="application_item">
                        <div class="application_image">
                            <img src="/verstka/img/profile/price.svg" alt="" class="application_img">
                        </div>
                        <p class="application_p"><a href="/price/" target="_blank" rel="noreferrer noopener" class="black-a">Посмотреть и скачать прайс-лист</a></p>
                        <div class="application_picture">
                            <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                        </div>
                    </div>
                    <?/*
                    if ($USER->IsAdmin()) {
                        ?>
                        <div class="application_item">
                            <a href="#zay-na-domzal" class="new-wrap-link-testdem">
                                <div class="application_image">
                                    <img src="/verstka/img/application/file.png" alt="" class="application_img">
                                </div>
                                <p class="application_p">Заявка на тест в демозал - Новые popup окна</p>
                                <div class="application_picture">
                                    <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                                </div>
                            </a>
                        </div>
                        <div class="application_item">
                            <a href="#zay-na-domzal" class="new-wrap-link-zaktoc">
                                <div class="application_image">
                                    <img src="/verstka/img/application/file.png" alt="" class="application_img">
                                </div>
                                <p class="application_p">Форма заказа товара - Новые popup окна</p>
                                <div class="application_picture">
                                    <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                                </div>
                            </a>
                        </div>
                        <?
                    }*/
                    ?>
                </div>
             </div>



             <?else:?>

             <div class="personal_content personal_content__additional">
                 <div class="profile-order_picture">
                     <img src="/verstka/img/profile/order.svg" alt="" class="profile-order_img">
                 </div>
                 <div class="profile_top profile_top__additional">
                     <p class="profile_title">Заказы</p>
                 </div>
                <div class="application_content">
                    <div class="application_item">
                        <div class="application_image">
                            <a href="/personal/order/">
                                <img src="/verstka/img/profile/track.svg" alt="" class="application_img">
                            </a>
                        </div>
                        <p class="application_p"><a href="/personal/order/" class="black-a">Ознакомиться с состоянием заказов</a></p>
                        <div class="application_picture">
                            <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                        </div>
                    </div>
                    <div class="application_item">
                        <div class="application_image">
                            <a href="/personal/cart/">
                                <img src="/bitrix/templates/dresscodeV2_new/images/ND/basket__header__icon.svg" alt="" class="application_img">
                            </a>
                        </div>
                        <p class="application_p"><a href="/personal/cart/" class="black-a">Посмотреть содержимое корзины</a></p>
                        <div class="application_picture">
                            <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                        </div>
                    </div>
                    <div class="application_item">
                        <div class="application_image">
                            <a href="/personal/order/">
                                <img src="/verstka/img/profile/clipboard.svg" alt="" class="application_img">
                            </a>
                        </div>
                        <p class="application_p"><a href="/personal/order/" class="black-a">Посмотреть историю заказов</a></p>
                        <div class="application_picture">
                            <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                        </div>
                    </div>
                    <div class="application_item">
                        <div class="application_image">
                            <a href="/price/">
                                <img src="/verstka/img/profile/price.svg" alt="" class="application_img">
                            </a>
                        </div>
                        <p class="application_p"><a href="/price/" target="_blank" rel="noreferrer noopener" class="black-a">Посмотреть и скачать прайс-лист</a></p>
                        <div class="application_picture">
                            <img src="/verstka/img/mobile/arrow-right.png" alt="" class="application_img">
                        </div>
                    </div>
                </div>
             </div>

             <?endif;?>
        <?endif;?>
        </div>
    </div>
</section>
<?
//if ($USER->IsAdmin()) {
?>

	

    <div class="popUp popUp_test-demozal" id="zay-na-domzal">
        <div class="background-bl"></div>
        <div class="dropshipping">
            <div class="go go_close _goFirst remove">
                <img src="/verstka/img/close/close.png" alt="" class="close_img">
            </div>
            <div class="go-new go _goFirst remove">
                <img src="/verstka/img/mobile/back.png" alt="" class="back_img" onclick="$('#back_custom').click();">
            </div>
            <div class="dropshipping_title">
                <h2 class="dropshipping_h2 dropshipping_h2-new">Заявка на тест в демозал</h2>
            </div>
            <div class="dropshipping_main">
                <form method="post" action="/include/ajax/demo.php">
                <input type="hidden" name="curpage" value="<?=$APPLICATION->GetCurPage()?>">
                <div class="demo-zal-first" style="display: block;">
                    <div class="dropshipping_wrap">
                        <p class="dropshipping_p dropshipping_p-new">
                            По адресу: Москва, Лермонтовский пр-т, д. 19 А. <a href="https://yandex.ru/map-widget/v1/?um=constructor%3A3683478f95476540ec804293d242d9dbe3c265d534d5df088893825b921983d2&amp;source=constructor" target="_blank" class="geo-location-icon"></a>
                        </p>
                        <?/*<button class="personal_button personal_button__hide _dropMob">Продолжить</button>*/?>
                    </div>
                    <div>
                        <p class="dropshipping_p dropshipping_p__red">Обязательно *</p>

                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Адрес электронной почты <span>*</span></p>
                            <input type="text" value="<?=$arUser["EMAIL"]?>" class="personal_input personal_input__email" name="email-demo" id="email-demo" required="" placeholder="Ваш адрес эл.почты" onkeyup="validateDemoForm1()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Ваши контакты <span>*</span></p>
                            <input type="text" value="<?=$arUser["UF_CONTACTS_NAME"]?>" class="personal_input personal_input__name" name="contacts-demo" id="contacts-demo" required="" placeholder="Укажите свои имя и фамилию для обратной связи" onkeyup="validateDemoForm1()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Телефон для связи <span>*</span></p>
                            <input type="text" value="<?=$arUser["PERSONAL_PHONE"]?>" class="personal_input personal_input__number" name="phone-demo" id="phone-demo" required="" placeholder="" onkeyup="validateDemoForm1()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Ваша компания <span>*</span></p>
                            <input type="text" value="<?=$arUser["UF_NAME_COMPANY"]?>" class="personal_input personal_input__name" name="company-demo" id="company-demo" required="" placeholder="Введите данные для обратной связи" onkeyup="validateDemoForm1()">
                        </div>
                        <div class="recovery_btn recovery_btn__dropshipping _dropGo">
                            <button class="personal_button personal_button__recovery personal_button__recovery3 next-step demo_button_validate1" >Далее</button>
                        </div>
                    </div>
                </div>
                <div class="demo-zal-second" style="display: none;">
                    <div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Оборудование для теста и цену <span>*</span></p>
                            <input type="text" class="personal_input personal_input__email" name="name-obor1" id="modname-demo" required="" placeholder="Укажите наименование модели" onkeyup="validateDemoForm2()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <input type="text" class="personal_input personal_input__email" name="price-obor1" id="modprice-demo" required="" placeholder="Укажите цену" onkeyup="validateDemoForm2()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new dropshipping_input-new-1" style="display: none;">
                            <input type="text" class="personal_input personal_input__email" name="name-obor2" placeholder="Укажите наименование модели">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new dropshipping_input-new-1" style="display: none;">
                            <input type="text" class="personal_input personal_input__email" name="price-obor2" placeholder="Укажите цену">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new dropshipping_input-new-2" style="display: none;">
                            <input type="text" class="personal_input personal_input__email" name="name-obor3" placeholder="Укажите наименование модели">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new dropshipping_input-new-2" style="display: none;">
                            <input type="text" class="personal_input personal_input__email" name="price-obor3" placeholder="Укажите цену">
                        </div>
                        <div class="dropshipping_input-plus-wp">
                            <a href="#" class="dropshipping_input-plus">Еще</a>
                        </div>
                    </div>

                    <div class="dropshipping_main">
                        <div>
                            <div class="inputs">
                                <div class="dropshipping_input">
                                    <p class="dropshipping_ttl">Дата визита<span>*</span></p>
                                    <p class="dropshipping_description">
                                        Мы ждем Вашего клиента в течение пяти дней с указанной даты. Если в эти
                                        сроки он не придет, заявка автоматически аннулируется.
                                    </p>
                                    <input class="date_btn" name="date" required="" id="date-demo" placeholder="ДД.ММ.ГГГГ" onblur="validateDemoForm2()" autocomplete="off" style="max-width: 188px;">
                                </div>
                                <div class="dropshipping_input">
                                    <p class="dropshipping_ttl">Время визита</p>
                                    <input id="timepicker" name="time" class="personal_input personal_input__time" placeholder="__:__" autocomplete="off" style="max-width: 188px;">
                                </div>
                            </div>
                            <div class="dropshipping_btns">
                                <div class="recovery_btn recovery_btn__dropshipping _dropBack">
                                    <button class="personal_button personal_button__settings prev-step" id="back_custom">Назад</button>
                                </div>
                                <div class="recovery_btn recovery_btn__dropshipping _dropEnd">
                                    <button class="personal_button personal_button__recovery personal_button__recovery3 next-step demo_button_validate2" >Далее</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="demo-zal-threes" style="display: none;">
                    <div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Имя клиента <span>*</span></p>
                            <input type="text" value="<?=$arUser["NAME"]?>" class="personal_input personal_input__email" id="clname-demo" name="client-name" required="" placeholder="Укажите данные клиента" onkeyup="validateDemoForm3()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Телефон клиента <span>*</span></p>
                            <input type="text" value="<?=$arUser["PERSONAL_PHONE"]?>" class="personal_input personal_input__number" id="clphone-demo" name="client-phone" required="" placeholder="+7(___)___-__-__" onkeyup="validateDemoForm3()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Дополнительная информация <span>*</span></p>
                            <p class="dropshipping_description">
                                Дополнительные пожелания клиента
                            </p>
                            <textarea name="comment" id="comment-demo" cols="30" rows="3" style="display: block; width: 100%;" onkeyup="validateDemoForm3()"></textarea>
                            <p class="dropshipping_description" style="padding: 20px 0;">
                                Копии ответов будут отправлены на указанный Вами электронный адрес.
                            </p>
                        </div>
                    </div>

                    <div class="dropshipping_main">
                        <div class="dropshipping_btns">
                            <div class="recovery_btn recovery_btn__dropshipping _dropBack">
                                <button class="personal_button personal_button__settings prev-step">Назад</button>
                            </div>
                            <div class="recovery_btn recovery_btn__dropshipping _dropEnd">
                                <button type="submit" class="personal_button personal_button__recovery personal_button__recovery3 demo_button_validate3" >Отправить</button>
                            </div>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>


<div class="popUp popUp_zak-tov" id="zak-tov">
    <div class="background-bl"></div>
    <div class="dropshipping">
        <div class="go go_close _goFirst remove">
            <img src="/verstka/img/close/close.png" alt="" class="close_img">
        </div>
        <div class="go-new go _goFirst remove">
            <img src="/verstka/img/mobile/back.png" alt="" class="back_img">
        </div>
        <div class="dropshipping_title">
            <h2 class="dropshipping_h2 dropshipping_h2-new">Форма заказа товара</h2>
        </div>
        <div class="dropshipping_main">
            <form method="post" action="/include/ajax/order.php">
            <input type="hidden" name="curpage" value="<?=$APPLICATION->GetCurPage()?>">
                <div class="zak-tov-first" style="display: block;">
                    <div class="mob-first-window">
                        <div class="dropshipping_wrap">
                            <p class="dropshipping_p dropshipping_wrap-mob">
                                После заполнения формы мы свяжемся с Вами, чтобы подтвердить заказ.
                                Если Вы хотите быстро узнать о наличии и ценах, то можете посмотреть
                                <a href="/price/" class="a_blue _load">прайс</a> на нашем сайте, позвонить по номеру
                                <a href="tel:84957899174" class="a_blue _num">8(495)789-91-74</a> или написать
                                на почту  <a href="mailto:diler@relaxa.ru" class="a_blue _mail">diler@relaxa.ru</a>.
                            </p>
                            <button class="personal_button personal_button__hide _dropMob">Продолжить</button>
                        </div>
                    </div>
                    <div class="dropshipping_wrap dropshipping_wrap-pc">
                        <p class="dropshipping_p dropshipping_p-new">
                            После заполнения формы мы свяжемся с Вами, чтобы подтвердить заказ.
                            Если Вы хотите быстро узнать о наличии и ценах, позвоните нам по номеру
                            <a href="tel:84957899174">8(495)789-91-74</a> или напишите на почту <a href="mailto:diler@relaxa.ru">diler@relaxa.ru</a>.
                        </p>
                        <?/*<button class="personal_button personal_button__hide _dropMob">Продолжить</button>*/?>
                    </div>
                    <div class="first-step">
                        <p class="dropshipping_p dropshipping_p__red">Обязательно *</p>

                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Адрес электронной почты <span>*</span></p>
                            <input type="text" value="<?=$arUser["EMAIL"]?>" class="personal_input personal_input__email" id="email_order" name="email_order" required="" placeholder="Ваш адрес эл.почты" onkeyup="validateOrderForm1()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Контактное лицо <span>*</span></p>
                            <input type="text" value="<?=$arUser["UF_CONTACTS_NAME"]?>" class="personal_input personal_input__name" id="contacts_order" name="contacts_order" required="" placeholder="Введите свои данные для обратной связи" onkeyup="validateOrderForm1()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Контактный номер телефона <span>*</span></p>
                            <input type="text" value="<?=$arUser["UF_CONTACTS_PHONE"]?>" class="personal_input personal_input__number" id="phone_order" name="phone_order" required="" placeholder="+7(___)___-__-__" onkeyup="validateOrderForm1()">
                        </div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Наименование Вашей компании <span>*</span></p>
                            <input type="text" value="<?=$arUser["UF_NAME_COMPANY"]?>" class="personal_input personal_input__name" id="company_order" name="company_order" required="" placeholder="Введите данные Вашей компании" onkeyup="validateOrderForm1()">
                        </div>
                        <div class="recovery_btn recovery_btn__dropshipping _dropGo">
                            <button class="personal_button personal_button__recovery personal_button__recovery3 next-step order_button_validate1" >Далее</button>
                        </div>
                        <a href="#" class="prev-step-new" style="display: none;"></a>
                    </div>
                </div>
                <div class="zak-tov-second" style="display: none;">
                    <div>
                        <div class="dropshipping_input dropshipping_input-new">
                            <p class="dropshipping_ttl">Что бы вы хотели заказать <span>*</span></p>
                            <input type="text" class="personal_input personal_input__email" name="prod1_order" id="prod1_order" required="" placeholder="Укажите наименование модели и цену" onkeyup="validateOrderForm2()">
                            <div class="new-counter">
                                <a href="#" class="new-countel-minus minus_order">-</a>
                                <input type="text" class="new-countel-input" value="1" name="count1_order">
                                <a href="#" class="new-countel-plus plus_order">+</a>
                            </div>
                        </div>
                        <div class="dropshipping_input dropshipping_input-new dropshipping_input-new-1" style="display: none;">
                            <input type="text" class="personal_input personal_input__email" name="prod2_order" placeholder="Укажите наименование модели и цену">
                            <div class="new-counter">
                                <a href="#" class="new-countel-minus minus_order">-</a>
                                <input type="text" class="new-countel-input" value="1" name="count2_order">
                                <a href="#" class="new-countel-plus plus_order">+</a>
                            </div>
                        </div>
                        <div class="dropshipping_input dropshipping_input-new dropshipping_input-new-2" style="display: none;">
                            <input type="text" class="personal_input personal_input__email" name="prod3_order" placeholder="Укажите наименование модели и цену">
                            <div class="new-counter">
                                <a href="#" class="new-countel-minus minus_order">-</a>
                                <input type="text" class="new-countel-input" value="1" name="count3_order">
                                <a href="#" class="new-countel-plus plus_order">+</a>
                            </div>
                        </div>
                        <div class="dropshipping_input-plus-wp">
                            <a href="#" class="dropshipping_input-plus">Еще</a>
                        </div>
                    </div>
                    <div class="dropshipping_selects one_select">
                        <p class="dropshipping_ttl">Вид оплаты <span>*</span></p>
                        <input type="hidden" name="oplata_order" value="Наличные">
                        <div class="registration_item registration_item__dropshipping">
                            <label class="custom-check"><input type="checkbox" onclick="$('input[name=oplata_order]').val('Наличные');" checked=""><div></div></label>
                            <div class="personal_ttl personal_ttl__margin">Наличные</div>
                        </div>
                        <div class="registration_item registration_item__dropshipping">
                            <label class="custom-check"><input type="checkbox" onclick="$('input[name=oplata_order]').val('Безналичная оплата');"><div></div></label>
                            <div class="personal_ttl personal_ttl__margin">Безналичная оплата</div>
                        </div>
                        <div class="registration_item registration_item__dropshipping">
                            <label class="custom-check"><input type="checkbox" onclick="$('input[name=oplata_order]').val('Онлайн оплата через сайт');"><div></div></label>
                            <div class="personal_ttl personal_ttl__margin">Онлайн оплата через сайт</div>
                        </div>
                        <div class="registration_item registration_item__dropshipping">
                            <label class="custom-check"><input type="checkbox" onclick="$('input[name=oplata_order]').val('Наложный платеж');"><div></div></label>
                            <div class="personal_ttl personal_ttl__margin">Наложный платеж</div>
                        </div>
                        <div class="registration_item registration_item__dropshipping">
                            <label class="custom-check"><input type="checkbox" onclick="$('input[name=oplata_order]').val('Оплата через карту спб');"><div></div></label>
                            <div class="personal_ttl personal_ttl__margin">Оплата через карту СБ</div>
                        </div>
                        <div class="registration_item registration_item__dropshipping">
                            <label class="custom-check"><input type="checkbox" id="other_click" onclick="$('input[name=oplata_order]').val($('#other_ord1').val());"><div></div></label>
                            <div class="personal_ttl personal_ttl__margin">Другое</div>
                            <input type="text" class="drug-otprav-input" id="other_ord1" onkeyup="$('#other_click').click();$('input[name=oplata_order]').val($('#other_ord1').val());">
                        </div>
                    </div>
                    <div class="dropshipping_btns">
                        <div class="recovery_btn recovery_btn__dropshipping _dropBack">
                            <button class="personal_button personal_button__settings prev-step" id="back_custom2">Назад</button>
                        </div>
                        <div class="recovery_btn recovery_btn__dropshipping _dropEnd">
                            <button class="personal_button personal_button__recovery personal_button__recovery3 next-step order_button_validate2" >Далее</button>
                        </div>
                    </div>
                </div>
                <div class="zak-tov-threes" style="display: none;">
                    <div>
                        <div class="inputs">
                            <div class="dropshipping_input">
                                <p class="dropshipping_ttl">Дата отгрузки<span>*</span></p>
                                <input class="date_btn" name="date_order" id="date_order" required="" placeholder="ДД.ММ.ГГГГ" onblur="validateOrderForm3()" style="max-width: 188px; width: 100%;">
                            </div>
                        </div>
                        <div class="dropshipping_selects one_select2">
                            <p class="dropshipping_ttl">Способ доставки <span>*</span></p>
                            <input type="hidden" name="dost_order" value="Самовывоз">
                            <div class="registration_item registration_item__dropshipping">
                                <label class="custom-check"><input type="checkbox" onclick="$('input[name=dost_order]').val('Самовывоз');" checked=""><div></div></label>
                                <div class="personal_ttl personal_ttl__margin">Самовывоз</div>
                            </div>
                            <div class="registration_item registration_item__dropshipping">
                                <label class="custom-check"><input type="checkbox" onclick="$('input[name=dost_order]').val('Отправка через компанию ПЭК');"><div></div></label>
                                <div class="personal_ttl personal_ttl__margin">Отправка через компанию ПЭК</div>
                            </div>
                            <div class="registration_item registration_item__dropshipping">
                                <label class="custom-check"><input type="checkbox" id="other2_click" onclick="$('input[name=dost_order]').val($('#other_ord2').val());"><div></div></label>
                                <div class="personal_ttl personal_ttl__margin">Другое</div>
                                <input type="text" class="drug-otprav-input" id="other_ord2" onkeyup="$('#other2_click').click();$('input[name=dost_order]').val($('#other_ord2').val());">
                            </div>
                        </div>
                        <div class="dropshipping_textarea">
                            <p class="dropshipping_ttl">Вопросы и комментарии</p>
                            <textarea name="comment_order" id="" cols="30" rows="3" style="display: block; width: 100%;"></textarea>
                            <p class="dropshipping_description" style="padding: 20px 0;">
                                Копии ответов будут отправлены на указанный Вами электронный адрес
                            </p>
                        </div>
                        <div class="dropshipping_btns">
                            <div class="recovery_btn recovery_btn__dropshipping _dropBack">
                                <button class="personal_button personal_button__settings prev-step">Назад</button>
                            </div>
                            <div class="recovery_btn recovery_btn__dropshipping _dropEnd">
                                <button type="submit" class="personal_button personal_button__recovery personal_button__recovery3 order_button_validate3">Отправить</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?//}?>
<?/*if(in_array("8",$arGroups)):?>



<?endif;*/?>



<?else:?>

<!-- Styles and scripts for personal_area -->
<link rel="stylesheet" href="/verstka/style/personal_area.css">
<link rel="stylesheet" href="/verstka/style/modal.css">
<link rel="stylesheet" href="/verstka/style/media.css">
<link rel="stylesheet" href="/verstka/style/datepicker.css">
    <link rel="stylesheet" href="/bitrix/templates/dresscodeV2/js/fancybox/jquery.fancybox.min.css">

<script src="/verstka/scripts/datepicker.js"></script>
<script src="/verstka/scripts/personal_area.js"></script>
<!-- End for personal_area -->
<section class="personal">

        <?/*<div class="close close_order close_mobile">
        	<a href="<?if(('http://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER'] || 'https://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=""):?><?=$_SERVER['HTTP_REFERER']?><?else:?>/<?endif;?>">
            	<img src="/verstka/img/close/close.png" alt="" class="close_img">
            </a>
        </div>

        <div class="back">
        	<a href="<?if(('http://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER'] || 'https://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=""):?><?=$_SERVER['HTTP_REFERER']?><?else:?>/<?endif;?>">
            	<img src="/verstka/img/mobile/back.png" alt="" class="back_img">
            </a>
        </div>*/?>

    <div class="personal_title">
		<div class="back">
        	<a href="<?if(('http://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER'] || 'https://'.$_SERVER["HTTP_HOST"].$APPLICATION->GetCurPage()!=$_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!=""):?><?=$_SERVER['HTTP_REFERER']?><?else:?>/<?endif;?>">
            	<img src="/verstka/img/mobile/back.png" alt="" class="back_img">
            </a>
        </div>
        <h1 class="personal_h1">Настройки пользователя</h1>
    </div>
    <form method="post" name="form1" action="/personal/profile/" enctype="multipart/form-data" class="personal_reg personal_reg__registration user_settings">
	<?=$arResult["BX_SESSION_CHECK"]?>
	<input type="hidden" name="lang" value="<?=LANG?>" />
	<input type="hidden" name="ID" value=<?=$arResult["ID"]?> />
    <div class="personal_wrapper">
    		
	        <div class="profile profile_set">

	            <div class="personal_content personal_content__settings">
	                <div class="profile_big">
	                    <div class="profile_top">
	                        <p class="profile_title"><?=$arUser["LOGIN"]?></p>
	                    </div>
	                    <div class="profile_main">
	                    	<?if($arResult["arUser"]["PERSONAL_PHOTO"]>0):?>
	                    		<?
								$arPhotoSmall = CFile::ResizeImageGet(
								   	$arResult["arUser"]["PERSONAL_PHOTO"], 
								   	array(
								      	'width'=>212,
								      	'height'=>212
								   	), 
								   	BX_RESIZE_IMAGE_EXACT,
								   	Array(
								      	"name" => "sharpen", 
								      	"precision" => 0
								   	)
								);
	                    		?>
	                    	<?endif;?>
	                        <div class="profile_picture profile_picture__settings"<?if($arResult["arUser"]["PERSONAL_PHOTO"]>0):?> style="background-image: url(<?=$arPhotoSmall['src']?>);"<?endif;?>>
	                            <div class="settings_absolute">
                                    <?/*
	                                <div class="settings_wrap">
	                                    <div class="settings_item">
	                                        <div class="settings_picture settings_picture__make">
	                                            <img src="/verstka/img/profile/make.png" alt="" class="settings_img">
	                                        </div>
	                                        <p class="settings_p">Сделать фото</p>
	                                    </div>
	                                </div>
                                    */?>
	                                <div class="settings_item">
	                                    <div class="settings_picture settings_picture__save">
	                                        <img src="/verstka/img/profile/save.png" alt="" class="settings_img">
	                                    </div>
	                                    <div style="display: none;">
	                                    	<input id="photo_personal" name="PERSONAL_PHOTO" class="typefile" size="20" type="file">
	                                	</div>
	                                    <p class="settings_p" onclick="$('input[name=PERSONAL_PHOTO]').click();return false;">Загрузить фото</p>
	                                    <?if($arResult["arUser"]["PERSONAL_PHOTO"]>0):?>
	                                    	<p class="settings_p" onclick="delPhoto('<?=$USER->GetID()?>');">Удалить фото</p>
	                                    <?endif;?>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <p class="settings_change" onclick="$('input[name=PERSONAL_PHOTO]').click();return false;">Сменить фото профиля</p>
	            <div class="settings_date">
        			<?
					if (strlen($arResult["arUser"]["TIMESTAMP_X"])>0)
					{
					?>
		                <div class="settings_item-big">
		                    <p class="profile_subtitle-sm">Дата обновления</p>
		                    <p class="profile_subtitle-sm"><?=$arResult["arUser"]["TIMESTAMP_X"]?></p>
		                </div>
	                <?
	            	}
	                ?>
        			<?
					if (strlen($arResult["arUser"]["LAST_LOGIN"])>0)
					{
					?>
		                <div class="settings_item-big">
		                    <p class="profile_subtitle-sm">Последняя авторизация</p>
		                    <p class="profile_subtitle-sm"><?=$arResult["arUser"]["LAST_LOGIN"]?></p>
		                </div>
	                <?
	            	}
	                ?>
	            </div>
	        </div>
	        <div class="contacts contacts_settings">
	            <div class="personal_content personal_content__settings">
	            	<?ShowError($arResult["strProfileError"]);?>
	                <div class="profile_top profile_top__settings">
	                    <p class="profile_title profile_title__settings">Данные аккаунта</p>
	                </div>
	                <div class="profile_main settings-inner">	                    
	                        
	                        <input type="text" name="EMAIL" maxlength="50" value="<? echo $arResult["arUser"]["EMAIL"]?>" class="personal_input personal_input__email" placeholder="E-mail *" required="">
	                        <?/*<input type="password" class="personal_input personal_input__password" placeholder="Старый пароль *" required="">*/?>
	                        <div class="reg_input">	                            
	                            <input type="password" name="NEW_PASSWORD" maxlength="50" value="" autocomplete="off" class="personal_input personal_input__password" placeholder="Новый пароль">
								<a class="personal_ttl__a">Пожалуйста, введите не менее 6 символов</a>
	                        </div>
	                        <input type="password" name="NEW_PASSWORD_CONFIRM" maxlength="50" value="" autocomplete="off" class="personal_input personal_input__password" placeholder="Подтвердите новый пароль">
	                
	                </div>
	                <div class="profile_top profile_top__settings">
	                    <p class="profile_title profile_title__settings">Личные данные</p>
	                </div>
                    <style>
                        .new-row {
                            width: auto;
                            align-items: flex-end;
                            -webkit-box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            box-sizing: border-box;                          
                        }
                        .new-col {
                            width: auto;                           
                            MIN-WIDTH: 50%;                            
                            -webkit-box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            box-sizing: border-box;
                        }
                        .new-col > div {
                            max-width: none;
                        }
                        .new-col input {
                            width: 100% !important;
                        }
                        .profile_main input {
                            width: 100%;
                            max-width: none !important;
                        }
                        @media(max-width: 950px) {
                            .new-row {
                                width: 100%;
                                margin-left: 0;
                                margin-right: 0;
                            }
                            .new-col {
                                width: 100%;
                                max-width: 100%;
                                MIN-WIDTH: 100%;
                                padding-left: 0;
                                padding-right: 0;
                            }
                        }
                    </style>
	                <div class="settings_personal settings-inner">
                            <div class="new-row">
                                <div class="new-col">
									<input type="text" name="NAME" maxlength="50" value="<?=$arResult["arUser"]["NAME"]?>" class="personal_input personal_input__text" placeholder="Имя">
                                    <input type="text" name="LAST_NAME" maxlength="50" value="<?=$arResult["arUser"]["LAST_NAME"]?>" class="personal_input personal_input__text" placeholder="Фамилия">
                                </div>
                                <div class="new-col">
                                    <div class="date_reg">
                                        <a href="" class="personal_ttl__a">Дата рождения</a>
                                        <input type="hidden" name="PERSONAL_BIRTHDAY" value="<?=$arResult["arUser"]["PERSONAL_BIRTHDAY"]?>">
                                        <input id="date" type="text" name="PERSONAL_BIRTHDAY_sub" maxlength="50" value="<?=$arResult["arUser"]["PERSONAL_BIRTHDAY"]?>" class="personal_input personal_input__text" placeholder="<?= $arResult["arUser"]["PERSONAL_BIRTHDAY"]!="" ? $arResult["arUser"]["PERSONAL_BIRTHDAY"] : 'ДД.ММ.ГГГГ'?>">
                                        <div class="calendar_picture">
                                            <img src="/verstka/img/profile/calendar-m.svg" alt="" class="calendar_img">
                                        </div>
                                    </div>
                                </div>
                                <div class="new-col">
                                    <div class="date_reg">
                                        <a href="" class="personal_ttl__a">Контактный телефон *</a>
                                        <input type="text" name="PERSONAL_PHONE" maxlength="50" value="<? echo $arResult["arUser"]["PERSONAL_PHONE"]?>" class="personal_input personal_input__number" placeholder="+7(___)___-__-__">
                                    </div>
                                </div>
                            </div>
	                        <input type="text" name="PERSONAL_STREET" maxlength="50" value="<? echo $arResult["arUser"]["PERSONAL_STREET"]?>" class="personal_input personal_input__delivery" placeholder="Адрес доставки">

	                </div>
	                <?/*<div class="profile_top profile_top__settings">
	                    <p class="profile_title profile_title__settings">Дополнительная информация</p>
	                </div>*/?>
	                <div class="settings_additional settings-inner">
	                <?/*<textarea type="text" name="PERSONAL_NOTES" id="" rows="3" class="personal_textarea"><?=$arResult["arUser"]["PERSONAL_NOTES"]?></textarea>*/?>
	                    <div class="settings_buttons">
	                    	<input id="custom_submit" style="display:none;" type="submit" name="save" value="Сохранить изменения">
	                    	<input id="custom_reset" style="display:none;" type="reset" value="Сбросить изменения">
	                        <button class="personal_button" onclick="offerChange();$('#custom_submit').click();return false;">Сохранить изменения</button>
	                        <button class="personal_button personal_button__settings" onclick="window.location.href = '/personal/profile/';return false;">Сбросить изменения</button>
	                    </div>

	                </div>
                    <script type="text/javascript">
                        function offerChange() {
                            var date_sub = $('input[name=PERSONAL_BIRTHDAY_sub]').val();
                            var date = $('input[name=PERSONAL_BIRTHDAY]').val();
                            console.log(date_sub);console.log(date);
                            if(date_sub!=''){
                                $('input[name=PERSONAL_BIRTHDAY]').val($('input[name=PERSONAL_BIRTHDAY_sub]').val());
                            }
                        }
                    </script>
	            </div>

	        </div>
  
    </div>
</form>

</section>
<div class="settings_userpic">
    <div class="background-bl"></div>
    <div class="userpic">
        <h3 class="userpic_h3">Сменить фото профиля</h3>
        <?/*<div class="settings_wrap">
            <div class="settings_item">
                <div class="settings_picture settings_picture__make">
                    <img src="/verstka/img/profile/make.png" alt="" class="settings_img">
                </div>
                <p class="settings_p">Сделать фото</p>
            </div>
        </div>*/?>
        <div class="settings_item">
            <div class="settings_picture settings_picture__save">
                <img src="/verstka/img/profile/save.png" alt="" class="settings_img">
            </div>
            <p class="settings_p">Загрузить фото</p>

        </div>
    </div>
</div>

<script type="text/javascript">
	$('#photo_personal').change(function() {
	  	$('#custom_submit').click();return false;
	});
</script>


<?endif;?>


