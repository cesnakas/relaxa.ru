<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(
    !empty($_POST['email-demo'])&&isset($_POST['email-demo'])&&
    !empty($_POST['contacts-demo'])&&isset($_POST['contacts-demo'])&&
    !empty($_POST['phone-demo'])&&isset($_POST['phone-demo'])&&
    !empty($_POST['company-demo'])&&isset($_POST['company-demo'])&&
    !empty($_POST['name-obor1'])&&isset($_POST['name-obor1'])&&
    !empty($_POST['price-obor1'])&&isset($_POST['price-obor1'])&&
    !empty($_POST['date'])&&isset($_POST['date'])&&
    !empty($_POST['client-name'])&&isset($_POST['client-name'])&&
    !empty($_POST['client-phone'])&&isset($_POST['client-phone'])&&
    !empty($_POST['comment'])&&isset($_POST['comment'])
  ){

    //roistat start

    $text = '';
    $text .= 'Оборудование для теста 1: '.$_POST["name-obor1"].PHP_EOL;
    $text .= 'Цена: '.$_POST["price-obor1"].PHP_EOL;
    if(!empty($_POST["name-obor2"])){
        $text .= 'Оборудование для теста 2: '.$_POST["name-obor2"].PHP_EOL;
        $text .= 'Цена: '.$_POST["price-obor2"].PHP_EOL;
    }
    if(!empty($_POST["name-obor3"])){
        $text .= 'Оборудование для теста 3: '.$_POST["name-obor3"].PHP_EOL;
        $text .= 'Цена: '.$_POST["price-obor2"].PHP_EOL;
    }
    $commet = '';
    $commet .= 'Адрес электронной почты: '.$_POST['email-demo'].PHP_EOL;
    $commet .= 'Ваши контакты: '.$_POST['contacts-demo'].PHP_EOL;
    $commet .= 'Телефон для связи: '.$_POST['phone-demo'].PHP_EOL;
    $commet .= 'Ваша компания: '.$_POST['company-demo'].PHP_EOL;
    $commet .= 'Дата визита: '.$_POST['date'].PHP_EOL;
    $commet .= 'Время визита: '.$_POST['time'].PHP_EOL;
    $commet .= $text.PHP_EOL;
    $commet .='Дополнительная информация: '.$_POST['comment'].PHP_EOL;


    $roistatData = array(
//        'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : null,
        'roistat' =>'Заявка на тест в демозал',
        'key'     => 'OTkwNjQ6NzM4MTc6NTQ1MjQ4MGMyMTFjNWIzZjQyMDUyZjE0OWIwYTFjZjM=', // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
        'title'   => 'Заявка на тест в демозал',
        'name'   => $_POST['client-name'],
        'phone' => $_POST["client-phone"],
        'comment' => $commet,
        'fields'  => array(
            'UF_CRM_1575469387' =>  $_POST['company-demo'] ,
            'UF_CRM_1563359438' => '{landingPage}',
            'UF_CRM_1575469348' => '{source}',
            'UF_CRM_1521456176' => '{city}',
            'UF_CRM_1563359383' => '{referrer}',
            'UF_CRM_1521451780' => 'Заявка на тест в демозал',
        )
    );

    file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));

    //roistat end



    CModule::IncludeModule('iblock'); 
    $el = new CIBlockElement;

    $PROP = array();
    $PROP['EMAIL'] = $_POST["email-demo"];
    $PROP['CONT'] = $_POST["contacts-demo"];
    $PROP['PHONE'] = $_POST["phone-demo"];
    $PROP['COMP'] = $_POST["company-demo"];
    $PROP['OBORUD1'] = $_POST["name-obor1"];
    $PROP['PRICE1'] = $_POST["price-obor1"];
    $PROP['OBORUD2'] = $_POST["name-obor2"];
    if($_POST["name-obor2"]!=""){
        $PROP['PRICE2'] = $_POST["price-obor2"];
    }
    if($_POST["name-obor3"]!=""){
        $PROP['PRICE3'] = $_POST["price-obor3"];
    }
    $PROP['DATEVISIT'] = $_POST["date"];
    $PROP['TIME'] = $_POST["time"];
    $PROP['NAMECL'] = $_POST["client-name"];
    $PROP['PHONECL'] = $_POST["client-phone"];
    $PROP['DOP'] = $_POST["comment"];

    $arLoadProductArray = Array(
      "IBLOCK_ID"      => 40,            //id нужного инфоблока
      "PROPERTY_VALUES"=> $PROP,        //массив свойств
      "NAME"           => 'Сообщение от '.date('d.m.Y H:i:s'), //название элемента
      "ACTIVE"         => "Y",          //активность элемента
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);

    $text = '';
    $text .= 'Оборудование для теста 1: '.$_POST["name-obor1"].'<br>'; 
    $text .= 'Цена: '.$_POST["price-obor1"].'<br>'; 
    if($_POST["name-obor2"]!=""){
        $text .= 'Оборудование для теста 2: '.$_POST["name-obor2"].'<br>'; 
        $text .= 'Цена: '.$_POST["price-obor2"].'<br>'; 
    }
    if($_POST["name-obor3"]!=""){
        $text .= 'Оборудование для теста 3: '.$_POST["name-obor3"].'<br>'; 
        $text .= 'Цена: '.$_POST["price-obor2"].'<br>'; 
    }

    $arEventFields= array(
        "EMAIL" => $_POST["email-demo"],
        "CONT" => $_POST["contacts-demo"],
        "PHONE" => $_POST["phone-demo"],
        "COMP" => $_POST["company-demo"],
        "OBOR1" => $_POST["name-obor1"],
        "PRICE1" => $_POST["price-obor1"],
        "OBOR2" => $_POST["name-obor2"],
        "PRICE2" => $_POST["price-obor2"],
        "OBOR3" => $_POST["name-obor3"],
        "PRICE3" => $_POST["price-obor3"],
        "DATE" => $_POST["date"],
        "TIME" => $_POST["time"],
        "NAMECL" => $_POST["client-name"],
        "PHONECL" => $_POST["client-phone"],
        "DOP" => $_POST["comment"],
        "TEXT" => $text
    );

    CEvent::Send("REQUESTS", SITE_ID, $arEventFields, "N", 75);
    CEvent::Send("REQUESTS", SITE_ID, $arEventFields, "N", 76);
    session_start();
    //setcookie("success", "demo", time()+3600);
    $_SESSION['FORM_MODAL'][$_SESSION['SESS_AUTH']['USER_ID']] = 'demo';
    LocalRedirect($_POST['curpage']);

    /*unset($_POST["phone"]);
    unset($_POST["name"]);*/
}
else{

    LocalRedirect($_POST['curpage'].'?success=n');

}
?>
