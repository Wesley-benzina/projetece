<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index()
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/", name="main")
     */
    public function home()
    {
        return $this->render('main/main.html.twig');
    }

    /**
     * @Route("/clients", name="clients")
     */
    public function clients()
    {
        return $this->render('main/clients.html.twig',[
                'current_menu' => 'clients'
            ]
        );
    }

    /**
     * @Route("/edit_user", name="edit_user")
     */
    public function edit_user()
    {
        return $this->render('main/edit_user.html.twig',[
                'current_menu' => 'clients'
            ]
        );
    }

    /**
     * @Route("/projets", name="projets")
     */
    public function projects ()
    {
        return $this->render('main/projects.html.twig',[
                'current_menu' => 'projects'
            ]
        );
    }

    /**
     * @Route("/devisetfacture", name="devisetfacture")
     */
    public function devisetfacture ()
    {
        return $this->render('main/devisetfacture.html.twig',[
                'current_menu' => 'devisetfacture'
            ]
        );
    }

    /**
     * @Route("/taches", name="taches")
     */
    public function taches ()
    {
        return $this->render('main/taches.html.twig',[
                'current_menu' => 'taches'
            ]
        );
    }

}
