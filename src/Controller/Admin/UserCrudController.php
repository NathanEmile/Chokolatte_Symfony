<?php

namespace App\Controller\Admin;

use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            EmailField::new('email'),
            TextField::new('firstName'),
            TextField::new('lastName'),
            ChoiceField::new('roles')
                    ->setChoices([
                        'Admin' => 'ROLE_ADMIN',
                        'User' => 'ROLE_USER',
                        'Product Manager' => 'ROLE_PRODUCT_MANAGER',
                        'Order Manager' => 'ROLE_ORDER_MANAGER',
                    ])
                    ->allowMultipleChoices()
                    ->setHelp('Select the roles the user should have.'),
                    ];
    }
    
}
