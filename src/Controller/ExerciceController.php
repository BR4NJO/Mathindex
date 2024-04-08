<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

class ExerciceController extends AbstractController
{
    #[Route('/exercice', name: 'exercice')]
    public function home(EntityManagerInterface $entity)
    {
        return $this->render("public/exerice.html.twig", [
        ]);
    }
}
