<?require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("iblock");
CModule::IncludeModule("form");

$el = new CIBlockElement;

$arIBlockProps = array(
    'NAME' => $_POST['NAME'],
    'PHONE' => $_POST['PHONE'],
	'DOP_SVAZ' => $_POST['DOP_SVAZ']
);

/*$res = CIBlockElement::GetByID($_POST['ID']);
if($ar_res = $res->GetNext()) {*/
    $arValues = array (
        "form_text_241" => $_POST['NAME'],
        "form_text_242" => $_POST['PHONE'],
		"form_text_244" => $_POST['DOP_SVAZ']
    );

    if ($RESULT_ID = CFormResult::Add(16, $arValues))
    {
        $arEventFields = array(
            "NAME" => $_POST['NAME'],
            "PHONE" => $_POST['PHONE'],
			"DOP_SVAZ" => $_POST['DOP_SVAZ']
        );



        //roistat start\

        $comment = '';	
        $comment .= 'Имя: ' . $_POST['NAME'] . PHP_EOL;
        $comment .= 'Телефон: ' . $_POST['PHONE'] . PHP_EOL;
		$comment .= 'Дополнительные средства связи: ' . $_POST['DOP_SVAZ'] . PHP_EOL;

        $roistatData = array(
            'roistat' =>'ВРЕМЯ ДЕЛАТЬ ПОДАРКИ (Массажеры ног)',
            'key'     => 'OTkwNjQ6NzM4MTc6NTQ1MjQ4MGMyMTFjNWIzZjQyMDUyZjE0OWIwYTFjZjM=', // Ключ для интеграции с CRM, указывается в настройках интеграции с CRM.
            'title'   => 'ВРЕМЯ ДЕЛАТЬ ПОДАРКИ (Массажеры ног)',
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

?>