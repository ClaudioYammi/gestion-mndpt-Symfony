<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccuilleController extends AbstractController
{
    #[Route('/', name: 'app_accuille')]
    public function index(): Response
    {
        return $this->render('accuille/index.html.twig', [
            'controller_name' => 'AccuilleController',
        ]);
    }
}
