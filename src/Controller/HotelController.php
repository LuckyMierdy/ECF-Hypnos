<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Form\HotelType;
use App\Repository\HotelRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PHPUnit\Util\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('admin/hotel')]
class HotelController extends AbstractController
{
  #[Route('/', name: 'app_hotel_index', methods: ['GET'])]
  public function index(HotelRepository $hotelRepository): Response
  {
    return $this->render('hotel/index.html.twig', [
      'hotels' => $hotelRepository->findAll(),
    ]);
  }

  #[Route('/new', name: 'app_hotel_new', methods: ['GET', 'POST'])]
  public function new(Request $request, HotelRepository $hotelRepository): Response
  {
    $hotel = new Hotel();
    $form = $this->createForm(HotelType::class, $hotel);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      /** @var UploadedFile $hotelFile */
      $hotelFile = $form->get('imageFile')->getData();

      if ($hotelFile) {
        $newFilename = uniqid() . '.' . $hotelFile->guessExtension();

        try {
          $hotelFile->move(
            $this->getParameter('kernel.project_dir') . '/public/uploads',
            $newFilename
          );
        } catch (FileException $e) {
          $this->addFlash('error', $e->getMessage());
        }

        $hotel->setHotelImage($newFilename);
      }

      $hotelRepository->add($hotel);
      return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('hotel/new.html.twig', [
      'hotel' => $hotel,
      'form' => $form,
    ]);
  }

  #[Route('/{id}', name: 'app_hotel_show', methods: ['GET'])]
  public function show(Hotel $hotel): Response
  {
    return $this->render('hotel/show.html.twig', [
      'hotel' => $hotel,
    ]);
  }

  #[Route('/{id}/edit', name: 'app_hotel_edit', methods: ['GET', 'POST'])]
  public function edit(Request $request, Hotel $hotel, HotelRepository $hotelRepository): Response
  {
    $form = $this->createForm(HotelType::class, $hotel);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      /** @var UploadedFile $hotelFile */
      $hotelFile = $form->get('imageFile')->getData();

      if ($hotelFile) {
        $newFilename = $hotel->getHotelImage();

        try {
          $hotelFile->move(
            $this->getParameter('kernel.project_dir') . '/public/uploads',
            $newFilename
          );
        } catch (FileException $e) {
          $this->addFlash('error', $e->getMessage());
        }

        $hotel->setHotelImage($newFilename);
      }

      $hotelRepository->add($hotel);
      return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('hotel/edit.html.twig', [
      'hotel' => $hotel,
      'form' => $form,

    ]);
  }

  #[Route('/{id}', name: 'app_hotel_delete', methods: ['POST'])]
  public function delete(Request $request, Hotel $hotel, HotelRepository $hotelRepository): Response
  {
    if ($this->isCsrfTokenValid('delete' . $hotel->getId(), $request->request->get('_token'))) {
      $filename = $hotel->gethotelImage();
      $hotelRepository->remove($hotel);

      $fs = new Filesystem();
      $fs->remove($this->getParameter('kernel.project_dir') . '/public/uploads/' . $filename);
    }

    return $this->redirectToRoute('app_hotel_index', [], Response::HTTP_SEE_OTHER);
  }
}
