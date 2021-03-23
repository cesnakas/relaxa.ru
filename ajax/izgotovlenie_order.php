<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");

global $arSite;
global $Message;

if($_POST['TYPEO'] == 'Свой вариант') {
    $TYPEO = $_POST['TYPEO_TEXT'];
} else {
    $TYPEO = $_POST['TYPEO'];
}
if($_POST['TYPEC'] == 'Свой вариант') {
    $TYPEC = $_POST['TYPEC_TEXT'];
} else {
    $TYPEC = $_POST['TYPEC'];
}

if($_POST['TYPEP'] == 'Свой вариант') {
    $TYPEP = $_POST['TYPEP_TEXT'];
} else {
    $TYPEP = $_POST['TYPEP'];
}

if($_POST['TYPEM'] == 'Свой вариант') {
    $TYPEM = $_POST['TYPEM_TEXT'];
} else {
    $TYPEM = $_POST['TYPEM'];
}

if($_POST['TYPEOP'] == 'Свой вариант') {
    $TYPEOP = $_POST['TYPEOP_TEXT'];
} else {
    $TYPEOP = $_POST['TYPEOP'];
}
if($_POST['TYPEPOD'] == 'Свой вариант') {
    $TYPEPOD = $_POST['TYPEPOD_TEXT'];
} else {
    $TYPEPOD = $_POST['TYPEPOD'];
}
if($_POST['TYPEAC'] == 'Свой вариант') {
    $TYPEAC = $_POST['TYPEAC_TEXT'];
} else {
    $TYPEAC = $_POST['TYPEAC'];
}


$arForm = array(
    'PROD' => $_POST['PROD'], // товар
    'TYPEO' => $TYPEO, // тип обивки
    'TYPEC' => $TYPEC, // цвет обивки
    'TYPEP' => $TYPEP, //тип покрытия
    'TYPEM' => $TYPEM, // мех. раскачивания
    'TYPEOP' => $TYPEOP, // тип опоры
    'TYPEPOD' => $TYPEPOD, // подлокотники
    'TYPEAC' => $TYPEAC, // аксесуары
    'TREB' => $_POST['TREB'],
    'NAME' => $_POST['NAME'],
    'PHONE' => $_POST['PHONE'],
    'EMAIL' => $_POST['EMAIL'],
    'SOGL' => $_POST['SOGL'],
);

$el = new CIBlockElement;

$arLoadProductArray = Array(
    "MODIFIED_BY"    => $USER->GetID(),
    "IBLOCK_SECTION_ID" => false,
    "IBLOCK_ID"      => 43,
    "PROPERTY_VALUES"=> $arForm,
    "NAME"           => $_POST['NAME'],
    "ACTIVE"         => "Y",
);

