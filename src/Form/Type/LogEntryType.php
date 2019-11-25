<?php

declare(strict_types=1);

namespace Setono\SyliusLogEntryPlugin\Form\Type;

use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use function Safe\sprintf;
use Setono\SyliusLogEntryPlugin\Model\LogEntry;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;

abstract class AbstractLogEntryType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('level', ChoiceType::class, [
                'label' => 'setono_sylius_log_entry.form.log_entry.level',
                'choices' => LogEntry::getLevels(),
                'choice_label' => static function (string $level): string {
                    return sprintf('setono_sylius_log_entry.form.log_entry.levels.%s', $level);
                },
            ])
            ->add('message', TextareaType::class, [
                'label' => 'setono_sylius_log_entry.form.log_entry.message',
            ])
        ;
    }
}
