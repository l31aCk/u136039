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
<tr>
<td>Вы являетесь:
<select name="rang">
<option>участником</option>
<option>автором</option>
</select>
</td>
<td>Должность: <input type="input" name="work"></td>
</tr>
<tr>
<td>Тезисы: </td>
<td><input type="input" name="thesis"></td>
</tr>
<tr>
<td colspan="2">
<input type="submit" name="save" value="Сохранить">
<input type="reset" value="Очистить">
</td>
</tr>
</table>
</form>
</body>
</html>