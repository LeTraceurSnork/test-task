<?php

declare(strict_types=1);

namespace Maslomart\Catalog;

use CIBlockElement;

final readonly class ProductListProvider
{
    /**
     * @param int $iblockId
     */
    public function __construct(
        private int $iblockId,
    ) {
    }

    /**
     * @return array
     */
    public function fetchElements(): array
    {
        $arSelect = ['ID', 'NAME', 'PROPERTY_PRICE'];
        $arFilter = [
            'IBLOCK_ID' => $this->iblockId,
            'ACTIVE'    => 'Y',
        ];

        $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        $out = [];

        while ($ob = $res->GetNextElement()) {
            $fields = $ob->GetFields();
            $price  = $this->normalizePrice($fields['PROPERTY_PRICE_VALUE'] ?? null);

            $out[] = [
                'id'    => (int)$fields['ID'],
                'name'  => (string)($fields['NAME'] ?? ''),
                'price' => $price,
                'raw'   => $fields,
            ];
        }

        return $out;
    }

    /**
     * @param mixed $value
     *
     * @return float|null
     */
    private function normalizePrice(mixed $value): ?float
    {
        if (is_array($value)) {
            $value = $value[0] ?? null;
        }
        if ($value === null || $value === '') {
            return null;
        }
        $normalized = str_replace([' ', ','], ['', '.'], (string)$value);

        return is_numeric($normalized)
            ? (float)$normalized
            : null;
    }
}
