<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/client")
 */

class ClientController extends AbstractController
{
    /**
     * @Route("/", name="list_client")
     */
    public function index(ClientRepository $clientRepository)
    {
        return $this->render('client/index.html.twig', [
            'clients' => $clientRepository->findAll()
        ]);
    }

    /**
     * @Route("/nouveau", name="new_client")
     */
    public function new(Request $request){
        $client = new Client();
        $form = $this->createForm(ClientType::class,$client);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){
            $client->setCreatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($client);
            $em->flush();
            return $this->redirectToRoute('list_client');
        }

        return $this->render('client/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="edit_client")
     */
    public function edit(Client $client, Request $request){

        $form = $this->createForm(ClientType::class,$client);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $client->setUpdatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('list_client');
        }

        return $this->render('client/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_client")
     */
    public function delete(Client $client){
        $em = $this->getDoctrine()->getManager();
        $em->remove($client);
        $em->flush();
        return $this->redirectToRoute('list_client');
    }
}
