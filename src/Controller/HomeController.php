<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtatvoitureRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

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
