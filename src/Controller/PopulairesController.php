<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PopulairesController extends AbstractController
{
    #[Route('/populaires', name: 'app_populaires')]
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('populaires/index.html.twig', [
            'livres' => $livreRepository->findPlusEmpruntes(5),
        ]);
    }
}