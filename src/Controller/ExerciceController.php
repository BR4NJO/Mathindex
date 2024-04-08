<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Entity\Thematic;
use App\Entity\Classroom;
use App\Form\ExerciseSearchFormType;
// use App\src\Repository\ExerciseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Doctrine\ORM\EntityManagerInterface;

class ExerciceController extends AbstractController
{
    #[Route('/exercice', name: 'exercice')]
    // ExerciseRepository $exerciceRepository
    public function home(Request $request, EntityManagerInterface $entity)
    {

        $form = $this->createForm(ExerciseSearchFormType::class,[
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted()){
                if($form->isValid()){
                    return $this->redirectToRoute('exerciceFound',[
                        'id' => $id,
                ]);
            }
        }

        $nbExerciceTrouver = 0;

        return $this->render('public/exercice.html.twig', [
            'form' => $form,
            'nbExerciceTrouver' => $nbExerciceTrouver,
        ]);
    }

    #[Route('/exercice/{id}', name:'exerciceFound')]
    public function exerciceFound(Request $request, EntityManagerInterface $entity, string $id)
    {
        $exercice = new Exercise();

        $form = $this->createForm(ExerciseSearchFormType::class,[
            'method' => 'POST',
        ]);

        $nbExerciceTrouver = 0;

        return $this->render('public/exercice.html.twig', [
            'form' => $form,
            'nbExerciceTrouver' => $nbExerciceTrouver,
        ]);
    }
}
