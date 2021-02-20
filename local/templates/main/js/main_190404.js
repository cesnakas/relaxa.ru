$(document).ready(function() {
//  $('select').niceSelect();
});

var pricesSlider = $("#prices-slider"),
        minCost = $("#min-cost"),
        maxCost = $("#max-cost");

    pricesSlider.slider({
        min: 0,
        max: 99999,
        values: [967, 27164],
        range: true,
        stop: function (event, ui) {
            minCost.val(pricesSlider.slider("values", 0));
            maxCost.val(pricesSlider.slider("values", 1));
        },
        slide: function (event, ui) {
            minCost.val(pricesSlider.slider("values", 0));
            maxCost.val(pricesSlider.slider("values", 1));
        }
    });

    minCost.change(function () {
        var value1 = minCost.val();
        var value2 = maxCost.val();

        if (parseInt(value1) > parseInt(value2)) {
            value1 = value2;
            minCost.val(value1);
        }
        pricesSlider.slider("values", 0, value1);
    });

    maxCost.change(function () {
        var value1 = minCost.val();
        var value2 = maxCost.val();

        if (value2 > 1000) {
            value2 = 1000;
            maxCost.val(1000)
        }

        if (parseInt(value1) > parseInt(value2)) {
            value2 = value1;
            maxCost.val(value2);
        }
        pricesSlider.slider("values", 1, value2);
    });

$('.slider_one').slick({
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 4000,
    prevArrow: "<p class=\"slider_prev\"><img src=\"img/slider_prev.png\"></p>",
    nextArrow: "<p class=\"slider_next\"><img src=\"img/slider_next.png\"></p>",
});

$('.slider_brand').slick({
    dots: false,
    slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: false,
    autoplaySpeed: 2000,
    prevArrow: "<p class=\"b_slider_prev\"><img src=\"img/slider_prev.png\"></p>",
    nextArrow: "<p class=\"b_slider_next\"><img src=\"img/slider_next.png\"></p>",
});
/*правки слайдера в карточке товара by RG*/
$(document).on('click', '#rg_prev_slide', function() {
    $('#moreImagesCarousel .slideBox > .item').each(function(i) {
        if($(this).hasClass('selected')) {
            if(i == 0) {
                $(this).removeClass("selected");
                $(this).parent().find('.item:last-child').addClass("selected");
                return false;
            } else {
                $(this).removeClass("selected");
                $(this).prev().addClass("selected");
                return false;
            }
        }
    });
    $('#moreImagesCarousel .slideBox > .item').each(function(j) {
        if($(this).hasClass('selected')) {
            if(j == 0) {
                $('#pictureContainer .pictureSlider').css('left', '0%');
                return false;
            } else {
                $('#pictureContainer .pictureSlider').css('left', '-' + j + '00%');
                return false;
            }
        }
    });
});
$(document).on('click', '#rg_next_slide', function() {
    $('#moreImagesCarousel .slideBox > .item').each(function(i) {
        if($(this).hasClass('selected')) {
            if($(this).next().length > 0) {
                $(this).removeClass("selected");
                $(this).next().addClass("selected");
                return false;
            } else {
                $(this).removeClass("selected");
                $(this).parent().find('.item:first-child').addClass("selected");
                return false;
            }
        }
    });
    $('#moreImagesCarousel .slideBox > .item').each(function(j) {
        if($(this).hasClass('selected')) {
            if(j != 0) {
                $('#pictureContainer .pictureSlider').css('left', '-' + j + '00%');
                return false;
            } else {
                $('#pictureContainer .pictureSlider').css('left', '0%');
                return false;
            }
        }
    });
});
/*end by RG*/
$( ".modal_wrapp .inputtext" ).each(function( index ) {
    if($( this ).attr( 'name' ) == mask) {
        $(this).addClass('mask').mask("+38(999)9999999");
    } else if($(this).attr( 'name' ) == ub) {
        $(this).val(user);
    } else if($(this).attr( 'name' ) == email) {
        $(this).addClass('email_mask').inputmask({
            mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]",
            greedy: false,
            onBeforePaste: function (pastedValue, opts) {
                pastedValue = pastedValue.toLowerCase();
                return pastedValue.replace("mailto:", "");
            },
            definitions: {
                '*': {
                    validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
                    cardinality: 1,
                    casing: "lower"
                }
            }
        });
    } else if($(this).attr( 'name' ) == ul) {
        $(this).val(location);
    }
});

$(".open_heder_mob_menu").click(function() {
    $(".mob_menu_body").toggleClass("open");
});
$(".closet_mob_menu").click(function() {
    $(".mob_menu_body").toggleClass("open");
});
$(".open_drop").click(function() {
    $(this).toggleClass("open");
    $(this).next().toggleClass("open");
});
$(".mob_sort_filters").click(function() {
    $(this).toggleClass("open");
    $(".sitebar").toggleClass("open");
});
$("#go_oform").click(function() {
    $(".page_korzina").css("display", "none");
    $(".page_dector").css("display", "block");
});
$("a.suuk").click(function() {
    $(".page_korzina").css("display", "none");
    $(".page_dector").css("display", "none");
    $(".page_sucess").css("display", "block");
});

    $('.js-ajax').on('submit', function() {
        _success = $(this).find('.success');
        _error = $(this).find('.error');
        var data = $(this).serialize();
        var url = $(this).attr('action');
        console.log(data);
		_success.hide();_error.hide();
        $.ajax({
            url: url, // указываем URL и
            dataType: "json", // тип загружаемых данных
            method: "POST",
            data: data,
            success: function(data) { // вешаем свой обработчик на функцию success
                console.log(data);
                if (data['status'] == 'success') {
                    _success.html(data['text']).show();
                }
                if (data['status'] == 'error') {
                    _error.html(data['text']).show();
                }
            }
        });

        return false;
    });

$(".modal").click(function() {
	var href=$(this).attr('href');
    $(href).addClass("open");
    $(".modal_back").addClass("open");
});
$(".call_back_header").click(function() {
    $(".calback_modal").addClass("open");
    $(".modal_back").addClass("open");
});
$(".send_reviews").click(function() {
    $(".send_reviews_modal").addClass("open");
    $(".modal_back").addClass("open");
});
$(".pm_d").click(function() {
    $(".pm_d_modal").addClass("open");
    $(".modal_back").addClass("open");
});
$(".modal_back, .closs_th_modal_b").click(function() {
    $(".calback_modal").removeClass("open");
    $(".modal_back").removeClass("open");
    $(".pm_d_modal").removeClass("open");
    $(".send_reviews_modal").removeClass("open");
    $(".modal").removeClass("open");
});
$( ".company_blcok>div>select" ).change(function () {
    var str = "";
    $( ".company_blcok>div>select option:selected" ).each(function() {
        str += $( this ).val() + " ";
        if (str == 2) {
           $(".company_form").css("display", "block"); 
        } else {
           $(".company_form").css("display", "none"); 
        }
    });
  })
  .change();

$(document).ready(function() {
    $("a.scrollto").click(function() {
      var elementClick = $(this).attr("href")
      var destination = $(elementClick).offset().top;
      jQuery("html:not(:animated),body:not(:animated)").animate({
        scrollTop: destination
      }, 800);
      return false;
    });
	
	$(document).on("click", ".anchor-scroll", function(e) {
		e.preventDefault();
		$('body,html').animate({
			scrollTop:$($(this).attr('href')).offset().top + 'px',
		},300);
	});
	$('.actionHead').click(function(){
		$(this).toggleClass('transformScale');
	});
});