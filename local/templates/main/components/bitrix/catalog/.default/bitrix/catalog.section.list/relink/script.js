$(document).ready(function () {
    var category = $('.relink_cat'),
        category_btn = $('.button_open_all_item'),
        category_open = 'Скрыть',
        category_close = 'Показать все категории',
        category_maxh = 95,
        category_h = category.height();
    category_btn.hide();
    if (category_h > category_maxh) {
        category_btn.text(category_close).show();
        category.css('height', category_maxh + 'px');
        category_btn.on('click', function (a) {
            a.preventDefault();
            if (!category.hasClass('opened')) {
                category.addClass('opened').css('height', category_h + 'px');
                category_btn.text(category_open);
                return;
            }
            category.removeClass('opened').css('height', category_maxh + 'px');
            category_btn.text(category_close);
            fs_scroll_pos = +($(window).scrollTop() - category_h + category_maxh);
            $("html, body").animate({
                scrollTop: fs_scroll_pos
            }, 700);
        });
    }
});