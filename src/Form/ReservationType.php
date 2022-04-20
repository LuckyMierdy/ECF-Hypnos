<?php

namespace App\Form;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Entity\Room;
use App\Repository\RoomRepository;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ReservationType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {

    $builder
      ->add('hotel', EntityType::class, [
        'class' => Hotel::class,
        'label' => 'Établissement :',
        'choice_label' => function ($hotel) {
          return $hotel->getName();
        },
        'placeholder' => 'Choisissez un établissement',
        'query_builder' => function (HotelRepository $hotelRepository) {
          return $hotelRepository->createQueryBuilder('h')->orderBy('h.name', 'ASC');
        },

      ])

      ->add('room', EntityType::class, [
        'class' => Room::class,
        'label' => 'Chambre :',
        'choice_label' => function ($room) {
          return $room->getName();
        },
        'placeholder' => 'Choisissez une chambre',
        'query_builder' => function (RoomRepository $roomRepository) {
          return $roomRepository->createQueryBuilder('r')->orderBy('r.name', 'ASC');
        },
      ])
      ->add('checkin', DateType::class, [
        'label' => 'Date d\'arrivée :',
        'widget' => 'single_text',
      ])
      ->add('checkout', DateType::class, [
        'label' => 'Date de départ :',
        'widget' => 'single_text',
      ]);
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Reservation::class,
    ]);
  }
}
