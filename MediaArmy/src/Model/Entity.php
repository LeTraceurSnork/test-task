<?php

declare(strict_types=1);

namespace MediaArmy\Model;

final readonly class Entity
{
    /**
     * @param string      $name
     * @param string|null $img_src
     * @param string|null $description
     */
    public function __construct(
        private string $name,
        private ?string $img_src = null,
        private ?string $description = null
    ) {
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getImage(): ?string
    {
        return $this->img_src;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
}
