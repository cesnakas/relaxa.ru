<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

/***CustomPageNav start***/
$nPageWindow = 3; //количество отображаемых страниц
if ($arResult["NavPageNomer"] > floor($nPageWindow/2) + 1 && $arResult["NavPageCount"] > $nPageWindow)
    $nStartPage = $arResult["NavPageNomer"] - floor($nPageWindow/2);
else
    $nStartPage = 1;

if ($arResult["NavPageNomer"] <= $arResult["NavPageCount"] - floor($nPageWindow/2) && $nStartPage + $nPageWindow-1 <= $arResult["NavPageCount"])
    $nEndPage = $nStartPage + $nPageWindow - 1;
else
{
    $nEndPage = $arResult["NavPageCount"];
    if($nEndPage - $nPageWindow + 1 >= 1)
        $nStartPage = $nEndPage - $nPageWindow + 1;
}
$arResult["nStartPage"] = $arResult["nStartPage"] = $nStartPage;
$arResult["nEndPage"] = $arResult["nEndPage"] = $nEndPage;
/***CustomPageNav end***/

if (!$arResult["NavShowAlways"])
{
	if (0 == $arResult["NavRecordCount"] || (1 == $arResult["NavPageCount"] && false == $arResult["NavShowAll"]))
		return;
}
if ('' != $arResult["NavTitle"])
	$arResult["NavTitle"] .= ' ';

$strSelectPath = $arResult['sUrlPathParams'].($arResult["bSavePage"] ? '&PAGEN_'.$arResult["NavNum"].'='.(true !== $arResult["bDescPageNumbering"] ? 1 : '').'&' : '').'SHOWALL_'.$arResult["NavNum"].'=0&SIZEN_'.$arResult["NavNum"].'=';

?>
<div class="bx_pagination_bottom">
	

	<div class="bx_pagination_section_one">
		<div class="bx_pg_section pg_pagination_num">
			<div class="bx_pagination_page"><?
