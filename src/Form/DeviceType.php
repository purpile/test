<?php

namespace App\Form;

use App\Entity\Devices;
use App\Entity\DevicesType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DeviceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('model')
            ->add('brand')
            ->add('system')
            ->add('version')
            ->add('code')
            ->add('type', EntityType::class, [
                'class' => DevicesType::class,
                'choice_label' => function ($device) {
                    return sprintf('%s', $device->getName());
                }
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Zapisz'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devices::class,
        ]);
    }
}
