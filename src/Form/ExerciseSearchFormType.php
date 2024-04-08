<?php

namespace App\Form;

use App\Entity\Exercise;
use App\Entity\Thematic;
use App\Entity\Classroom;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ExerciseSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('classroom', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'name',
            ])

            ->add('thematic', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'name',
            ])

            ->add('keywords')

            ->add('Rechercher', SubmitType::class,[

            ])
        ;
    }
}
