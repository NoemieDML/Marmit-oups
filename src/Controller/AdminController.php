<?php

namespace App\Controller;

use App\Repository\UserRepository;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/remove_user/{id}', name: 'remove_user')]
    public function remove_recette(EntityManagerInterface $entitymanager, UserRepository $user_repository, $id): Response
    {
        $user = $user_repository->find($id);

        $entitymanager->remove($user);

        $entitymanager->flush();

        return $this->redirectToRoute('');
    }
}
