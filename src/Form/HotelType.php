<?php

namespace App\Form;

use App\Entity\Hotel;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HotelType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name', TextType::class, [
        'label' => 'Nom :'
      ])

      ->add('city', TextType::class, [
        'label' => 'Ville :'
      ])

      ->add('adress', TextType::class, [
        'label' => 'Adresse :'
      ])

      ->add('description', TextareaType::class, [
        'label' => 'description :',
        'label_attr' => [
          'class' => 'align-top'
        ]
      ])

      ->add('manager_name', TextType::class, [
        'label' => 'Nom du gérant :',
      ])

      ->add('imageFile', FileType::class, [
        'label' => 'Hotel image :',
        'mapped' => false,
        'required' => false,

        'constraints' => [
          new File([
            'maxSize' => '4096k',
            'mimeTypes' => [
              'image/jpeg',
              'image/png',
              'image/jpg',
            ],
            'mimeTypesMessage' => 'Seuls les Jpeg et Png sont acceptés',
          ]),
        ],
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Hotel::class,
    ]);
  }
}
