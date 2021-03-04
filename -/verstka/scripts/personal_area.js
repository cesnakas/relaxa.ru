/* Для функционала на адаптиве  */

/* Добавление класса основному родительскому контейнеру, чтобы верстка стала резиновой  */
$(document).mouseover(function(){
    if ('.personal') {
        $('.container').addClass('container_personal');
    }
});
var handleMatchMedia = function (mediaQuery) {
    if (mediaQuery.matches) {
        // смена текста
        $('.personal_h2.personal_h2__status').text('Статус заказа');
        $('.personal_h2.personal_h2__sign').text('Войти в личный кабинет');
        $('.order_stroke:nth-child(3) .order_name:nth-child(1)').text('Адрес:');
        $('p.help_p').text('Редактировать');

        // добавление и удаление класса (представенные классы предназначены для корректной работы на мобильных устройствах)
        $('.personal_tab').addClass('mobile');
        $('.personal_mobile').addClass('active');
        $('.entrance_picture').addClass('active');
        $('.personal_forgive').addClass('unactive');
        $('._drop').addClass('full');
        $('.social').removeClass('social_active');
        $('.go').removeClass('remove');
        $('.personal_menu').removeClass('mobile_menu');
        $('section.personal.personal_sign .personal_content').removeClass('personal_content__padding');
        $('.popUp.popUp_recovery,.popUp.popUp_dropshipping,.popUp.popUp_wants,.popUp.popUp_pay').addClass('popUp_position');
        $('form.personal_reg.personal_reg__dropshipping').addClass('max_width_750');

        // Для модального окна "Забыли пароль"
        $('.unactive').click(function () {
            if ($(this)) {
                $('section.personal.personal_sign').addClass('max_width_750');
                $('.personal_tab').removeClass('active');
                $('.social').removeClass('social_active');
                event.preventDefault();
            } else {
                $('section.personal.personal_sign').removeClass('max_width_750');
                $('.personal_tab').addClass('active');
                $('.social').addClass('social_active');
            }
        });

        // Клик на "Заказ дроппшипинг" - меняет состояние окна
        $('.full').click(function () {
            if ($(this)) {
                $('section.personal').addClass('max_width_750');
                event.preventDefault();
            } else {
                $('section.personal').removeClass('max_width_750');
            }
        });

        // Клик на стрелку "назад" и "крестик" у модальных окон "pay, wants, dropshipping" - первое и второе окно
        $('._goFirst').click(function () {
            let form = $('form.personal_reg.personal_reg__dropshipping');
            let section = $('section.personal');
            let modal = $('.popUp.popUp_dropshipping.popUp_position');
            let wrap = $('.dropshipping_wrap');

            if ($(form).hasClass('max_width_750')) {
                $(section).removeClass('max_width_750');
                $(modal).removeClass('active');
                $(form).removeClass('active');
                return;
            } else if ($(wrap).hasClass('max_width_750')) {
                $(wrap).removeClass('max_width_750');
                $(form).addClass('max_width_750');
                $(modal).addClass('active');
                return;
            }
        });

        // Клик на стрелку "назад" и "крестик" у модальных окон "pay, wants, dropshipping" - третье+ окна
        $('._goMain').click(function () {
            let container = $(this).closest('.popUp');
            let prev = container.prev('.popUp');

            container.removeClass('active');
            prev.addClass('active');
            event.preventDefault();
        });

        // Клик для выбора вида оплаты
       $('._choose').click(function () {
            if ($(this)) {
                $('.selects-back').addClass('active');
                $('.adaptive__header').addClass('unactive');
                $('.dropshipping_selects').addClass('active');
                $('.background-bl').addClass('active');
            }
        });

        $('.selects-back').click(function () {
            $('.selects-back').removeClass('active');
            $('.adaptive__header').removeClass('unactive');
            $('.dropshipping_selects').removeClass('active');
        });
        // Страница login_dealer.php - переход со второго окна к третьему
        $('._dropMob').click(function () {
           $('.dropshipping_wrap').addClass('max_width_750');
           $('form.personal_reg.personal_reg__dropshipping.max_width_750').removeClass('max_width_750');
        });

        $('.recovery .close').click(function () {
            $('.popUp.popUp_recovery.popUp_position').removeClass('active');
            $('section.personal.personal_sign').removeClass('max_width_750');

            $('.personal_tab:nth-child(4)').addClass('active');
            $('.social').addClass('social_active');
        });

        // Разные состояния табов - страница index.php
        $('.personal_a').addClass('mobile')
                        .click(function () {
                            $('.personal_menu').addClass('mobile_menu');
                            $('.personal_content').addClass('personal_content__padding');
                            $('.social').addClass('social_active');

                            $('.personal_tab').removeClass('mobile');
                            $('.personal_mobile').removeClass('active');
                            $('.entrance_picture').removeClass('active');
                        });

        $('.personal_a.personal_a__hide,.personal_a.personal_a__registration').click(function () {
            $('.social').removeClass('social_active');
            $(this).closest('.social').addClass('none');
        });

        // Для возврата к предыдущему состоянию - страница index.php
        $('.back,.personal_tab .close').click(function () {
            let container = $(this).closest('.personal_tab');


                container.addClass('active')
                    .addClass('mobile');

                $('.personal_menu').removeClass('mobile_menu');
                $('.social').removeClass('social_active');
                $('.personal_content').removeClass('personal_content__padding');

                $('.personal_mobile').addClass('active');
                $('.entrance_picture').addClass('active');
        });

        // Для действия с фотографией пользователя
        $('.profile_picture.profile_picture__settings').click(function() {
            $('.settings_userpic').addClass('active');
        });

        // Открытие модальных окон для звонка, написания на почту и скачивания прайса
        $('._load').click(function(){
            $('.popUp_download').addClass('active');
        });
        $('._num').click(function(){
            $('.popUp_call').addClass('active');
        });
        $('._mail').click(function(){
            $('.popUp_mail').addClass('active');
        });
   }
    else {
        // Обратная смена текста
        $('.personal_h2.personal_h2__status').text('Проверить статус заказа');
        $('.personal_h2.personal_h2__sign').text('Войти с паролем');
        $('.order_stroke:nth-child(3) .order_name:nth-child(1)').text('Адрес доставки:');
        $('p.help_p').text('Редактировать профиль');
        // Удаление классов, которые не нужны на десктопе
        $('.personal_a').removeClass('mobile');
        $('.personal_tab').removeClass('mobile');
        $('.personal_menu').removeClass('mobile_menu');
        $('.social').removeClass('max_width_750')
            .removeClass('social_active');
        $('.go').addClass('remove');
        $('.popUp.popUp_recovery,.popUp.popUp_dropshipping,.popUp.popUp_wants,.popUp.popUp_pay').removeClass('popUp_position');
        $('.personal_forgive').removeClass('unactive');
        $('._drop').removeClass('full');
        // Если все табы на мобильном были закрыты, но осуществляется смена размера экрана, нужно вывести первый таб
        if ($('.personal_tab').hasClass('active')) {
            return;
        } else {
            $('.personal_tab:nth-child(4)').addClass('active');
        }
        // Удаление события с классов, которые нужны только на моб
        $('._goFirst,' +
            '._goMain,' +
            '.unactive,' +
            '.personal_a,' +
            '.personal_a.personal_a__hide,' +
            '.personal_a.personal_a__registration,' +
            '.back,.' +
            'profile_picture.profile_picture__settings,' +
            '._load,' +
            '._num,' +
            '._mail').off('click');

    }
    // Закрытие модальных окон "pay, wants, dropshipping" на десктопе
    $('.remove').click(function () {
        $('.popUp').removeClass('active');
    });
},
mql = window.matchMedia('(max-width: 750px)');
handleMatchMedia(mql);
mql.addListener(handleMatchMedia);

