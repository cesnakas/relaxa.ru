<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if(isset($_POST['order'])&&!empty($_POST['order'])&&!empty($_POST['captcha_word'])&&isset($_POST['captcha_word'])&&!empty($_POST['phone'])&&isset($_POST['phone'])){


    if($APPLICATION->CaptchaCheckCode($_POST['captcha_word'], $_POST['captcha_code'])){

        CModule::IncludeModule('sale');

        if (!($arOrderMain = CSaleOrder::GetByID($_POST['order'])))
        {
$order = strip_tags($_POST['order']);
$order = htmlentities($order, ENT_QUOTES, "UTF-8");
$order = htmlspecialchars($order, ENT_QUOTES);
           echo "Заказ с кодом ".$order." не найден";
        }
        else
        {
            $arOrder = array();
            $arFilter = array("ORDER_ID"=>$order, "CODE"=>"PHONE");
            $arGroupBy = false;
            $arNavStartParams = false;
            $arSelectFields = array();
            $ord = CSaleOrderPropsValue::GetList($arOrder, $arFilter, $arGroupBy, $arNavStartParams,  $arSelectFields);
            if($order = $ord->Fetch()){
                //echo $order["VALUE"];
                if($order["VALUE"] == $_POST['phone']){
                    if ($arStatus = CSaleStatus::GetByID($arOrderMain["STATUS_ID"]))
                    {
                        echo 'Статус заказа № '.$order.' - '.$arStatus['NAME'];
                    }else{
                        echo 'Ошибка получения статуса.';
                    }
                }else{
                    echo "Неправильно указан номер телефона заказа.";
                }
                //echo 'Статус заказа с ID '.$order.' - '.$order["VALUE"];
            }
        }

    }else{
        echo "Код с картинки введен неверно.";
    }







    



    
     

    unset($_POST["phone"]);
    unset($_POST["captcha"]);
    unset($_POST["phone"]);
}
else{
    echo "Все поля обязательны к заполнению.";
}
?>