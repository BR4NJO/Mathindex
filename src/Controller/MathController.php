<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;
use App\Trait\ObjsToArrayTrait;

class MathController extends AbstractController
{
    use ObjsToArrayTrait;
    #[Route('/math', name: 'math')]
    public function math(EntityManagerInterface $m)
    {
        $data = $m->getRepository(Exercise::class)->findAll();
        $data = $this->ObjsToArray($data);
        return $this->render("public/math.html.twig", [
            "data" => $data,
        ]);
    }
}
