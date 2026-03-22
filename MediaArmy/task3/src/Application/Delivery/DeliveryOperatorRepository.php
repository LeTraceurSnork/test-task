<?php

declare(strict_types=1);

namespace MediaArmy\Application\Delivery;

use MediaArmy\Domain\Delivery\Operators\DeliveryOperatorInterface;
use MediaArmy\Exception\UnknownCarrierException;

/**
 * Хранит зарегистрированных перевозчиков по строковому ID и отдаёт контракт для расчёта.
 */
final readonly class DeliveryOperatorRepository
{
    /**
     * @param array<string, DeliveryOperatorInterface> $operators
     */
    public function __construct(
        private array $operators,
    ) {
    }

    /**
     * @param string $id
     *
     * @return DeliveryOperatorInterface
     */
    public function getById(string $id): DeliveryOperatorInterface
    {
        $operator = $this->operators[$id] ?? null;

        if ($operator === null) {
            throw new UnknownCarrierException(sprintf('Неизвестный перевозчик: %s', $id));
        }

        return $operator;
    }

    /**
     * @return DeliveryOperatorInterface[]
     */
    public function getList(): array
    {
        return $this->operators;
    }
}
