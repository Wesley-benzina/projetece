<?php

namespace App\Form;

use App\Entity\Project;
use App\Entity\Tache;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TacheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', TextType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Tâche à réaliser ...']))
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En cours' => 1,
                    'Terminé' => 0
                ],
                'attr' => ['class' => 'input w-full border mt-2']
            ])
            ->add('project', EntityType::class, [
                'invalid_message' => 'Le projet n\'a pas été trouvé',
                'class' => Project::class,
                'multiple' => false,
                'choice_label' => 'firstname',
                'attr' => ['class' => 'input w-full border mt-2']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tache::class,
        ]);
    }
}
