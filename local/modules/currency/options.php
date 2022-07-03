<?
use Bitrix\Main\Loader;
use Bitrix\Currency;

$module_id = 'currency';

Loader::includeModule('currency');

$aTabs = array(
    array("DIV" => "edit0", "TAB" => "Таб 1", "ICON" => "currency_settings", "TITLE" => "Курсы валют")
);
$tabControl = new CAdminTabControl("currencyTabControl", $aTabs, true, true);
$tabControl->Begin();
?>
<form method="POST" action="<?echo $APPLICATION->GetCurPage()?>?lang=<?echo LANGUAGE_ID?>&mid=<?=$module_id?>" name="currency_settings">
<?
echo bitrix_sessid_post();
$tabControl->BeginNextTab();
?>
<tr><td width="40%"><? echo 'BASE_CURRENCY'; ?></td></tr>
</form>
<? $tabControl->End();