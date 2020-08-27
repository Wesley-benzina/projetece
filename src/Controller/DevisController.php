<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\Devis;
use App\Form\ClientType;
use App\Form\DevisType;
use App\Repository\DevisRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/devisetfacture")
 */
class DevisController extends AbstractController
{
    /**
     * @Route("/", name="liste_devis")
     * @param DevisRepository $devisRepository
     * @return Response
     */
    public function index(DevisRepository $devisRepository)
    {
        return $this->render('devis/index.html.twig', [
            'listDevis' => $devisRepository->findAll()
        ]);
    }

    /**
     * @Route("/nouveau", name="new_devis")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request){
        $devis = new Devis();
        $form = $this->createForm(DevisType::class,$devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $devis->setCreatedAt(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($devis);
            $em->flush();
            return $this->redirectToRoute('liste_devis');
        }

        return $this->render('devis/new.html.twig', [
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/{id}", name="edit_devis")
     */
    public function edit(Devis $devis, Request $request){

        $form = $this->createForm(DevisType::class,$devis);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $devis->setUpdatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('liste_devis');
        }

        return $this->render('devis/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }
    /**
     * @Route("/delete/{id}", name="delete_devis")
     */
    public function delete(Devis $devis){
        $em = $this->getDoctrine()->getManager();
        $em->remove($devis);
        $em->flush();
        return $this->redirectToRoute('liste_devis');
    }

    /**
     * @Route("/show/{id}", name="show_devis")
     */
    public function show(DevisRepository $devisRepository){
        return $this->render('devis/show.html.twig', [
            'listeDevis' => $devisRepository->findAll()
        ]);
        $devis = new Devis();
        $devis->setCreatedAt(new DateTime());

    }
}

