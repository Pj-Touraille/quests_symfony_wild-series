<?php

// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Episode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\ProgramType;
use Symfony\Component\HttpFoundation\Request;

/**
* @Route("/programs", name="program_")
*/
class ProgramController extends AbstractController
{
    /**
     * @Route("/", name="index")
     * @return Response 
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig',
            [
                'programs' => $programs,
            ]
        );
    }

    /**
     * The controller for the program add form
     * @Route("/new", name="new")
     * @return Response
     */
    public function new(Request $request) : Response
    {
        // Create a new Category Object
        $program = new Program();
        // Create the associated Form
        $form = $this->createForm(ProgramType::class, $program);
        // Get data from HTTP request
        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted()) {
            /// Deal with the submitted data
            // Get the Entity Manager
            $entityManager = $this->getDoctrine()->getManager();
            // Persist Category Object
            $entityManager->persist($program);
            // Flush the persisted object
            $entityManager->flush();
            // Finally redirect to categories list
            return $this->redirectToRoute('category_index');
        }
        // Render the form
        return $this->render('program/new.html.twig', ["form" => $form->createView()]);
    }

    /**
    * @Route("/{id}", methods={"GET"}, requirements={"id"="\d+"}, name="show")
    * @return Response
    */
    public function show(Program $program): Response
    {
        return $this->render(
            'program/show.html.twig',
            [
                'program' => $program
            ]
        );
    }

    /**
    * @Route("/{program}/season/{season}", methods={"GET"}, requirements={"programId"="\d+", "seasonId"="\d+"}, name="season_show")
    * @return Response
    */
    public function showSeason(program $program, Season $season): Response
    {
        return $this->render(
            'program/season_show.html.twig',
            [
                'program' => $program,
                'season' => $season
            ]
        );
    }

    /**
    * @Route("/{program}/season/{season}/episode/{episode}", methods={"GET"}, name="episode_show")
    * @return Response
    */
    public function showEpisode(program $program, Season $season, Episode $episode): Response
    {
        return $this->render(
            'program/episode_show.html.twig',
            [
                'program' => $program,
                'season' => $season,
                'episode' => $episode
            ]
        );
    }
}
