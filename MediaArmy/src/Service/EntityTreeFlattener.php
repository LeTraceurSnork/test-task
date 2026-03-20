<?php

declare(strict_types=1);

namespace MediaArmy\Service;

use MediaArmy\Model\Entity;

final class EntityTreeFlattener
{
    /**
     * @param array<int, Entity|array> $nodes
     *
     * @return array<int, Entity>
     */
    public function flatten(array $nodes): array
    {
        $result = [];

        foreach ($nodes as $node) {
            if ($node instanceof Entity) {
                $result[] = $node;
                continue;
            }

            if (is_array($node)) {
                $result = array_merge($result, $this->flatten($node));
            }
        }

        return $result;
    }
}
