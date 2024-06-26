<?php
namespace App\Controller;

use App\Entity\ExampleEntity;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleEntityRepository extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/example/create", name="example_create", methods={"GET", "POST"})
     */
    public function create(Request $request): Response
    {
        $exampleEntity = new ExampleEntity();
        $form = $this->createForm(ExampleEntityType::class, $exampleEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($exampleEntity);
            $this->entityManager->flush();

            $this->addFlash('success', 'ExampleEntity created successfully!');
            return $this->redirectToRoute('example_index');
        }

        return $this->render('example/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/example/{id}", name="example_show", methods={"GET"})
     */
    public function show(ExampleEntity $exampleEntity): Response
    {
        return $this->render('example/show.html.twig', [
            'exampleEntity' => $exampleEntity,
        ]);
    }

    /**
     * @Route("/example/{id}/edit", name="example_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ExampleEntity $exampleEntity): Response
    {
        $form = $this->createForm(ExampleEntityType::class, $exampleEntity);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            $this->addFlash('success', 'ExampleEntity updated successfully!');
            return $this->redirectToRoute('example_index');
        }

        return $this->render('example/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/example/{id}", name="example_delete", methods={"DELETE"})
     */
    public function delete(Request $request, ExampleEntity $exampleEntity): Response
    {
        if ($this->isCsrfTokenValid('delete'.$exampleEntity->getId(), $request->request->get('_token'))) {
            $this->entityManager->remove($exampleEntity);
            $this->entityManager->flush();

            $this->addFlash('success', 'ExampleEntity deleted successfully!');
        }

        return $this->redirectToRoute('example_index');
    }
}