<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use Setono\SyliusLogEntryPlugin\Repository\LogEntryRepositoryInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;

class LogEntryRepository extends EntityRepository implements LogEntryRepositoryInterface
{
    public function createByOwnerIdQueryBuilder($id): QueryBuilder
    {
        return $this->createQueryBuilder('o')
            ->innerJoin('o.owner', 'owner')
            ->andWhere('owner.id = :id')
            ->setParameter('id', $id)
            ;
    }
}
