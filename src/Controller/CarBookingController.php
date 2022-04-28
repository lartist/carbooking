<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\CarBooking;
use App\Form\CarBookingType;
use App\Repository\CarBookingRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/car-booking')]
class CarBookingController extends AbstractController
{
    #[Route('/', name: 'app_car_booking_index', methods: ['GET'])]
    public function index(CarBookingRepository $carBookingRepository): Response
    {
        return $this->render('car_booking/index.html.twig', [
            'car_bookings' => $carBookingRepository->findAll(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_car_booking_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarBookingRepository $carBookingRepository, Car $car): Response
    {
        $carBooking = new CarBooking();
        $form = $this->createForm(CarBookingType::class, $carBooking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carBooking->setCar($car);
            $carBooking->setUser($this->getUser());
            $carBookingRepository->add($carBooking);
            return $this->redirectToRoute(self::HOME_ROUTE_NAME, [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car_booking/new.html.twig', [
            'car_booking' => $carBooking,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_car_booking_delete', methods: ['POST'])]
    public function delete(Request $request, CarBooking $carBooking, CarBookingRepository $carBookingRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carBooking->getId(), $request->request->get('_token'))) {
            $carBookingRepository->remove($carBooking);
        }

        return $this->redirectToRoute(self::HOME_ROUTE_NAME, [], Response::HTTP_SEE_OTHER);
    }
}
