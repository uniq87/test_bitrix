<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CategoryDetail extends CBitrixComponent
{

    private function getDetailDescription() {
        $rsSection = \Bitrix\Iblock\SectionTable::getById($this->arParams["SECTION_ID"]);
        while ($arSection = $rsSection->fetch()) {
            $this->arResult["ITEMS"][] = [
				"ID" => $arSection["ID"],
                "NAME" => $arSection["NAME"],
                "DESCRIPTION" => $arSection["DESCRIPTION"]
			];
        }
    }

    public function executeComponent() {
        try {
            $this->getDetailDescription();
            $this->includeComponentTemplate();
        }
        catch(Exception $e) {
            ShowError($e->getMessage());
        }
    }
}