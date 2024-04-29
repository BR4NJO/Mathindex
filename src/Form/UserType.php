<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('last_name', null,[
                'label' => 'Nom de famille',
            ])
            ->add('first_name', null,[
                'label' => 'Prénom',
            ])
            ->add('email')
            ->add('password', null, [
                'label' => 'Mot de passe',
                'mapped' => false,
            ])
            ->add('role', ChoiceType::class,[
                'choices' => [
                    'Administateur' => 'admin',
                    'Enseignant' => 'Enseignant',
                    'Eleve' => 'Eleve',
                ],
                'placeholder' => 'Choisissez une option',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
