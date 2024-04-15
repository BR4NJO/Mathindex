<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Entity\Thematic;
use App\Entity\Classroom;
use App\Form\ExerciseSearchFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Doctrine\ORM\EntityManagerInterface;

class ExerciceController extends AbstractController
{
    #[Route('/exercice', name: 'exercice')]
    public function exercice(Request $request, EntityManagerInterface $entityManager)
    {
    
        $form = $this->createForm(ExerciseSearchFormType::class, null, [
            'method' => 'GET',
        ]);
    
        $form->handleRequest($request);

        $exercises = [];
    
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Call the search method in Exercise repository
            $exercises = $entityManager->getRepository(Exercise::class)->search($data);

            $nbExerciceTrouver = count($exercises);
        }
    
        return $this->render('public/exercice.html.twig', [
            'form' => $form,
            'nbExerciceTrouver' => $nbExerciceTrouver ?? 0,
            'exercises' => $exercises,
        ]);
    }
}
