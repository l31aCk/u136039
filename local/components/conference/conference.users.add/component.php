<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

//Подключаем наш модуль
\Bitrix\Main\Loader::includeModule('conference.users');

//Пространство имён, которое используется для работы с модулем
use CONFERENCE\USERS;

//Проверка входных параметров на корректность и приведение их к нужному виду
$arParams["conf"] = mysql_real_escape_string($_GET["conf"]);
$arParams["rang"] = mysql_real_escape_string($_POST["rang"]);
$arParams["work"] = mysql_real_escape_string($_POST["work"]);
$arParams["status"] = 0;

echo '-' . $_FILES["thesis"]["name"];
if(isset($_REQUEST['save']) && ($_FILES["thesis"]["name"] == ''))
{
echo '</br>Файл не загружен!';
exit;
}

$arResult['CONF'] = USERS\USERSConference::ShowConference($arParams["conf"]);

if($arResult['CONF'] == false)
{
	 echo '<span style="color: #ff0000">Такая конференция не существует или уже была проведена.</span>';
	 exit;
}

$arFile = $_FILES["thesis"];
$fid = CFile::SaveFile($arFile, "thesis");
$arfile = CFile::MakeFileArray($fid);
$file = str_replace('/home/bitrix/www/upload', '', $arfile["tmp_name"]);
$file_name = $arfile["name"];

//Создаём новый пункт и получаем ответ
$arResult['ITEMS'] = USERS\USERSConference::UsersAddConference($GLOBALS['USER']->GetID(), $arParams["conf"], $arParams["rang"], $arParams["work"], $file, $file_name);

//Обработка кнопки saveMENU
if ($_REQUEST['save'])
{
$arResult['GOOD'] = USERS\USERSConference::AdminAddConference($GLOBALS['USER']->GetID(), $arParams["conf"]);
	 
    //Ответ БД на наш запрс
    if($arResult['ITEMS'] && !$arResult['GOOD']) $arResult['ERROR'] = 'Ошибка при сохранении';
	elseif($arResult['ITEMS'] && $arResult['GOOD']) $arResult['OK'] = 'Изменения успешно сохранены';
    else $arResult['ERROR'] = 'Ошибка при сохранении';

}



//Подключаем шаблон
$this ->IncludeComponentTemplate();


?>