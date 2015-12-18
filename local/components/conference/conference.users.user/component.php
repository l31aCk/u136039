<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

//Инициализация глобальных переменных Битрикс
global $DB;
global $USER;

//Подключаем наш модуль
\Bitrix\Main\Loader::includeModule('conference.users');

//Пространство имён, которое используется для работы с модулем
use CONFERENCE\USERS;

$id = intval($_GET["id"]);

//Доступен только для админа
if(!$USER->IsAdmin())
{
echo 'Вы не админ!';
exit;
}

USERS\USERSConference::UpdateConference($id);
Header("Location: localhost:8082/conference/admin.php");

?>