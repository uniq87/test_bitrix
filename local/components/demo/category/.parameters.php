<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentParameters = array(
    'GROUPS' => array(
    ),
    "PARAMETERS" => array(
        "BROWSER_TITLE" => array(
            "PARENT" => "BASE",
            "NAME" => "Заголовок страницы",
            "TYPE" => "STRING",
            "DEFAULT" => "category"
		),
        "CACHE_TIME" => array(
            "DEFAULT" => 3600
        )
    )
);
?>
