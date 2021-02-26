<?
/**
 * Bitrix Framework
 * @package bitrix
 * @subpackage main
 * @copyright 2001-2014 Bitrix
 */

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @param array $arParams
 * @param array $arResult
 * @param CBitrixComponentTemplate $this
 */

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

if($arResult["SHOW_SMS_FIELD"] == true)
{
	CJSCore::Init('phone_auth');
}
?>


<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="/bitrix/templates/dresscodeV2/components/dubl/main.register/custom/jquery.maskedinput.min.js" async defer></script>
                <div class="personal_form personal_form__big">
					<?if($USER->IsAuthorized()):?>

						<p><?echo GetMessage("MAIN_REGISTER_AUTH")?></p>

					<?else:?>
						<?
						if (count($arResult["ERRORS"]) > 0):
							foreach ($arResult["ERRORS"] as $key => $error)
								if (intval($key) == 0 && $key !== 0) 
									$arResult["ERRORS"][$key] = str_replace("#FIELD_NAME#", "&quot;".GetMessage("REGISTER_FIELD_".$key)."&quot;", $error);

							ShowError(implode("<br />", $arResult["ERRORS"]));

						elseif($arResult["USE_EMAIL_CONFIRMATION"] === "Y"):
						?>

							<p><?echo GetMessage("REGISTER_EMAIL_WILL_BE_SENT")?></p>
							<script type="text/javascript">							
								$('.auth_class').click(function (e) {
								$('.personal_tab').removeClass("active");
								$('.personal_tab:first').addClass("active");
								$('.personal_a').removeClass("active");
								$('.personal_a:first').addClass("active");
								});
							</script>							
							<?if(count($arResult["ERRORS"]) == 0 && $_GET["reg"]=='y'):?>
								<p><font class="errortext" style="color:green;">На указанный в форме e-mail было выслано письмо с информацией о подтверждении регистрации.<br></font></p>
								<?// echo '<meta http-equiv="refresh" content="2; url=http://'.$_SERVER['SERVER_NAME'].'">';?>
								<script type="text/javascript">
									setTimeout(function(){
									$('.personal_tab').removeClass("active");
									$('.personal_tab:first').addClass("active");
									$('.personal_a').removeClass("active");
									$('.personal_a:first').addClass("active");
									}, 3000);
									
									
								</script>
							<?endif;?>
						<?endif?>

	                    <div class="personal_title">
	                        <p class="personal_ttl">* Обязательные поля</p>
	                    </div>
	                    <form method="post" action="<?=$APPLICATION->GetCurPageParam('reg=y', array('reg')); ?>" name="regform" class="personal_reg personal_reg__registration">
							<?
							if($arResult["BACKURL"] <> ''):
							?>
								<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>?regok=y" />
							<?
							endif;
							?>
							<div class="urdn">
								<input type="text" name="<?php echo OlegPro\UserRegister::FAKE_FIELD_NAME1 ?>" maxlength="50" value="<?php echo $arResult[OlegPro\UserRegister::FAKE_FIELD_NAME1] ?>" class="bx-auth-input" />
							</div>
	                        <input type="text" name="REGISTER[NAME]" class="personal_input personal_input__text" value="<?=$arResult["VALUES"]["NAME"]?>" placeholder="* Имя">
	                        <input type="text" name="REGISTER[PERSONAL_PHONE]" class="personal_input personal_input__number" placeholder="* Телефон" value="" required>
							<input type="text" name="REGISTER[EMAIL]" class="personal_input personal_input__email" placeholder="* E-mail" value="<?=$arResult["VALUES"]["EMAIL"]?>" required>
							<input type="hidden" name="UF_PHONE" value=" "> 
							<input type="text" name="UF_NAME_COMPANY" class="personal_input personal_input__text" placeholder="Название компании" value="" >
							<input type="text" name="UF_CONTACTS_NAME" class="personal_input personal_input__text" placeholder="Контактное лицо компании" value="" >
							<input type="text" name="UF_CONTACTS_PHONE" class="personal_input personal_input__number phones_pl" placeholder="Телефон контактного лица" value="" >
							
							
							
							
	                        <div class="reg_input reg_input__width">
	                            <p class="personal_ttl__a personal_ttl__mobile">Введите не менее 6 символов</p>
	                            <input size="30" type="password" name="REGISTER[PASSWORD]" autocomplete="off" class="personal_input personal_input__password" placeholder="* Пароль" required>
	                        </div>
	                        <div class="reg_input reg_input__width">
	                            <input size="30" type="password" name="REGISTER[CONFIRM_PASSWORD]" autocomplete="off" class="personal_input personal_input__password" placeholder="* Подтвердите пароль" required>
	                            <p class="personal_ttl__a">Пожалуйста, введите не менее 6 символов</p>
	                        </div>
	                        <div class="registration_block">
	                            <div class="registration_item">
	                                <label class="custom-check"><input type="checkbox" value="1" name="UF_SUBS"><div></div></label>
	                                <div class="personal_ttl personal_ttl__margin">Я согласен с <a href="" class="personal_ttl__a">условиями подписки</a></div>
	                            </div>

								<?
								/* CAPTCHA */
								if ($arResult["USE_CAPTCHA"] == "Y")
								{
									?>
			                            <div class="registration_inner">
			                                <input type="text" name="captcha_word" maxlength="50" value="" autocomplete="off" class="personal_input" placeholder="* Укажите символы с картинки" required>
			                                <div class="personal_captcha">
			                                	<input type="hidden" name="captcha_sid" class="captchaSidReg" value="<?=$arResult["CAPTCHA_CODE"]?>" />
			                                    <picture>
			                                        <source srcset="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" class="captcha_img captcha_img_reg" media="(max-width: 750px)">
			                                        <source srcset="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" class="captcha_img_reg">
			                                        <img srcset="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" alt="CAPTCHA" class="captcha_img captcha_img_reg">
			                                        
			                                    </picture>
			                                    <img srcset="/verstka/img/Captcha_full.png" alt="CAPTCHA" onclick="reloadCapthaReg();">
			                                </div>
			                            </div>
						                <script type="text/javascript">
										
											$(function(){
											  $(".phones_pl").mask("8(999) 999-9999");
											});
										
						                    function reloadCapthaReg(){
						                        $.getJSON('/include/ajax/reload_captcha.php', function(data) {
						                            $('.captcha_img_reg').attr('srcset','/bitrix/tools/captcha.php?captcha_sid='+data);
						                            $('.captchaSidReg').val(data);
						                            //$parent.find('.whiteBlock').hide();
						                        });
						                        return false;
						                    };
						                </script>
			                            
									<?
								}
								/* !CAPTCHA */
								?>
<div class="g-recaptcha" data-sitekey="<?=RE_SITE_KEY?>"></div>
	                        </div>
	                        <div class="registration_item">
	                            <label class="custom-check"><input type="checkbox" id="modal_reg-chbx-new" onchange="validateForm();"><div></div></label>
	                            <div class="personal_ttl personal_ttl__margin" >Я согласен с <a href="" class="personal_ttl__a">обработкой персональных данных</a></div>
	                        </div>

	                        <div class="personal_title personal_title__mobile">
	                            <p class="personal_ttl">* Обязательные поля</p>
	                        </div>
	                        <input type="submit" name="register_submit_button" style="display: none;" value="<?=GetMessage("AUTH_REGISTER")?>" />
	                        <button onclick="$('input[name=register_submit_button]').click();return false; document.getElementById('check').value = 'secretcode';" class="personal_button personal_button__registration" disabled>Регистрация</button>

	                    </form>
                    <?endif?>
                </div>


<??>