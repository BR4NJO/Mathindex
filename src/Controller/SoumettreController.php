<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

use Doctrine\ORM\EntityManagerInterface;

use App\Form\NewExerciseType;
use App\Entity\Exercise;
use App\Entity\File;

class SoumettreController extends AbstractController
{
    public $m;
    public function __construct(EntityManagerInterface $m) {
        $this->m = $m;
    }

    #[Route('/soumettre', name: 'soumettre')]
    public function soumettre1(Request $r): Response
    {
        $exercise = new Exercise();

        $form = $this->createForm(NewExerciseType::class, $exercise, [
            "validation_groups" => ['part1']
        ]);
        $form->handleRequest($r);

        $errors = [];
        if ($form->isSubmitted() && $form->isValid() && $r->request->get('page') >= 1) {
            if ($exercise->getDifficulty() == 0) {
                $errors[] = 'difficulty';
            }
            if ($exercise->getDuration() == 0) {
                $errors[] = 'duration';
            }
            if (empty($exercise->getSkills()->getValues())) {
                $errors[] = 'skills';
            }

            if (empty($errors)) {
                return $this->soumettre2($r, $exercise);
            }
        }

        return $this->render('public/soumettre-1.html.twig', [
            'form' => $form,
            'errors' => $errors,
        ]);
    }

    //

    public function soumettre2(Request $r, Exercise $exercise): Response
    {
        $form = $this->createForm(NewExerciseType::class, $exercise, [
            "validation_groups" => ['part2']
        ]);
        $form->handleRequest($r);

        $errors = [];
        if ($form->isSubmitted() && $form->isValid() && $r->request->get('page') >= 2) {
            if ($exercise->getSource() !== null && $exercise->getSourceName() !== null && $exercise->getSourceInformation() !== null) {
                $exercise->setProposedByType(null);
                $exercise->setProposedByFirstName(null);
                $exercise->setProposedByLastName(null);

                return $this->soumettre3($r, $exercise);
            }
            else if ($exercise->getProposedByType() !== null && $exercise->getProposedByFirstName() !== null && $exercise->getProposedByLastName() !== null) {
                $exercise->setSource(null);
                $exercise->setSourceName(null);
                $exercise->setSourceInformation(null);

                return $this->soumettre3($r, $exercise);
            }
            else {
                $errors[] = 'either';
            }
        }

        return $this->render('public/soumettre-2.html.twig', [
            'form' => $form,
            'errors' => $errors,
        ]);
    }

    //

    public function soumettre3(Request $r, Exercise $exercise): Response
    {
        $form3 = $this->createForm(NewExerciseType::class, $exercise, [
            "validation_groups" => ['part3']
        ]);
        $form3->handleRequest($r);

        $errors = [];
        if ($form3->isSubmitted() && $form3->isValid() && $r->request->get('page') >= 3) {
            if ($exercise->getExerciseFile() === null) {
                $errors[] = 'file_1_nofile';
            }
            else if ($exercise->getExerciseFile()->getImageFile() === null) {
                $errors[] = 'file_1_badfile';
            }
            if ($exercise->getCorrectionFile() === null) {
                $errors[] = 'file_2_nofile';
            }
            else if ($exercise->getCorrectionFile()->getImageFile() === null) {
                $errors[] = 'file_2_badfile';
            }
            if (empty($errors)) {
                $exercise->getExerciseFile()->setName("MathIndex");
                $exercise->getExerciseFile()->setOriginalName("MathIndex");
                $exercise->getExerciseFile()->setExtension("MathIndex");
                $exercise->getExerciseFile()->setSize(1);

                $exercise->getCorrectionFile()->setName("MathIndex");
                $exercise->getCorrectionFile()->setOriginalName("MathIndex");
                $exercise->getCorrectionFile()->setExtension("MathIndex");
                $exercise->getCorrectionFile()->setSize(1);

                $this->m->persist($exercise);
                $this->m->flush();
            }
        }

        return $this->render('public/soumettre-3.html.twig', [
            'form' => $form3,
            'errors' => $errors,
        ]);
    }
}
