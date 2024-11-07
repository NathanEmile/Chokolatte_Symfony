<?php

namespace App\Controller;

use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;

class MenuController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
        // Constructor injection to inject the EntityManagerInterface       
    }

    #[Route('/menu', name: 'app_menu')]
    public function index(): Response
    {
        $categories = $this->entityManager->getRepository(Category::class)->findBy([], ['position' => 'DESC']);

        return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
            'categories' => $categories,
        ]);
        /*return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
        ]);*/
    }
}
