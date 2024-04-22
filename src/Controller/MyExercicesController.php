<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\User;
use App\Entity\Exercise;  
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MyExercicesController extends AbstractController
{

    #[Route('/myExercices', name: 'myExercices')]
    public function myExercices(EntityManagerInterface $entity, Request $request): Response
    {
        $user = $this->getUser();

        if (empty($user)){
            throw $this->createNotFoundException();
        }
     
        // On récupére le nombre d'exercice étant lié au user
            $exerciseUser = $entity->getRepository(Exercise::class)
            ->findBy(['user' => $user]);
            // dd($exerciseUser);

        return $this->render("public/myexercices.html.twig", [
            'exercices' => $exerciseUser,
        ]);
    }
}
