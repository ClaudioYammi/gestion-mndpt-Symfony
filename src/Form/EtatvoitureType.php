<?php

namespace App\Form;

use App\Entity\direction;
use App\Entity\Etatvoiture;
use App\Entity\voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtatvoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numetat', null,[
                'attr' => [
                    'class' => 'form-control',]
                    
                ],)
            ->add('etat', null,[
                'attr' => [
                    'class' => 'form-control',]
                    
                ],)
            ->add('dateetat', null, [
                'widget' => 'single_text',
            ])
            ->add('abrdirection', EntityType::class, [
                'class' => direction::class,
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control',]
            ])
            ->add('matriculevoiture', EntityType::class, [
                'class' => voiture::class,
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control',]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Etatvoiture::class,
        ]);
    }
}
