<?php

namespace App\Controller;

use App\Repository\VoitureRepository;
use App\Repository\DirectionRepository;
use App\Repository\EtatvoitureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
     /**
     * @Route("/dashboard", name="app_dashboard")
     */
    public function index(
        VoitureRepository $voitureRepository,
        DirectionRepository $directionRepository,
        EtatvoitureRepository $etatvoitureRepository
    ): Response {
        // Nombre total de voitures
        $totalVoitures = $voitureRepository->count([]);

        // Nombre de voitures par direction
        $voituresByDirection = $directionRepository->createQueryBuilder('d')
            ->select('d.abrdirection, COUNT(v.id) AS total_voitures')
            ->leftJoin('d.voitures', 'v')
            ->groupBy('d.abrdirection')
            ->getQuery()
            ->getResult();

        // Nombre de voitures en bon état et en panne par direction
        $voituresParEtatParDirection = $etatvoitureRepository->createQueryBuilder('e')
            ->select('d.abrdirection, e.etat, COUNT(v.id) AS total_voitures')
            ->leftJoin('e.matriculevoiture', 'v')
            ->leftJoin('v.abrdirection', 'd')
            ->groupBy('d.abrdirection, e.etat')
            ->getQuery()
            ->getResult();

        return $this->render('dashboard/index.html.twig', [
            'totalVoitures' => $totalVoitures,
            'voituresByDirection' => $voituresByDirection,
            'voituresParEtatParDirection' => $voituresParEtatParDirection,
        ]);
    }
}