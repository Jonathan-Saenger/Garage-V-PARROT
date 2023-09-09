<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName, $roles=['ROLE_USER', 'ROLE_ADMIN']): iterable
    {
        yield TextField::new('Nom')->setPermission('ROLE_ADMIN');
        yield TextField::new('Prenom')->setPermission('ROLE_ADMIN');
        yield TextField::new('Email', 'Adresse Email')->setPermission('ROLE_ADMIN');
        yield TextField::new('Password')->setPermission('ROLE_ADMIN');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)->setPermission(Action::INDEX, 'ROLE_ADMIN')->disable(Action::DELETE);
    }
}