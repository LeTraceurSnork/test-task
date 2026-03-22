<?php

declare(strict_types=1);

namespace MediaArmy\Domain\Delivery\Operators;

use MediaArmy\Domain\Delivery\Package;

/**
 * Контракт перевозчика (стратегия расчёта).
 * Новый перевозчик — новый класс с этим интерфейсом.
 */
interface DeliveryOperatorInterface
{
    /**
     * Возвращает уникальный ID оператора
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Возвращает имя оператора
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Подсчитывает цену транспортировки посылки.
     *
     * @param Package $package
     *
     * @return float
     */
    public function calculate(Package $package): float;
}
