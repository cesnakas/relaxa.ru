<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

ShowMessage($arParams["~AUTH_RESULT"]);
?>



<div class="recovery_main">
    <p class="recovery_p">
        После заполнения формы мы отправим<br>
        на указанный электронный адрес<br>
        специальную ссылку, перейдя<br>
        по которой, вы сможете задать новый пароль.<br>
    </p>
    <div id="result_send"></div>
    <form action="#winpass?password=send" method="post" id="send" name="bform" class="personal_reg">
		<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
		<input type="hidden" name="AUTH_FORM" value="Y">
		<input type="hidden" name="TYPE" value="SEND_PWD">
        <input type="email" id="input" name="USER_LOGIN" class="personal_input personal_input__email" placeholder="Адрес электронной почты">
        <div class="recovery_btn">
            <button class="personal_button personal_button__recovery">Отправить</button>
        </div>
    </form>
</div>



<?/*
<div id="result_send"></div>
<form action="#winpass?password=send" method="post" id="send" name="bform">
	<input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
	<input type="hidden" name="AUTH_FORM" value="Y">
	<input type="hidden" name="TYPE" value="SEND_PWD">
	<p class="common-input pasword">
		<input type="text" id="input" name="USER_LOGIN" >
		<label for="input">E-mail<span>*</span></label>
	</p>
	<a href="javascript:void(0);" onclick="$(this).closest('form').submit()" class="btn-enter">Отправить</a>
</form>*/?>



<script type="text/javascript">
document.bform.USER_LOGIN.focus();
</script>
