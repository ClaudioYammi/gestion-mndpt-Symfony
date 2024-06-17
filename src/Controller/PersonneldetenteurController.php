<?php

namespace App\Controller;

use App\Entity\Personneldetenteur;
use App\Form\PersonneldetenteurType;
use App\Repository\PersonneldetenteurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/personneldetenteur')]
class PersonneldetenteurController extends AbstractController
{
    #[Route('/', name: 'app_personneldetenteur_index', methods: ['GET'])]
    public function index(PersonneldetenteurRepository $personneldetenteurRepository): Response
    {
        return $this->render('personneldetenteur/index.html.twig', [
            'personneldetenteurs' => $personneldetenteurRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_personneldetenteur_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $personneldetenteur = new Personneldetenteur();
        $form = $this->createForm(PersonneldetenteurType::class, $personneldetenteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($personneldetenteur);
            $entityManager->flush();

            return $this->redirectToRoute('app_personneldetenteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('personneldetenteur/new.html.twig', [
            'personneldetenteur' => $personneldetenteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personneldetenteur_show', methods: ['GET'])]
    public function show(Personneldetenteur $personneldetenteur): Response
    {
        return $this->render('personneldetenteur/show.html.twig', [
            'personneldetenteur' => $personneldetenteur,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_personneldetenteur_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Personneldetenteur $personneldetenteur, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(PersonneldetenteurType::class, $personneldetenteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_personneldetenteur_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('personneldetenteur/edit.html.twig', [
            'personneldetenteur' => $personneldetenteur,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_personneldetenteur_delete', methods: ['POST'])]
    public function delete(Request $request, Personneldetenteur $personneldetenteur, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$personneldetenteur->getId(), $request->request->get('_token'))) {
            $entityManager->remove($personneldetenteur);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_personneldetenteur_index', [], Response::HTTP_SEE_OTHER);
    }
}
