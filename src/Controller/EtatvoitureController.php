<?php

namespace App\Controller;

use App\Entity\Etatvoiture;
use App\Form\EtatvoitureType;
use App\Repository\EtatvoitureRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/etatvoiture')]
class EtatvoitureController extends AbstractController
{
    #[Route('/', name: 'app_etatvoiture_index', methods: ['GET'])]
    public function index(EtatvoitureRepository $etatvoitureRepository): Response
    {
        return $this->render('etatvoiture/index.html.twig', [
            'etatvoitures' => $etatvoitureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_etatvoiture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $etatvoiture = new Etatvoiture();
        $form = $this->createForm(EtatvoitureType::class, $etatvoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($etatvoiture);
            $entityManager->flush();

            return $this->redirectToRoute('app_etatvoiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etatvoiture/new.html.twig', [
            'etatvoiture' => $etatvoiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etatvoiture_show', methods: ['GET'])]
    public function show(Etatvoiture $etatvoiture): Response
    {
        return $this->render('etatvoiture/show.html.twig', [
            'etatvoiture' => $etatvoiture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_etatvoiture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etatvoiture $etatvoiture, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EtatvoitureType::class, $etatvoiture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_etatvoiture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('etatvoiture/edit.html.twig', [
            'etatvoiture' => $etatvoiture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_etatvoiture_delete', methods: ['POST'])]
    public function delete(Request $request, Etatvoiture $etatvoiture, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$etatvoiture->getId(), $request->request->get('_token'))) {
            $entityManager->remove($etatvoiture);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_etatvoiture_index', [], Response::HTTP_SEE_OTHER);
    }
}
