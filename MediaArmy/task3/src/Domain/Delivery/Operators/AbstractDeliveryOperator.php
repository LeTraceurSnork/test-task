<?php

declare(strict_types=1);

namespace MediaArmy\Domain\Delivery\Operators;

abstract class AbstractDeliveryOperator implements DeliveryOperatorInterface
{
    /**
     * Уникальный строковый ID оператора
     */
    public const string DELIVERY_OPERATOR_ID = '';

    /**
     * Название оператора
     */
    public const string DELIVERY_OPERATOR_NAME = '';

    /**
     * @inheritdoc
     */
    public function getId(): string
    {
        return static::DELIVERY_OPERATOR_ID;
    }

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return static::DELIVERY_OPERATOR_NAME;
    }
}
