<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Title");
?><?$APPLICATION->IncludeComponent(
	"conference:conference.general.show",
	"",
	Array(
		"COMPONENT_TEMPLATE" => ".default",
		"SHOW" => "0"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>