<?php

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CreateUserForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, ['attr' => ['placeholder' => 'Enter your name', 'class' => 'form-control border-input'], 'label' => 'Username: '])
            ->add('fullName', TextType::class, ['attr' => ['placeholder' => 'Enter your fullName', 'class' => 'form-control border-input'], 'label' => 'fullName: '])
            ->add('email', EmailType::class, ['attr' => ['placeholder' => 'Please enter your email', 'class' => 'form-control border-input'], 'label' => 'E-mail: '])
            ->add('contactPhone', NumberType::class, ['attr' => ['placeholder' => 'Enter phone number in format +1(111)111-11-11','class' => 'form-control border-input'],'label' => 'Contact phone: '])
            ->add('domainName', TextType::class, ['attr' => ['placeholder' => 'Enter domain name for marketing agency', 'class' => 'form-control border-input'], 'label' => 'Domain name: '])
            ->add('fullName', TextType::class, ['attr' => ['placeholder' => 'Enter your fullName', 'class' => 'form-control border-input'], 'label' => 'fullName: '])
            ->add('primaryLanguage', ChoiceType::class, [
                'choices'  => array(
                    'English' => 'english',
                    'Germany' => 'germany',
                    'Ukraine' => 'ukrainian',
                ),])
            ->add('photo', FileType::class, ['label' => 'Avatars: '])
            ->add('Create', SubmitType::class);


    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
            'allow_extra_fields' => true,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_user';
    }
}
