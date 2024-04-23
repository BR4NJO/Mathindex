<?php

namespace App\Form;

use App\Entity\Classroom;
use App\Entity\Exercise;
use App\Entity\File;
use App\Entity\Skill;
use App\Entity\Source;
use App\Entity\Course;
use App\Entity\Thematic;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Form\FileType;

class NewExerciseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
            // Part 1
            ->add('name', null, [
                'label' => 'Nom de l\'exercice',
                'validation_groups' => ['part1'],
            ])
            ->add('chapter', null, [
                'label' => 'Chapitre',
                'validation_groups' => ['part1'],
            ])
            ->add('keywords', null, [
                'label' => 'Mots-clés',
                'validation_groups' => ['part1'],
            ])
            ->add('difficulty', null, [
                'label' => 'Difficulté',
                'validation_groups' => ['part1'],
            ])
            ->add('duration', null, [
                'label' => 'Durée (en heures)',
                'validation_groups' => ['part1'],
            ])
            ->add('course', EntityType::class, [
                'class' => Course::class,
                'choice_label' => 'name',
                'label' => 'Matière',
                'validation_groups' => ['part1'],
            ])
            ->add('classroom', EntityType::class, [
                'class' => Classroom::class,
                'choice_label' => 'name',
                'label' => 'Classe',
                'validation_groups' => ['part1'],
            ])
            ->add('thematic', EntityType::class, [
                'class' => Thematic::class,
                'choice_label' => 'name',
                'label' => 'Thématique',
                'validation_groups' => ['part1'],
            ])
            ->add('skills', EntityType::class, [
                'class' => Skill::class,
                'choice_label' => 'name',
                'expanded' => true,
                'multiple' => true,
                'label' => 'Compétences',
                'validation_groups' => ['part1'],
            ])

            // Part 2
            ->add('proposed_by_type', null, [
                'label' => 'Ou proposé par :',
                'validation_groups' => ['part2'],
                'required' => false,
            ])
            ->add('proposed_by_first_name', null, [
                'label' => 'Prénom :',
                'validation_groups' => ['part2'],
                'required' => false,
            ])
            ->add('proposed_by_last_name', null, [
                'label' => 'Nom :',
                'validation_groups' => ['part2'],
                'required' => false,
            ])
            ->add('source_name', null, [
                'label' => 'Nom de la source',
                'validation_groups' => ['part2'],
                'required' => false,
            ])
            ->add('source_information', null, [
                'label' => 'Informations sur la source',
                'validation_groups' => ['part2'],
                'required' => false,
            ])
            ->add('source', EntityType::class, [
                'class' => Source::class,
                'choice_label' => 'name',
                'label' => 'Source',
                'validation_groups' => ['part2'],
                'required' => false,
            ])            

            // Part 3
            ->add('exercise_file', FileType::class, [
                'label' => 'Fichier d\'exercice',
                'validation_groups' => ['part3'],
                'mapped' => false,
            ])
            ->add('correction_file', FileType::class, [
                'label' => 'Fichier de correction',
                'validation_groups' => ['part3'],
                'mapped' => false,
            ])

            ->add('submit', SubmitType::class, [
                'label' => 'Soumettre'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Exercise::class,
        ]);
    }
}
