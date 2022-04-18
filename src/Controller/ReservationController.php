<?php

namespace App\Controller;

use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
  #[Route('/reservation', name: 'app_reservation')]
  public function index(): Response
  {
    $form = $this->createForm(ReservationType::class);
    return $this->renderForm('reservation/index.html.twig', [
      'controller_name' => 'ReservationController',
      'reservation' => $form,
    ]);
  }
}
