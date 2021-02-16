<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(
    !empty($_POST['email_order'])&&isset($_POST['email_order'])&&
    !empty($_POST['contacts_order'])&&isset($_POST['contacts_order'])&&
    !empty($_POST['phone_order'])&&isset($_POST['phone_order'])&&
    !empty($_POST['company_order'])&&isset($_POST['company_order'])
  ){


    //roistat start
    $text = ''. PHP_EOL;
    $text .= 'Что бы вы хотели заказать 1: '.$_POST["prod1_order"].PHP_EOL;
    $text .= 'Количество: '.$_POST["count1_order"].PHP_EOL;
    if(!empty($_POST["prod2_order"])){
        $text .= 'Что бы вы хотели заказать 2: '.$_POST["prod2_order"].PHP_EOL;
        $text .= 'Количество: '.$_POST["count2_order"].PHP_EOL;
    }
    if(!empty($_POST["prod3_order"])){
        $text .= 'Что бы вы хотели заказать 3: '.$_POST["prod3_order"].PHP_EOL;
        $text .= 'Количество: '.$_POST["count3_order"].PHP_EOL;
    }

    $commet = '';
    $commet .= 'Адрес электронной почты: ' . $_POST['email_order'] . PHP_EOL;
    $commet .= 'Контактное лицо: ' . $_POST['contacts_order'] . PHP_EOL;
    $commet .= 'Контактный номер телефона: ' . $_POST['phone_order'] . PHP_EOL;
    $commet .= 'Наименование Вашей компании: ' . $_POST['company_order'] . PHP_EOL;
    $commet .= $text. PHP_EOL;
    $commet .= 'Вид оплаты: ' . $_POST['oplata_order'] . PHP_EOL;
    $commet .= 'Дата отгрузки: ' . $_POST['date_order'] . PHP_EOL;
    $commet .= 'Способ доставки: ' . $_POST['dost_order'] . PHP_EOL;
    $commet .= 'Вопросы и комментарии: ' . $_POST['comment_order'] . PHP_EOL;

    $roistatData = array(
        //'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : null,
        'roistat' =>'Форма заказа товара',
        'key'     => 'OTkwNjQ6NzM4MTc6NTQ1MjQ4MGMyMTFjNWIzZjQyMDUyZjE0OWIwYTFjZjM=', // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
        'title'   => 'Форма заказа товара',
        'name'   => $_POST['contacts_order'],
        'phone' => $_POST["phone_order"],
        'email' => $_POST["email_order"],
        'comment' =>$commet,
        'fields'  => array(
            'UF_CRM_1575469387' =>  $_POST['company_order'] ,
            'UF_CRM_1524672576' =>  $_POST['oplata_order'] ,
            'UF_CRM_1524673207' =>  $_POST['dost_order'] ,
            'UF_CRM_1563359438' => '{landingPage}',
            'UF_CRM_1575469348' => '{source}',
            'UF_CRM_1521456176' => '{city}',
            'UF_CRM_1563359383' => '{referrer}',
            'UF_CRM_1521451780' => 'Форма заказа товара',
        )
    );

    file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));

    //roistat end


    CModule::IncludeModule('iblock'); 
    $el = new CIBlockElement;

    $PROP = array();
    $PROP['EMAIL'] = $_POST["email_order"];
    $PROP['CONTNAME'] = $_POST["contacts_order"];
    $PROP['CONTPHONE'] = $_POST["phone_order"];
    $PROP['COMPNAME'] = $_POST["company_order"];
    $PROP['PROD1'] = $_POST["prod1_order"];
    $PROP['COUNT1'] = $_POST["count1_order"];
    $PROP['PROD2'] = $_POST["prod2_order"];
    if($_POST["prod2_order"]!=""){
        $PROP['COUNT2'] = $_POST["count2_order"];
    }
    if($_POST["prod3_order"]!=""){
        $PROP['COUNT3'] = $_POST["count3_order"];
    }
    $PROP['OPL'] = $_POST["oplata_order"];
    $PROP['DATE'] = $_POST["date_order"];
    $PROP['DOST'] = $_POST["dost_order"];

    $arLoadProductArray = Array(
      "IBLOCK_ID"      => 41,            //id нужного инфоблока
      "PROPERTY_VALUES"=> $PROP,        //массив свойств
      "NAME"           => 'Сообщение от '.date('d.m.Y H:i:s'), //название элемента
      "ACTIVE"         => "Y",          //активность элемента
      "PREVIEW_TEXT"   => $_POST["comment_order"]
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);

    $text = '';
    $text .= 'Что бы вы хотели заказать 1: '.$_POST["prod1_order"].'<br>'; 
    $text .= 'Количество: '.$_POST["count1_order"].'<br>'; 
    if($_POST["prod2_order"]!=""){
        $text .= 'Что бы вы хотели заказать 2: '.$_POST["prod2_order"].'<br>'; 
        $text .= 'Количество: '.$_POST["count2_order"].'<br>'; 
    }
    if($_POST["prod3_order"]!=""){
        $text .= 'Что бы вы хотели заказать 3: '.$_POST["prod3_order"].'<br>'; 
        $text .= 'Количество: '.$_POST["count3_order"].'<br>'; 
    }


    $arEventFields= array(
        "EMAIL" => $_POST["email_order"],
        "NAME" => $_POST["contacts_order"],
        "PHONE" => $_POST["phone_order"],
        "COMPNAME" => $_POST["company_order"],
        "PROD1" => $_POST["prod1_order"],
        "COUNT1" => $_POST["count1_order"],
        "PROD2" => $_POST["prod2_order"],
        "COUNT2" => $_POST["count2_order"],
        "PROD3" => $_POST["prod3_order"],
        "COUNT3" => $_POST["count3_order"],
        "OPL" => $_POST["oplata_order"],
        "DATE" => $_POST["date_order"],
        "DOST" => $_POST["dost_order"],
        "COMMENT" => $_POST["comment_order"],
        "TEXT" => $text
    );

    CEvent::Send("REQUESTS", SITE_ID, $arEventFields, "N", 77);
    CEvent::Send("REQUESTS", SITE_ID, $arEventFields, "N", 78);
    
    //LocalRedirect($_POST['curpage'].'?success=order');
    session_start();
    //setcookie("success", "demo", time()+3600);
    $_SESSION['FORM_MODAL'][$_SESSION['SESS_AUTH']['USER_ID']] = 'order';
    LocalRedirect($_POST['curpage']);

    /*unset($_POST["phone"]);
    unset($_POST["name"]);*/
}
else{

    LocalRedirect($_POST['curpage'].'?success=n');

}
?>