/* Табы в PERSONAL AREA */
$('.personal_menu').on('click', 'a.personal_a:not(.active)', function() {
    $(this)
        .addClass('active').siblings().removeClass('active')
        .closest('div.personal_content').find('div.personal_tab').removeClass('active').eq($(this).index()).addClass('active');
		$('.personal_a').removeClass('active');
		$(this).addClass('active');
});
// Закрытие модальных окон "pay, wants, dropshipping" на десктопе
$('.remove').click(function () {
    $('.popUp').removeClass('active');
});
// Открытие модальных окон
$('.personal_forgive').click(function(){
    $('.popUp_recovery').addClass('active');
    let container = $(this).closest('.personal_tab');
    container.addClass('active')
});
$('.personal_regSuccess').click(function(){
    $('.popUp_regSuccess').addClass('active');
    /*let container = $(this).closest('.personal_tab');
    container.addClass('active')*/
});
$('.personal_regSuccessDrop').click(function(){
    $('.popUp_regSuccessDrop').addClass('active');
    /*let container = $(this).closest('.personal_tab');
    container.addClass('active')*/
});

$('.personal_button.personal_button__registration').click(function(){
    $('.popUp_access').addClass('active');
});
$('button.order_btn.order_btn__open.order_btn__select').click(function(){
    $('.popUp_select').addClass('active');
});
// Функции для работы модальных окон "pay, wants, dropshipping"
// Открыие на десктопе по клику на "заказ дроппшипинг"
$('._drop').click(function(){
    $('.popUp_dropshipping').addClass('active');
});
// Переход к следующему модальному окну
$('._dropGo').click(function () {
    let container = $(this).closest('.popUp');
    let next = container.next('.popUp');

    container.removeClass('active');
    next.addClass('active');
    event.preventDefault();
});
// Возврат к предыдущему модальному окну
$('._dropBack').click(function () {
    let container = $(this).closest('.popUp');
    let prev = container.prev('.popUp');

    container.removeClass('active');
    prev.addClass('active');
    event.preventDefault();
});
// Возврат к дефолтному состоянию по окончанию всех модальных окон
/*$('._dropEnd').click(function () {
    $('.popUp').removeClass('active');
    $('section.personal').removeClass('max_width_750');
    $('.dropshipping_wrap').removeClass('max_width_750');
    $('form.personal_reg.personal_reg__dropshipping').addClass('max_width_750');
    event.preventDefault();
});*/
// Закрытие части модальных окон - не касается следующих модалок - "pay, wants, dropshipping"
$('.close,.background-bl').click(function(){
    $('.popUp,.settings_userpic').removeClass('active');
});
$('.background-mob').click(function(){
    $('.popUp_call,.popUp_download,.popUp_mail').removeClass('active');
});

