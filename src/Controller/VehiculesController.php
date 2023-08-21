<?php

namespace App\Controller;

use App\Entity\Annonce;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Horaire;
use App\Repository\AnnonceRepository;
use App\Repository\HoraireRepository;
use Doctrine\Persistence\ManagerRegistry;

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
}
