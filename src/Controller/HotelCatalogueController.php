<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PHPUnit\Util\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/hotel/catalogue')]
class HotelCatalogueController extends AbstractController
{
  #[Route('/', name: 'app_hotel_catalogue', methods: ['GET', 'POST'])]
  public function index(HotelRepository $hotelRepository): Response
  {
    $hotel = new hotel();
    $hotel->getName();
    return $this->render('hotel_catalogue/index.html.twig', [
      'hotels' => $hotelRepository->findAll(),
    ]);
  }
}
