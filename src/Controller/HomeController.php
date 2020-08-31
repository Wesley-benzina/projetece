<?php

namespace App\Controller;

use App\Repository\TacheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(TacheRepository $tacheRepository)
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'taches' => $tacheRepository->findAll()
        ]);
    }
}
