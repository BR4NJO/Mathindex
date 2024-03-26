<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Exercise;
use App\Trait\PaginationTrait;
use App\Trait\ObjsToArrayTrait;
use App\Repository\ExerciceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;

class MathController extends AbstractController
{
    use PaginationTrait;
    use ObjsToArrayTrait;

    #[Route('/math', name: 'math')]
    public function math(EntityManagerInterface $entity): Response
    {
        $data = $entity->getRepository(Exercise::class)->findAll();
        $data = $this->ObjsToArray($data);
        return $this->render("public/math.html.twig", [
            "data" => $data,
        ]);
    }

    #[Route('/math/{id}', name: 'mathShow', methods:'GET')]
    public function mathShow(EntityManagerInterface $entity, string $id): Response
    {
        $data = $entity->getRepository(Exercise::class)->findAll();
        return $this->render("public/math.html.twig", [
            "data" => $data,
        ]);
    }
}
