<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'login')]
    public function index(): Response
    {
        return $this->render('public/connexion.html.twig', [
            'controller_name' => 'ConnexionController',
        ]);
    }
}
