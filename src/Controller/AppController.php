<?php
// src/Controller/DefaultController.php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{
    /**
    * @Route("/", name="homepage")
    */
    public function index()
    {
        return $this->render(
            'index.html.twig',
            []
        );
    }
}