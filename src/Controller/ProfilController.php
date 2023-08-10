<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Form\ProfilType;
use App\Repository\ExerciceRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil')]
    public function index(
    Request $request, 
    EntityManagerInterface $entityManagerInterface, 
    UserRepository $userRepository,
    ?int $id = null
    ): Response
    {
        $currentUser = $userRepository->find($id);
        return $this->render('profil/profil.html.twig', [
            'user' => $currentUser
        ]);
    }
    // #[Security("is_granted('ROLE_USER') and user === currentUser")]
    #[Route('/profil/update/{id}', name: 'update.profil')]
    #[IsGranted('ROLE_USER')]
    public function updateProfil(
    Request $request, 
    EntityManagerInterface $entityManagerInterface, 
    UserRepository $userRepository,
    ?int $id = null
    ) {
        $user = $userRepository->findOneBy(['id' => $id]);
        $userProfil = new Profil();
        $formProfil = $this->createForm(ProfilType::class, $userProfil);
        $formProfil->handleRequest($request);

        if ($formProfil->isSubmitted() && $formProfil->isValid()) {
            $userProfil = $formProfil->getData();

            $userProfil->setScore($userProfil->getScore());
            $entityManagerInterface->persist($userProfil);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('app_profil', ['id' => $currentUser->getId()]);
        } 
        return $this->render('profil/update-profil.html.twig', [
            'form' => $formProfil->createView()
        ]);
    }
}
