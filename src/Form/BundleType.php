<?php

namespace App\Form;

use App\Entity\Bundle;
use App\Entity\Platform;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BundleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Название'])
            ->add('tech_name', TextType::class, ['label' => 'Тех. название'])
            ->add('critical_data')
            ->add('is_local')
            ->add('is_low_definition')
            ->add('version')
            ->add('platform', EntityType::class, [
                'class' => Platform::class,
                'label' => 'Платформа',
                'choice_label' => 'name',
            ])
            ->add('save', SubmitType::class, ['label' => 'Сохранить', 'attr' => ['class' => 'btn-primary btn']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Bundle::class,
        ]);
    }
}
