<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use App\Trait\ObjsToArrayTrait;

// use App\Entity\User;  
use App\Entity\Exercise;
use App\Entity\User;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MyExercicesController extends AbstractController
{

    use ObjsToArrayTrait;

    #[Route('/myExercices', name: 'myExercices')]
    public function myExercices(EntityManagerInterface $entity, Request $request): Response
    {
        
        $user = $this->getUser();

        if (empty($user)){
            return $this->render("404.html.twig", []);
        }

        // Récupérer les exercices liés à l'utilisateur connecté
        $userExercices = $entity->getRepository(Exercise::class)->findBy(['user' => $user]);

        // Récupérer tous les exercices
        $allExercices = $entity->getRepository(Exercise::class)->findAll();

        // Fusionner les deux tableaux d'exercices
        $exercices = array_merge($userExercices, $allExercices);


        

        // pagination
        $count = $entity->getRepository(Exercise::class)->count([]);

        $countPerPage = 4;

        $currentPage = $request->query->getInt('page',1);
        $countPages = ceil($count/$countPerPage);

        // On vérifie que la page renseignée dans l'url est valide, si ce n'est pas le cas on génère une 404.
        if ($currentPage > $countPages || $currentPage <= 0) {
            throw $this->createNotFoundException();
        }

        $exercices = $entity->getRepository(Exercise::class)->paginate($currentPage, $countPerPage);

        // tableau: nouveau exerice
        $data = $entity->getRepository(Exercise::class)
            ->findBy([], ['id' => 'DESC'], 3);
        $data = $this->ObjsToArray($data);

        // tableau avec pagination
        $exercicespaginate = $this->ObjsToArray($exercices);
        dd($exercicespaginate);

        return $this->render("public/myexercices.html.twig", [
            "data" => $data,
            "exercicespaginate" => $exercicespaginate,
            'exercices' => $exercices,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }
}
