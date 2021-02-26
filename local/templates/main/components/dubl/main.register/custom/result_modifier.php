<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

// меняем порядок следования полей
$arResult['SHOW_FIELDS'] = array(
   'NAME',
   'EMAIL',
   'PASSWORD',
   'CONFIRM_PASSWORD',
);


use OlegPro\UserRegister;
 
$arResult[UserRegister::FAKE_FIELD_NAME1] = isset($_POST[UserRegister::FAKE_FIELD_NAME1]) 
    ? htmlspecialcharsbx($_POST[UserRegister::FAKE_FIELD_NAME1]) 
    : '';

?> 