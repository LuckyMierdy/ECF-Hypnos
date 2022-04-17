<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use App\Repository\RoomRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hotel/catalogue')]
class HotelCatalogueController extends AbstractController
{
  #[Route('/', name: 'app_hotel_catalogue_index', methods: ['GET', 'POST'])]
  public function index(HotelRepository $hotelRepository, RoomRepository $roomRepository): Response
  {
    return $this->render('hotel_catalogue/index.html.twig', [
      'hotels' => $hotelRepository->findAll(),
      'rooms' => $roomRepository->findAll(),
    ]);
  }

  #[Route('/{id}', name: 'app_hotel_catalogue_show', methods: ['GET', 'POST'])]
  public function show(HotelRepository $hotelRepository, RoomRepository $roomRepository, Hotel $hotel): Response
  {
    return $this->render('hotel_catalogue/show.html.twig', [
      'hotel' => $hotel,
      'hotels' => $hotelRepository->findAll(),
      'rooms' => $roomRepository->findAll(),
    ]);
  }
}
