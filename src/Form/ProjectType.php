<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Project;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Nom du Projet ...']))
            ->add('progress', RangeType::class, ['data' => 50,'attr' => ['class' => 'range-slider__range', 'min' => 0,'max' => 100]])
            ->add('state', ChoiceType::class, [
                'choices' => [
                    'En cours' => 1,
                    'Terminé' => 0
                ],
                'attr' => ['class' => 'input w-full border mt-2']
            ])
            ->add('client', EntityType::class, [
                'invalid_message' => 'Le client n\'a pas été trouvé',
                'class' => Client::class,
                'multiple' => false,
                'choice_label' => 'firstname',
                'attr' => ['class' => 'input w-full border mt-2']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
