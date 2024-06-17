<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\VoitureRepository;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', []);
    }

    /**
     * @Route("/voitures/statistics", name="voitures_statistics")
     */
    public function getVoitureStatistics(VoitureRepository $voitureRepository): Response
    {
        $voitures = $voitureRepository->findAll();
        $enPanne = 0;
        $enBonEtat = 0;

        foreach ($voitures as $voiture) {
            foreach ($voiture->getEtatvoitures() as $etat) {
                if ($etat->getEtat() === 'Enpanne') {
                    $enPanne++;
                } elseif ($etat->getEtat() === 'Enbonétat') {
                    $enBonEtat++;
                }
            }
        }

        return $this->json([
            'en_panne' => $enPanne,
            'en_bon_etat' => $enBonEtat,
        ]);
    }
}
