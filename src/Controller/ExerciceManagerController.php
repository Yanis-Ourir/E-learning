<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Form\ExerciceType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceManagerController extends AbstractController
{
    #[Route('/exercice/manager/create', name: 'app_exercice_manager')]
    public function addExercice(Request $request, EntityManagerInterface $manager): Response
    {
        $exercice = new Exercice();
        $exercice->setCreatedAt(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $formExercice = $this->createForm(ExerciceType::class, $exercice);

        $formExercice->handleRequest($request);

        if ($formExercice->isSubmitted() && $formExercice->isValid()) {
            $exercice = $formExercice->getData();
            $manager->persist($exercice);
            $manager->flush();
        }
        return $this->render('exercice_manager/add-exercice.html.twig', [
            'form' => $formExercice->createView()
        ]);
    }
}
