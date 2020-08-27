<?php

namespace App\Controller;


use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/projet")
 */
class ProjetController extends AbstractController
{
    /**
     * @Route("/liste", name="liste_projet")
     * @param ProjectRepository $projectRepository
     * @return Response
     */
    public function index(ProjectRepository $projectRepository)
    {
        return $this->render('projet/index.html.twig', [
            'listProject' => $projectRepository->findAll()
        ]);
    }

    /**
     * @Route("/nouveau", name="new_project")
     * @param Request $request
     * @return Response
     */
    public function new(Request $request){
        $project = new Project();
        $form = $this->createForm(ProjectType::class,$project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $project->setCreatedAt(new DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($project);
            $em->flush();
            return $this->redirectToRoute('liste_projet');
        }

        return $this->render('projet/new.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/{id}", name="edit_projet")
     */
    public function edit(Project $project, Request $request){

        $form = $this->createForm(ProjectType::class,$project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $project->setUpdatedAt(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('liste_projet');
        }

        return $this->render('projet/edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
