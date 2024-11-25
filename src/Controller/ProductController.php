<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class ProductController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        // Constructor injection to inject the EntityManagerInterface       
    }

    #[Route('/menu/drinks/{slug}', name: 'app_product_details')]
    public function details($slug): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['slug' => $slug]);
        if (!$product) {
            throw $this->createNotFoundException('Produit non trouvé');
        }
        return $this->render('menu/drinks/details.html.twig', ['product' => $product]);
    }
}
