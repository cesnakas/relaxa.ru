<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

   global $USER;   
   
   $rsUser =  CUser::GetByID($_POST["userid"]); 
        $arUser = $rsUser->Fetch();
   $arFile = Array (
      "name" => $_FILES['profile-photo']['name'],
      "size" => $_FILES['profile-photo']['size'],
      "tmp_name" => $_FILES['profile-photo']['tmp_name'],
      "type" => "",
      "old_file" => "",
      "del" => "Y",
      "MODULE_ID" => "main",
   );
   $fid = CFile::SaveFile ($arFile, "main");

   $arFile = CFile::MakeFileArray ($fid);
   $arFile['del'] = "Y";
   $arFile['old_file'] = $arUser['PERSONAL_PHOTO'];
   $arFile['MODULE_ID'] = "main";
   
   $USER->Update($_POST["userid"], Array ('PERSONAL_PHOTO' => $arFile));
?>