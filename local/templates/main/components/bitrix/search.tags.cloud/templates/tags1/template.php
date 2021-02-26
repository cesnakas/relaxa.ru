<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
?>
<noindex>
<?
$movie = $templateFolder.'/tagcloud.swf';
$path = $templateFolder.'/';

if (is_array($arResult["SEARCH"]))
{
$cloud = "";
foreach ($arResult["SEARCH"] as $key => $res)
	{
		$cloud.='<a href="'.$res["URL"].'" style="font-size: '.$res["FONT_SIZE"].'px;">'.$res["NAME"].'</a>';
	}
$tagcloud=urlencode($cloud);
}
	
	$flashtag = '';	
	$soname = 'cl';
	$divname = 'cloud_tags';
	$flashtag .= '<script type="text/javascript" src="'.$path.'swfobject.js"></script>';
	$flashtag .= '<div id="'.$divname.'"><p style="display:none">';
	// alternate content
	$flashtag .= urldecode($tagcloud);
	$flashtag .= '</p><p>Облако тегов требует для просмотра <noindex><a href="http://www.adobe.com/go/getflashplayer" target="_blank" rel="nofollow">Flash Player 9</a></noindex> или выше.</p></div>';
	$flashtag .= '<script type="text/javascript">';
	$flashtag .= 'var rnumber = Math.floor(Math.random()*9999999);'; // force loading of movie to fix IE weirdness
	$flashtag .= 'var '.$soname.' = new SWFObject("'.$movie.'?r="+rnumber, "tagcloudflash", "'.$arResult['WIDTH2'].'", "'.$arResult['HEIGHT'].'", "9", "#'.$arResult['BG'].'");';
	if( $arResult['TRANS'] == 'Y' ){
		$flashtag .= $soname.'.addParam("wmode", "transparent");';
	}
	$flashtag .= $soname.'.addParam("allowScriptAccess", "always");';
	$flashtag .= $soname.'.addVariable("tcolor", "0x'.$arResult['COLOR'].'");';
	$flashtag .= $soname.'.addVariable("tspeed", "'.$arResult['SPEED'].'");';
	if( $arResult['DISTR'] == 'Y' )
		{ $flashtag .= $soname.'.addVariable("distr", "true");'; }
	else
		{ $flashtag .= $soname.'.addVariable("distr", "false");'; }
	$flashtag .= $soname.'.addVariable("mode", "tags");';
	// put tags in flashvar
	$flashtag .= $soname.'.addVariable("tagcloud", "'.urlencode('<tags>') . $tagcloud . urlencode('</tags>').'");';
	$flashtag .= $soname.'.write("'.$divname.'");';
	$flashtag .= '</script>';

echo $flashtag;
?>

</noindex>