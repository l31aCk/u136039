<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die;

function urlmenu($page)
{
	$url = $_SERVER["SERVER_NAME"] . ':8082' . $_SERVER["PHP_SELF"];
	
	if($_SERVER["PHP_SELF"] == '') $_SERVER["PHP_SELF"] = $_SERVER["SERVER_NAME"] . ':8082';
	
	if($url == $page) $page = ' class="current"';
	else $page =  '';
	
	return $page;
}
?>

<div id="menu">
<ul>
<?foreach ($arResult['ITEMS'] as $arItem)
{

echo '<li><a href="//' . $arItem["UF_URL"] . '"' . urlmenu($arItem["UF_URL"]) . '>' . $arItem["UF_VALUE"] . '</a></li>';

}
?>
</ul>
</div>
