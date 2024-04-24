<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController
{

    #[Route("/", name: "app.index")]
    public function index() : Response
    {
        return new Response("hello");
    }

    #[Route("/show/{id<\d>}", name: "app.show")]
    public function show(int $id) : Response
    {
        return new Response("hello id: $id");
    }



}