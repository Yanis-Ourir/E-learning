<?php

namespace App\Controller;

use App\Entity\Profil;
use App\Entity\User;
use App\Entity\ToDoList;
use App\Form\ProfilType;
use App\Form\ToDoListType;
use DateTimeImmutable;
use App\Repository\ExerciceRepository;
use App\Repository\UserRepository;
use App\Repository\ProfilRepository;
use App\Repository\ToDoListRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class ProfilController extends AbstractController
{
    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    #[Route('/profil/{id}', name: 'app_profil')]
    public function createToDoList(
    Request $request, 
    EntityManagerInterface $entityManagerInterface,
    User $currentUser,
    UserRepository $userRepository,
    ProfilRepository $profilRepository,
    ToDoListRepository $toDoListRepository,
    ?int $id = null
    ): Response
    {
        $user = $userRepository->find($id);
        $profil = $profilRepository->findOneBy(['user' => $id]);
        $toDoList = null;

        if($profil) {
            $toDoList = $toDoListRepository->findOneBy(['id' => $profil->getToDoList()]);

            if(!$toDoList) {
                $toDoList = new ToDoList();
                $profil->setToDoList($toDoList);
                $entityManagerInterface->persist($profil);   
               
            } 

           
        
           }
           
            $formList = $this->createForm(ToDoListType::class, $toDoList);
            $formList->handleRequest($request);

                if ($formList->isSubmitted() && $formList->isValid()) {
                    $toDoList = $formList->getData();
                
                    $entityManagerInterface->persist($toDoList);
                    $entityManagerInterface->flush();

                    return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
                }
          
        
        return $this->render('profil/profil.html.twig', [
            'user' => $user,
            'profil' => $profil,
            'toDoList' => $toDoList,
            'form' => $formList->createView()
        ]);
    }

    #[Route('/profil/delete/to-do-list/{id}', name: 'app_delete_tdl')]
    public function deleteToDoList( 
    EntityManagerInterface $entityManagerInterface,
    User $currentUser,
    UserRepository $userRepository,
    ProfilRepository $profilRepository,
    ToDoListRepository $toDoListRepository,
    ?int $id = null
    ) : Response {
        $user = $userRepository->find($id);
        $profil = $profilRepository->findOneBy(['user' => $id]);
        $toDoList = $profil->getToDoList();

        $entityManagerInterface->remove($toDoList);
        $entityManagerInterface->flush();        

        return $this->redirectToRoute('app_profil', ['id' => $user->getId()]);
    }

    #[Security("is_granted('ROLE_USER') and user === currentUser")]
    #[Route('/profil/update/{id}', name: 'update.profil')]
    public function updateProfil(
    Request $request, 
    EntityManagerInterface $entityManagerInterface, 
    User $currentUser,
    UserRepository $userRepository,
    ProfilRepository $profilRepository,
    ?int $id = null
    ) {
        $user = $userRepository->findOneBy(['id' => $id]);
        $userProfil = $profilRepository->findOneBy(['user' => $id]);
        
        if(!$userProfil) {
           $userProfil = new Profil(); 
           $userProfil->setCreatedAt(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
           $userProfil->setIdUser($user);
           $userProfil->setScore(0);
        }
        
        $formProfil = $this->createForm(ProfilType::class, $userProfil);
        $formProfil->handleRequest($request);

        if ($formProfil->isSubmitted() && $formProfil->isValid()) {
            $userProfil = $formProfil->getData();
            $userProfil->setUpdatedAt(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        
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
