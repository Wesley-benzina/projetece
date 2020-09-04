<?php

namespace App\Controller;

use App\Entity\Tache;
use App\Form\TacheType;
use App\Repository\TacheRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/app/tache")
 */

class TacheController extends AbstractController
{
    /**
     * @Route("/", name="list_tache")
     */
    public function index(TacheRepository $tacheRepository)
    {
        if ($this->isGranted('ROLE_ADMIN')){
            $taches = $tacheRepository->findAll();
        } else {
            $taches = $tacheRepository->findByClientUser($this->getUser());
        }

        return $this->render('tache/index.html.twig', [
            'taches' => $taches
        ]);
    }

    /**
     * @Route("/nouveau", name="new_tache")
     */
    public function new(Request $request){
        $tache = new Tache();
        $form = $this->createForm(TacheType::class,$tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $tache->setCreatedAt(new DateTime())
            ->setUpdatedAt(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($tache);
            $em->flush();
            return $this->redirectToRoute('list_tache');
        }

        return $this->render('tache/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="edit_tache")
     */
    public function edit(Tache $tache, Request $request){

        $form = $this->createForm(TacheType::class,$tache);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $tache->setUpdatedAt(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('list_tache');
        }

        return $this->render('tache/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete_tache", methods={"DELETE"})
     */
    public function delete(Tache $tache){
        $em = $this->getDoctrine()->getManager();
        $em->remove($tache);
        $em->flush();
        return $this->redirectToRoute('list_tache');
    }
}
