<?php 
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'app_conference')]
    public function index(): Response
    {
        return $this->render('hello/index.html.twig', [
            'message' => 'Hello World',
        ]);
    }
} 
?>