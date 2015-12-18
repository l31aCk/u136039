<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die
?>

<table style="border-width:0px;border-spacing:10px;">
<?if(!$arResult["ITEMS"]):?>
<td>Новых заявок нет!</td>
<?endif;?>
<?foreach($arResult["ITEMS"] as $arItem):?>
<tr>
<td>Тема: <a href="request.php?conf=<?=$arItem["ID"]?>"><?=$arItem["UF_TOPIC"]?></td>
<td>Заявку подал: <?=$arItem["NAME"]?> <?=$arItem["LAST_NAME"]?></td>
<td><a href="accept.php?id=<?=$arItem["ID"]?>">Принять</a> <a href="delete.php?id=<?=$arItem["ID"]?>&usid=<?=$arItem["USID"]?>">Отклонить</a></td>
</tr>
<?endforeach; ?>
</table>

</body>
</html>