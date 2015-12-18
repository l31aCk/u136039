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
<form enctype="multipart/form-data" action="<?=POST_FORM_ACTION_URI?>" method="POST">
<table style="border-width:0px;border-spacing:10px;">
<tr>
<td colspan="2">Вы являетесь:
<select name="rang">
<option value="1">участником</option>
<option value="2">автором</option>
</select>
</td>
</tr>
<tr>
<td colspan="2">Должность: <input type="input" name="work"></td>
</tr>
<tr>
<td colspan="2">Тезис:
<input type="file" name="thesis"></td>
</tr>
<tr>
<td>
<input type="submit" name="save" value="Сохранить">
<input type="reset" value="Очистить">
</td>
</tr>
</table>
</form>
</body>
</html>