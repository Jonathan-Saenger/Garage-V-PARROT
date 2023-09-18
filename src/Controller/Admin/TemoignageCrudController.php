<?php

namespace App\Controller\Admin;

use App\Entity\Temoignage;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\Intl\Timezones;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

\Locale::setDefault('en');
$timezone = Timezones::getName('Europe/Paris');

class TemoignageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Temoignage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('nom');
        yield IntegerField::new('note');
        yield TextareaField::new('commentaire');
        yield BooleanField::new('publication');
        yield DateTimeField::new('jourpublication','Jour de publication (à compléter)')->setFormat('dd.MM.yyyy')->setTimezone('Europe/Paris');

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */  
    }
}