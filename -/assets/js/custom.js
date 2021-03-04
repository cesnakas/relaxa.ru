$(document).ready(function(){
    //форма восстановления пароля
    $("#send").submit(function(){
        var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/include/ajax/send_pass.php",
            data: str,
            success: function(html){
                $('#result_send').html(html);
                $('input').val('');
            }
        });
        return false;
    });

    //запрос статуса заказа
    $("#order_status_form").submit(function(){
        var str = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "/include/ajax/order_status.php",
            data: str,
            success: function(html){
                $('#order_status').html(html);
                $('#captcha_word').val('');
                reloadCaptha()
            }
        });
        return false;
    });
    $(".upload_file_drop").change(function() {
        var name = document.getElementById('.upload_file_drop'); 
        $('.add_text_after').after(this.value.split('/').pop().split('\\').pop()+'<a href="javascript:void(0);" onclick="filedel()" style="color:black;margin-left:10px;">Удалить</a>');
        $('.add_text_after').css('margin-right','10px');
    });

    $(".pay input[type=checkbox]").on("click", function() {
        $(".pay input").removeAttr("checked");
        $(this).prop("checked", true);
    });

    $(".one_select input[type=checkbox]").on("click", function() {
        $(".one_select input").removeAttr("checked");
        $(this).prop("checked", true);
    });
    $(".one_select2 input[type=checkbox]").on("click", function() {
        $(".one_select2 input").removeAttr("checked");
        $(this).prop("checked", true);
    });

});
function filedel(){
    document.getElementById("upload_file_drop").value = "";
    $('.recovery_btn__load').html('<button class="personal_button personal_button__load add_text_after" onclick="$(\'input[name=upload_file]\').click();return false;" style="margin-right: 10px;">Загрузить файл</button>');
}

function validateForm(){
    var flagcheck = false;
    if($("#modal_reg-chbx-new").prop("checked")){
        flagcheck=true;
    }else{
        flagcheck=false;
    }
    if(flagcheck){
        $(".personal_button__registration").removeAttr('disabled');
    }else{
        $(".personal_button__registration").attr('disabled','disabled');
    }
}

function validateDropForm1(){
    var email = false;
    var comp_partn = false;
    var kont_partn = false;
    var phone_partn = false;

    if($('#your_email').val()!=""){
        $('input[name=email]').val($('#your_email').val());
        email=true;
    }else{
        $('input[name=email]').val($('#your_email').val());
        email=false;
    }

    if($('#comp_name').val()!=""){
        $('input[name=comp_partn]').val($('#comp_name').val());
        comp_partn=true;
    }else{
        $('input[name=comp_partn]').val($('#comp_name').val());
        comp_partn=false;
    }

    if($('#kont_partner').val()!=""){
        $('input[name=kont_partn]').val($('#kont_partner').val());
        kont_partn=true;
    }else{
        $('input[name=kont_partn]').val($('#kont_partner').val());
        kont_partn=false;
    }

    if($('#phone_partner').val()!=""){
        $('input[name=phone_partn]').val($('#phone_partner').val());
        phone_partn=true;
    }else{
        $('input[name=phone_partn]').val($('#phone_partner').val());
        phone_partn=false;
    }

    if(email && comp_partn && kont_partn && phone_partn){
        $(".personal_button__recovery1").removeAttr('disabled');
    }else{
        $(".personal_button__recovery1").attr('disabled','disabled');
    }
}

function validateDropForm2(){
    var zakaz_cl = false;
    var price_pr = false;
    var name_cl = false;
    var phone_cl = false;
    var address_deliv = false;

    if($('#client_zakaz').val()!=""){
        $('input[name=zakaz_client]').val($('#client_zakaz').val());
        zakaz_cl=true;
    }else{
        $('input[name=zakaz_client]').val($('#client_zakaz').val());
        zakaz_cl=false;
    }

    if($('#price_prod').val()!=""){
        $('input[name=price_prod]').val($('#price_prod').val());
        price_pr=true;
    }else{
        $('input[name=price_prod]').val($('#price_prod').val());
        price_pr=false;
    }

    if($('#name_klient').val()!=""){
        $('input[name=name_client]').val($('#name_klient').val());
        name_cl=true;
    }else{
        $('input[name=name_client]').val($('#name_klient').val());
        name_cl=false;
    }

    if($('#phone_klient').val()!=""){
        $('input[name=phone_client]').val($('#phone_klient').val());
        phone_cl=true;
    }else{
        $('input[name=phone_client]').val($('#phone_klient').val());
        phone_cl=false;
    }

    if($('#address_dost').val()!=""){
        $('input[name=address_client]').val($('#address_dost').val());
        address_deliv=true;
    }else{
        $('input[name=address_client]').val($('#address_dost').val());
        address_deliv=false;
    }


    if(zakaz_cl && price_pr && name_cl && phone_cl && address_deliv){
        $(".personal_button__recovery2").removeAttr('disabled');
    }else{
        $(".personal_button__recovery2").attr('disabled','disabled');
    }
}

