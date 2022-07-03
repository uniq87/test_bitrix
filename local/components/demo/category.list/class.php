<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class CategoryList extends CBitrixComponent
{

    private function getSectionPageUrl() {
		$rsSection = \Bitrix\Iblock\SectionTable::getList(array(
			"filter" => array("IBLOCK_ID" => $this->arParams["IBLOCK_ID"]
			),
			"select" =>  array("ID", "NAME")
		));

		while ($arSection = $rsSection->fetch()) {
			$this->arResult["ITEMS"][] = [
				"NAME" => $arSection["NAME"],
                "SECTION_PAGE_URL" => $this->arParams["DETAIL_PAGE_URL"].$arSection["ID"]."/"
			];
		}
	}

    public function executeComponent() {
        try {
            $this->getSectionPageUrl();
            $this->includeComponentTemplate();
        }
		catch(Exception $e) {
            ShowError($e->getMessage());
        }
    }
}