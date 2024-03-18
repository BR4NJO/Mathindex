<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Exercise;
use App\Entity\File;
use App\Entity\Skill;
use App\Entity\Source;
use App\Entity\Thematic;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('chapter')
            ->add('keywords')
            ->add('difficulty')
            ->add('duration')
            ->add('proposed_by_type')
            ->add('proposed_by_first_name')
            ->add('proposed_by_last_name')
            ->add('source_name')
            ->add('source_information')
            ->add('source', EntityType::class, [
                'class' => Source::class,
                'choice_label' => 'id',
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('exercise_file', EntityType::class, [
                'class' => File::class,
                'choice_label' => 'id',
            ])
            ->add('correction_file', EntityType::class, [
                'class' => File::class,
                'choice_label' => 'id',
            ])
            ->add('classroom', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'id',
            ])
            ->add('thematic', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'id',
            ])
            ->add('skills', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
