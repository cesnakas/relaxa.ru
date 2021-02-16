<script type="text/javascript" src="https://relaxa.ru/bitrix/templates/dresscodeV2_new/js/jquery.js"></script>
<link rel="stylesheet" href="https://relaxa.ru/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.css">
<link rel="stylesheet" href="https://relaxa.ru/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.min.css">
<script type="text/javascript" src="https://relaxa.ru/bitrix/templates/dresscodeV2_new/js/fancybox/jquery.fancybox.min.js"></script>

<link rel="stylesheet" href="https://relaxa.ru/assets/js/fancybox/jquery.fancybox.min.css">
<link rel="stylesheet" href="https://relaxa.ru/assets/js/fancybox/jquery.fancybox.min.css">
<script type="text/javascript" src="https://relaxa.ru/assets/js/fancybox/jquery.fancybox.min.js"></script>

<link rel="stylesheet" href="https://relaxa.ru/bitrix/templates/dresscodeV2/css/prefix-new/main.css">
<link rel="stylesheet" href="https://relaxa.ru/assets/css/style.css">
 

<div class="ny-mk" id="ny-mk">
            <form class="ny-mk__wrap">
                <input type="hidden" name="ID" value="<?=$arResult['ID']?>">
                <input type="hidden" name="IBLOCK_ID" value="<?=$arResult['IBLOCK_ID']?>">
                <div class="form-pokaza__close " data-fancybox-close>
                    <span></span>
                    <span></span>
                </div>
                <div class="form__title">Получить предложение на скидку</div>
                <div class="form__text">
                    Оставьте заявку на получение уникального предложения <br> на преобретение массажного кресла со скидкой 30%!
                </div>
                <div class="form-pokaza__item">
                    <label>Ваше имя<span>*</span></label>
                    <input type="text" name="NAME" placeholder="Введите имя" required>
                </div>
                <div class="form-pokaza__item">
                    <label>Номер телефона<span>*</span></label>
                    <input class="p-izgotov__phone" type="text" name="PHONE" placeholder="+7(___) ___-__-__" required>
                </div>
				<div class="form-pokaza__item">
                    <label>Укажите e-mail или мессенджер для связи (не обязательно)</label>
                    <input type="text" name="DOP_SVAZ">
                </div>
                
				<div class="form-pokaza__checkbox">
                    <input type="checkbox" name="SOGL" id="form-check__ny-mk" checked required>
                    <label for="form-check__ny-mk">Согласие на обработку персональных данных</label>
                </div>
				
                <div class="g-recaptcha" id="ny-mk_cap" data-sitekey="6Lcdw-MUAAAAANewuNvmQb0ikgc-2OKf9AfjMYW_"></div>
                <button name="submit" type="submit" class="ny-mk__submite">Отправить</button>
            </form>
        </div>
<script src='https://www.google.com/recaptcha/api.js'></script>	
        <script>
            $(document).ready(function() {
                $('.ny-mk__wrap').submit(function() {
                    var key = grecaptcha.getResponse();
                    if(key == '') {
                        alert('Вы не прошли проверку "Я не робот"');
                    } else {
                        var form = $(this).serialize();
                        $.ajax({
                            type: 'POST', // метод
                            url: '/ajax/ny-mk.php', // ссылка на обработчик
                            data: form, // нашы переменные из name
                            success: function(data){
                                console.log(data);
                                $.fancybox.close();
                                setTimeout(function() {
                                    $.fancybox.open("<div class='modal-ok' id='modalloll-ok' style='display: none;'><a href='#' class='p-izgotov__close'></a><div class='p-izgotov__title'>Спасибо за заявку!</div><div class='p-izgotov__subtitle'>Наши менеджеры свяжутся с Вами в ближайшее время.</div></div>");
                                    $('.p-izgotov__close').on('click', function() {
                                        $.fancybox.close();
                                        return false;
                                    });

                                    setTimeout(function() {
                                        $.fancybox.close();
                                    }, 2500);

                                }, 500);
                            }
                        });
                    }
                    return false;
                });
            });			
        </script>