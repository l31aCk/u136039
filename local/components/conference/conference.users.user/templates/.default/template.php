<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die
?>

<table style="border-width:0px;border-spacing:10px;">
<?foreach($arResult["ITEMS"] as $arItem):?>
<tr>
<td>Тема: <a href="request.php?conf=<?=$arItem["ID"]?>"><?=$arItem["UF_TOPIC"]?></td>
<td>Заявку подал: <?=$arItem["NAME"]?> <?=$arItem["LAST_NAME"]?></td>
</tr>
<?endforeach; ?>
</table>

</body>
</html>