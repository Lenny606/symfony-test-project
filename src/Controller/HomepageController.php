<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{

    #[Route("/{limit<\d+>?0}", name: "app.index")]
    public function index(int $limit): Response
    {


        $template = $this->render(
            'homepage/homepage.html.twig',
            [
                'limit' => $limit,
                'id' => $limit,
                'pageTitle' => 'Homepage',
                'featuredProducts' => [
                    [
                        'name' => "Adui",
                        'description' => "skkvnsen",
                        'price' => "20"
                    ],
                   [
                       'name' => "AFe",
                       'description' => "acdc",
                       'price' => "220"
                   ],
                    [
                        'name' => "",
                        'description' => "acdc",
                        'price' => "220"
                    ]
                ],
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