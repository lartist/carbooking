<?php

namespace App\Controller;

use App\Repository\TransactionRepository;
use App\ValueObject\AccountStatistics;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class DashboardController extends AbstractController
{
    #[Route('/dashboard', name: 'dashboard')]
    public function index(
        TranslatorInterface $translator
    ): Response
    {
        return $this->render('dashboard/index.html.twig', [
        ]);
    }
}
