<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ShowController extends AbstractController
{
    #[Route('recette_show/{id}', name: 'recette_show')]
    public function show(RecetteRepository $RecetteRepository, $id): Response
    {
        $recette = $RecetteRepository->find($id);
        return $this->render('show/index.html.twig', [
            'recette' => $recette,
        ]);
    }
}
