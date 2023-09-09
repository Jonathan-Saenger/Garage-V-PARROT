<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Horaire;
use App\Form\ContactType;
use Doctrine\ORM\Mapping\Id;
use Symfony\Component\Mime\Email;
use App\Repository\AnnonceRepository;
use App\Repository\HoraireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VehiculesController extends AbstractController
{
    #[Route('/vehicules', name: 'app_vehicules')]
    public function index(ManagerRegistry $doctrine, HoraireRepository $HoraireRepository, AnnonceRepository $AnnonceRepository): Response
    {
        $HoraireRepository = $doctrine->getRepository(Horaire::class);
        $Horaires = $HoraireRepository ->findAll();

        $AnnonceRepository = $doctrine->getRepository(Annonce::class);
        $Annonces = $AnnonceRepository ->findall();

        return $this->render('vehicules/vehicules.html.twig', [
            'controller_name' => 'VehiculesController',
            'Horaires' => $Horaires,
            'Annonces' => $Annonces,
        ]);
    }

    #[Route('/vehicules/{id}', name: 'app_detail_vehicule')]
    public function detail($id, ManagerRegistry $doctrine, HoraireRepository $HoraireRepository, AnnonceRepository $AnnonceRepository, 
    Annonce $Annonce, Request $request, MailerInterface $mailer): Response
    {
        $HoraireRepository = $doctrine ->getRepository(Horaire::class);
        $Horaires = $HoraireRepository ->findAll();

        //Appel des véhicules depuis la base de données
        $AnnonceRepository = $doctrine ->getRepository(Annonce::class);
        $Annonce = $AnnonceRepository ->find($id);

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
        ->subject('Contact au sujet d\'une annonce')
        ->text($message)
        ->html('<p>Bonjour à toute l\'équipe ! Vous avez reçu une demande de contact de ' . $nom . ' ' . $prenom . '. Sa demande concerne le véhicule
        '.$Annonce->getTitre().'. Vous pouvez le rappeler sur son numéro ' . $telephone . '. Voici son message : ' . $message . ' </p>');

         $mailer->send($email);

         $this->addFlash('success', 'Merci ! L\'équipe V. Parrot vous recontactera dans les meilleurs délais !');
         return $this->redirectToRoute('app_vehicules');
        }

        return $this->render('vehicules/details.html.twig', [
            'controller_name' => 'VehiculesController',
            'Horaires' => $Horaires,
            'Annonce' => $Annonce,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/filtrer-annonces', name: 'app_filtrer_annonces', methods: ['GET'])]
    public function filtrerAnnonces(Request $request, AnnonceRepository $AnnonceRepository, UploaderHelper $uploaderHelper): JsonResponse
    {
        $anneeValeur = $request->query->get('annee');
        $prixValeur = $request->query->get('prix');
        $kilometrageValeur = $request->query->get('kilometrage');
    
        $annonceFiltre = $AnnonceRepository->findFiltre($anneeValeur, $prixValeur, $kilometrageValeur);
    
        $annoncesArray = [];
        foreach ($annonceFiltre as $annonce) {
            $imageFile = $annonce->getImageFile() ? $uploaderHelper->asset($annonce, 'imageFile') : '/images/annonce/' . $annonce->getImageFile();
    
            $annoncesArray[] = [
                'imageFile' => $imageFile,
                'titre' => $annonce->getTitre(),
                'infotechniques' => $annonce->getInfotechniques(),
                'annee' => $annonce->getAnnee(),
                'carburant' => $annonce->getCarburant(),
                'kilometrage' => $annonce->getKilometrage(),
                'boiteVitesse' => $annonce->getBoiteVitesse(),
                'prix' => $annonce->getPrix(),
                'url' => $this->generateUrl('app_detail_vehicule', ['id' => $annonce->getId()])
            ];
        }
        return new JsonResponse($annoncesArray);
    }
}