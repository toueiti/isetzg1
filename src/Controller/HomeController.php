<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/{name}', name: 'app_home')]
    public function index($name = 'world'): Response
    {
        return $this->render('home/index.html.twig', [
            'name' => $name,
        ]);
    }

    #[Route('/fr/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            
        ]);
    }

    #[Route('/fr/service', name: 'app_service')]
    public function service(): Response
    {
        return $this->render('home/service.html.twig', [
            
        ]);
    }
}
