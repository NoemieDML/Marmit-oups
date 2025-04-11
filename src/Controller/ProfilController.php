<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\UserRepository;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(): Response
    {
        return $this->render('profil/index.html.twig', [
            'controller_name' => 'ProfilController',
        ]);
    }

    #[Route('/recette_user', name: 'recette_user')]
    public function recette_user(UserRepository $UserRepository): Response
    {
        $user = $UserRepository->find(1); // TODO  a changer !!!


        return $this->render('profil/index.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/add_recette', name: 'add_recette')]
    public function add_recette(
        RecetteRepository $RecetteRepository,
        EntityManagerInterface $entityManager,
        Request $request
    ): Response {

        $recette = new Recette();
        $form = $this->createForm(RecetteType::class, $recette);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($recette);
            $entityManager->flush();
        }

        return $this->render('profil/add.html.twig', [
            'recette' => $recette,
            'form' => $form->createView()
        ]);
    }

    #[Route('/remove_recette/{id}', name: 'remove_recette')]
    public function remove_recette(EntityManagerInterface $entitymanager, RecetteRepository $recette_repository, $id): Response
    {
        $recette = $recette_repository->find($id);

        $entitymanager->remove($recette);

        $entitymanager->flush();


        return $this->redirectToRoute('profil');
    }

    #[Route('/edit_recette/{id}/recette', name: 'edit_recette')]
    public function edit_recette(EntityManagerInterface $entitymanager, RecetteRepository $recette_repository, $name, $id): Response
    {
        $recette = $recette_repository->find($id);

        $recette->setLabel($name);
        $entitymanager->persist($recette);
        $entitymanager->flush();

        return $this->render('profil/add_recette.html.twig');
    }
}
