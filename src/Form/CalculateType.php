<?php

namespace App\Form;

use App\Entity\Calculate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CalculateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('norm', TextType::class, [
                'label' => 'Оклад в тенге'
            ])
            ->add('isTaxDeduction', CheckboxType::class, [
                'label' => 'Имеется ли налоговый вычет 1 МЗП?',
                'required' => false
            ])
            ->add('normOfDays', IntegerType::class,[
                'label' => 'Норма дней в месяц',
                'data' => 22,
                'attr' => [
                    'min' => 1,
                    'max' => 31,
                ]
            ])
            ->add('workedOfDays', IntegerType::class,[
                'label' => 'Отработанное количество дней',
                'attr' => [
                    'min' => 1,
                    'max' => 31,
                ]
            ])
            ->add('month', ChoiceType::class, [
                'label' => 'Календарный месяц',
                'choices' => $this->getMonths(),
            ])
            ->add('year', ChoiceType::class, [
                'label' => 'Календарный год',
                'choices' => $this->getYears()
            ])
            ->add('isRetired', CheckboxType::class, [
                'label' => 'Является ли сотрудник пенсионером?',
                'required' => false
            ])
            ->add('disabledGroup', ChoiceType::class, [
                'label' => 'Является ли сотрудник инвалидом',
                'choices' => [
                    'Не является инвалидом' => 0,
                    'инвалиды от общего заболевания' => 1,
                    'инвалиды из числа военнослужащих срочной службы' => 2,
                    'инвалиды из числа военнослужащих (кроме военнослужащих срочной службы)' => 3,
                    'инвалидность которых наступила вследствие ранения, контузии, увечья, заболевания, полученных при прохождении воинской службы' => 4,
                    'инвалиды вследствие чрезвычайных экологических ситуаций' => 5,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Calculate::class,
        ]);
    }

    private function getDays(): array
    {
        $days = range(1, 31);

        return array_combine($days, $days);
    }

    private function getYears(): array
    {
        $years = range((int) date('Y') - 2, (int) date('Y') + 2);

        return array_combine($years, $years);
    }

    private function getMonths(): array
    {
        $months = range(1, 12);

        return array_combine($months, $months);
    }
}
