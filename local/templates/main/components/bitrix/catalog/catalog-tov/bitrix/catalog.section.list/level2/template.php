<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);?>

<?foreach($arResult["LEFT_MENU"] as $arSection):?>
	<div id="nextSection">
		<?if(empty($arSection["ANCHOR"]) === true):?>
			<div class="title">Тип</div>
		<?else:?>
			<div class="title"><?=$arSection["ANCHOR"]?></div>
		<?endif?>
		<ul>
			<?foreach($arSection as $arElement):?>
	    		<?if($arElement["ELEMENT_CNT"] > 0):?>
	    			<li>
		    			<span class="sectionLine">
		    				<span class="sectionColumn"><a href="<?=$arElement["SECTION_PAGE_URL"]?>" class="<?=!empty($arElement["SELECTED"]) ? "selected" : ""?>"><?=$arElement["NAME"]?></a></span>
		    				<span class="sectionColumn last"><a href="<?=$arElement["SECTION_PAGE_URL"]?>" class="cnt"><?=$arElement["ELEMENT_CNT"]?></a></span>
		    			</span>
	    			</li>
	    		<?endif;?>
		    <?endforeach;?>	
		</ul>
	</div>
<?endforeach;?>	