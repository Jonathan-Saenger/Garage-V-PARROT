<?php

namespace App\Controller\Admin;

use App\Entity\User;
use PhpParser\Node\Expr\Cast\Array_;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Validator\Constraints\NotNull;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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
        yield TextField::new('Email')->setPermission('ROLE_ADMIN');
        yield TextField::new('Password')->setPermission('ROLE_ADMIN');
        yield ChoiceField::new('roles')->setChoices(array_combine($roles, $roles))->allowMultipleChoices()->renderExpanded()->renderAsBadges()->setPermission('ROLE_ADMIN');
    }
}