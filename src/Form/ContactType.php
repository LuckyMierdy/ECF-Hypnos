<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('firstname', TextType::class, [
        'label' => 'Prénom :',
      ])
      ->add('lastname', TextType::class, [
        'label' => 'Nom :',
      ])
      ->add('email', TextType::class, [
        'label' => 'Email :',
      ])
      ->add('subject', ChoiceType::class, [
        'label' => 'Sujet :',
        'choices' => [
          '' => null,
          'Je souhaite poser une réclamation' => 'problem 1',
          'Je souhaite commander un service supplémentaire' => 'problem 2',
          'Je souhaite en savoir plus sur une suite' => 'problem 3',
          'J’ai un souci avec cette application' => 'problem 4',
        ]
      ])
      ->add('description', TextareaType::class, [
        'label' => 'description :',
        'label_attr' => [
          'class' => 'align-top'
        ]
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      // Configure your form options here
    ]);
  }
}
