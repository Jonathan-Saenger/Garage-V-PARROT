<?php

namespace App\Controller;

use App\Entity\Horaire;
use App\Entity\Service;
use App\Entity\Temoignage;
use App\Repository\HoraireRepository;
use App\Repository\ServiceRepository;
use App\Repository\TemoignageRepository;
//use Symfony\Component\BrowserKit\Request;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]

    public function index(ManagerRegistry $doctrine, 
    HoraireRepository $HoraireRepository, 
    ServiceRepository $ServiceRepository, 
    TemoignageRepository $TemoignageRepository,
    Request $request, 
    PaginatorInterface $paginatorInterface,
    ): Response {
        $HoraireRepository = $doctrine->getRepository(Horaire::class);
        $Horaires = $HoraireRepository ->findAll();

        $Pagination = $paginatorInterface->paginate(
            $ServiceRepository->paginationQuery(),
            $request->query->get('page', 1),
            3
        );

        $PaginationTemoignage = $paginatorInterface->paginate(
            $TemoignageRepository->paginationQueryTemoignage(),
            $request->query->get('page', 1),
            1
        );

        return $this->render('home/index.html.twig', [
            'controller_name' => ' Garage V.PARROT',
            'Horaires' => $Horaires,
            //'Services' => $Services,
            'Pagination' => $Pagination,
            'Temoignage' => $PaginationTemoignage,

        ]);
    }
}