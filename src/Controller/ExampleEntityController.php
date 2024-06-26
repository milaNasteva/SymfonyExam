<?php

namespace App\Controller;

use App\Entity\ExampleEntity;
use App\Form\ExampleEntityType;
use App\Repository\ExampleEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/example/entity')]
class ExampleEntityController extends AbstractController
{
    #[Route('/', name: 'app_example_entity_index', methods: ['GET'])]
    public function index(ExampleEntityRepository $exampleEntityRepository): Response
    {
        return $this->render('example_entity/index.html.twig', [
            'example_entities' => $exampleEntityRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_example_entity_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $exampleEntity = new ExampleEntity();
        $form = $this->createForm(ExampleEntityType::class, $exampleEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($exampleEntity);
            $entityManager->flush();

            return $this->redirectToRoute('app_example_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('example_entity/new.html.twig', [
            'example_entity' => $exampleEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_example_entity_show', methods: ['GET'])]
    public function show(ExampleEntity $exampleEntity): Response
    {
        return $this->render('example_entity/show.html.twig', [
            'example_entity' => $exampleEntity,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_example_entity_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ExampleEntity $exampleEntity, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExampleEntityType::class, $exampleEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_example_entity_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('example_entity/edit.html.twig', [
            'example_entity' => $exampleEntity,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_example_entity_delete', methods: ['POST'])]
    public function delete(Request $request, ExampleEntity $exampleEntity, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exampleEntity->getId(), $request->request->get('_token'))) {
            $entityManager->remove($exampleEntity);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_example_entity_index', [], Response::HTTP_SEE_OTHER);
    }
}
