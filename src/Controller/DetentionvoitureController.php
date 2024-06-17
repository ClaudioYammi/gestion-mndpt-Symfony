<?php

namespace App\Controller;

use App\Entity\Detentionvoiture;
use App\Form\DetentionvoitureType;
use App\Repository\DetentionvoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/detentionvoiture')]
class DetentionvoitureController extends AbstractController
{
    #[Route('/', name: 'app_detentionvoiture_index', methods: ['GET'])]
    public function index(DetentionvoitureRepository $detentionvoitureRepository): Response
    {
        return $this->render('detentionvoiture/index.html.twig', [
            'detentionvoitures' => $detentionvoitureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_detentionvoiture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $detentionvoiture = new Detentionvoiture();
        $form = $this->createForm(DetentionvoitureType::class, $detentionvoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($detentionvoiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_detentionvoiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detentionvoiture/new.html.twig', [
            'detentionvoiture' => $detentionvoiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detentionvoiture_show', methods: ['GET'])]
    public function show(Detentionvoiture $detentionvoiture): Response
    {
        return $this->render('detentionvoiture/show.html.twig', [
            'detentionvoiture' => $detentionvoiture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_detentionvoiture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Detentionvoiture $detentionvoiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DetentionvoitureType::class, $detentionvoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_detentionvoiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('detentionvoiture/edit.html.twig', [
            'detentionvoiture' => $detentionvoiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_detentionvoiture_delete', methods: ['POST'])]
    public function delete(Request $request, Detentionvoiture $detentionvoiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$detentionvoiture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($detentionvoiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_detentionvoiture_index', [], Response::HTTP_SEE_OTHER);
    }
}
