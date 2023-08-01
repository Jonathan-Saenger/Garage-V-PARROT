<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Horaire;
use App\Repository\HoraireRepository;
use Doctrine\Persistence\ManagerRegistry;

class ServicesController extends AbstractController
{
    #[Route('/services', name: 'app_services')]
    public function index(ManagerRegistry $doctrine, HoraireRepository $HoraireRepository): Response
    {
        $HoraireRepository = $doctrine->getRepository(Horaire::class);
        $Horaires = $HoraireRepository ->findAll();

        return $this->render('services/services.html.twig', [
            'controller_name' => 'ServicesController',
            'Horaires' => $Horaires,
        ]);
    }
}
