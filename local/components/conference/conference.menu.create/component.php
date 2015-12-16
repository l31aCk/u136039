<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

//Подключаем наш модуль
\Bitrix\Main\Loader::includeModule('conference.menu');

//Пространство имён, которое используется для работы с модулем
use CONFERENCE\MENU;

//Доступен только для админа
if($USER->IsAdmin() == false)
{
    echo 'Вы не админ!';
    exit;
}

//Проверка входных параметров на корректность и приведение их к нужному виду
$arParams["name"] = mysql_real_escape_string($_REQUEST["name"]);
$arParams["url"] = mysql_real_escape_string($_REQUEST["url"]);
$arParams["access"] = intval($_REQUEST["access"]);

//Создаём новый пункт и получаем ответ
$arResult['ITEMS'] = MENU\MENUConference::AddMenu($_REQUEST["name"], $_REQUEST["access"], $_REQUEST["url"]);

//Обработка кнопки saveMENU
if ($_REQUEST['saveMENU'])
{

    //Ответ БД на наш запрс
    if($arResult['ITEMS']) $arResult['OK'] = 'Изменения успешно сохранены';
    else $arResult['ERROR'] = 'Ошибка при сохранении';

}

//Подключаем шаблон
$this ->IncludeComponentTemplate();
?>