<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\ConnexionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use App\Repository\UserRepository;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;


class ConnexionController extends AbstractController
{
  
    
    /*======================AJOUT ADMIN======================*/

    #[Route('/connexion', name: 'connexion')]
    public function connexion(AuthenticationUtils $utils): Response
    {

        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('public/connexion.html.twig', [
            'last_username'=> $lastUsername,
            'error'=> $error,
            'user'=>$this->getUser(),
        ]);
    }

    #[Route('/admin', name: 'admin')]
    public function admin(AuthenticationUtils $utils): Response
    {

        $error = $utils->getLastAuthenticationError();
        $lastUsername = $utils->getLastUsername();

        return $this->render('public/connexion.html.twig', [
            'last_username'=> $lastUsername,
            'error'=> $error,
            'user'=>$this->getUser(),
    #[Route('/connexion', name: 'login')]
    public function index(): Response
    {
        return $this->render('public/connexion.html.twig', [
            'controller_name' => 'ConnexionController',
        ]);
    }
}
