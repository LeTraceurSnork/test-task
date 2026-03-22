<?php

declare(strict_types=1);

namespace MediaArmy\Domain\Delivery;

use InvalidArgumentException;

/**
 * Масса посылки в килограммах (> 0).
 */
class Package
{
    /**
     * @var float Вес посылки
     */
    private float $weight;

    /**
     * @param float $weight
     *
     * @throws InvalidArgumentException
     */
    public function __construct(float $weight)
    {
        $this->setWeight($weight);
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     *
     * @throws InvalidArgumentException
     * @return void
     */
    private function setWeight(float $weight): void
    {
        if ($weight <= 0.0 || !is_finite($weight)) {
            throw new InvalidArgumentException('Масса должна быть положительным конечным числом.');
        }
        $this->weight = $weight;
    }
}
