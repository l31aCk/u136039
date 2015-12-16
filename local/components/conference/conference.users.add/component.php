<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

//Подключаем наш модуль
\Bitrix\Main\Loader::includeModule('conference.users');

//Пространство имён, которое используется для работы с модулем
use CONFERENCE\USERS;

//Доступен только для админа
if($USER->IsAdmin() == false)
{
    echo 'Вы не админ!';
    exit;
}

//Проверка входных параметров на корректность и приведение их к нужному виду
$arParams["conf"] = mysql_real_escape_string($_GET["conf"]);
$arParams["rang"] = mysql_real_escape_string($_POST["rang"]);
$arParams["work"] = mysql_real_escape_string($_POST["work"]);
$arParams["thesis"] = mysql_real_escape_string($_POST["thesis"]);
$arParams["status"] = 0;

$arResult['CONF'] = GENERAL\GENERALConference::ShowConference($arParams["conf"]);

if($arResult['CONF'] == false)
{
	 echo '<span style="color: #ff0000">Такая конференция не существует.</span>';
	 exit;
}

	
//Создаём новый пункт и получаем ответ
$arResult['ITEMS'] = GENERAL\GENERALConference::UsersAddConference($arParams["conf"], $arParams["rang"], $arParams["work"], $arParams["thesis"]);


//Обработка кнопки saveMENU
if ($_REQUEST['save'])
{

    //Ответ БД на наш запрс
    if($arResult['ITEMS']) $arResult['OK'] = 'Изменения успешно сохранены';
    else $arResult['ERROR'] = 'Ошибка при сохранении';

}



//Подключаем шаблон
$this ->IncludeComponentTemplate();


?>