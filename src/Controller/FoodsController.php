<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Speciality;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class FoodsController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        // Constructor injection to inject the EntityManagerInterface       
    }

    #[Route('menu/foods', name: 'app_foods')]
    public function index(): Response
    {
        $category = $this->entityManager->getRepository(Category::class)
            ->findOneBy(['name' => 'Foods']);

        $specialities = $this->entityManager->getRepository(Speciality::class)
            ->createQueryBuilder('s')
            ->innerJoin('s.category', 'c')
            ->where('c.name = :category')
            ->setParameter('category', 'Foods')
            ->getQuery()
            ->getResult();

        $products = $this->entityManager->getRepository(Product::class)
            ->createQueryBuilder('p')
            ->innerJoin('p.category', 'c')
            ->where('c.name = :category')
            ->setParameter('category', 'Foods')
            ->getQuery()
            ->getResult();

        return $this->render('menu/foods/index.html.twig', [
            'controller_name' => 'FoodsController',
            'products' => $products,
            'specialities' => $specialities,
            'category' => $category
        ]);
    }
}



