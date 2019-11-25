<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Repository;

use Doctrine\ORM\QueryBuilder;
use Sylius\Component\Resource\Repository\RepositoryInterface;

interface LogEntryRepositoryInterface extends RepositoryInterface
{
    /**
     * @param string|int|mixed $id
     */
    public function createByOwnerIdQueryBuilder($id): QueryBuilder;
}
