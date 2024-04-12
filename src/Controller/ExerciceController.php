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
    
        $form = $this->createForm(ExerciseSearchFormType::class, [
            'method' => 'POST',
        ]);
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

    
            $exercise = new Exercise();
            $exercise->setThematic($data['thematic']);
            $exercise->setKeywords($data['keywords']);
            $exercise->setClassroom($data['classroom']);
    
            // Appeler la méthode de recherche dans votre repository Exercise
            $exercises = $entityManager->getRepository(Exercise::class)->search($exercise); 
    
            // Rediriger vers la route 'exercice' avec les résultats de la recherche
            return $this->redirectToRoute('exerciceFound', [
                'exercises' => $exercises]
            );
        }
        
        $nbExerciceTrouver = 0;

        return $this->render('public/exercice.html.twig', [
            'form' => $form,
            'nbExerciceTrouver' => $nbExerciceTrouver,
        ]);
    }

    #[Route('/exerciceFound', name: 'exerciceFound')]
    public function exerciceFound(Request $request, EntityManagerInterface $entity, array $exercises)
    {

        $form = $this->createForm(ExerciseSearchFormType::class,[
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $data = $form->getData();

            $exercice = new Exercise();
            $exercise->setClassroom($data['thematic']);
            $exercise->setClassroom($data['Keywords']);
            $exercise->setClassroom($data['classroom']);

            // Appeler la méthode de recherche dans votre repository Exercise
            $exercises = $this->getDoctrine()
                ->getRepository(Exercise::class)
                ->search($exerice);

            // Rediriger vers la route 'exercice' avec les résultats de la recherche
            return $this->redirectToRoute('exerciceFound', ['exercises' => $exercises]);
        }

        $nbExerciceTrouver = count($exercises);

        return $this->render('public/exercice.html.twig', [
            'form' => $form,
            'exercises' => $exercises,
            'nbExerciceTrouver' => $nbExerciceTrouver,
        ]);
    }

}
