<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    /**
     * @Route("/connection", name="connection")
     */
    public function connection()
    {
        return $this->render('account/connection.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

    /**
     * @Route("/inscription", name="inscription")
     */
    public function inscription()
    {
        return $this->render('account/create_account.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
}
