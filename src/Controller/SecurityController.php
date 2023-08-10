<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login', methods: ['GET', 'POST'])]
    public function login(AuthenticationUtils $authenticationUtils) : Response {
        return $this->render('security/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout() {
       // Déconnecte l'utilisateur
    }

    // Page d'inscription
    #[Route('/registration', name: 'app_registration', methods: ['GET', 'POST'])]
    public function registration(Request $request, EntityManagerInterface $manager, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user->setRoles(['ROLE_USER']);
        $user->setCreatedAt(DateTimeImmutable::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s')));
        $formRegistration = $this->createForm(RegistrationType::class, $user);

        $formRegistration->handleRequest($request);
        
        if($formRegistration->isSubmitted()  && $formRegistration->isValid()) {
            $user = $formRegistration->getData();
            $plainPassword = $user->getPassword();

            $hashedPassword  = $passwordHasher->hashPassword(
                    $user,
                    $plainPassword
            );

            $user->setPassword($hashedPassword);

            $this->addFlash(
                'success',
                'Votre compte a bien été créé'
            );

            $manager->persist($user);
            $manager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('security/registration.html.twig', [
            'form' => $formRegistration->createView(),
        ]);
    }
}