/* FOR REGISTRATION_TAB */
$('.personal_a').click(function(){
    if ($(this).hasClass('personal_a__registration')) {
        $('.social').addClass('none');
        $('.personal_main').addClass('_fullWidth');
        $('.personal_menu').addClass('personal_menu__width');

        $('h1.personal_h1').text('Регистрация');
    } else {
        $('.social').removeClass('none');
        $('.personal_main').removeClass('_fullWidth');
        $('.personal_menu').removeClass('personal_menu__width');

        $('h1.personal_h1').text('Войти на сайт');
    }
});
/* END FOR REGISTRATION_TAB */
/* FOR USER SETTINGS MODAL */
$('.profile_settings')
    .mouseover(function () {
        $('.help').addClass('active');
    })
    .mouseleave(function () {
        $('.help').removeClass('active');
    });
/* END FOR USER SETTINGS MODAL */
/* FOR CALENDAR */
$('#date,.date_btn').datepicker();
$('#date,.date_btn').data('datepicker');
/* END FOR CALENDAR */
/* FOR TIME */
//$('#timepicker').timepicker();
$('.personal_input__time').timepicker();

$('.timepicker_picture').click(function() {
    $('.timepicker').hide();
});
/* END FOR TIME */


function delPhoto(userid) {
    var userid = userid;
    $.ajax({
        type: "POST",
        url: "/include/ajax/del_photo.php",
        data: {userid: userid},
        success: function(html){
            $('#custom_submit').click();
        }
    });
    return false;
}