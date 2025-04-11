<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class S'inscrire/SeConnecterController extends AbstractController{
    #[Route('/s/inscrire/se/connecter', name: 'app_s_inscrire_se_connecter')]
    public function index(): Response
    {
        return $this->render('s'inscrire/se_connecter/index.html.twig', [
            'controller_name' => 'S'inscrire/SeConnecterController',
        ]);
    }
}
