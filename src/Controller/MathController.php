<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Exercise;
use App\Trait\ObjsToArrayTrait;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MathController extends AbstractController
{
    use ObjsToArrayTrait;

    #[Route('/math', name: 'math')]
    public function math(EntityManagerInterface $entity, Request $request): Response
    {
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

        return $this->render("public/math.html.twig", [
            "data" => $data,
            "exercicespaginate" => $exercicespaginate,
            'exercices' => $exercices,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }

    #[Route('/math/page/{id}', name: 'mathShow', methods:'GET')]
    public function mathShow(EntityManagerInterface $entity, string $id, Request $request): Response
    {
        // pagination
        $count = $entity->getRepository(Exercise::class)->count([]);
        $countPerPage = 4;

        $currentPage = $id;
        $countPages = ceil($count/$countPerPage);

        // On vérifie que la page renseignée dans l'url est valide, si ce n'est pas le cas on génère une 404.
        if ($currentPage > $countPages || $currentPage <= 0) {
            throw $this->createNotFoundException();
        }

        $exercices = $entity->getRepository(Exercise::class)->paginate($currentPage, $countPerPage);

        // tableau: nouveau exerice
        $data = $entity->getRepository(Exercise::class)->findAll();
        $data = $this->ObjsToArray($data);

        // tableau avec pagination
        $exercicespaginate = $this->ObjsToArray($exercices);

        return $this->render("public/math.html.twig", [
            "data" => $data,
            "exercicespaginate" => $exercicespaginate,
            'countPages' => $countPages,
            'currentPage' => $currentPage,
        ]);
    }
}
