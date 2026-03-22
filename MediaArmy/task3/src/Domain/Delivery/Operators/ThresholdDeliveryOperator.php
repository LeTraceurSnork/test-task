<?php

declare(strict_types=1);

namespace MediaArmy\Domain\Delivery\Operators;

use MediaArmy\Domain\Delivery\Package;

/**
 * Перевозчик 1: до 10 кг включительно — 100 ₽, свыше — 1000 ₽.
 */
final class ThresholdDeliveryOperator extends AbstractDeliveryOperator implements DeliveryOperatorInterface
{
    /**
     * @inheritdoc
     */
    public const string DELIVERY_OPERATOR_ID = 'threshold_operator';

    /**
     * @inheritdoc
     */
    public const string DELIVERY_OPERATOR_NAME = 'Оператор "До 10 кг и после"';

    /**
     * Пороговое значение
     */
    private const float THRESHOLD_KG = 10.0;

    /**
     * Цена "до" порогового значения
     */
    private const float PRICE_BELOW_THRESHOLD = 100.0;

    /**
     * Цена "после" порогового значения
     */
    private const float PRICE_ABOVE_THRESHOLD = 1000.0;

    /**
     * @param Package $package
     *
     * @return float
     */
    public function calculate(Package $package): float
    {
        return match (true) {
            $package->getWeight() <= self::THRESHOLD_KG => self::PRICE_BELOW_THRESHOLD,
            default                                     => self::PRICE_ABOVE_THRESHOLD,
        };
    }
}
