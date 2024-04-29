<?php

namespace App\Controller;

use App\Entity\Exercise;
use App\Form\ExerciseSearchFormType;
use App\Repository\ExerciseRepository;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExerciceAdminController extends AbstractController
{
    #[Route('/exercice/admin', name: 'app_exercice_admin')]
    public function index(Request $request, ExerciseRepository $exerciseRepository, EntityManagerInterface $entityManager): Response
    {
        $exercises = $exerciseRepository->findAll();
    

        $form = $this->createForm(ExerciseSearchFormType::class);
    

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
       
        }
    

        return $this->render('exercice_admin/index.html.twig', [
            'exercises' => $exercises,
            'form' => $form->createView(), 
        ]);
    }

    

    #[Route('/exercice/admin/user/{id}/edit', name: 'app_exercice_admin_edit', methods: ['GET', 'POST'])]
    public function editUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_exercice_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('exercice_admin/edit_user.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/exercice/admin/user/{id}', name: 'app_exercice_admin_delete', methods: ['POST'])]
    public function deleteUser(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_exercice_admin', [], Response::HTTP_SEE_OTHER);
    }
}
