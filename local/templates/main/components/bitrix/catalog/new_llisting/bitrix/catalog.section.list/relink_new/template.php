<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

    <div class="relink">
        <div class="relink_cat">
           
            <?
       
            
           
           foreach ($arResult["LEFT_MENU"]['TYPE'] as $value): 
			//print_r($arResult); 
			?>
               
                    <div class="relink_cat-item">
                        <a href="<?= $value["SECTION_PAGE_URL"]?>"><?  echo $value["NAME"];

						
                            ?><sup><?=$value["ELEMENT_CNT"];?></sup></a>
                    </div>
            
            <? endforeach;
        
            
            ?> 
        </div>
    </div>

    <div class="clear"></div>
