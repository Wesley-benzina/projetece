<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/client")
 */

class ClientController extends AbstractController
{
    /**
     * @Route("/", name="list_client")
     */
    public function index(ClientRepository $clientRepository)
    {
        if ($this->isGranted('ROLE_ADMIN')){
            $clients = $clientRepository->findAll();
        } else {
            $clients = $clientRepository->findBy(['user' => $this->getUser()]);
        }
        return $this->render('client/index.html.twig', [
            'clients' => $clients
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
            $client->setCreatedAt(new DateTime())
                ->setUser($this->getUser());
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
        if ($this->isGranted('ROLE_ADMIN') || $client->getUser() == $this->getUser()){
            $form = $this->createForm(ClientType::class,$client);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()){
                $client->setUpdatedAt(new DateTime());
                $em = $this->getDoctrine()->getManager();
                $em->flush();
                return $this->redirectToRoute('list_client');
            }

            return $this->render('client/edit.html.twig', [
                'form' => $form->createView()
            ]);
        } else {
            return $this->redirectToRoute('list_client');
        }

    }

    /**
     * @Route("/delete/{id}", name="delete_client", methods={"DELETE"})
     */
    public function delete(Client $client){
        $em = $this->getDoctrine()->getManager();
        $em->remove($client);
        $em->flush();
        return $this->redirectToRoute('list_client');
    }
}
