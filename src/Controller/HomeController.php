<?php

namespace App\Controller;

use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'name' => 'world',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            
        ]);
    }

    #[Route('/service', name: 'app_service')]
    public function service(EntityManagerInterface $em): Response
    {
        $services = $em->getRepository(Service::class)->findAll();
        return $this->render('home/service.html.twig', [
            'services' => $services,
        ]);
    }
}
