<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\NewSourceType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Source;
use App\Repository\SourceRepository;

class SourceAdminController extends AbstractController
{
    #[Route('/source/admin', name: 'app_source_admin')]
    public function index(Request $request, SourceRepository $sourceRepository): Response
    {
        $form = $this->createForm(NewSourceType::class);
    

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        }
    

        $sources = $sourceRepository->findAll(); 
    

        return $this->render('source_admin/index.html.twig', [
            'form' => $form->createView(),
            'sources' => $sources, 
        ]);
    }

    #[Route('/source/new', name: 'app_source_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $source = new Source();
        $form = $this->createForm(NewSourceType::class, $source);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($source);
            $entityManager->flush();

            return $this->redirectToRoute('app_source_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('source_admin/new.html.twig', [
            'sources' => $source,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/source/{id}/edit', name: 'app_source_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Source $source, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(NewSourceType::class, $source);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_source_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('source_admin/edit.html.twig', [
            'source' => $source,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/source/{id}', name: 'app_source_delete', methods: ['POST'])]
    public function delete(Request $request, Source $source, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$source->getId(), $request->request->get('_token'))) {
            $entityManager->remove($source);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_source_admin', [], Response::HTTP_SEE_OTHER);
    }
}
