<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

//Подключаем наш модуль
\Bitrix\Main\Loader::includeModule('conference.users');

//Пространство имён, которое используется для работы с модулем
use CONFERENCE\USERS;

if($GLOBALS['USER']->GetID()) 
{

//Доступен только для админа
if($USER->IsAdmin())
{
$us = 1;
$message = USERS\USERSConference::MessageToConference(1, 'yes');
if($message) $this->IncludeComponentTemplate();

}
else
{

$message = USERS\USERSConference::MessageToConference($GLOBALS['USER']->GetID(), 'no');
if($message) $this->IncludeComponentTemplate();

}

}
?>