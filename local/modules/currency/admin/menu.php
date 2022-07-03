<?
if ($APPLICATION->GetGroupRight('currency') == 'D')
	return false;

return array(
	"parent_menu" => "global_menu_settings",
	"section" => "currency",
	"sort" => 300,
	"text" => "Валюты",
	"title" => "",
	"icon" => "currency_menu_icon",
	"page_icon" => "",
	"items_id" => "menu_currency",
	"items" => array(
		array(
			"text" => "Курсы валют",
			"title" => "",
			"url" => "",
			"more_url" => array(
				"currency_rate_edit.php"
			)
		)
	)
);