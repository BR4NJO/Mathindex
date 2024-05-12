<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\NewSkillType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Skill;
use App\Repository\SkillRepository;;

class SkillAdminController extends AbstractController
{
    #[Route('/skill/admin', name: 'app_skill_admin')]
    public function index(Request $request, SkillRepository $skillRepository): Response
    {

        $form = $this->createForm(NewSkillType::class);
    

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        }
    

        $skills = $skillRepository->findAll(); 

        return $this->render('skill_admin/index.html.twig', [
            'form' => $form->createView(),
            'skills' => $skills, 
        ]);
    }

    #[Route('/skill/new', name: 'app_skill_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $skill = new Skill();
        $form = $this->createForm(NewSkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($skill);
            $entityManager->flush();

            return $this->redirectToRoute('app_skill_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('skill_admin/new.html.twig', [
            'skills' => $skill,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/skill/{id}/edit', name: 'app_skill_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewSkillType::class, $skill);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_skill_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('skill_admin/edit.html.twig', [
            'skill' => $skill,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/skill/{id}', name: 'app_skill_delete', methods: ['POST'])]
    public function delete(Request $request, Skill $skill, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$skill->getId(), $request->request->get('_token'))) {
            $entityManager->remove($skill);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_classroom_admin', [], Response::HTTP_SEE_OTHER);
    }
}
