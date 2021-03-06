<?php

namespace App\Controller;

use App\Entity\Room;

use App\Form\RoomType;
use App\Repository\RoomRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use PHPUnit\Util\Filesystem;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('manager/room')]
class RoomController extends AbstractController
{
  #[Route('/', name: 'app_room_index', methods: ['GET', 'POST'])]
  public function index(RoomRepository $roomRepository, UserRepository $userRepository): Response
  {
    return $this->render('room/index.html.twig', [
      'rooms' => $roomRepository->findAll(),
      'users' => $userRepository->findAll(),
    ]);
  }

  #[Route('/new', name: 'app_room_new', methods: ['GET', 'POST'])]
  public function new(Request $request, RoomRepository $roomRepository, UserRepository $userRepository): Response
  {
    $room = new Room();
    $form = $this->createForm(RoomType::class, $room);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      /** @var UploadedFile $roomFile */
      $roomFile = $form->get('imageFile')->getData();

      if ($roomFile) {
        $newFilename = uniqid() . '.' . $roomFile->guessExtension();

        try {
          $roomFile->move(
            $this->getParameter('kernel.project_dir') . '/public/uploads',
            $newFilename
          );
        } catch (FileException $e) {
          $this->addFlash('error', $e->getMessage());
        }

        $room->setRoomImage($newFilename);
      }

      $roomRepository->add($room);
      return $this->redirectToRoute('app_room_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('room/new.html.twig', [
      'room' => $room,
      'form' => $form,
      'users' => $userRepository->findAll(),
    ]);
  }

  #[Route('/{id}', name: 'app_room_show', methods: ['GET'])]
  public function show(Room $room): Response
  {
    return $this->render('room/show.html.twig', [
      'room' => $room,
    ]);
  }

  #[Route('/{id}/edit', name: 'app_room_edit', methods: ['GET', 'POST'])]
  public function edit(Request $request, Room $room, RoomRepository $roomRepository, UserRepository $userRepository): Response
  {
    $form = $this->createForm(RoomType::class, $room);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      /** @var UploadedFile $roomFile */
      $roomFile = $form->get('imageFile')->getData();

      if ($roomFile) {
        $newFilename = $room->getRoomImage();

        try {
          $roomFile->move(
            $this->getParameter('kernel.project_dir') . '/public/uploads',
            $newFilename
          );
        } catch (FileException $e) {
          $this->addFlash('error', $e->getMessage());
        }

        $room->setRoomImage($newFilename);
      }

      $roomRepository->add($room);
      return $this->redirectToRoute('app_room_index', [], Response::HTTP_SEE_OTHER);
    }

    return $this->renderForm('room/edit.html.twig', [
      'room' => $room,
      'form' => $form,
      'users' => $userRepository->findAll(),

    ]);
  }

  #[Route('/{id}', name: 'app_room_delete', methods: ['POST'])]
  public function delete(Request $request, Room $room, RoomRepository $roomRepository): Response
  {
    if ($this->isCsrfTokenValid('delete' . $room->getId(), $request->request->get('_token'))) {
      $filename = $room->getRoomImage();
      $roomRepository->remove($room);


      $fs = new Filesystem();
      $fs->remove($this->getParameter('kernel.project_dir') . '/public/uploads/' . $filename);
    }

    return $this->redirectToRoute('app_room_index', [], Response::HTTP_SEE_OTHER);
  }
}
