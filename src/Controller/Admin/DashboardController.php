<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use App\Entity\User;
use App\Entity\Exercice;
use App\Entity\Achievement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class DashboardController extends AbstractDashboardController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
       return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Start404');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Exercices');
        yield MenuItem::linkToCrud('Exercices', 'fa-regular fa-rectangle-list', Exercice::class);

        yield MenuItem::section('Users');
        yield MenuItem::linkToCrud('Users', 'fa-solid fa-user', User::class);

        yield MenuItem::section('Achievements');
        yield MenuItem::linkToCrud('Achievements', 'fa-solid fa-medal', Achievement::class);

    }
}
