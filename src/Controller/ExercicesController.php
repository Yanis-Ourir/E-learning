<?php

namespace App\Controller;

use App\Entity\Exercice;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExercicesController extends AbstractController
{
    #[Route('/exercices', name: 'app_exercices')]
    public function index(): Response
    {
        return $this->render('exercices/exercices.html.twig', [
            'controller_name' => 'ExercicesController',
        ]);
    }

    #[Route('/exercices/html', name: 'app_html_exercices')]
    public function html(ExerciceRepository $exerciceRepository, ?int $id): Response
    {
        $exercices = $exerciceRepository->findBy(['category' => 'HTML']);
        return $this->render('exercices/exercices-html.html.twig', [
            'exercices' => $exercices,
        ]);
    }

    #[Route('/exercices/css', name: 'app_css_exercices')]
    public function css(ExerciceRepository $exerciceRepository, ?int $id): Response
    {
        $exercices = $exerciceRepository->findBy(['category' => 'CSS']);
        return $this->render('exercices/exercices-css.html.twig', [
            'exercices' => $exercices,
        ]);
    }

    #[Route('/exercices/js', name: 'app_js_exercices')]
    public function javascript(): Response
    {
        $exercices = $exerciceRepository->findBy(['category' => 'JS']);
        return $this->render('exercices/exercices-js.html.twig', [
            'exercices' => $exercices,
        ]);
    }

    #[Route('/exercices/html/{id}', name: 'html.exercice')]
    public function exerciceHtml(ExerciceRepository $exerciceRepository, ?int $id = null): Response
    {
        $exercice = $exerciceRepository->findOneBy(['id' => $id]);
        return $this->render('exercices/repository-html.html.twig', [
            'exercice'=> $exercice,
        ]);
    }

    #[Route('/exercices/css/{id}', name: 'css.exercice')]
    public function exerciceCss(ExerciceRepository $exerciceRepository, ?int $id = null): Response
    {
        $exercice = $exerciceRepository->findOneBy(['id' => $id]);
        return $this->render('exercices/repository-css.html.twig', [
            'exercice'=> $exercice,
        ]);
    }

    #[Route('/exercices/js/{id}', name: 'js.exercices')]
    public function exerciceJs(?int $id = null): Response
    {
        return $this->render('exercices/repository-js.html.twig', [
            'controller_name' => 'ExercicesController',
        ]);
    }
}
