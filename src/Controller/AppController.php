<?php
// src/Controller/DefaultController.php

namespace App\Controller;

use App\Entity\Army;
use App\Form\ArmyType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController
{
    /**
    * @Route("/", name="homepage")
    */
    public function index()
    {
        $army = new Army();
        $form = $this->createForm(ArmyType::class, $army);

        $this->render('army.html.twig', array('form' => $form));
    }
}