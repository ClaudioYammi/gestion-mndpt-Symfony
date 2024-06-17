<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtatvoitureRepository;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="app_home")
     */
    public function index(VoitureRepository $voitureRepository): Response
    {
        // Récupérer le repository des voitures pour accéder aux données
        $voitures = $voitureRepository->findAll();

        // Créer un tableau pour stocker les données par mois
        $dataByMonth = [];

        // Remplir le tableau avec le nombre de voitures par mois
        foreach ($voitures as $voiture) {
            $monthYear = $voiture->getDateentrevoiture()->format('Y-m');
            if (!isset($dataByMonth[$monthYear])) {
                $dataByMonth[$monthYear] = 0;
            }
            $dataByMonth[$monthYear]++;
        }

        // Tri des données par mois (optionnel mais recommandé)
        ksort($dataByMonth);

        return $this->render('home/index.html.twig', [
            'dataByMonth' => $dataByMonth,
        ]);
    }

    /**
     * @Route("/api/etat-voitures", name="api_etat_voitures", methods={"GET"})
     */
    public function getEtatVoitures(EtatvoitureRepository $etatvoitureRepository): JsonResponse
    {
        // Récupérer les données depuis le repository
        $totalEnPanne = $etatvoitureRepository->count(['etat' => 'mauvaisetat']);
        $totalEnBonEtat = $etatvoitureRepository->count(['etat' => 'bonetat']);

        // Préparer les données pour le JSON
        $data = [
            'en_panne' => $totalEnPanne,
            'en_bon_etat' => $totalEnBonEtat,
        ];

        // Retourner une réponse JSON
        return new JsonResponse($data);
    }
}
