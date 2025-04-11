<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CategorieController extends AbstractController
{
    #[Route('/categories', name: 'recette_categories')]
    public function recette_categ(RecetteRepository $RecetteRepository): Response
    {
        $recette = $RecetteRepository->findAll();
        return $this->render('categories/categories.html.twig', [
            'recette' => $recette,
        ]);
    }

    #[Route('/categories/{id}', name: 'categories')]
    public function categories(RecetteRepository $RecetteRepository, $id): Response
    {
        $recette = $RecetteRepository->findBy(['categories' => $id]);
        return $this->render('show/index.html.twig', [
            'recette' => $recette,
        ]);
    }
}
