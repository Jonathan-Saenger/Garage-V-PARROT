<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Garage;
use App\Entity\Annonce;
use App\Entity\Employe;
use App\Entity\Horaire;
use App\Entity\Service;
use App\Entity\Temoignage;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');

            return $this->render('admin/dashboard.html.twig');

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Garage V Parrot');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Accès employés', 'fas fa-store', User::class)->setPermission('ROLE_ADMIN');
        //Nyield MenuItem::linkToCrud('Employe', 'fas fa-user', Employe::class);
        yield MenuItem::linkToCrud('Annonce', 'fas fa-car', Annonce::class);
        yield MenuItem::linkToCrud('Horaire', 'fas fa-calendar-days', Horaire::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Service', 'fas fa-car-on', Service::class)->setPermission('ROLE_ADMIN');
        yield MenuItem::linkToCrud('Temoignage', 'fas fa-comment', Temoignage::class);
        yield MenuItem::linkToCrud('Garage', 'fas fa-store', Garage::class)->setPermission('ROLE_ADMIN');
    }
}
