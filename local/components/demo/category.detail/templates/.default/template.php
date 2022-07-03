<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die(); ?>
<? if (!empty($arResult["ITEMS"])): ?>
    <? foreach ($arResult["ITEMS"] as $arItem): ?>
        <div class="item-id"><span>ID: <span><?=$arItem["ID"];?></div>
        <div class="item-title"><span>Название группы: </span><?=$arItem["NAME"];?></div>
        <div class="item-text"><span>Описание группы: </span><?=$arItem["DESCRIPTION"];?></div>
    <? endforeach; ?>
<? endif; ?>