if($PRODUCT_ID = $el->Add($arLoadProductArray)) {

    $Message = array(
        'PROD' => $_POST['PROD'], // товар
        'TYPEO' => $TYPEO, // тип обивки
        'TYPEC' => $TYPEC, // цвет обивки
        'TYPEP' => $TYPEP, //тип покрытия
        'TYPEM' => $TYPEM, // мех. раскачивания
        'TYPEOP' => $TYPEOP, // тип опоры
        'TYPEPOD' => $TYPEPOD, // подлокотники
        'TYPEAC' => $TYPEAC, // аксесуары

        'NAME' => $_POST['NAME'],
        'PHONE' => $_POST['PHONE'],
        'EMAIL' => $_POST['EMAIL'],
        'SOGL' => $_POST['SOGL'],
    );

    $rsSites = CSite::GetByID(SITE_ID);
    $arSite = $rsSites->Fetch();

    $res = CIBlockElement::GetByID($Message['PROD']);
    if($ar_res = $res->GetNext()) {
        $Message['PROD'] = $ar_res['NAME'];
    }

    $MessageVal = array();
    $arMessMessageSt = PHP_EOL;
    /*Тип обивки*/
    if(!empty($Message['TYPEO'])) {

        if($_POST['TYPEO'] == 'Свой вариант') {
            $arMessMessageSt .= "Тип обивки: " . $_POST['TYPEO_TEXT'] . PHP_EOL;
        } else {
            $resTYPEO = CIBlockElement::GetByID($Message['TYPEO']);
            if($ar_resTYPEO = $resTYPEO->GetNext()) {
                $MessageVal['TYPEO'] = $ar_resTYPEO['NAME'];
                $arMessMessageSt .= "Тип обивки: " . $ar_resTYPEO['NAME'] . PHP_EOL;
            }
        }

    }
    /*Цвет обивки*/
    if(!empty($Message['TYPEC'])) {

        if($_POST['TYPEC'] == 'Свой вариант') {
            $arMessMessageSt .= "Цвет обивки: " . $_POST['TYPEC_TEXT'] . PHP_EOL;
        } else {
            $resTYPEC = CIBlockElement::GetByID($Message['TYPEC']);
            if($ar_resTYPEC = $resTYPEC->GetNext()) {
                $MessageVal['TYPEC'] = $ar_resTYPEC['NAME'];
                $arMessMessageSt .= "Цвет обивки: " . $ar_resTYPEC['NAME'] . PHP_EOL;
            }
        }
    }
    /*Тип покрытия*/
    if(!empty($Message['TYPEP'])) {

        if($_POST['TYPEP'] == 'Свой вариант') {
            $arMessMessageSt .= "Тип покрытия: " . $_POST['TYPEP_TEXT'] . PHP_EOL;
        } else {
            $resTYPEP = CIBlockElement::GetByID($Message['TYPEP']);
            if ($ar_resTYPEP = $resTYPEP->GetNext()) {
                $MessageVal['TYPEP'] = $ar_resTYPEP['NAME'];
                $arMessMessageSt .= "Тип покрытия: " . $ar_resTYPEP['NAME'] . PHP_EOL;
            }
        }

    }
    /*Мех. раскачивания*/
    if(!empty($Message['TYPEM'])) {

        if($_POST['TYPEM'] == 'Свой вариант') {
            $arMessMessageSt .= "Мех. раскачивания: " . $_POST['TYPEM_TEXT'] . PHP_EOL;
        } else {
            $resTYPEM = CIBlockElement::GetByID($Message['TYPEM']);
            if ($ar_resTYPEM = $resTYPEM->GetNext()) {
                $MessageVal['TYPEM'] = $ar_resTYPEM['NAME'];
                $arMessMessageSt .= "Мех. раскачивания: " . $ar_resTYPEM['NAME'] . PHP_EOL;
            }
        }
    }
    /*Тип опоры*/
    if(!empty($Message['TYPEOP'])) {

        if($_POST['TYPEOP'] == 'Свой вариант') {
            $arMessMessageSt .= "Тип опоры: " . $_POST['TYPEOP_TEXT'] . PHP_EOL;
        } else {
            $resTYPEOP = CIBlockElement::GetByID($Message['TYPEOP']);
            if ($ar_resTYPEOP = $resTYPEOP->GetNext()) {
                $MessageVal['TYPEOP'] = $ar_resTYPEOP['NAME'];
                $arMessMessageSt .= "Тип опоры: " . $ar_resTYPEOP['NAME'] . PHP_EOL;
            }
        }
    }
    /*Подлокотники*/
    if(!empty($Message['TYPEPOD'])) {

        if($_POST['TYPEPOD'] == 'Свой вариант') {
            $arMessMessageSt .= "Подлокотники: " . $_POST['TYPEPOD_TEXT'] . PHP_EOL;
        } else {
            $resTYPEPOD = CIBlockElement::GetByID($Message['TYPEPOD']);
            if ($ar_resTYPEPOD = $resTYPEPOD->GetNext()) {
                $MessageVal['TYPEPOD'] = $ar_resTYPEPOD['NAME'];
                $arMessMessageSt .= "Подлокотники: " . $ar_resTYPEPOD['NAME'] . PHP_EOL;
            }
        }
    }
    /*Аксесуары*/
    if(!empty($Message['TYPEAC'])) {

        if($_POST['TYPEAC'] == 'Свой вариант') {
            $arMessMessageSt .= "Аксесуары: " . $_POST['TYPEAC_TEXT'] . PHP_EOL;
        } else {
            $resTYPEAC = CIBlockElement::GetByID($Message['TYPEAC']);
            if ($ar_resTYPEAC = $resTYPEAC->GetNext()) {
                $MessageVal['TYPEAC'] = $ar_resTYPEAC['NAME'];
                $arMessMessageSt .= "Аксесуары: " . $ar_resTYPEAC['NAME'] . PHP_EOL;
            }
        }
    }

    $to = $arSite['EMAIL']; // Почта клиента $arSite['EMAIL']
    $subject = 'На сайте ' . $arSite['SITE_NAME'] . ' была оформлена заявка "Изготовление на заказ"';
    $charset = "utf-8";
    $headerss ="Content-type: text/html; charset=$charset\r\n";
    $headerss.="MIME-Version: 1.0\r\n";
    $headerss.="Date: ".date('D, d M Y h:i:s O')."\r\n";
    $msg = 'Товар: ' . $Message['PROD']
        . '<br> ' . $arMessMessageSt
        . '<br>Дополнительные требования к заказу: ' . $arForm['TREB']
        . '<br><br>Имя: ' . $Message['NAME']
        . '<br>Телефон: ' . $Message['PHONE']
        . '<br>Email: ' . $Message['EMAIL'];
    mail($to, $subject, $msg, $headerss);
	
	
//roistat start\

        $comment = '';
        $comment .= 'Ссылка на товар: ' . $_SERVER["SERVER_NAME"] . $ar_res['DETAIL_PAGE_URL'] . PHP_EOL . PHP_EOL;
        $comment .= 'Товар: ' . $ar_res['NAME'] . PHP_EOL . PHP_EOL . $arMessMessageSt . PHP_EOL . PHP_EOL ;
        $comment .= 'Дополнительные требования: ' . $arForm['TREB'] . PHP_EOL . PHP_EOL;		
        $comment .= 'Имя: ' . $_POST['NAME'] . PHP_EOL . PHP_EOL;
        $comment .= 'Телефон: ' . $_POST['PHONE'] . PHP_EOL . PHP_EOL;
        $comment .= 'e-mail: ' . $_POST['EMAIL'] . PHP_EOL;

        $roistatData = array(
            'roistat' =>'Изготовление на заказ',
            'key'     => 'OTkwNjQ6NzM4MTc6NTQ1MjQ4MGMyMTFjNWIzZjQyMDUyZjE0OWIwYTFjZjM=', // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
            'title'   => 'Изготовление на заказ',
            'name'   => $_POST['NAME'],
            'phone' => $_POST["PHONE"],
			'email'   => $_POST["EMAIL"],
            'comment' =>$comment,
            'fields'  => array(
            )
        );

        echo  file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
		
//roistat end
}