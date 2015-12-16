<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

//Подключаем наш модуль
\Bitrix\Main\Loader::includeModule('conference.general');

//Пространство имён, которое используется для работы с модулем
use CONFERENCE\GENERAL;

//Доступен только для админа
if($USER->IsAdmin() == false)
{
    echo 'Вы не админ!';
    exit;
}

//Проверка входных параметров на корректность и приведение их к нужному виду
$arParams["topic"] = mysql_real_escape_string($_REQUEST["topic"]);
$arParams["place"] = mysql_real_escape_string($_REQUEST["place"]);


$arParams["date"] = GENERAL\GENERALConference::DateIntval($_POST["day"], $_POST["month"], $_POST["year"]);


//Создаём новый пункт и получаем ответ
$arResult['ITEMS'] = GENERAL\GENERALConference::AddConference($arParams["topic"], $arParams["place"], $arParams["date"]);


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