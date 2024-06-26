<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
    ->add('email', EmailType::class, [
        'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Votre adresse email'
        ],
        'label' => 'Adresse email *',
    ])  
    ->add('pseudo', TextType::class, [
        'attr' => [
            'class' => 'form-control',
            'placeholder' => 'Votre pseudo'
        ],
        'label' => 'Pseudo *',
    ])
    ->add('agreeTerms', CheckboxType::class, [
        'mapped' => false,
        'constraints' => [
            new IsTrue([
                'message' => 'Vous devez accepter nos conditions.',
            ]),
        ],
        'label' => 'Accepter les conditions',
    ])
    ->add('plainPassword', RepeatedType::class, [
        'type' => PasswordType::class,
        'invalid_message' => 'Les champs de mot de passe doivent correspondre.',
        'options' => ['attr' => ['class' => 'password-field']],
        'required' => true,
        'first_options'  => [
            'label' => 'Mot de passe *', 
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Votre mot de passe'
            ]
        ],
        'second_options' => [
            'label' => 'Répéter le mot de passe *', 
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Répétez votre mot de passe'
            ]
        ],
        'mapped' => false,
        'constraints' => [
            new NotBlank([
                'message' => 'Veuillez entrer un mot de passe',
            ]),
            new Length([
                'min' => 6,
                'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères',
                'max' => 4096,
            ]),
        ],
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
