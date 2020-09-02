<?php

namespace App\Form;

use App\Entity\Devis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DevisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',  TextType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Nom ...']))
            ->add('linkto',  TextType::class, array('attr' => ['class' => 'input w-full border mt-2', 'placeholder' => 'Nom du projet']));
           /* ->add('linkto', EntityType::class, [
            'invalid_message' => 'Le projet n\'a pas été trouvé',
            'class' => Project::class,
            'multiple' => false,
            'choice_label' => 'name',
            'attr' => ['class' => 'input w-full border mt-2']*/
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Devis::class,
        ]);
    }
}
