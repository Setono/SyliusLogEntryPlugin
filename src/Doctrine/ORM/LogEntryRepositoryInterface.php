<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface LogEntryRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string|int $id
     * @return QueryBuilder
     */
    public function createByOwnerIdQueryBuilder($id): QueryBuilder;
}
