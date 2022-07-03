<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<?$APPLICATION->IncludeComponent(
	"demo:category.list",
	".default",
	array(
		"IBLOCK_ID" => $arParams["IBLOCK_ID"],
        "DETAIL_PAGE_URL" => $arResult["FOLDER"]
	),
	$component
);?>
