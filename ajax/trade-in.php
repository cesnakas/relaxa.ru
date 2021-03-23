<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("form");

$el = new CIBlockElement;

$arIBlockProps = array(
    'PROD' => $_POST['ID'],
    'NAME' => $_POST['NAME'],
    'PHONE' => $_POST['PHONE']
);

$res = CIBlockElement::GetByID($_POST['ID']);
if($ar_res = $res->GetNext()) {
    $arValues = array (
        "form_text_240" => $ar_res['NAME'],
        "form_text_241" => $_POST['NAME'],
        "form_text_242" => $_POST['PHONE']
    );

    if ($RESULT_ID = CFormResult::Add(13, $arValues))
    {
        $arEventFields = array(
            "PROD" => $ar_res['NAME'],
            "LINK" => $_SERVER["SERVER_NAME"] . $ar_res['DETAIL_PAGE_URL'],
            "NAME" => $_POST['NAME'],
            "PHONE" => $_POST['PHONE']
        );

        //roistat start\

        $comment = '';
        $comment .= 'Ссылка на товар: ' . $_SERVER["SERVER_NAME"] . $ar_res['DETAIL_PAGE_URL'] . PHP_EOL;
        $comment .= 'Товар: ' . $ar_res['NAME'] . PHP_EOL;		
        $comment .= 'Имя: ' . $_POST['NAME'] . PHP_EOL;
        $comment .= 'Телефон: ' . $_POST['PHONE'] . PHP_EOL;

        $roistatData = array(
            'roistat' =>'Trade In',
            'key'     => 'OTkwNjQ6NzM4MTc6NTQ1MjQ4MGMyMTFjNWIzZjQyMDUyZjE0OWIwYTFjZjM=', // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
            'title'   => 'Trade In',
            'name'   => $_POST['NAME'],
            'phone' => $_POST["PHONE"],
            'comment' =>$comment,
            'fields'  => array(
            )
        );

        echo  file_get_contents("https://cloud.roistat.com/api/proxy/1.0/leads/add?" . http_build_query($roistatData));
        //roistat end

    }
    else
    {
        global $strError;
        echo $strError;
    }
}
?>