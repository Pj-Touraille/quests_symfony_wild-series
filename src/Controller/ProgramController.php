<?php

// src/Controller/ProgramController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
        return $this->render('program/index.html.twig', [
        'website' => 'Wild Séries',
        ]);
    }

    /**
    * @Route("/{id}", methods={"GET"}, requirements={"id"="\d+"}, name="show")
    */
    public function show(int $id = 1): Response
    {
        return $this->render('program/show.html.twig', ['id' => $id]);
    }

    /**
    * @Route("/new", methods={"GET","POST"}, name="new")
    * @return Response 
    */
    public function new(): Response
    {
        // traitement d'un formulaire par exemple

        // redirection vers la page 'program_show',
        // correspondant à l'url /programs/4
        return $this->redirectToRoute('program_show', ['id' => 4]);
    }
}
