<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

//Подключаем наш модуль
\Bitrix\Main\Loader::includeModule('conference.users');

//Пространство имён, которое используется для работы с модулем
use CONFERENCE\USERS;

if($USER->IsAdmin())
{

$id = intval($_GET["id"]);
$user_id = intval($_GET["usid"]);

if($user_id) 
{

$message = USERS\USERSConference::DeleteUserConference($id, $user_id);
Header("Location: http://localhost:8082/conference/admin.php");
}
}
else Header("Location: http://localhost:8082");
?>