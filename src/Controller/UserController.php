<?php 
namespace App\Controller;

use App\Form\UserFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    /**
     * @Route("/user/create", name="user_create")
     */
    #[Route('/user/create', name: 'user_create')]
    public function newUser(Request $request): Response
    {
        $form = $this->createForm(UserFormType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formData = $form->getData();

            $this->addFlash('success', 'Form submitted successfully!');

            return $this->redirectToRoute('user_new');
        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

?>