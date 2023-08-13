<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('titre')->setPermission('ROLE_ADMIN');
        yield TextareaField::new('description')->setPermission('ROLE_ADMIN');
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class)->setPermission('ROLE_ADMIN');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)->setPermission(Action::INDEX, 'ROLE_ADMIN');
    }
}