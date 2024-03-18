<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Exercise;
use App\Entity\Thematic;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExerciseSearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('difficulty')
            ->add('classroom', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'id',
            ])
            ->add('thematic', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'id',
            ])
        ;
    }
}
