<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/admin/service', name: 'app_service')]
class ServiceController extends AbstractController
{
    #[Route('/', name: '_list')]
    public function index(EntityManagerInterface $em): Response
    {
        $services = $em->getRepository(Service::class)->findAll();
        return $this->render('service/index.html.twig', [
            'services' => $services,
        ]);
    }

    #[Route('/new', name: '_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($service);
            $em->flush();
            $this->addFlash('success', 'Service created successfully!');
            return $this->redirectToRoute('app_service_list');
        }
        return $this->render('service/new.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/show', name: '_show')]
    public function show(Service $service): Response
    {
        return $this->render('service/show.html.twig', [
            'service' => $service,
        ]);
    }

    #[Route('/{id}/edit', name: '_edit')]
    public function edit(Request $request, EntityManagerInterface $em, Service $service): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'Service updated successfully!');
            return $this->redirectToRoute('app_service_list');
        }
        return $this->render('service/edit.html.twig', [
            'service' => $service,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}/delete', name: '_delete')]
    public function delete(EntityManagerInterface $em, Service $service): Response
    {
        $em->remove($service);
        $em->flush();
        $this->addFlash('success', 'Service deleted successfully!');
        return $this->redirectToRoute('app_service_list');
    }

    #[Route('/search', name: '_search')]
    public function search(Request $request, EntityManagerInterface $em): Response
    {
        $keyword = $request->get('keyword');
        $services = $em->getRepository(Service::class)->search($keyword);
        return $this->render('service/search.html.twig', [
            'services' => $services,
        ]);
    }
}
