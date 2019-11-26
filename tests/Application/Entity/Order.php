<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLogEntryPlugin\Application\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Setono\SyliusLogEntryPlugin\Model\LogEntriesAwareInterface;
use Setono\SyliusLogEntryPlugin\Model\LogEntriesAwareTrait;
use Sylius\Component\Core\Model\Order as BaseOrder;

/**
 * @ORM\Table(name="sylius_order")
 * @ORM\Entity()
 */
class Order extends BaseOrder implements LogEntriesAwareInterface
{
    use LogEntriesAwareTrait {
        LogEntriesAwareTrait::__construct as private __logEntriesAwareTraitConstruct;
    }

    /**
     * @var Collection|OrderLogEntry[]
     *
     * @ORM\OneToMany(targetEntity="Tests\Setono\SyliusLogEntryPlugin\Application\Entity\OrderLogEntry", mappedBy="owner", orphanRemoval=true)
     */
    protected $logEntries;

    public function __construct()
    {
        parent::__construct();

        $this->__logEntriesAwareTraitConstruct();
    }
}
