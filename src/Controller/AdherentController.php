<?php

namespace App\Controller;

use App\Entity\Adherent;
use App\Repository\EmpruntRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdherentController extends AbstractController
{
    #[Route('/adherent/{id}', name: 'app_adherent', requirements: ['id' => '\d+'])]
    public function show(Adherent $adherent, EmpruntRepository $empruntRepository): Response
    {
        return $this->render('adherent/show.html.twig', [
            'adherent' => $adherent,
            'emprunts' => $empruntRepository->findBy(
                ['adherent' => $adherent],
                ['dateEmprunt' => 'DESC']
            ),
        ]);
    }
}