<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use App\Entity\Exercise;
use Doctrine\ORM\EntityManagerInterface;
use App\Controller\BaseController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(EntityManagerInterface $m)
    {
        return $this->render("public/home.html.twig");
=======
        $data = $m->getRepository(Exercise::class)->findAll();
        $data = BaseController::ObjsToArray($data);
        return $this->render("public/home.html.twig", [
            "data" => $data,
        ]);
    }
}
