<?php

declare(strict_types=1);

namespace Maslomart\Catalog;

final readonly class ProductViewModelBuilder
{
    /**
     * @param float|null $salePriceThreshold
     */
    public function __construct(
        private ?float $salePriceThreshold,
    ) {
    }

    /**
     * @param array $item
     *
     * @return array{
     *     id: int,
     *     name: string,
     *     price: float|null,
     *     is_sale: bool,
     * }
     */
    public function build(array $item): array
    {
        $price = $item['price'] ?? null;
        $price = $price === null ? null : (float) $price;
        $isSale = $price !== null
            && $this->salePriceThreshold !== null
            && $price <= $this->salePriceThreshold;

        return [
            'id'      => (int)$item['id'],
            'name'    => $item['name'],
            'price'   => $price,
            'is_sale' => $isSale,
        ];
    }
}
