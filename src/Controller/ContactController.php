<?php

namespace App\Controller;

use App\Entity\Horaire;
use App\Form\ContactType;
use App\Repository\HoraireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(ManagerRegistry $doctrine, HoraireRepository $HoraireRepository, MailerInterface $mailer, Request $request): Response
    {
        $HoraireRepository = $doctrine->getRepository(Horaire::class);
        $Horaires = $HoraireRepository ->findAll();

        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();

        $nom = $data['nom'];
        $prenom = $data['prenom'];
        $email = $data['email'];
        $telephone = $data['telephone'];
        $message = $data['message'];

        $email = (new Email())
        ->from($email)
        ->to('you@example.com')
        ->subject('Formulaire de contact')
        ->text($message)
        ->html('<p>Bonjour à toute l\'équipe ! Vous avez reçu une demande de contact de ' . $nom . ' ' . $prenom . '. Vous pouvez le rappeler sur son 
        numéro ' . $telephone . '. Voici son message : ' . $message . ' </p>');

         $mailer->send($email);

         $this->addFlash('success', 'Merci ! L\'équipe V. Parrot vous recontactera dans les meilleurs délais !');
         return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'ContactController',
            'Horaires' => $Horaires,
            'form' => $form->createView(),
        ]);
    }
}
