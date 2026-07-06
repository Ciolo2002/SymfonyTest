<?php

namespace App\Form;

use App\Entity\Captain;
use App\Entity\Starship;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StarshipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('class')
            ->add('status')
            ->add('arrivedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('captain', EntityType::class, [
                'class' => Captain::class,
                'choice_label' => 'id',
            ])
            ->add('checkbox', null, [
                'mapped' => false,
                'label' => 'I agree to the terms and conditions',
                'constraints' => [
                    new \Symfony\Component\Validator\Constraints\IsTrue([
                        'message' => 'You must agree to the terms and conditions.',
                    ]),
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Create Starship',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Starship::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'starship', //without id, it won't generate the token
        ]);
    }
}