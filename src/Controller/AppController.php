<?php
// src/Controller/DefaultController.php

namespace App\Controller;

use App\Entity\Army;
use App\Entity\Player;
use App\Services\Calculator;
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
     * @param Calculator            $calculateur
     *
     * @return Response
     */
    public function calcule(EntityManagerInterface $entityManager, Request $request, Calculator $calculateur)
    {
        $playerName = $request->get('player');
        $armyData = $request->get('army');
        dump($playerName);
        dump($armyData);

        $link = uniqid($playerName.'_'.date('Y-m-d').'_');

        $player = new Player();
        $player->setName($playerName);
        $player->setLink($link);
        $entityManager->persist($player);

        foreach ( $armyData as $unitId => $qty) {
            $unit = $entityManager->getRepository('App:Unit')->find($unitId);

            $army = new Army();
            $army->setPlayer($player);
            $army->setUnit($unit);
            $army->setQuantity($qty);
            $entityManager->persist($army);
        }

        $entityManager->flush();


        $calcule = $calculateur->setPlayer($player);




        return $this->render(
            'calcule.html.twig',
            [ 'calcule' => $calcule ]
        );
    }
}