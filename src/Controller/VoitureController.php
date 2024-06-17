<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Form\SearchFormType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

use Knp\Snappy\Pdf;
use Symfony\Component\HttpFoundation\BinaryFileResponse;




#[Route('/voiture')]
class VoitureController extends AbstractController
{
    private $knpSnappyPdf;

    public function __construct(VoitureRepository $voitureRepository, Pdf $knpSnappyPdf)
    {
    $this->knpSnappyPdf = $knpSnappyPdf;
    }

    #[Route('/', name: 'app_voiture_index', methods: ['GET'])]
    public function index(Request $request, VoitureRepository $voitureRepository): Response
{
    $searchForm = $this->createForm(SearchFormType::class);
    $searchForm->handleRequest($request);

    $keyword = null;

    if ($searchForm->isSubmitted() && $searchForm->isValid()) {
        $keyword = $searchForm->get('keyword')->getData();
        $voitures = $voitureRepository->search($keyword);
        
    } else {
        $voitures = $voitureRepository->findAll();
    }

    return $this->render('voiture/index.html.twig', [
        'voitures' => $voitures,
        'searchForm' => $searchForm->createView(),
    ]);
}

    #[Route('/new', name: 'app_voiture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($voiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voiture/new.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voiture_show', methods: ['GET'])]
    public function show(Voiture $voiture): Response
    {
        return $this->render('voiture/show.html.twig', [
            'voiture' => $voiture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_voiture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_voiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('voiture/edit.html.twig', [
            'voiture' => $voiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_voiture_delete', methods: ['POST'])]
    public function delete(Request $request, Voiture $voiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$voiture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($voiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_voiture_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/generate-pdf/{id}', name: 'app_voiture_pdf', methods: ['GET'])]
    public function generatePdf(Voiture $voiture, Request $request, Pdf $knpSnappyPdf ): Response
    {
       $html = $this->renderView('voiture/pdf.html.twig', [
        'voitures' => $voiture,
       ]) ;
       $filename = sprintf('pdfd-%s.pdf', $voiture->getId());
       $pdfPath = $this->getParameter('kernel.project_dir') . '/public/pdf/voiture/' . $filename;

       if (file_exists($pdfPath)) {
        unlink($pdfPath);
       }

       $this->knpSnappyPdf->generateFromHtml($html, $pdfPath);

       $response = new BinaryFileResponse($pdfPath);
       $response->setContentDisposition(
        $request->query->get('download') ? 'attachment' : 'inline',
        $filename
       );
       $response->headers->set('Content-type', 'application/pdf');
       
       return $response;
    }
}
