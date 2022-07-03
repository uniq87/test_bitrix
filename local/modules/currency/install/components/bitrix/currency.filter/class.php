<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Loader;

class CurrencyListComponent extends CBitrixComponent
{
    private function checkModules() {
		if (!Loader::includeModule('currency')) throw new \Exception("currency not found");
		return true;
	}

    public function executeComponent() {
        $this->checkModules();
        $this->includeComponentTemplate();
    }
}