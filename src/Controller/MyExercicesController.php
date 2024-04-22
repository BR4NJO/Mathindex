<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

// use App\Entity\User;  
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
        // On récupére le nombre d'exercice étant lié au user
        $user = $entity->getRepository(Exercise::class)->findBy([],exercice);
        dd($user);

        // pagination
        $count = $entity->getRepository(Exercise::class)->count([]);

        $countPerPage = 4;

        $currentPage = $request->query->getInt('page',1);
        $countPages = ceil($count/$countPerPage);

        // On vérifie que la page renseignée dans l'url est valide, si ce n'est pas le cas on génère une 404.
        if ($currentPage > $countPages || $currentPage <= 0) {
            return $this->render("404.html.twig", []);
        }

        $exercices = $entity->getRepository(Exercise::class)->paginate($currentPage, $countPerPage);

        // tableau: nouveau exerice
        $data = $entity->getRepository(Exercise::class)
            ->findBy([], ['id' => 'DESC'], 3);
        $data = $this->ObjsToArray($data);

        // tableau avec pagination
        $exercicespaginate = $this->ObjsToArray($exercices);

        return $this->render("public/math.html.twig", [
            "data" => $data,
            "exercicespaginate" => $exercicespaginate,
            'exercices' => $exercices,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }
}
