<?php

declare(strict_types=1);

namespace spec\Setono\SyliusLogEntryPlugin\Model;

use InvalidArgumentException;
use PhpSpec\ObjectBehavior;
use Psr\Log\LogLevel;
use Setono\SyliusLogEntryPlugin\Model\LogEntry;
use Setono\SyliusLogEntryPlugin\Model\LogEntryInterface;

class LogEntrySpec extends ObjectBehavior
{
    public function let(): void
    {
        $this->beAnInstanceOf(get_class(new class() extends LogEntry {
        }));
    }

    public function it_is_initializable(): void
    {
        $this->shouldHaveType(LogEntry::class);
    }

    public function it_implements_interface(): void
    {
        $this->shouldImplement(LogEntryInterface::class);
    }

    public function its_level_is_info_by_default(): void
    {
        $this->getLevel()->shouldReturn(LogLevel::INFO);
    }

    public function its_level_can_be_changed_to_error(): void
    {
        $this->setLevel(LogLevel::ERROR);
    }

    public function it_throws_exception_if_any_other_value_is_given_as_level(): void
    {
        $this
            ->shouldThrow(InvalidArgumentException::class)
            ->during('setLevel', ['foo'])
        ;
    }

    public function it_sets_message(): void
    {
        $this->setMessage('bla');
        $this->getMessage()->shouldReturn('bla');
    }
}
