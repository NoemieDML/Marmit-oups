<?php

namespace App\Controller;

use App\Entity\Ingredient;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IngredienController extends AbstractController
{
    #[Route('/ingredien', name: 'app_ingredien')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        // 🛡️ Restriction d'accès : uniquement ROLE_ADMIN
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $ingredien = new Ingredient();
        $form = $this->createForm(IngredientType::class, $ingredien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($ingredien);
            $entityManager->flush();

            $this->addFlash('success', 'Ingrédient ajouté avec succès !');
            return $this->redirectToRoute('app_ingredien');
        }

        return $this->render('ingredien/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
