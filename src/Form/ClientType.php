<?php

namespace App\Form;

use App\Entity\Client;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Email']))
            ->add('firstname', TextType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Prénom...']))
            ->add('lastname', TextType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Nom']))
            ->add('phone', TextType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Téléphone']))
            ->add('firme', TextType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Entreprise']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Client::class,
        ]);
    }
}
