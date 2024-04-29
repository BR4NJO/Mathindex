<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use App\Form\MailerType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;

class MailerController extends AbstractController
{
    #[Route('/mail', name: 'mail')]
    public function sendEmail(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createForm(MailerType::class);
    
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $data = $form->getData();

            $address = $data['email'];
            $content = $data['content'];

            $email = (new Email())
                ->from($address)
                ->to('aquasword60@gmail.com')
                ->subject('Demande Mot de Passe oublié')
                ->text($content);

            $mailer->send($email);

            return $this->redirectToRoute('home');
        }

        return $this->render("public/mail.html.twig", [
            'controller_name' => 'MailerController',
            'formulaire' => $form
        ]
        );
    }
}