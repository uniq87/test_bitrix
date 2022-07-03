<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die(); ?>
<? if (!empty($arResult["ITEMS"])): ?>
    <div class="items">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="item-list"><?=$arItem["NAME"];?>
                <div class="item-link">
                    <a href="<?=$arItem["SECTION_PAGE_URL"];?>">Подробнее</a>
                </div>
            </div>
        <? endforeach; ?>
    </div>
<? endif; ?>