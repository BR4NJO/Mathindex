<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\NewThematicType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Thematic;
use App\Repository\ThematicRepository;

class ThematicAdminController extends AbstractController
{
    #[Route('/thematic/admin', name: 'app_thematic_admin')]
    public function index(Request $request, ThematicRepository $thematicRepository): Response
    {

        $form = $this->createForm(NewThematicType::class);
    

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        }
    

        $thematics = $thematicRepository->findAll(); 
    

        return $this->render('thematic_admin/index.html.twig', [
            'form' => $form->createView(),
            'thematics' => $thematics, 
        ]);
    }

    #[Route('/thematic/new', name: 'app_thematic_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $thematic = new Thematic();
        $form = $this->createForm(NewThematicType::class, $thematic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($thematic);
            $entityManager->flush();

            return $this->redirectToRoute('app_thematic_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('thematic_admin/new.html.twig', [
            'thematics' => $thematic,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/thematic/{id}/edit', name: 'app_thematic_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Thematic $thematic, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewThematicType::class, $thematic);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_thematic_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('thematic_admin/edit.html.twig', [
            'thematic' => $thematic,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/thematic/{id}', name: 'app_thematic_delete', methods: ['POST'])]
    public function delete(Request $request, Thematic $thematic, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$thematic->getId(), $request->request->get('_token'))) {
            $entityManager->remove($thematic);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_thematic_admin', [], Response::HTTP_SEE_OTHER);
    }
}
