<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Doctrine\ORM;

use Doctrine\ORM\QueryBuilder;
use Setono\SyliusLogEntryPlugin\Repository\LogEntryRepositoryInterface;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Webmozart\Assert\Assert;

class LogEntryRepository extends EntityRepository implements LogEntryRepositoryInterface
{
    public function createByOwnerIdQueryBuilder($id): QueryBuilder
    {
        Assert::scalar($id);

        return $this->createQueryBuilder('o')
            ->innerJoin('o.owner', 'owner')
            ->andWhere('owner.id = :id')
            ->setParameter('id', $id)
            ;
    }
}
