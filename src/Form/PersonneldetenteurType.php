<?php

namespace App\Form;

use App\Entity\direction;
use App\Entity\Personneldetenteur;
use App\Entity\voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PersonneldetenteurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matriculepersonnel',null,[
                'attr' => [
                    'class' => 'form-control',]
                    
                ],)
            ->add('nom',null,[
                'attr' => [
                    'class' => 'form-control',]
                    
                ],)
            ->add('prenom',null,[
                'attr' => [
                    'class' => 'form-control',]
                    
                ],)
            ->add('telephone',null,[
                'attr' => [
                    'class' => 'form-control',]
                    
                ],)
            ->add('adresse',null,[
                'attr' => [
                    'class' => 'form-control',]
                    
                ],)
            ->add('matriculevoiture', EntityType::class, [
                'class' => voiture::class,
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control',]
            ])
            ->add('abrdirection', EntityType::class, [
                'class' => direction::class,
                'choice_label' => 'id',
                'attr' => [
                    'class' => 'form-control',]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Personneldetenteur::class,
        ]);
    }
}
