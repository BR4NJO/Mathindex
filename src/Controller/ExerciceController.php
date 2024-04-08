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
    public function home(Request $request, EntityManagerInterface $entityManager)
    {
        $exerciseRepository = $entityManager->getRepository(Exercise::class);

        // Récupérer les 3 exercices les plus récents
        $recentExercises = $exerciseRepository->findBy([], ['id' => 'DESC'], 3);

        $form = $this->createForm(ExerciseSearchFormType::class, [
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Traitement lorsque le formulaire est soumis et valide
            // Redirection vers une autre route par exemple
            return $this->redirectToRoute('exerciceFound', ['id' => $id]);
        }

        // Vous pouvez compter le nombre d'exercices trouvés ici si nécessaire
        $nbExerciceTrouver = count($recentExercises);

        return $this->render('public/exercice.html.twig', [
            'recentExercises' => $recentExercises,
            'form' => $form->createView(),
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
