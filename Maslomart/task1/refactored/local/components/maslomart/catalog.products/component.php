<?php

declare(strict_types=1);

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use Bitrix\Main\Loader;
use Bitrix\Main\Config\Option;
use Maslomart\Catalog\ProductListProvider;
use Maslomart\Catalog\ProductViewModelBuilder;

class CatalogProducts extends CBitrixComponent
{
    /**
     * @param $arParams
     *
     * @return array
     */
    public function onPrepareComponentParams($arParams): array
    {
        $arParams['IBLOCK_ID']            = (int)($arParams['IBLOCK_ID'] ?? 0);
        $arParams['SALE_PRICE_THRESHOLD'] = self::normalizeSaleThreshold($arParams['SALE_PRICE_THRESHOLD'] ?? null);
        $arParams['CURRENCY']             = self::normalizeCurrency($arParams['CURRENCY'] ?? null);
        $arParams['CACHE_TYPE']           = (string)($arParams['CACHE_TYPE'] ?? 'A');
        $arParams['CACHE_TIME']           = (int)($arParams['CACHE_TIME'] ?? 3600);

        return $arParams;
    }

    /**
     * @return void
     */
    public function executeComponent(): void
    {
        if (!Loader::includeModule('iblock')) {
            $this->abortResultCache();
            ShowError('Модуль iblock не установлен');

            return;
        }

        $iblockId      = $this->arParams['IBLOCK_ID'];
        $saleThreshold = $this->arParams['SALE_PRICE_THRESHOLD'];

        if ($iblockId <= 0) {
            ShowError('Не задан корректный IBLOCK_ID');

            return;
        }

        if (is_float($saleThreshold) && $saleThreshold < 0.0) {
            ShowError('Некорректный порог цены (SALE_PRICE_THRESHOLD)');

            return;
        }

        $cacheId = [
            'maslomart.catalog.products',
            $iblockId,
            $saleThreshold,
        ];

        if ($this->startResultCache($this->arParams['CACHE_TIME'], $cacheId)) {
            $provider = new ProductListProvider($iblockId);
            $builder  = new ProductViewModelBuilder($saleThreshold);

            $items = [];
            foreach ($provider->fetchElements() as $row) {
                $items[] = $builder->build($row);
            }

            $this->arResult['ITEMS']    = $items;
            $this->arResult['CURRENCY'] = $this->arParams['CURRENCY'];
            $this->endResultCache();
        }

        $this->IncludeComponentTemplate();
    }

    /**
     * @param mixed $value
     *
     * @return float|null
     */
    private static function normalizeSaleThreshold(mixed $value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        $float = filter_var($value, FILTER_VALIDATE_FLOAT);
        if ($float === false) {
            return null;
        }

        return is_finite((float)$float)
            ? (float)$float
            : null;
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    private static function normalizeCurrency(mixed $value): string
    {
        $currency = is_string($value)
            ? trim($value)
            : '';
        if ($currency !== '') {
            return strtoupper($currency);
        }

        $fromSettings = (string)Option::get('sale', 'default_currency', '');

        if ($fromSettings !== '') {
            return strtoupper($fromSettings);
        }

        return 'RUB';
    }
}
