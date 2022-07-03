<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(false);
?>
<?$APPLICATION->IncludeComponent(
	"demo:category",
	".default",
	array(
		"IBLOCK_ID" => "2",
		"SEF_FOLDER" => "/category/",
		"SEF_MODE" => "Y",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>