<?php

namespace App\Controller\Admin;


use App\Entity\Horaire;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class HoraireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Horaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('Jour')->setRequired('false')->setPermission('ROLE_ADMIN');
            yield TimeField::new('heure_ouverture')->setFormat('HH:mm')->setPermission('ROLE_ADMIN');
            yield TimeField::new('heure_fermeture')->setFormat('HH:mm')->setPermission('ROLE_ADMIN');
            yield TimeField::new('ouverture_soir')->setFormat('HH:mm')->setPermission('ROLE_ADMIN');
            yield TimeField::new('fermeture_soir')->setFormat('HH:mm')->setPermission('ROLE_ADMIN');
    }
}