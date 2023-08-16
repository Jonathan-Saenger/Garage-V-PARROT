<?php

namespace App\Controller;

use App\Entity\Horaire;
use App\Entity\Temoignage;
use App\Form\TemoignageType;
use App\Repository\HoraireRepository;
use App\Repository\TemoignageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class TemoignagesController extends AbstractController
{
    #[Route('/temoignages', name: 'app_temoignages')]

    public function index(ManagerRegistry $doctrine, HoraireRepository $HoraireRepository, TemoignageRepository $TemoignageRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        //affichage de l'horaire
        $HoraireRepository = $doctrine->getRepository(Horaire::class);
        $Horaires = $HoraireRepository ->findAll();

        //affichage du formulaire de temoignage
        $temoignage = new Temoignage();
        $form = $this->createForm(TemoignageType::class, $temoignage);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($temoignage);
            $entityManager->flush();
            $this->addFlash('success', 'Merci pour votre commentaire ! Il sera publié après modération !');
        }
        return $this->render('temoignages/temoignages.html.twig', [
            'controller_name' => 'TemoignagesController',
            'Horaires' => $Horaires,
            'form' => $form->createView(),
        ]);
    }
}