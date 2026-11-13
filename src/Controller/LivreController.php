<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\EmpruntRepository;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LivreController extends AbstractController
{
    #[Route('/livre/{id}', name: 'app_livre', requirements: ['id' => '\d+'])]
    public function show(
        Livre $livre,
        LivreRepository $livreRepository,
        EmpruntRepository $empruntRepository
    ): Response {
        return $this->render('livre/show.html.twig', [
            'livre'      => $livre,
            'emprunts'   => $empruntRepository->findDerniersPourLivre($livre),
            'memeGenre'  => $livreRepository->findMemeGenre($livre),
        ]);
    }
}