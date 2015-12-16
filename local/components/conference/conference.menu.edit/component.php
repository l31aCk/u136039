<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

\Bitrix\Main\Loader::includeModule('conference.menu');

use CONFERENCE\MENU;

if($USER->IsAdmin() == false)
{
echo 'ERROR 404';
exit;
} 


//Проверка входных параметров на корректность и приведение их к нужному виду
if($_REQUEST['update']) unset($_REQUEST["del"]);
$arParams["del"] = intval($_REQUEST["del"]);
$arResult['ITEMS'] = MENU\MENUConference::MenuValues();



if($_REQUEST['del'])
{
$arResult['DELETE'] = MENU\MENUConference::DeleteMenu($arParams["del"]);
}
elseif($_REQUEST['update']) {


foreach($arResult['ITEMS'] as $arUpd)
{
$vparam = "name-" . $arUpd["ID"];
$uparam = "url-" . $arUpd["ID"];
$arParams[$vparam] = mysql_real_escape_string($_REQUEST[$vparam]);
$arParams[$uparam] = mysql_real_escape_string($_REQUEST[$uparam]);

$arResult['UPDATE'] = MENU\MENUConference::UpdateMenu($arUpd["ID"], $arParams[$vparam], $arParams[$uparam]);
}

}


//Обработка кнопки saveMENU
if ($_REQUEST['del'] || $_REQUEST['update'])
{

    //Ответ БД на наш запрс
    if($arResult['DELETE'] || $arResult['UPDATE']) $arResult['OK'] = 'Изменения успешно сохранены';
    else $arResult['ERROR'] = 'Ошибка при сохранении';

}

$this ->IncludeComponentTemplate();
?>