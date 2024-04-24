<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController
{

    #[Route('/', 'app.index')]
    public function index() : Response
    {
        return new Response("Homepage");
    }
}