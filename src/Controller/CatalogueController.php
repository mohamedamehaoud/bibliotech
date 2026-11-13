<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogueController extends AbstractController
{
    #[Route('/', name: 'app_catalogue')]
    public function index(Request $request, LivreRepository $livreRepository): Response
    {
        $filtres = [
            'genre'  => $request->query->get('genre'),
            'auteur' => $request->query->get('auteur'),
            'tri'    => $request->query->get('tri'),
        ];

        return $this->render('catalogue/index.html.twig', [
            'livres'  => $livreRepository->findCatalogue($filtres['genre'], $filtres['auteur'], $filtres['tri']),
            'genres'  => $livreRepository->findGenres(),
            'auteurs' => $livreRepository->findAuteurs(),
            'filtres' => $filtres,
        ]);
    }
}