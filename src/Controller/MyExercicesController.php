<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Trait\ObjsToArrayTrait;

use App\Entity\User;
use App\Entity\Exercise;  
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MyExercicesController extends AbstractController
{

    use ObjsToArrayTrait;

    #[Route('/mesexercices', name: 'myExercices')]
    public function myExercices(EntityManagerInterface $entity, Request $request): Response
    {
        // On récupére le nombre d'exercice étant lié au user
            $exercices = $entity->getRepository(Exercise::class)
            ->findBy(['user' => $user]);
            // dd($exerciseUser);

        // tableau avec pagination
        $exercicespaginate = $this->ObjsToArray($exercices);

        return $this->render("public/myexercices.html.twig", [
            'exercices' => $exercices,
        ]);
    }
}
