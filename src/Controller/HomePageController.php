<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Services\GetProductsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{

    #[Route("/{limit<\d+>?0}", name: "app.index")]
    public function index(int $limit, GetProductsService $getProductsService, ProductRepository $productRepository ): Response
    {

        $data = $getProductsService->loadData('https://dummyjson.com/products', [ 'limit' => '6']);


        $template = $this->render(
            'homepage/homepage.html.twig',
            [
                'limit' => $limit,
                'id' => $limit,
                'pageTitle' => 'Homepage',
                'featuredProducts' => $data['products'],
                'currentYear' => date('Y'),
            ]
        );

        return $template;
    }

    #[Route("/show/{id<\d>}", name: "app.show", /* requirements: ["id" => '\d+']*/)]
    public function show(?int $id): Response
    {
        $val = $id === null ? $id : '';
        $template = $this->render(
            'show/show.html.twig',
            [
                'id' => $id
            ]
        );

        return $template;
    }


}