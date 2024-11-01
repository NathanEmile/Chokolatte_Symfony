<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CategoryCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Chokolatte Administration System');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::subMenu('Menu', 'fa fa-article')->setSubItems([
                MenuItem::linkToCrud('Categories', 'fa fa-book', Category::class),
                // MenuItem::linkToCrud('Posts', 'fa fa-file-text', BlogPost::class),
                // MenuItem::linkToCrud('Comments', 'fa fa-comment', Comment::class),
            ]),
            MenuItem::linkToCrud('User', 'fas fa-user', User::class),
        ];
    }
    
}
