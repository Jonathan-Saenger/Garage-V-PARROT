<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use Vich\UploaderBundle\Form\Type\VichImageType;
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
        yield TextField::new('titre');
        yield TextareaField::new('description');
        yield TextareaField::new('imageFile')->setFormType(VichImageType::class);
    }
    
}
