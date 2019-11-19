<?php

declare(strict_types=1);

namespace Setono\LogEntryBundle\Form\Type;

use function Safe\sprintf;
use Setono\LogEntryBundle\Entity\LogEntry;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class LogEntryType extends AbstractType
{
    /** @var string */
    protected $dataClass;

    /** @var string[] */
    protected $validationGroups = [];

    public function __construct(string $dataClass, array $validationGroups = [])
    {
        $this->dataClass = $dataClass;
        $this->validationGroups = $validationGroups;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('level', ChoiceType::class, [
                'label' => 'setono_log_entry.form.log_entry.level',
                'choices' => LogEntry::getLevels(),
                'choice_label' => static function (string $level): string {
                    return sprintf('setono_log_entry.form.log_entry.levels.%s', $level);
                },
            ])
            ->add('message', TextareaType::class, [
                'label' => 'setono_log_entry.form.log_entry.message',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => $this->dataClass,
            'validation_groups' => $this->validationGroups,
        ]);
    }
}
