<html>
<head>
    <?$APPLICATION->ShowHead();
    $APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/interface.css", true);
    $APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/bitrix24.js", true);
    ?><title><? if (!$isCompositeMode || $isIndexPage) $APPLICATION->ShowTitle()?></title>
</head>
<?$APPLICATION->ShowPanel();?>
<div id="header">
    <div class="logo"><img src="http://localhost:8082/images/logo.png"></div>
</div>

<?$APPLICATION->IncludeComponent(
    "conference:conference.menu.general",
    "",
    Array(
        "COMPONENT_TEMPLATE" => ".default"
    )
);?>



</body>
</html>
