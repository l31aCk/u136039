<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die
?>

<?if ($arResult['OK']):?>
    <? ShowMessage(
        array
        (
            'TYPE' => 'OK',
            'MESSAGE' => $arResult['OK']
        )
    );
    ?>
<?endif;?>
<?if ($arResult['ERROR']):?>
    <? ShowMessage(
        array
        (
            'TYPE' => 'ERROR',
            'MESSAGE' => $arResult['ERROR']
        )
    );
    ?>
<?endif; ?>

<form action="<?=POST_FORM_ACTION_URI?>" method="POST">
<table style="border-width:0px;border-spacing:10px;">
<?
$access = array(
0 => 'error',
1 => 'для всех',
2 => 'только для пользователей',
3 => 'только для гостей'
);

foreach($arResult['ITEMS'] as $arItem)
{

if(isset($_POST['update']))
{
$vparam = "name-" . $arItem["ID"];
$uparam = "url-" . $arItem["ID"];

$arItem["UF_VALUE"] = $arParams[$vparam];
$arItem["UF_URL"] = $arParams[$uparam];
}
?>
<tr>
<td>Название: <input type="text" name="name-<?=$arItem["ID"]?>" value="<?=$arItem["UF_VALUE"]?>"></td>
<td>URL: <input type="text" name="url-<?=$arItem["ID"]?>" value="<?=$arItem["UF_URL"]?>"></td>
<td>Доступно: 
<?
switch($arItem["UF_ACCESS"])
{
   case 2:
      echo '<span class="red">' . $access[2] . '</span>';
   break;
   
   case 3:
      echo '<span class="green">' . $access[3] . '</span>';
   break;   
   
   default: echo '<span class="blue">' . $access[1] . '</span>';
  }
?>
</td>
<td><a href="?del=<?=$arItem["ID"]?>">Удалить</a></td>
</tr>
<?}?>
<tr>
<td colspan="4"><input type="submit" name="update" value="Изменить"></td>
</tr>
</table>
</form>
</body>
</html>