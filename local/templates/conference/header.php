<html>
<head>
<?$APPLICATION->ShowHead();
$APPLICATION->SetAdditionalCSS(SITE_TEMPLATE_PATH."/interface.css", true);
$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH."/bitrix24.js", true);
?><title><? if (!$isCompositeMode || $isIndexPage) $APPLICATION->ShowTitle()?></title>
</head>
<?$APPLICATION->ShowPanel();?>
<div id="header">
   <div class="logo"><img src="images/logo.png"></div>
</div>

<div id="menu">
<ul>
<li><a href="" class="current">First</a></li>
<li><a href="">Second</a></li>
</ul>
</div>



<div id="main">
