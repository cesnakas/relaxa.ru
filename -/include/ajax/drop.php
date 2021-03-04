<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(
    !empty($_POST['email'])&&isset($_POST['email'])&&
    !empty($_POST['comp_partn'])&&isset($_POST['comp_partn'])&&
    !empty($_POST['kont_partn'])&&isset($_POST['kont_partn'])&&
    !empty($_POST['phone_partn'])&&isset($_POST['phone_partn'])&&
    !empty($_POST['zakaz_client'])&&isset($_POST['zakaz_client'])&&
    !empty($_POST['price_prod'])&&isset($_POST['price_prod'])&&
    !empty($_POST['name_client'])&&isset($_POST['name_client'])&&
    !empty($_POST['phone_client'])&&isset($_POST['phone_client'])&&
    !empty($_POST['address_client'])&&isset($_POST['address_client'])&&
    !empty($_POST['oplata'])&&isset($_POST['oplata'])&&
    !empty($_POST['date'])&&isset($_POST['date'])
  ){


    CModule::IncludeModule('iblock'); 
    $el = new CIBlockElement;

    $PROP = array();
    $PROP['EMAIL'] = $_POST["email"];
    $PROP['COMP_PARTN'] = $_POST["comp_partn"];
    $PROP['KONT_PARTN'] = $_POST["kont_partn"];
    $PROP['PHONE_PARTN'] = $_POST["phone_partn"];
    $PROP['ZAKAZ_CLIENT'] = $_POST["zakaz_client"];
    $PROP['PRICE_PROD'] = $_POST["price_prod"];
    $PROP['NAME_CLIENT'] = $_POST["name_client"];
    $PROP['PHONE_CLIENT'] = $_POST["phone_client"];
    $PROP['ADDRESS_CLIENT'] = $_POST["address_client"];
    $PROP['OPLATA'] = $_POST["oplata"];
    $PROP['DATE'] = $_POST["date"];
    $PROP['TIME'] = $_POST["time"];

    if($_FILES['upload_file']){ //echo "<pre>"; var_dump($_FILES);
        $fid =  CFile::SaveFile($_FILES['upload_file'], "drop");
        $PROP['FILE'] = $fid; //echo $fid;
    }

    $arLoadProductArray = Array(
      "IBLOCK_ID"      => 39,            //id нужного инфоблока
      "PROPERTY_VALUES"=> $PROP,        //массив свойств
      "NAME"           => 'Сообщение от '.date('d.m.Y H:i:s'), //название элемента
      "ACTIVE"         => "Y",          //активность элемента
      "PREVIEW_TEXT"   => $_POST['comment']
    );

    $PRODUCT_ID = $el->Add($arLoadProductArray);

    $arEventFields= array(
        "EMAIL" => $_POST["email"],
        "COMP_PARTN" => $_POST["comp_partn"],
        "KONT_PARTN" => $_POST["kont_partn"],
        "PHONE_PARTN" => $_POST["phone_partn"],
        "ZAKAZ_CLIENT" => $_POST["zakaz_client"],
        "PRICE_PROD" => $_POST["price_prod"],
        "NAME_CLIENT" => $_POST["name_client"],
        "PHONE_CLIENT" => $_POST["phone_client"],
        "ADDRESS_CLIENT" => $_POST["address_client"],
        "OPLATA" => $_POST["oplata"],
        "DATE" => $_POST["date"],
        "TIME" => $_POST["time"],
        "COMMENT" => $_POST["comment"],
        //"FILE" => 'http://'.$_SERVER['HTTP_HOST'].CFile::GetPath($fid)
    );
    if($fid>0){
        $arEventFields["FILE"]='http://'.$_SERVER['HTTP_HOST'].CFile::GetPath($fid);
    }


    //roistat start\

    $commet = '';
    $commet .= 'Адрес электронной почты: ' . $_POST['email'] . PHP_EOL;
    $commet .= 'Компания партнера: ' . $_POST['comp_partn'] . PHP_EOL;
    $commet .= 'Контактное лицо партнера: ' . $_POST['kont_partn'] . PHP_EOL;
    $commet .= 'Телефон для связи партнера: ' . $_POST['phone_partn'] . PHP_EOL;
    $commet .= 'Что хочет заказать клиент?: ' . $_POST['zakaz_client'] . PHP_EOL;
    $commet .= 'Цена товара?: ' . $_POST['price_prod'] . PHP_EOL;
    $commet .= 'Адрес доставки: ' . $_POST['address_client'] . PHP_EOL;
    $commet .= 'Вид оплаты: ' . $_POST['oplata'] . PHP_EOL;
    $commet .= 'Дата доставки: ' . $_POST['date'] . PHP_EOL;
    $commet .= 'Время доставки: ' . $_POST['time'] . PHP_EOL;
    $commet .= 'Вопросы и комментарии: ' . $_POST['comment'] . PHP_EOL;
    $commet .= 'Файл: ' .  $arEventFields["FILE"] . PHP_EOL;

    $roistatData = array(
//        'roistat' => isset($_COOKIE['roistat_visit']) ? $_COOKIE['roistat_visit'] : null,
        'roistat' =>'Заказ дропшиппинг',
        'key'     => 'OTkwNjQ6NzM4MTc6NTQ1MjQ4MGMyMTFjNWIzZjQyMDUyZjE0OWIwYTFjZjM=', // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
        'title'   => 'Заказ дропшиппинг',
        'name'   => $_POST['name_client'],
        'phone' => $_POST["phone_client"],
        'comment' =>$commet,
        'fields'  => array(
            'UF_CRM_1575469387' =>  $_POST['comp_partn'] ,
            'UF_CRM_1521456234' =>  $_POST['address_client'] ,
            'UF_CRM_1563359438' => '{landingPage}',
            'UF_CRM_1575469348' => '{source}',
            'UF_CRM_1521456176' => '{city}',
            'UF_CRM_1563359383' => '{referrer}',
            'UF_CRM_1521451780' => 'Заказ дропшиппинг',
        )
    );

    echo  file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
    //roistat end


    CEvent::Send("REQUESTS", SITE_ID, $arEventFields, "N", 73);
    CEvent::Send("REQUESTS", SITE_ID, $arEventFields, "N", 74);
    
    //LocalRedirect($_POST['curpage'].'?success=drop');
    session_start();
    //setcookie("success", "demo", time()+3600);
    $_SESSION['FORM_MODAL'][$_SESSION['SESS_AUTH']['USER_ID']] = 'drop';
    LocalRedirect($_POST['curpage']);

    /*unset($_POST["phone"]);
    unset($_POST["name"]);*/
}
else{

    LocalRedirect($_POST['curpage'].'?success=n');

}
?>
