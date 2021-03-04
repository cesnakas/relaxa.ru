<?php

// Константы файла
const FILE_KEY    = '2b69848e2e73097cae972600754d2bd5';

// Константы Roistat
const ROISTAT_KEY = 'M2FkNzFiODM5Y2ZlYTRjYThmMzViN2I0NTQ2MjI5Zjc6NzM4MTc=';

// Webhook данные
$data = $_GET;

// Проверка наличия данных
if($data['key'] != FILE_KEY || empty($data)) {
    die('Invalid key or no data');
}

// Необходимые данные
$visit         = isset($data['visit'])         ? $data['visit']         : null;
$title         = isset($data['title'])         ? $data['title']         : null;
$form          = isset($data['form'])          ? $data['form']          : null;
$name          = isset($data['name'])          ? $data['name']          : null;
$phone         = isset($data['phone'])         ? $data['phone']         : null;
$email         = isset($data['email'])         ? $data['email']         : null;
$comment       = isset($data['comment'])       ? $data['comment']       : null;
$price         = isset($data['price'])         ? $data['price']         : null;
$payment       = isset($data['payment'])       ? $data['payment']       : null;
$delivery      = isset($data['delivery'])      ? $data['delivery']      : null;
$basketComment = isset($data['basketComment']) ? $data['basketComment'] : null;
$basketAddress = isset($data['basketAddress']) ? $data['basketAddress'] : null;
$quiz          = isset($data['quiz'])          ? $data['quiz']          : null;

// Сборка данных
$roistatData = [
    'roistat' => $visit,
    'key'     => ROISTAT_KEY,
    'title'   => $title,
    'name'    => $name,
    'phone'   => $phone,
    'email'   => $email,
    'comment' => $comment,
    'fields'  => [
        'OPPORTUNITY'       => $price,
        'UF_CRM_1563359383' => '{referrer}',
        'UF_CRM_1563359438' => '{landingPage}',
        'UF_CRM_1563359495' => '{city}',
        'UF_CRM_1521451780' => $form,
        'UF_CRM_1563359584' => $delivery,
        'UF_CRM_1521456260' => $payment,
        'UF_CRM_1521456277' => $basketComment,
        'UF_CRM_1521456234' => $basketAddress,
        'UF_CRM_1563359532' => $quiz,
    ],
];

// Отправка данных
file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));