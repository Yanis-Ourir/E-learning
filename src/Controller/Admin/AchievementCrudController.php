<?php

namespace App\Controller\Admin;

use App\Entity\Achievement;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AchievementCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Achievement::class;
    }

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
