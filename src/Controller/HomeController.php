<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\HoraireRepository;
use App\Entity\Horaire;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ManagerRegistry $doctrine, HoraireRepository $HoraireRepository): Response
    {
        $HoraireRepository = $doctrine->getRepository(Horaire::class);
        $Horaires = $HoraireRepository ->findAll();


        return $this->render('home/index.html.twig', [
            'controller_name' => ' Garage V.PARROT',
            'Horaires' => $Horaires,
        ]);
    }
}