<?php

namespace App\Controller\Admin;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminProductController extends AbstractController
{
    #[Route('/admin/product', name: 'app_admin_product')]
    public function index(ProductRepository $productRepository): Response
    {
        $productList = $productRepository->getProductList();

        return $this->render('admin/products/products.html.twig', [
            'productList' => $productList,
        ]);
    }

    #[Route('/admin/product/{id<\d+>}', name: 'admin_product_edit')]
    public function editProduct(ProductRepository $productRepository): Response
    {
        $productList = $productRepository->getProductList();

        return $this->render('admin/products/products.html.twig', [
            'productList' => $productList,
        ]);
    }

    #[Route('/admin/product/add', name: 'admin_product_add')]
    public function addProduct(ProductRepository $productRepository): Response
    {
        $productList = $productRepository->getProductList();

        return $this->render('admin/products/products.html.twig', [
            'productList' => $productList,
        ]);
    }
}
