<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

use \Bitrix\Main\Loader;

class Category extends CBitrixComponent
{
	protected $arDefaultUrlTemplates404 = [];
	protected $arComponentVariables  = [];
	protected $componentPage;

	public function onPrepareComponentParams($arParams) {
		$arParams["IBLOCK_ID"] = isset($arParams["IBLOCK_ID"]) ? $arParams["IBLOCK_ID"] : 2;
		return $arParams;
	}

	private function checkModules() {
		if (!Loader::includeModule("iblock")) throw new \Exception("iblock not found");
		return true;
	}

	private function checkTitle() {
		global $APPLICATION;
		return (!empty($this->arParams["BROWSER_TITLE"]) || $this->arParams["SET_TITLE"] === "Y") ? $APPLICATION->SetPageProperty("title", $this->arParams["BROWSER_TITLE"]) : false;
	}

	private function setDefaultUrlTemplates() {
		$this->arDefaultUrlTemplates404 = [
			"category" => "",
			"detail" => "#SECTION_ID#/"
		];
		$this->arComponentVariables  = ["SECTION_ID"];
	}

	private function getResult() {
		$arUrlTemplates = [];
		if ($this->arParams["SEF_MODE"] == "Y") {
			$arVariables = [];
			$arUrlTemplates = \CComponentEngine::MakeComponentUrlTemplates(
				$this->arDefaultUrlTemplates404,
				$this->arParams['SEF_URL_TEMPLATES']
			);
			$arVariableAliases = \CComponentEngine::MakeComponentVariableAliases(
				$this->arDefaultUrlTemplates404,
				$this->arParams['VARIABLE_ALIASES']
			);
			$engine = new CComponentEngine($this);
			if (CModule::IncludeModule('iblock')) {
				$engine->addGreedyPart("#SECTION_CODE_PATH#");
				$engine->setResolveCallback(array("CIBlockFindTools", "resolveComponentEngine"));
			}
			$this->componentPage = $engine->guessComponentPath(
				$this->arParams['SEF_FOLDER'],
				$arUrlTemplates,
				$arVariables
			);

			if (strlen($this->componentPage) <= 0) $this->componentPage = 'category';

			\CComponentEngine::InitComponentVariables(
		    	$this->componentPage,
		    	$this->componentVariables, $arVariableAliases,
		    	$arVariables
			);
		} else {
			$this->componentPage = "index";
		}
		$this->arResult = [
			"FOLDER" => $this->arParams["SEF_FOLDER"],
			"URL_TEMPLATES" => $arUrlTemplates,
			"VARIABLES" => $arVariables,
			"ALIASES" => $arVariableAliases
		];
	}

    public function executeComponent() {
		try {
			$this->checkTitle();
			$this->checkModules();
			$this->setDefaultUrlTemplates();
			$this->getResult();
			$this->includeComponentTemplate($this->componentPage);
		}
		catch (Exception $e) {
			ShowError($e->getMessage());
		}
	}
}