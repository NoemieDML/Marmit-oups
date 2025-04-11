<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Recette;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('img')
            ->add('name')
            ->add('description')
            ->add('nbrPersonne')
            ->add('timePreparation')
            ->add('difficulte')
            ->add('etapePreparation')
            ->add('dateCreation', null, [
                'widget' => 'single_text'
            ])
            ->add('dateModification', null, [
                'widget' => 'single_text'
            ])
            ->add('ingredients', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',
                'multiple' => true,        // ✅ permet la sélection multiple
                'expanded' => true,       // false = liste déroulante multiple / true = cases à cocher
                'required' => true,        // optionnel selon ton besoin
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
