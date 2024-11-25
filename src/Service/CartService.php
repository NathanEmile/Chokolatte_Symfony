<?php

namespace App\Service;

use App\Entity\Product;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService {

    private RequestStack $requestStack;
    private EntityManagerInterface $entityManager;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $entityManager) 
    {
        $this->requestStack = $requestStack;
        $this->entityManager = $entityManager;
    }

    //Récupérer le panier
    public function getCartTotal(): array
    {
        $cart = $this->getSession()->get('cart', []);
        $cartData = [];
        if ($cart){
            foreach ($cart as $id => $quantity) {
                $product = $this->entityManager->getRepository(Product::class)->findOneBy(['id' => $id]);
                if (!$product) {
                    continue;
                }
                $cartData[] = [
                    'product' => $product,
                    'quantity' => $quantity
                ];
            }
        }
        return $cartData;
    }

    //Ajouter 1 produit
    public function addToCart(int $id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);
        if (!empty($cart[$id])) {
            $cart[$id]++;
        } else {
            $cart[$id] = 1;
        }
        $this->getSession()->set('cart', $cart);
    }

    //Supprimer 1 produit
    public function removeFromCart(int $id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);
        if (!empty($cart[$id])) {
            if ($cart[$id] > 1) {
                $cart[$id]--;
            }else{
                unset($cart[$id]);
            }
        }
        $this->getSession()->set('cart', $cart);
    }

    //Supprimer "un" produit
    public function deleteFromCart(int $id)
    {
        $cart = $this->requestStack->getSession()->get('cart', []);
        if (!empty($cart[$id])) {
            unset($cart[$id]);
        }
        $this->getSession()->set('cart', $cart);
    }

    //Vider le panier
    public function clearCart()
    {
        $this->getSession()->remove('cart');
    }

    private function getSession(): SessionInterface
    {
        return $this->requestStack->getSession();
    }

}