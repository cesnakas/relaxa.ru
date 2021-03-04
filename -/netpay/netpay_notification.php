<?php 
/**
 * Notification Net Pay v2.4
 * With Hold operations, All notify types
 * Name of module "netpay.sale" can not change!
*/
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule("sale");
CModule::IncludeModule("netpay.sale");

$dbPayList = CSalePaySystemAction::GetList(
	array(), array(), false, false, array('ID', 'ACTION_FILE', 'PARAMS', 'ENCODING')
	);
$paysystem_id = null;
while ($arPaysystem = $dbPayList->Fetch()) {
	if (strpos($arPaysystem['ACTION_FILE'], 'netpay.sale') !== false) {
		$paysystem_id = $arPaysystem['ID'];
		$paysystem_params = unserialize($arPaysystem['PARAMS']);
		break;
	}
}

if (!is_null($paysystem_id)) {
	$is_testmode = (trim($paysystem_params['TEST']['VALUE']) != '0');
	if ($is_testmode) {
		$auth = 1;
	    $api_key = 'js4cucpn4kkc6jl1p95np054g2';
	} else {
		$auth = $paysystem_params['AUTHSIGN']['VALUE'];
	    $api_key = $paysystem_params['APIKEY']['VALUE'];
	}
	
	//$getData = array_map('urldecode', $_GET);	
	$getData = $_GET;	
	$preToken = '';
	foreach ($getData as $k => $v)
	    if ($k !== 'token') $preToken .= $v . ';';	
	$token = md5($preToken . base64_encode(md5($api_key, true)) . ';');
	
	if ($getData['auth'] == $auth) {
	    if ($token === urldecode($getData['token'])) {
	        if (in_array($getData['error'], array('000', '0'))) {
				$order_id = $getData['orderID'];				
				if ($is_testmode) {
					$order_id = str_replace('_TEST_'.$_SERVER['HTTP_HOST'], '', $getData['orderID']);
				}
				if (isset($getData['orderNumber'])) {
					$order_id = $getData['orderNumber'];
					$arOrder = CSaleOrder::GetByID($order_id);
				}
				else {
					$arOrder = CSaleOrder::GetList(array(),array("ACCOUNT_NUMBER"=>intval($order_id)))
						->arResult[0];
					$order_id = $arOrder['ID'];
				}
				$is_payed = ($arOrder['PAYED'] == 'Y');
        		$error = '';
				$status = $getData['status'];
				$trans_type = $getData['transactionType'];
	        	if ($status === 'APPROVED') { 
					if (in_array(
						$trans_type, 
						array('Capture', 'Sale', 'Sale_Qiwi', 'Sale_YaMoney', 'Sale_WebMoney')
						)) {
						if (!$is_payed && !CSaleOrder::PayOrder($order_id, "Y"))
					        $error .= ' Set payed flag error; ';
					    $arFields = array("STATUS_ID" => "P");
						if ($trans_type == 'Capture')
							$arFields["COMMENTS"] = $arOrder['COMMENTS']."\n Сумма ".$getData['amount'].' для оплаты заказа была списана.';
						if (isset($paysystem_params['PAID_STATUS'], $paysystem_params['PAID_STATUS']['VALUE'])) {
							$arFields['STATUS_ID'] = $paysystem_params['PAID_STATUS']['VALUE'];
						}
					    if (!CSaleOrder::Update($order_id, $arFields))
					        $error .= ' Update payed order error ';
					}
					elseif (in_array($trans_type, 
						array('Cancel','Refund','Refund_Qiwi','Refund_WebMoney','Refund_YaMoney')
						)) {
						if (isset($paysystem_params['REFUND_STATUS'], $paysystem_params['REFUND_STATUS']['VALUE'])) {
							$arFields = array(
								'STATUS_ID' => $paysystem_params['REFUND_STATUS']['VALUE'],
								"COMMENTS" => $arOrder['COMMENTS'].' Сумма '.$getData['amount'].' была возвращена покупателю.',
							);
							if (!CSaleOrder::Update($order_id, $arFields)) {
					    		$error .= ' Update Refund order error ';
					   		}
						}
					}
					else {
						$error .= '| unknown transactionType | ';
					}
				}
				elseif (($status == 'WAITING') && ($trans_type == 'Authorize')) {
					$arFields = array(
				        "COMMENTS" => $arOrder['COMMENTS']."\n Сумма ".$getData['amount'].' для оплаты заказа заморожена.',
				    );
					if (isset($paysystem_params['HOLD_STATUS'], $paysystem_params['HOLD_STATUS']['VALUE'])) {
						$arFields['STATUS_ID'] = $paysystem_params['HOLD_STATUS']['VALUE'];
					}
				    if (!CSaleOrder::Update($order_id, $arFields))
				        $error .= ' Update hold order error ';
				}
				else {
					$error .= '| unknown error | ';
				}
				if (strlen($error)) {
					$getData['status'] = '0';
	            	$getData['error'] = $error;
				}
				else {
					$getData['status'] = '1';
	            	$getData['error'] = '';
				}
	        }
	        else {
	            $getData['status'] = '0';
	        }
	    }
	    else {
	        $getData['status'] = '0';
	        $getData['error'] = 'Error: token does not match';
	    }
	}
	else {
	    $getData['status'] = 0;
	    $getData['error'] = 'Wrong auth value';
	}
}
else {
	$getData['status'] = 0;
    $getData['error'] = 'Paysystem not found';
}

echo '<notification>
	<orderId>'.htmlentities($getData['orderID']).'</orderId>
	<transactionType>'.htmlentities($getData['transactionType']).'</transactionType>
	<status>'.htmlentities($getData['status']).'</status>
	<error>'.htmlentities($getData['error']).'</error>
</notification>';
