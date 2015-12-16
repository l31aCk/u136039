<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.register",
	"",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"SHOW_FIELDS" => array("EMAIL","NAME","SECOND_NAME","LAST_NAME","PERSONAL_PHONE"),
		"REQUIRED_FIELDS" => array("EMAIL","NAME","LAST_NAME","PERSONAL_PHONE"),
		"AUTH" => "Y",
		"USE_BACKURL" => "Y",
		"SUCCESS_PAGE" => "",
		"SET_TITLE" => "Y",
		"USER_PROPERTY" => array(),
		"USER_PROPERTY_NAME" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>