<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Horaire;
use Doctrine\ORM\Mapping\Id;
use App\Repository\AnnonceRepository;
use App\Repository\HoraireRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VehiculesController extends AbstractController
{
    #[Route('/vehicules', name: 'app_vehicules')]
    public function index(ManagerRegistry $doctrine, 
    HoraireRepository $HoraireRepository, 
    AnnonceRepository $AnnonceRepository): Response
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
    public function detail($id, ManagerRegistry $doctrine, 
    HoraireRepository $HoraireRepository, 
    AnnonceRepository $AnnonceRepository,
    Annonce $Annonce): Response
    {
        $HoraireRepository = $doctrine ->getRepository(Horaire::class);
        $Horaires = $HoraireRepository ->findAll();

        //Appel des véhicules depuis la base de données
        $AnnonceRepository = $doctrine ->getRepository(Annonce::class);
        $Annonce = $AnnonceRepository ->find($id);

        return $this->render('vehicules/details.html.twig', [
            'controller_name' => 'VehiculesController',
            'Horaires' => $Horaires,
            'Annonce' => $Annonce,
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
            $annoncesArray[] = [
                'imageFile' => $annonce->getImageFile() ? $uploaderHelper->asset($annonce, 'imageFile') : '/images/annonce/' . $annonce->getImageFile(),                'titre' => $annonce->getTitre(),
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