<?php

namespace App\Form;

use App\Entity\Room;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RoomType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name')
      ->add('description')
      ->add('price')
      ->add('manager_name')
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