if ($arResult["NavShowAll"])
{
?>
				<span class="bx_pg_text"><? echo GetMessage('nav_all_descr'); ?></span>
				<ul>
					<li><a href="<?=$arResult['sUrlPathParams']; ?>SHOWALL_<?=$arResult["NavNum"]?>=0&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>"><? echo GetMessage('nav_show_pages'); ?></a></li>
				</ul>
<?
}
else
{
?>
				
				<ul>
<?
	if (true === $arResult["bDescPageNumbering"])
	{
		?><li><?
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_prev_title'); ?>"><img src="<?=SITE_TEMPLATE_PATH ?>/images/new/prev.png"/></a><?
		}
		else
		{
			?><img src="<?=SITE_TEMPLATE_PATH ?>/images/new/prev.png"/><?
		}
		?></li><?
		$NavRecordGroup = $arResult["NavPageCount"];
		while ($NavRecordGroup >= 1)
		{
			$NavRecordGroupPrint = $arResult["NavPageCount"] - $NavRecordGroup + 1;
			$strTitle = GetMessage(
				'nav_page_num_title',
				array('#NUM#' => $NavRecordGroupPrint)
			);
			if ($NavRecordGroup == $arResult["NavPageNomer"])
			{
				?><li class="bx_active" title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroupPrint; ?></li><?
			}
			elseif ($NavRecordGroup == $arResult["NavPageCount"] && $arResult["bSavePage"] == false)
			{
				?><li><a href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a></li><?
			}
			else
			{
				?><li><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroupPrint?></a></li><?
			}
			if (1 == ($arResult["NavPageCount"] - $NavRecordGroup) && 2 < ($arResult["NavPageCount"] - $arResult["nStartPage"]))
			{
				$middlePage = floor(($arResult["nStartPage"] + $NavRecordGroup)/2);
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $NavRecordGroupPrint)
				);
				?><li><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
				$NavRecordGroup = $arResult["nStartPage"];
			}
			elseif ($NavRecordGroup == $arResult["nEndPage"] && 3 < $arResult["nEndPage"])
			{
				$middlePage = ceil(($arResult["nEndPage"] + 2)/2);
				$NavRecordGroupPrint = $arResult["NavPageCount"] - $middlePage + 1;
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $NavRecordGroupPrint)
				);
				?><li><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><?
				$NavRecordGroup = 2;
			}
			else
			{
				$NavRecordGroup--;
			}
		}
		?><li><?
		if ($arResult["NavPageNomer"] > 1)
		{
			?><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_next_title'); ?>"><img src="<?=SITE_TEMPLATE_PATH ?>/images/new/next.png"/></a><?
		}
		else
		{
			?><img src="<?=SITE_TEMPLATE_PATH ?>/images/new/next.png"/><?
		}
		?></li><li><ul><?
	}
	else
	{ 
?>
					<li><? 
		if (1 < $arResult["NavPageNomer"])
		{
			?><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]-1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_prev_title'); ?>"><img src="<?=SITE_TEMPLATE_PATH ?>/images/new/prev.png"/></a><?
		}
		else
		{
			?><img src="<?=SITE_TEMPLATE_PATH ?>/images/new/prev.png"/><?
		}
		?></li><ul class="wp_pgnav"><li><ul><?
		$NavRecordGroup = 1;
		$l=0; 
		while($NavRecordGroup <= $arResult["NavPageCount"])
		{ $l++; $k=''; if($l==1) $k='first ';
		
		if ($NavRecordGroup == 2 && $arResult["nStartPage"] > 3 && $arResult["nStartPage"] - $NavRecordGroup > 1)
		{ $k=$k.' dstart';}
		elseif
		($NavRecordGroup == $arResult["nEndPage"] && $arResult["nEndPage"] < ($arResult["NavPageCount"] - 2))
			{ $k=$k.' dstart';}
			
		
		
		if($l==$arResult["NavPageCount"]) $k=$k.'last ';
			$strTitle = GetMessage(
				'nav_page_num_title',
				array('#NUM#' => $NavRecordGroup)
			);
			if ($NavRecordGroup == $arResult["NavPageNomer"])
			{
				?><li class="bx_active item<?=$k?>" title="<? echo GetMessage('nav_page_current_title'); ?>"><? echo $NavRecordGroup; ?></li><?
			}
			elseif ($NavRecordGroup == 1 && $arResult["bSavePage"] == false)
			{
				?><li class="item<?=$k?>"><a href="<?=$arResult['sUrlPathParams']; ?>SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li><?
			}
			else
			{
				?><li class="item<?=$k?>"><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$NavRecordGroup?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>"><?=$NavRecordGroup?></a></li><?
			}
			if ($NavRecordGroup == 2 && $arResult["nStartPage"] > 3 && $arResult["nStartPage"] - $NavRecordGroup > 1)
			{
				$middlePage = ceil(($arResult["nStartPage"] + $NavRecordGroup)/2);
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $middlePage)
				);
				?></ul></li><li class="dotted"><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><li><ul><?
				$NavRecordGroup = $arResult["nStartPage"];
			}
			elseif ($NavRecordGroup == $arResult["nEndPage"] && $arResult["nEndPage"] < ($arResult["NavPageCount"] - 2))
			{
				$middlePage = floor(($arResult["NavPageCount"] + $arResult["nEndPage"] - 1)/2);
				$strTitle = GetMessage(
					'nav_page_num_title',
					array('#NUM#' => $middlePage)
				);
				?></ul></li><li class="dotted" ><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=$middlePage?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo $strTitle; ?>">...</a></li><li><ul><?
				$NavRecordGroup = $arResult["NavPageCount"]-1;
			}
			else
			{
				$NavRecordGroup++;
			}
		}
			?>
					</ul></li ></ul><li ><?
		if ($arResult["NavPageNomer"] < $arResult["NavPageCount"])
		{
			?><a href="<?=$arResult['sUrlPathParams']; ?>PAGEN_<?=$arResult["NavNum"]?>=<?=($arResult["NavPageNomer"]+1)?>&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult['NavPageSize']; ?>" title="<? echo GetMessage('nav_next_title'); ?>"><img src="<?=SITE_TEMPLATE_PATH ?>/images/new/next.png"/></a><?
		}
		else
		{
			?><img src="<?=SITE_TEMPLATE_PATH ?>/images/new/next.png"/><?
		}
		?></li><?
		/*if ($arResult["bShowAll"])
		{
			?></ul></li ><li><a href="<?=$arResult['sUrlPathParams']; ?>SHOWALL_<?=$arResult["NavNum"]?>=1&SIZEN_<?=$arResult["NavNum"]?>=<?=$arResult["NavPageSize"]?>"><? echo GetMessage('nav_all'); ?></a></li><?
		}*/
	}
?>
				</ul><?
}
?>
			</div>
		</div>
	</div>
</div>