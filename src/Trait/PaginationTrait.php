<?php

namespace App\Trait;

trait PaginationTrait {
    public function paginate(string $alias, int $page, int $itemsPerPage): array
    {
        return $this->createQueryBuilder($alias)
            ->setFirstResult(($page -1) * $itemsPerPage)
            ->setMaxResults($itemsPerPage)
            ->getQuery()
            ->execute();
    }
}