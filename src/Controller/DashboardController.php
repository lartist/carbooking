<?php

namespace App\Controller;

use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(CarRepository $carRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'cars' => $carRepository->findAll()
        ]);
    }
}
