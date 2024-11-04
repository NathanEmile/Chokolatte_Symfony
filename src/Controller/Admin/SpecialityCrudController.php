<?php

namespace App\Controller\Admin;

use App\Entity\Speciality;
use App\Entity\Category;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class SpecialityCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return Speciality::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // Récupération des catégories
        $categories = $this->entityManager->getRepository(Category::class)->findAll();
        $choices = [];
        foreach ($categories as $category) {
            // Utilisez le nom de la catégorie comme clé et l'objet Category comme valeur
            $choices[$category->getId()] = $category->getName();
        }
    
        return [
            //ChoiceField::new('category')
                //->setChoices($choices)
                //->setLabel('Catégorie'),
            AssociationField::new('category')
                ->setLabel('Category'),

            TextField::new('name'),
            TextEditorField::new('description')
        ];
    }

}


