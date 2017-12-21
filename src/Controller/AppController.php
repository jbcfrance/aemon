<?php
// src/Controller/DefaultController.php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function index(EntityManagerInterface $entityManager)
    {
        // Get all units
        $units = $entityManager->getRepository('App:Unit')->getAllUnitsByType();
        $unitTypes = $entityManager->getRepository('App:UnitType')->findAll();


        return $this->render(
            'index.html.twig',
            [
                'units'=>$units,
                'unitTypes'=>$unitTypes
            ]
        );
    }

    /**
     * @Route("/calcule", name="calcule")
     * @param EntityManagerInterface $entityManager
     *
     * @param Request                $request
     *
     * @return void
     */
    public function calcule(EntityManagerInterface $entityManager, Request $request)
    {
        $player = $request->get('player');
        $armyData = $request->get('army');
        dump($player);
        dump($armyData);

        return $this->render(
            'calcule.html.twig',
            [
            ]
        );
    }
}