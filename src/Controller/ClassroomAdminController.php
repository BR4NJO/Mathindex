<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\NewClassroomType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Classroom;
use App\Repository\ClassroomRepository;

class ClassroomAdminController extends AbstractController
{
    #[Route('/classroom/admin', name: 'app_classroom_admin')]
    public function index(Request $request, ClassroomRepository $courseRepository): Response
    {
        $form = $this->createForm(NewClassroomType::class);
    

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        }
    

        $classrooms = $courseRepository->findAll(); 
    

        return $this->render('classroom_admin/index.html.twig', [
            'form' => $form->createView(),
            'classrooms' => $classrooms, 
        ]);
    }

    #[Route('/classroom/new', name: 'app_classroom_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $classroom = new Classroom();
        $form = $this->createForm(NewClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($classroom);
            $entityManager->flush();

            return $this->redirectToRoute('app_course_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('classroom_admin/new.html.twig', [
            'classrooms' => $classroom,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/classroom/{id}/edit', name: 'app_classroom_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Classroom $classroom, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewClassroomType::class, $classroom);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_classroom_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('classroom_admin/edit.html.twig', [
            'classroom' => $classroom,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/classroom/{id}', name: 'app_classroom_delete', methods: ['POST'])]
    public function delete(Request $request, Classroom $classroom, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$classroom->getId(), $request->request->get('_token'))) {
            $entityManager->remove($classroom);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_classroom_admin', [], Response::HTTP_SEE_OTHER);
    }
}
