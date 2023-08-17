<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Form\ProfilType;
use DateTimeImmutable;
use App\Repository\ExerciceRepository;
use App\Repository\UserRepository;
use App\Repository\ProfilRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ProfilController extends AbstractController
{
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    #[Route('/profil/{id}', name: 'app_profil')]
    public function index(
    Request $request, 
    EntityManagerInterface $entityManagerInterface, 
    UserRepository $userRepository,
    ProfilRepository $profilRepository,
    ?int $id = null
    ): Response
    {
        $currentUser = $userRepository->find($id);
        $profil = $profilRepository->findOneBy(['user' => $id]);
        
        
        return $this->render('profil/profil.html.twig', [
            'user' => $currentUser,
            'profil' => $profil
        ]);
    }

    #[Route('/profil/update/{id}', name: 'update.profil')]
    #[IsGranted('ROLE_USER')]
    public function updateProfil(
    Request $request, 
    EntityManagerInterface $entityManagerInterface, 
    UserRepository $userRepository,
    ProfilRepository $profilRepository,
    ?int $id = null
    ) {
        $user = $userRepository->findOneBy(['id' => $id]);
        $userProfil = $profilRepository->findOneBy(['user' => $id]);
        
        if(!$userProfil) {
           $userProfil = new Profil(); 
           $userProfil->setCreatedAt(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        }
        
        $formProfil = $this->createForm(ProfilType::class, $userProfil);
        $formProfil->handleRequest($request);

        if ($formProfil->isSubmitted() && $formProfil->isValid()) {
            $userProfil = $formProfil->getData();
            $userProfil->setUpdatedAt(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
            if($userProfil->getIdUser() === null) {
               $userProfil->setIdUser($user); 
            }
            
            if($userProfil->getScore() === null) {
                $userProfil->setScore(0);
            }

            // dd($userProfil);
            $entityManagerInterface->persist($userProfil);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
        } 
        return $this->render('profil/update-profil.html.twig', [
            'form' => $formProfil->createView()
        ]);
    }
}
