<?php

namespace App\Controller;

use App\Service\ExampleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController
{
    private $exampleService;

    public function __construct(ExampleService $exampleService)
    {
        $this->exampleService = $exampleService;
    }

    /**
     * @Route("/example", name="example")
     */
    #[Route('/example', name: 'example')]
    public function index(): Response
    {
        $message = $this->exampleService->doSomething();

        return $this->render('example/index.html.twig', [
            'message' => $message,
        ]);
    }
}

?>
