<?php

declare(strict_types=1);

namespace MediaArmy\Domain\Delivery\Operators;

use MediaArmy\Domain\Delivery\Package;

/**
 * Перевозчик 2: 100 ₽ за каждый килограмм.
 */
final class PerKgDeliveryOperator extends AbstractDeliveryOperator implements DeliveryOperatorInterface
{
    /**
     * @inheritdoc
     */
    public const string DELIVERY_OPERATOR_ID = 'per_kg_operator';

    /**
     * @inheritdoc
     */
    public const string DELIVERY_OPERATOR_NAME = 'Оператор "Беру за килограмм"';

    /**
     * Цена за килограмм
     */
    private const float PRICE_PER_KG = 100.0;

    /**
     * @param Package $package
     *
     * @return float
     */
    public function calculate(Package $package): float
    {
        return $package->getWeight() * self::PRICE_PER_KG;
    }
}
