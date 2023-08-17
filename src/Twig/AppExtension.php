<?php

namespace App\Twig;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use App\Repository\ProfilRepository;
use App\Class\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class AppExtension extends AbstractExtension
{
    private $entityManager;
    private $security;
    private $profilRepository;

    public function __construct(EntityManagerInterface $entityManager, Security $security, ProfilRepository $profilRepository)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
        $this->profilRepository = $profilRepository;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getUserInfo', [$this, 'getUserInfo']),
        ];
    }

    public function getUserInfo() {
        $currentUser = $this->security->getUser();
        $profilUser = $this->profilRepository->findOneBy(['user' => $currentUser->getId()]);

        if ($currentUser->getProfil() !== null && $currentUser->getProfil()->getImageName() !== null) {
          
            return [
                'profilUser' => $profilUser,
                'user_pic' => $currentUser->getProfil()->getImageName(),
                'user_pseudo' => $currentUser->getProfil()->getPseudo(),
            ];
        }
        return null;
    }
}

?>