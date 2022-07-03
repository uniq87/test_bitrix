<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?$APPLICATION->IncludeComponent(
	"demo:category.detail",
	".default",
	array(
		"SECTION_ID" => $arResult["VARIABLES"]["SECTION_ID"]
	),
	$component
);?>