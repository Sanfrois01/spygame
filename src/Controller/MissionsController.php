<?php

namespace App\Controller;

use App\Entity\Mission;
use App\Form\MissionType;
use App\Repository\MissionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/')]
class MissionsController extends AbstractController
{
    #[Route('/', name: 'missions_index', methods: ['GET'])]
    public function index(MissionRepository $missionRepository): Response
    {
        return $this->render('missions/index.html.twig', [
            'missions' => $missionRepository->findAll(),
        ]);
    }

    #[Route('/admin/new', name: 'missions_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $mission = new Mission();
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($mission);
            $entityManager->flush();

            return $this->redirectToRoute('missions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('missions/new.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{id}', name: 'missions_show', methods: ['GET'])]
    public function show(Mission $mission): Response
    {
        return $this->render('missions/show.html.twig', [
            'mission' => $mission,
        ]);
    }

    #[Route('/admin/{id}/edit', name: 'missions_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Mission $mission, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MissionType::class, $mission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('missions_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('missions/edit.html.twig', [
            'mission' => $mission,
            'form' => $form,
        ]);
    }

    #[Route('/admin/{id}', name: 'missions_delete', methods: ['POST'])]
    public function delete(Request $request, Mission $mission, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$mission->getId(), $request->request->get('_token'))) {
            $entityManager->remove($mission);
            $entityManager->flush();
        }

        return $this->redirectToRoute('missions_index', [], Response::HTTP_SEE_OTHER);
    }
}
