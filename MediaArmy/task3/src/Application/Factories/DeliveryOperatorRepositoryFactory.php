<?php

declare(strict_types=1);

namespace MediaArmy\Application\Factories;

use MediaArmy\Application\Delivery\DeliveryOperatorRepository;
use MediaArmy\Domain\Delivery\Operators\PerKgDeliveryOperator;
use MediaArmy\Domain\Delivery\Operators\ThresholdDeliveryOperator;

final class DeliveryOperatorRepositoryFactory
{
    /**
     * @return DeliveryOperatorRepository
     */
    public static function make(): DeliveryOperatorRepository
    {
        return new DeliveryOperatorRepository([
            ThresholdDeliveryOperator::DELIVERY_OPERATOR_ID => new ThresholdDeliveryOperator(),
            PerKgDeliveryOperator::DELIVERY_OPERATOR_ID     => new PerKgDeliveryOperator(),
        ]);
    }
}
