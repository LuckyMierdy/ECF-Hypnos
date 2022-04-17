<?php

namespace App\Form;

use App\Entity\Hotel;
use SebastianBergmann\Type\TypeName;
use Symfony\Component\DomCrawler\Field\FormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HotelType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('name', null, array('label' => 'Nom :'))
      ->add('city', null, array('label' => 'Ville :'))
      ->add('adress', null, array('label' => 'Adresse :'))
      ->add('description', null, array('label' => 'Description :'))
      ->add('manager_name', null, array('label' => 'Nom du gérant :'))
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
