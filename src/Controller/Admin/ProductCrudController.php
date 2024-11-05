<?php

namespace App\Controller\Admin;


use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Speciality;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class ProductCrudController extends AbstractCrudController
{

    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            AssociationField::new('category')
                ->setLabel('Category'),
            AssociationField::new('speciality')
                ->setLabel('Speciality'),   
            TextField::new('name'),
            TextEditorField::new('description'),
            NumberField::new('price'),
            ImageField::new('image')
                ->setLabel('Image')
                ->setUploadDir('public/images/products'),
            IntegerField::new('position'),
            //BooleanField::new('isActive'),
        ];
    }
    
}
