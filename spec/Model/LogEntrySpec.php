<?php

namespace spec\Setono\SyliusLogEntryPlugin\Model;

use PhpSpec\ObjectBehavior;
use Psr\Log\LogLevel;
use Setono\SyliusLogEntryPlugin\Model\LogEntry;
use Setono\SyliusLogEntryPlugin\Model\LogEntryInterface;

class LogEntrySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(LogEntry::class);
    }

    function it_implements_interface(): void
    {
        $this->shouldImplement(LogEntryInterface::class);
    }

    function its_level_is_info_by_default(): void
    {
        $this->getLevel()->shouldReturn(LogLevel::INFO);
    }

    function its_level_can_be_changed_to_error(): void
    {
        $this->setLevel(LogLevel::ERROR);
    }

    function it_throws_exception_if_any_other_value_is_given_as_level(): void
    {
        $this
            ->shouldThrow(\InvalidArgumentException::class)
            ->during('setLevel', ['foo'])
        ;
    }

    function it_sets_message(): void
    {
        $this->setMessage('bla');
        $this->getMessage()->shouldReturn('bla');
    }

    function it_sets_notify_customer(): void
    {
        $this->setNotifyCustomer(true);
        $this->isNotifyCustomer()->shouldReturn(true);
    }
}
