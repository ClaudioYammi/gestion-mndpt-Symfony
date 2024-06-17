<?php
namespace App\Form;
use App\Entity\Voiture;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class SearchFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
{
    $builder
        ->setMethod('GET')
        ->add('keyword', TextType::class, [
            'label' => 'Recherche',
            'required' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Rechercher une voiture',
            ],
        ])
        ->add('search', SubmitType::class, [
            'label' => 'Rechercher',
            'attr' => [
                'class' => 'btn btn-primary',
            ],
        ]);
}
}