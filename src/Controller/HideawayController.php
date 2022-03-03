<?php

namespace App\Controller;

use App\Entity\Hideaway;
use App\Form\HideawayType;
use App\Repository\HideawayRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/hideaway')]
class HideawayController extends AbstractController
{
    #[Route('/', name: 'hideaway_index', methods: ['GET'])]
    public function index(HideawayRepository $hideawayRepository): Response
    {
        return $this->render('hideaway/index.html.twig', [
            'hideaways' => $hideawayRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'hideaway_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $hideaway = new Hideaway();
        $form = $this->createForm(HideawayType::class, $hideaway);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($hideaway);
            $entityManager->flush();

            return $this->redirectToRoute('hideaway_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hideaway/new.html.twig', [
            'hideaway' => $hideaway,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'hideaway_show', methods: ['GET'])]
    public function show(Hideaway $hideaway): Response
    {
        return $this->render('hideaway/show.html.twig', [
            'hideaway' => $hideaway,
        ]);
    }

    #[Route('/{id}/edit', name: 'hideaway_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Hideaway $hideaway, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HideawayType::class, $hideaway);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('hideaway_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('hideaway/edit.html.twig', [
            'hideaway' => $hideaway,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'hideaway_delete', methods: ['POST'])]
    public function delete(Request $request, Hideaway $hideaway, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$hideaway->getId(), $request->request->get('_token'))) {
            $entityManager->remove($hideaway);
            $entityManager->flush();
        }

        return $this->redirectToRoute('hideaway_index', [], Response::HTTP_SEE_OTHER);
    }
}
