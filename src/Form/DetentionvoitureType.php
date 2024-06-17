<?php

namespace App\Form;

use App\Entity\Detentionvoiture;
use App\Entity\personneldetenteur;
use App\Entity\voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DetentionvoitureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numdetention', null,[
                'attr' => [
                    'class' => 'form-control',]
                    
                ],)
            ->add('datedetention', null, [
                'widget' => 'single_text',
            ])
            ->add('matriculepersonnel', EntityType::class, [
                'class' => personneldetenteur::class,
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
            'data_class' => Detentionvoiture::class,
        ]);
    }
}
