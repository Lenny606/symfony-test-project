<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminCssController extends AbstractController
{
    #[Route('/admin/css', name: 'app_admin_css')]
    public function index(): Response
    {

        return $this->render('admin/css/css.html.twig', [
            'item' => "",
        ]);
    }
}
