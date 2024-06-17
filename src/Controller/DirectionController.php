<?php

namespace App\Controller;

use App\Entity\Direction;
use App\Form\DirectionType;
use App\Repository\DirectionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/direction')]
class DirectionController extends AbstractController
{
    #[Route('/', name: 'app_direction_index', methods: ['GET'])]
    public function index(DirectionRepository $directionRepository): Response
    {
        return $this->render('direction/index.html.twig', [
            'directions' => $directionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_direction_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $direction = new Direction();
        $form = $this->createForm(DirectionType::class, $direction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($direction);
            $entityManager->flush();

            return $this->redirectToRoute('app_direction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('direction/new.html.twig', [
            'direction' => $direction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_direction_show', methods: ['GET'])]
    public function show(Direction $direction): Response
    {
        return $this->render('direction/show.html.twig', [
            'direction' => $direction,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_direction_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Direction $direction, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(DirectionType::class, $direction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_direction_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('direction/edit.html.twig', [
            'direction' => $direction,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_direction_delete', methods: ['POST'])]
    public function delete(Request $request, Direction $direction, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$direction->getId(), $request->request->get('_token'))) {
            $entityManager->remove($direction);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_direction_index', [], Response::HTTP_SEE_OTHER);
    }
}
