<?php

namespace App\Form;

use App\Entity\Room;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class RoomType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name', TextType::class, [
        'label' => 'Nom :'
      ])
      ->add('description', TextareaType::class, [
        'label' => 'description :',
        'label_attr' => [
          'class' => 'align-top'
        ]
      ])
      ->add('price', TextType::class, [
        'label' => 'Prix:'
      ])
      ->add('manager_name', EntityType::class, [
        'class' => User::class,
        'label' => 'Nom du gérant :',
        'choice_label' => function ($User) {
          $UserFullname = $User->getFirstname() . ' ' . $User->getLastname();

          return $UserFullname;
        },
        'placeholder' => 'Choisissez un gérant',
      ])
      ->add('imageFile', FileType::class, [
        'label' => 'Hotel image',
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
      'data_class' => Room::class,
    ]);
  }
}
