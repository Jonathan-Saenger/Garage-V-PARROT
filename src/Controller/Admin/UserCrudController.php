<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use PhpParser\Node\Expr\Cast\Array_;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Validator\Constraints\NotNull;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Exception;
use Symfony\Component\Finder\Exception\AccessDeniedException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

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

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)->setPermission(Action::INDEX, 'ROLE_ADMIN');
        
    }
}