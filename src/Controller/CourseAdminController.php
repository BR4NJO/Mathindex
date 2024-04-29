<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\NewCourseType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Course;
use App\Repository\CourseRepository;

class CourseAdminController extends AbstractController
{


    #[Route('/course/admin', name: 'app_course_admin')]
    public function index(Request $request, CourseRepository $courseRepository): Response
    {

        $form = $this->createForm(NewCourseType::class);
    

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        }
    

        $courses = $courseRepository->findAll(); 
    

        return $this->render('course_admin/index.html.twig', [
            'form' => $form->createView(),
            'courses' => $courses, 
        ]);
    }


    #[Route('/course/new', name: 'app_course_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $course = new Course();
        $form = $this->createForm(NewCourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($course);
            $entityManager->flush();

            return $this->redirectToRoute('app_course_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('course_admin/new.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/course/{id}/edit', name: 'app_course_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Course $course, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewCourseType::class, $course);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_course_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('course_admin/edit.html.twig', [
            'course' => $course,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/course/{id}', name: 'app_course_delete', methods: ['POST'])]
    public function delete(Request $request, Course $course, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$course->getId(), $request->request->get('_token'))) {
            $entityManager->remove($course);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_course_admin', [], Response::HTTP_SEE_OTHER);
    }
}
