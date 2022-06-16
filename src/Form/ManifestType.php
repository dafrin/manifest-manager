<?php

namespace App\Form;

use App\Entity\Bundle;
use App\Entity\Manifest;
use App\Entity\Platform;
use App\Repository\BundleRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\RouterInterface;

class ManifestType extends AbstractType
{
    private RouterInterface $router;

    public function __construct(RouterInterface $router)
    {
        $this->router = $router;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $pid = 0;
        $platform = $options['data']->getPlatform();
        if ($platform instanceof Platform)
        {
            $pid = $options['data']->fixPlatformID($platform->getId());
        }

        $builder
            ->add('platform', EntityType::class, [
                'class' => Platform::class,
                'label' => 'ID Платформы',
                'choice_label' => 'name',
            ])
            ->add('bundles', EntityType::class, [
                'class' => Bundle::class,
                'expanded' => true,
                'label' => 'Бандлы',
                'label_html' => true,
                'choice_label' => function (Bundle $bundle) {
                    $url = $this->router->generate('bundle-edit', ['id' => $bundle->getId()]);
                    return sprintf('%s [<a href="%s"> %s</a> ]', $bundle->getName(), $url, $bundle->getId());
                },
                'multiple' => true,
                'query_builder' => function (BundleRepository $er) use ($pid) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.name', 'ASC')
                        ->where('u.platform=' . $pid);
                }
            ])
            ->add('game_version', TextType::class, ['label' => 'Game Version (перечисление через пробел)'])
            ->add('save', SubmitType::class, ['label' => 'Сохранить', 'attr' => ['class' => 'btn-primary btn']]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Manifest::class,
        ]);
    }
}
