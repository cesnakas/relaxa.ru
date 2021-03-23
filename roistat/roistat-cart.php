<?php

$roistatData = array(
    'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : null,
    'key'     => 'OTkwNjQ6NzM4MTc6NTQ1MjQ4MGMyMTFjNWIzZjQyMDUyZjE0OWIwYTFjZjM=', // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
    'title'   => 'Заявка с (Корзины) oto-relax.ru',
    'name'   => $_POST['name'], 
    'phone' => $_POST['phone'],
    'email'   => $_POST['email'],
    'comment' => "Местоположение: ".$_POST["adress"]."\n Индекс:".$_POST["index"]."\n Доставка:".$_POST["dostavka2"]."\n Адрес доставки:".$_POST["adressdostavka"]."\n Оплата:".$_POST["oplata2"]."\n Комментарий:".$_POST["comment"],
    'is_need_callback' => '0', // После создания в Roistat заявки, Roistat инициирует обратный звонок на номер клиента, если значение параметра рано 1 и в Ловце лидов включен индикатор обратного звонка.
    'callback_phone' => '<Номер для переопределения>', // Переопределяет номер, указанный в настройках обратного звонка.
    'sync'    => '0', // 
    'is_need_check_order_in_processing' => '1', // Включение проверки заявок на дубли
    'is_need_check_order_in_processing_append' => '1', // Если создана дублирующая заявка, в нее будет добавлен комментарий об этом
    'fields'  => array(
        'UF_CRM_1524672576' => $_POST['oplata2'],
        'ADDRESS' => $_POST["adressdostavka"],
        'UF_CRM_1521451780' => 'Корзина oto-relax.ru',
        'UF_CRM_1524673207' => $_POST['dostavka2'],
        'SOURCE_ID' => 'Корзина oto-relax.ru'
    // Массив дополнительных полей. Если дополнительные поля не нужны, оставьте массив пустым.
    // Примеры дополнительных полей смотрите в таблице ниже.
    )
);

file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));

echo "Отправка в корзину";