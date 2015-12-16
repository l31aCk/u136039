<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die
?>

<div id="menu">
<ul>
<?foreach ($arResult['ITEMS'] as $arItem)
{

$title = $APPLICATION->ShowTitle();
if($arItem["UF_VALUE"] == $title) echo '<li><a href="//' . $arItem["UF_URL"] . '" class="current">' . $arItem["UF_VALUE"] . '</a></li>';
else echo '<li><a href="//' . $arItem["UF_URL"] . '">' . $arItem["UF_VALUE"] . '</a></li>';
}
?>
</ul>
</div>