function validateDropForm3(){
    var date = false;

    if($('#drop_date').val()!=""){
        //$('input[name=zakaz_client]').val($('#client_zakaz').val());
        date=true;
    }else{
        //$('input[name=zakaz_client]').val($('#client_zakaz').val());
        date=false;
    }

    if(date){
        $(".personal_button__recovery3").removeAttr('disabled');
    }else{
        $(".personal_button__recovery3").attr('disabled','disabled');
    }
}



function validateDemoForm1(){
    var email = false;
    var cont = false;
    var phone = false;
    var comp = false;

    if($('#email-demo').val()!=""){
        email=true;
    }else{
        email=false;
    }

    if($('#contacts-demo').val()!=""){
        cont=true;
    }else{
        cont=false;
    }

    if($('#phone-demo').val()!=""){
        phone=true;
    }else{
        phone=false;
    }

    if($('#company-demo').val()!=""){
        comp=true;
    }else{
        comp=false;
    }

    if(email && cont && phone && comp){
        $(".demo_button_validate1").removeAttr('disabled');
    }else{
        $(".demo_button_validate1").attr('disabled','disabled');
    }
}

function validateDemoForm2(){
    var modname = false;
    var modprice = false;
    var date = false;

    if($('#modname-demo').val()!=""){
        modname=true;
    }else{
        modname=false;
    }

    if($('#modprice-demo').val()!=""){
        modprice=true;
    }else{
        modprice=false;
    }

    if($('#date-demo').val()!=""){
        date=true;
    }else{
        date=false;
    }


    if(modname && modprice && date){
        $(".demo_button_validate2").removeAttr('disabled');
    }else{
        $(".demo_button_validate2").attr('disabled','disabled');
    }
}

function validateDemoForm3(){
    var clname = false;
    var clphone = false;
    var comment = false;

    if($('#clname-demo').val()!=""){
        clname=true;
    }else{
        clname=false;
    }

    if($('#clphone-demo').val()!=""){
        clphone=true;
    }else{
        clphone=false;
    }

    if($('#comment-demo').val()!=""){
        comment=true;
    }else{
        comment=false;
    }


    if(clname && clphone && comment){
        $(".demo_button_validate3").removeAttr('disabled');
    }else{
        $(".demo_button_validate3").attr('disabled','disabled');
    }
}





function validateOrderForm1(){
    var email = false;
    var cont = false;
    var phone = false;
    var comp = false;

    if($('#email_order').val()!=""){
        email=true;
    }else{
        email=false;
    }

    if($('#contacts_order').val()!=""){
        cont=true;
    }else{
        cont=false;
    }

    if($('#phone_order').val()!=""){
        phone=true;
    }else{
        phone=false;
    }

    if($('#company_order').val()!=""){
        comp=true;
    }else{
        comp=false;
    }

    if(email && cont && phone && comp){
        $(".order_button_validate1").removeAttr('disabled');
    }else{
        $(".order_button_validate1").attr('disabled','disabled');
    }
}

function validateOrderForm2(){
    var prod1 = false;


    if($('#prod1_order').val()!=""){
        prod1=true;
    }else{
        prod1=false;
    }

    if(prod1){
        $(".order_button_validate2").removeAttr('disabled');
    }else{
        $(".order_button_validate2").attr('disabled','disabled');
    }
}

function validateOrderForm3(){
    var date = false;

    if($('#date_order').val()!=""){
        date=true;
    }else{
        date=false;
    }

    if(date){
        $(".order_button_validate3").removeAttr('disabled');
    }else{
        $(".order_button_validate3").attr('disabled','disabled');
    }
}


$(document).on('click','.minus_order',function () {
    var $input = $(this).parent().find('input');
    var count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);
    $input.change();
    return false;
});
$(document).on('click','.plus_order',function () {
    var $input = $(this).parent().find('input');
    var quantity = parseInt($input.val());
    $input.val(quantity+1).change();
    return false;
});