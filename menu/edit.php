<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent(
	"conference:conference.menu.edit",
	"",
	Array(
		"COMPONENT_TEMPLATE" => ".default"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>