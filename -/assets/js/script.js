$(document).ready(function() {

    if($(window).width() < 768) {
        $('#smartFilter').hide();
        $('.new-left').focus();
    }

    $('.p-prods__predzak').on('click', function() {
        $('.heading-modal-js').text('Предзаказ');
        $('.title-modal-js').text('Заполните данные для предзаказа');
        $('#fastBuyFormSubmit').html('Предзаказ');
    });
    $('.p-prods__buyoneclick').on('click', function() {
        $('.heading-modal-js').text('Купить в один клик');
        $('.title-modal-js').text('Заполните данные для заказа');
        $('#fastBuyFormSubmit').html('Купить в один клик');
    });
    $('.p-prods__buyoneclick-pred').on('click', function() {
        $('.heading-modal-js').text('Заказать в один клик');
        $('.title-modal-js').text('Заполните данные для заказа');
        $('#fastBuyFormSubmit').html('Заказать в один клик');
    });
    $('.p-carddes__buyoneclick').on('click', function() {
        $('.heading-modal-js').text('Купить в один клик');
        $('.title-modal-js').text('Заполните данные для заказа');
        $('#fastBuyFormSubmit').html('Купить в один клик');
    });
    $('.p-carddes__buyoneclick-pred').on('click', function() {
        $('.heading-modal-js').text('Заказать в один клик');
        $('.title-modal-js').text('Заполните данные для заказа');
        $('#fastBuyFormSubmit').html('Заказать в один клик');
    });
    $('.p-carddes__addbasket-pred').on('click', function() {
        $('.heading-modal-js').text('Предзаказ');
        $('.title-modal-js').text('Заполните данные для предзаказа');
        $('#fastBuyFormSubmit').html('Предзаказ');
    });


    /*MENU*/
    $('.catmob-header .catmob__menu').on('click', function(){
        $(this).parent().children('.menu__adaptive__menu').toggle();
        return false;
    });
    $('.catmob-header .catmob__search').on('click', function(){
        $(this).parent().children('.search-container-toggle').toggle();
        return false;
    });

    $('.toppanel__sort').on('click', function() {
        $(this).toggleClass('active');
        $(this).parent().children('.toppanel__sort-list').toggle();
        return false;
    });


    $('.catpanel__title').on('click', function() {
        $(this).toggleClass('active');
        $('.catpanel__list').toggle();
        return false;
    });
    $('.toppanel__filter').on('click', function() {
        $('#smartFilter').toggle();

        $('#smartFilter .blackoutLeft').draggable();
        $('#smartFilter .blackoutRight').draggable();

        $('#arrFilter_1423_MIN').focus();

        setTimeout(function() {
            $('#arrFilter_1423_MIN').blur();
        }, 100);

/*
        var slwidth = $('#smartFilter .rangeSlider').width();
        setTimeout(function() {
            $('#smartFilter .rangeSlider').css({

            })
        }, 3000);
        */
/*
        var fir1 = $('#arrFilter_1423_MAX').val();
        var fir2 = $('#arrFilter_1423_MIN').val();
        var fir3 = fir1 - 1;
        setTimeout(function() {
            $('#arrFilter_1423_MIN').val(fir3);
        }, 500);
        setTimeout(function() {
            $('#arrFilter_1423_MIN').val(fir2);
        }, 1000);
*/

        return false;
    });

    $('.p-izgotov__phone').mask("+7(999)999-99-99");

});

var basketcount;
basketcount = 0;
$(document).ready(function() {
    basketcount = $('header .stuff__in__basket__header a .count').html();
    basketcount = Number(basketcount);
    if(basketcount > 0) {
        $('.catmob__basket-count').show();
        $('.catmob__basket-count').text(basketcount);
    }
    $('.p-prods__addbasket').on('click', function() {
        setTimeout(function() {
            basketcount = $('header .stuff__in__basket__header a .count').html();
            basketcount = Number(basketcount);
            if(basketcount > 0) {
                $('.catmob__basket-count').show();
                $('.catmob__basket-count').text(basketcount);
            }
        }, 2000);
    });



});

$(document).ready(function() {
    if($(window).width() > 767) {
        setInterval(function() {
            var filterheight = $('#smartFilter').height();
            if(filterheight) {
                $('.rightColumn').css({
                    'min-height': filterheight + "px"
                });
            }
        }, 1000);
    }
});