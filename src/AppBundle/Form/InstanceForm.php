<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class InstanceForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['placeholder' => 'Enter instance name without spaces']])
            ->add('contactPerson', TextType::class, ['attr' => ['placeholder' => 'Enter name of contact person ']])
            ->add('licenseRate', MoneyType::class, ['attr' => ['placeholder' => 'Enter license rate'],'currency' => 'USD'])
            ->add('licenseIssued', NumberType::class, ['attr' => ['placeholder' => 'Enter license issued']]);
            //->add('submit', SubmitType::class, ['attr' => [ 'class' => 'btn btn-success text-right'],'label' => 'Create']);


    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_instance';
    }
}
