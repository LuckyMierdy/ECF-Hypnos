<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ManagerRegistrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin')]
class ManagerRegistrationController extends AbstractController
{
  #[Route('/managerRegistration', name: 'app_manager_registration')]
  public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
  {
    $user = new User();
    $form = $this->createForm(ManagerRegistrationType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
      // encode the plain password
      $user->setPassword(
        $userPasswordHasher->hashPassword(
          $user,
          $form->get('plainPassword')->getData()
        )
      );

      $user->setRoles([
        //'ROLE_ADMIN',
        'ROLE_MANAGER'
      ]);
      $entityManager->persist($user);
      $entityManager->flush();
      // do anything else you need here, like send an email

      return $this->redirectToRoute('app_hotel_index');
    }
    return $this->render('manager_registration/index.html.twig', [
      'managerRegistration' => $form->createView(),
    ]);
  }
}
