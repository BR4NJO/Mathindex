<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;
use App\Trait\ObjsToArrayTrait;

class HomeController extends AbstractController
{
    use ObjsToArrayTrait;
    #[Route('/', name: 'home')]
    public function home(EntityManagerInterface $m)
    {
        $data = $m->getRepository(Exercise::class)->findAll();
        $data = $this->ObjsToArray($data);
        return $this->render("public/home.html.twig", [
            "data" => $data,
        ]);
    }
}
