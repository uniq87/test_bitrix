<?
use Bitrix\Main;
use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;

class Currency extends CModule
{
	var $MODULE_ID = 'currency';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = 'Y';
	var $errors = false;

	function __construct() {
		$arModuleVersion = array();

		include(__DIR__.'/version.php');

		if (!empty($arModuleVersion['VERSION'])) {
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}

		$this->MODULE_NAME = "Курсы Валют";
		$this->MODULE_DESCRIPTION = "Тестовый модуль \"Курсы Валют\"";
	}

	function DoInstall() {
		$this->InstallFiles();
		$this->InstallDB();
		$this->InstallEvents();
		$GLOBALS["errors"] = $this->errors;
	}

	function DoUninstall() {
		$this->UnInstallFiles();
		$this->UnInstallDB(false);
	}

	function InstallDB() {
		global $DB, $APPLICATION;

		$this->errors = false;

		if (!$DB->query("SELECT 'x' FROM b_demo_currency", true)) {
			$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/currency/install/db/mysql/install.sql");
        }

		if ($this->errors !== false) {
			$APPLICATION->ThrowException(implode("", $this->errors));
			return false;
		}
		$checkDate = Main\Type\DateTime::createFromTimestamp(strtotime('tomorrow 00:01:00'));
		CAgent::AddAgent('\Bitrix\Currency\CurrencyRequest::updateAgent();', 'currency', 'Y', 86400, '', 'Y', $checkDate->toString(), 100, false, true);
		ModuleManager::registerModule('currency');
		$this->installCurrency();
		return true;
	}

	function UnInstallDB($arParams = array()) {
		global $DB, $APPLICATION;
		$this->errors = false;
		if (!isset($arParams["savedata"]) || $arParams["savedata"] != "Y") {
			$this->errors = $DB->RunSQLBatch($_SERVER["DOCUMENT_ROOT"]."/local/modules/currency/install/db/mysql/uninstall.sql");
			if($this->errors !== false) {
				$APPLICATION->ThrowException(implode('', $this->errors));
				return false;
			}
		}

		CAgent::RemoveModuleAgents('currency');
		ModuleManager::unRegisterModule('currency');

		return true;
	}

	function InstallEvents() {
		return true;
	}

	function UnInstallEvents() {
		return true;
	}

	function InstallFiles() {
		if($_ENV["COMPUTERNAME"]!='BX') {
			CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/currency/install/components", $_SERVER["DOCUMENT_ROOT"]."/local/components", true, true);
			CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/currency/install/themes", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes", true, true);
		}
		return true;
	}

	function UnInstallFiles() {
		DeleteDirFilesEx("/local/components/bitrix/");
		DeleteDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/currency/install/themes/.default/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/themes/.default");
		DeleteDirFilesEx("/bitrix/themes/.default/icons/currency/");
		return true;
	}

	private function installCurrency() {
		if (!Loader::includeModule('currency')) return;
	}
}