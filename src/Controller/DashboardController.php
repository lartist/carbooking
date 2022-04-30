<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\CarBookingRepository;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(CarRepository $carRepository, CarBookingRepository $carBookingRepository): Response
    {
        return $this->render('dashboard/index.html.twig', [
            'cars' => $carRepository->findAll(),
            'carBookings' => $carBookingRepository->findByUser($this->getUser())
        ]);
    }
}
