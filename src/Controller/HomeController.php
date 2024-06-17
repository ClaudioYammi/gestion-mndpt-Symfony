<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\EtatvoitureRepository;
use App\Repository\VoitureRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Direction; 
use Doctrine\ORM\EntityManagerInterface; // Importez le gestionnaire d'entité
class HomeController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/home", name="app_home")
     */
    public function index(VoitureRepository $voitureRepository): Response
    {
        // Récupérer le nombre total de voitures
        $totalVoitures = $voitureRepository->createQueryBuilder('v')
            ->select('COUNT(v.id)')
            ->getQuery()
            ->getSingleScalarResult();

        // Récupérer le nombre de voitures par direction
        $voituresByDirection = [];
        
        // Utilisation du gestionnaire d'entité pour obtenir le repository de Direction
        $directionRepository = $this->entityManager->getRepository(Direction::class);
        $directions = $directionRepository->findAll();

        foreach ($directions as $direction) {
            $voituresByDirection[$direction->getabrdirection()] = $voitureRepository->createQueryBuilder('v')
                ->select('COUNT(v.id)')
                ->where('v.abrdirection = :direction')
                ->setParameter('direction', $direction)
                ->getQuery()
                ->getSingleScalarResult();
        }
        return $this->render('home/index.html.twig', [
            'totalVoitures' => $totalVoitures,
            'voituresByDirection' => $voituresByDirection,
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
