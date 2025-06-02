<?php

namespace App\Controller\Admin;


use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Speciality;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;


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
            //BooleanField::new('isActive'),
            TextEditorField::new('description'),
            SlugField::new('slug')
                ->setTargetFieldName('slug'),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class)->onlyOnForms(),
            ImageField::new('image')
                ->setBasePath('images/products')->onlyOnIndex(),    
            MoneyField::new('price')
                ->setCurrency('EUR'),
            IntegerField::new('position'),
        ];
    }  
}