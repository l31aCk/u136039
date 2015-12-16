<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
###Инициализация глобальных переменных Битрикс###
global $DB;
/**@global CUser $USER */
global $USER;
###
\Bitrix\Main\Loader::includeModule('conference.menu');

use CONFERENCE\MENU;

global $USER;
$arResult['ITEMS'] = MENU\MENUConference::MenuValues($USER->IsAuthorized());

$this ->IncludeComponentTemplate();
?>