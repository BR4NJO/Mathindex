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


class ConnexionController extends AbstractController
{
    private $session;

    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }
    
    /*======================AJOUT ADMIN======================*/

    #[Route('/connexion', name: 'connexion')]
    public function connexion(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(ConnexionType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $userId = $user->getId();

            
            $this->session->set('user_'.$userId, true);

            
            return $this->redirectToRoute('/admin');
        }

        return $this->render('public/connexion.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
