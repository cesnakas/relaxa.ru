$(document).ready(function(){

  //Запрос индивидуальной экспедиции
  $("#cheaper_form").submit(function(){
   
    var formFields = $(this).serialize();
    $(".error-msg").html('');
  
    //Проверка на наличие телефона
    if($("#cheaper_form_name").val() == '') {
      $(".error-msg").prepend("Введите имя!");
      return false;
    }
   
    if($("#phone_number").val() == '') {
      $(".error-msg").prepend("Введите телефон!");
      return false;
    }

    if(!$('#cb1').prop('checked')) {
      $(".error-msg").prepend("Согласие на обработку персональных данных обязательно!");
      return false;
    }

    var okmess = "<div class='title'><h2 class='title_h2' style='text-align: center;'>Ваша заявка принята</h2></div><div class='recovery_main'><p class='recovery_p' style='text-align: center;margin: 35px 0 45px;'>Спасибо. Ваша заявка принята и передана в обработку.<br>Копии ответов будут отправлены на указанный Вами адрес.</p></div><div class='bottom-close-btn'><a href='#' onclick='$(\".fancybox-close-small\").trigger(\"click\");' class='bottom-close-btn__link'>Закрыть</a></div>";
         
    $.ajax({
      url: "/ajax/naslDesh.php",
      type: "POST",
      typeData: "json",
      data: formFields,
      success: function(res){
        if(res === 'captcha_error') {
          $(".error-msg").prepend("Пройдите каптчу!");
        } else {
          $("#cheaper_form_name").val('');
          $("#phone_number").val('');
          $("#cheaper_form_email").val('');
          $("#cheaper_form_text").val('');
          $("#cb1").prop('checked', false);
          $(".error-msg").prepend(res);
          $('#nasl-desh .c-modal__wrapper').html(okmess);
        }
      },
      error: function(jqXHR, exception){
        if (jqXHR.status === 0) {
        alert('НЕ подключен к интернету!');
        } else if (jqXHR.status == 404) {
        alert('НЕ найдена страница запроса [404])');
        } else if (jqXHR.status == 500) {
        alert('НЕ найден домен в запросе [500].');
        } else if (exception === 'parsererror') {
        alert("Ошибка в коде: \n"+jqXHR.responseText);
        } else if (exception === 'timeout') {
        alert('Не ответил на запрос.');
        } else if (exception === 'abort') {
        alert('Прерван запрос Ajax.');
        } else {
        alert('Неизвестная ошибка:\n' + jqXHR.responseText);
        }
      }

    });
    
    return false;
  });

  //Заявка на трейд-ин
  $("#trade_in_form").submit(function(){
   
    var formFields = $(this).serialize();
    $(".error-msg").html('');
  
    //Проверка на наличие телефона
    if($("#trade_in_name").val() == '') {
      $(".error-msg").prepend("Введите имя!");
      return false;
    }
   
    if($("#trade_in_phone").val() == '') {
      $(".error-msg").prepend("Введите телефон!");
      return false;
    }

    if(!$('#cb2').prop('checked')) {
      $(".error-msg").prepend("Согласие на обработку персональных данных обязательно!");
      return false;
    }

      var okmess = "<div class='title'><h2 class='title_h2' style='text-align: center;'>Ваша заявка принята</h2></div><div class='recovery_main'><p class='recovery_p' style='text-align: center;margin: 35px 0 45px;'>Спасибо. Ваша заявка принята и передана в обработку.<br>Копии ответов будут отправлены на указанный Вами адрес.</p></div><div class='bottom-close-btn'><a href='#' onclick='$(\".fancybox-close-small\").trigger(\"click\");' class='bottom-close-btn__link'>Закрыть</a></div>";

    $.ajax({
      url: "/ajax/tradeIn.php",
      type: "POST",
      typeData: "json",
      data: formFields,
      success: function(res){
        if(res === 'captcha_error') {
          $(".error-msg").prepend("Пройдите каптчу!");
        } else {
          $("#trade_in_name").val('');
          $("#trade_in_phone").val('');
          $("#trade_in_email").val('');
          $("#trade_in_text").val('');
          $("#cb2").prop('checked', false);
          $(".error-msg").prepend(res);
            $('#sdai-star-pol-nov .c-modal__wrapper').html(okmess);
        }  
      },
      error: function(jqXHR, exception){
        if (jqXHR.status === 0) {
        alert('НЕ подключен к интернету!');
        } else if (jqXHR.status == 404) {
        alert('НЕ найдена страница запроса [404])');
        } else if (jqXHR.status == 500) {
        alert('НЕ найден домен в запросе [500].');
        } else if (exception === 'parsererror') {
        alert("Ошибка в коде: \n"+jqXHR.responseText);
        } else if (exception === 'timeout') {
        alert('Не ответил на запрос.');
        } else if (exception === 'abort') {
        alert('Прерван запрос Ajax.');
        } else {
        alert('Неизвестная ошибка:\n' + jqXHR.responseText);
        }
      }

    });
    
    return false;
  });

});