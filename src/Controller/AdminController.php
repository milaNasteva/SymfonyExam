<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_dashboard")
     */
    public function index(): Response
    {
        // Check if user is authorized (ROLE_ADMIN)
        $this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Access denied! You must be an administrator.');

        // Replace with your own logic to handle admin dashboard

        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}