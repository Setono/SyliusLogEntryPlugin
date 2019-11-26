<?php

declare(strict_types=1);

namespace Tests\Setono\SyliusLogEntryPlugin\Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Setono\SyliusLogEntryPlugin\Model\LogEntry;

/**
 * @ORM\Table(name="app__order_log_entry")
 * @ORM\Entity()
 */
class OrderLogEntry extends LogEntry
{
    /**
     * @var Order|null
     *
     * @ORM\ManyToOne(targetEntity="Tests\Setono\SyliusLogEntryPlugin\Application\Entity\Order", inversedBy="logEntries")
     * @ORM\JoinColumn(name="owner_id", nullable=false, onDelete="CASCADE")
     */
    protected $owner;

    /**
     * @var bool
     *
     * @ORM\Column(name="notify_customer", type="boolean")
     */
    protected $notifyCustomer = false;

    public function isNotifyCustomer(): bool
    {
        return $this->notifyCustomer;
    }

    public function setNotifyCustomer(bool $notifyCustomer): void
    {
        $this->notifyCustomer = $notifyCustomer;
    }
}
