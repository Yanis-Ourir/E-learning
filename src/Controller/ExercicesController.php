<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Repository\ExerciceRepository;
use App\Repository\ToDoListRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExercicesController extends AbstractController
{
    #[Route('/exercices', name: 'app_exercices')]
    public function index(): Response
    {
        return $this->render('exercices/exercices.html.twig');
    }

    /**
     * $slug = ['HTML', 'CSS', 'JS']
     * Le slug est défini lors du clic de l'utilisateur, il affichera les informations correspondantes.
     */
    #[Route('/exercices/{slug}', name: 'app_category_exercice')]
    public function category(ExerciceRepository $exerciceRepository, ?string $slug = null): Response
    {
        $exercices = $exerciceRepository->findBy(['category' => $slug]);
        return $this->render('exercices/exercice-category.html.twig', [
            'exercices' => $exercices,
            'slug' => $slug
        ]);
    }

    #[Route('/exercices/{slugExercice}/{id}', name: 'app_repository_exercice')]
    public function exercice(ExerciceRepository $exerciceRepository, 
    ?int $id = null, 
    ?string $slugExercice = null
    ): Response
    {
        $exercice = $exerciceRepository->findOneBy(['id' => $id]);
        return $this->render('exercices/exercice-repository.html.twig', [
            'exercice'=> $exercice,
            'slug' => $slugExercice
        ]);
    }

    #[Route('/exercices/add-todolist/{id_exercice}/{id_toDoList}', name: 'add_to-do-list')]
    public function addExerciceInToDoList(
    ExerciceRepository $exerciceRepository,
    ToDoListRepository $toDoListRepository,
    EntityManagerInterface $entityManagerInterface,
    Request $request,
    ?int $id_exercice = null, 
    ?int $id_toDoList = null
    ) : Response {
        $exercice = $exerciceRepository->findOneBy(['id' => $id_exercice]);
        $toDoList = $toDoListRepository->findOneBy(['id' => $id_toDoList]);

        $toDoList->addExercice($exercice);

        $entityManagerInterface->persist($toDoList);
        $entityManagerInterface->flush();

        
        $route = $request->headers->get('referer');


        return $this->redirect($route);
    }
}
