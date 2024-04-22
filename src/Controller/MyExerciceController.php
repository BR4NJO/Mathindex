<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Exercise;
use App\Trait\ObjsToArrayTrait;

class MyExerciceController extends AbstractController
{
    use ObjsToArrayTrait;

    #[Route('/my_exercices', name: 'my_exercices')]
    public function myexercice(EntityManagerInterface $entity, Request $request): Response
    {
        $exercices = $entity->getRepository(Exercise::class);

        // tableau: nouveau exerice
        $data = $entity->getRepository(Exercise::class)
            ->findBy([], ['id' => 'DESC'], 3);
        $data = $this->ObjsToArray($data);

        // tableau avec pagination
        $exercicespaginate = $this->ObjsToArray($exercices);

        return $this->render("public/myexercices.html.twig", [
            "data" => $data,
            "exercicespaginate" => $exercicespaginate,
            'exercices' => $exercices,
        ]);
    }
}
