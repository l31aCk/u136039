<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

//Подключаем наш модуль
\Bitrix\Main\Loader::includeModule('conference.users');

//Пространство имён, которое используется для работы с модулем
use CONFERENCE\USERS;

if(!$USER->IsAdmin() && $GLOBALS['USER']->GetID())
{

$user_id = intval($_GET["id"]);

if($user_id) $message = USERS\USERSConference::CloseUserConference($user_id);
}

Header("Location: http://localhost:8082");
?>