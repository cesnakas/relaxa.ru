<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
CModule::IncludeModule('iblock');
$elementPhotos = CIBlockElement::GetProperty($_GET['IBLOCK_ID'], $_GET['ID'], array(), array('CODE' => 'MORE_PHOTO'));

?>
<pre>
    <?php    
    while ($elementPhoto = $elementPhotos->Fetch()) {
        $photoID = $elementPhoto['VALUE'];
        $prevSrc = CFile::ResizeImageGet($photoID, Array("width"=>200, "height"=>200), BX_RESIZE_IMAGE_PROPORTIONAL);
        $originalSrc = CFile::GetPath($photoID);
        echo CFile::Show2Images($prevSrc['src'], $originalSrc);
    }
?>
</pre>
