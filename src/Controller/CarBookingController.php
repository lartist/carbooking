<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Car;
use App\Entity\CarBooking;
use App\Form\CarBookingType;
use App\Repository\CarBookingRepository;
use App\Security\Voter\CarBookingVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

#[Route('/car-booking')]
class CarBookingController extends AbstractController
{
    #[Route('/', name: 'app_car_booking_index', methods: ['GET'])]
    public function index(CarBookingRepository $carBookingRepository): Response
    {
        return $this->render('car_booking/index.html.twig', [
            'car_bookings' => $carBookingRepository->findAllWithCar(),
        ]);
    }

    #[Route('/new/{id}', name: 'app_car_booking_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CarBookingRepository $carBookingRepository, Car $car, TranslatorInterface $translator): Response
    {
        $carBooking = new CarBooking();
        $carBooking->setCar($car);
        $carBooking->setUser($this->getUser());
        $form = $this->createForm(CarBookingType::class, $carBooking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $carBookingRepository->add($carBooking);

            $this->addFlash(self::SUCCESS, $translator->trans('flash.car_booked'));

            return $this->redirectToRoute(self::HOME_ROUTE_NAME, [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('car_booking/new.html.twig', [
            'car_booking' => $carBooking,
            'car' => $car,
            'form' => $form,
            'unavailable_car_bookings' => $carBookingRepository->findBy(['car' => $car]),
        ]);
    }

    #[Route('/{id}', name: 'app_car_booking_delete', methods: ['POST'])]
    #[IsGranted(CarBookingVoter::DELETE, subject: 'carBooking')]
    public function delete(Request $request, CarBooking $carBooking, CarBookingRepository $carBookingRepository, TranslatorInterface $translator): Response
    {
        if ($this->isCsrfTokenValid('delete'.$carBooking->getId(), $request->request->get('_token'))) {
            $carBookingRepository->remove($carBooking);
            $this->addFlash(self::SUCCESS, $translator->trans('flash.car_booking_deleted'));
        }

        return $this->redirectToRoute(self::HOME_ROUTE_NAME, [], Response::HTTP_SEE_OTHER);
    }
}
