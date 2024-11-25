<?php

namespace App\Controller;

use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(CartService $cartService): Response
    {
        return $this->render('cart/index.html.twig', [
            'cart' => $cartService->getCartTotal(),
        ]);
    }

    #[Route('/cart/add/{id<\d+>}', name: 'cart_add')]
    public function addToRoute(CartService $cartService, int $id): Response
    {
        $cartService->addToCart($id);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id<\d+>}', name: 'cart_remove')]
    public function removeFromRoute(CartService $cartService, int $id): Response
    {
        $cartService->removeFromCart($id);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/delete/{id<\d+>}', name: 'cart_delete')]
    public function deleteFromRoute(CartService $cartService, int $id): Response
    {
        $cartService->deleteFromCart($id);

        return $this->redirectToRoute('app_cart');
    }
    
    #[Route('/cart/clear', name: 'cart_clear')]
    public function clearRoute(CartService $cartService): Response
    {
        $cartService->clearCart();    

        return $this->redirectToRoute('app_cart');
    }
}

