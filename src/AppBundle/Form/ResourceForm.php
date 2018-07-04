<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ResourceForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['attr' => ['placeholder' => 'Enter resource name']])
            ->add('type', NumberType::class, ['attr' => ['placeholder' => 'Enter CPU values']])
            ->add('type', NumberType::class, ['attr' => ['placeholder' => 'Enter RAM values']])
            ->add('type', NumberType::class, ['attr' => ['placeholder' => 'Enter HDD values']])
            ->add('submit', SubmitType::class);


    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_instance';
    }
}
