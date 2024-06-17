<?php

namespace App\Form;

use App\Entity\chauffeur;
use App\Entity\direction;
use App\Entity\genre;
use App\Entity\marque;
use App\Entity\type;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;


class VoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matriculevoiture', null,[
            'attr' => [
                'class' => 'form-control',]
                
            ],)
            ->add('dateentrevoiture', DateType::class, [
                
                'widget' => 'single_text',
            ],)
            ->add('matriculechauffeur', EntityType::class, [
                'class' => chauffeur::class,
                'choice_label' => 'matriculechauffeur',
                'attr' => [
                    'class' => 'form-control',]
            ])
            ->add('type', EntityType::class, [
                'class' => type::class,
                'choice_label' => 'type',
                'attr' => [
                    'class' => 'form-control',]
            ])
            ->add('genre', EntityType::class, [
                'class' => genre::class,
                'choice_label' => 'genre',
                'attr' => [
                    'class' => 'form-control',]
            ])
            ->add('marque', EntityType::class, [
                'class' => marque::class,
                'choice_label' => 'marque',
                'attr' => [
                    'class' => 'form-control',]
            ])
            ->add('abrdirection', EntityType::class, [
                'class' => direction::class,
                'choice_label' => 'abrdirection',
                'attr' => [
                    'class' => 'form-control',]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Voiture::class,
        ]);
    }
}
