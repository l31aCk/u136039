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

<table style="border-width:0px;border-spacing:10px;">
<?foreach($arResult["ITEMS"] as $arItem):?>
<tr>
<td>Тема: <?=$arItem["UF_TOPIC"]?></td>
<td>Место: <?=$arItem["UF_PLACE"]?></td>
<td>Дата: <?=$arItem["UF_DATE"]?></td>
</tr>
<?endforeach; ?>
</table>
</form>
</body>
</html>