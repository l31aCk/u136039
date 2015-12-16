<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die;

	function DateOption($from, $before) {
        if(!$from || !$before) {
            return array();
        }

        //Добавляем значения
        $from = intval($from);
        $before = intval($before);
		
		$i = $from;
		while($i <= $before)
        {
		   echo '<option value="' . $i . '">' . $i . '</option>';
		   $i++;
        }
		
        //Возвращаем ответ
        return true;

    }

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
<td>Тема: </td>
<td><input type="input" name="topic"></td>
</tr>
<tr>
<td>Место: </td>
<td><input type="input" name="place"></td>
</tr>
<tr>
<td>Дата: </td>
<td>
<select name="day">
<?=DateOption(1,3)?>
</select>

<select name="month">
<?=DateOption(1,12)?>
</select>

<select name="year">
<?=DateOption(2014,2020)?>
</select>
</td>
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