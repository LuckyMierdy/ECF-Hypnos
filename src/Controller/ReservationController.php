<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends AbstractController
{
  #[Route('/reservation', name: 'app_reservation', methods: ['GET', 'POST'])]
  public function index(Request $request, ReservationRepository $reservationRepository): Response
  {
    $reservation = new Reservation();
    $form = $this->createForm(ReservationType::class, $reservation);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      $reservationRepository->add($reservation);

      return $this->redirectToRoute('app_reservation');
    }

    return $this->render('reservation/index.html.twig', [
      'controller_name' => 'ReservationController',
      'reservation' => $form->createView(),
    ]);
  }
}
