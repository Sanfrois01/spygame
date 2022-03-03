<?php

namespace App\Controller;

use App\Entity\Agent;
use App\Form\AgentType;
use App\Repository\AgentRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/agents')]

class AgentsController extends AbstractController
{
    #[Route('/', name: 'agents_index', methods: ['GET'])]
    public function index(AgentRepository $agentRepository): Response
    {
        return $this->render('agents/index.html.twig', [
            'agents' => $agentRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'agents_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $agent = new Agent();
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($agent);
            $entityManager->flush();

            return $this->redirectToRoute('agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agents/new.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'agents_show', methods: ['GET'])]
    public function show(Agent $agent): Response
    {
        return $this->render('agents/show.html.twig', [
            'agent' => $agent,
        ]);
    }

    #[Route('/{id}/edit', name: 'agents_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Agent $agent, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AgentType::class, $agent);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('agents_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('agents/edit.html.twig', [
            'agent' => $agent,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'agents_delete', methods: ['POST'])]
    public function delete(Request $request, Agent $agent, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$agent->getId(), $request->request->get('_token'))) {
            $entityManager->remove($agent);
            $entityManager->flush();
        }

        return $this->redirectToRoute('agents_index', [], Response::HTTP_SEE_OTHER);
    }
}
