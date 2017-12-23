<?php
// src/Controller/DefaultController.php

namespace App\Controller;

use App\Entity\Army;
use App\Entity\Player;
use App\Services\Calculator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param EntityManagerInterface $entityManager
     *
     * @param Request                $request
     *
     * @return Response
     */
    public function index(EntityManagerInterface $entityManager, Request $request)
    {
        // Get all units
        $units = $entityManager->getRepository('App:Unit')->getAllUnitsByType();
        $unitTypes = $entityManager->getRepository('App:UnitType')->findAll();

        $flash = $request->get('flash', null);


        return $this->render(
            'index.html.twig',
            [
                'unitsByType'=>$units,
                'unitTypes'=>$unitTypes,
                'flash' => $flash
            ]
        );
    }

    /**
     * @Route("/calcule", name="calcule")
     * @param EntityManagerInterface $entityManager
     *
     * @param Request                $request
     *
     * @param Calculator            $calculator
     *
     * @return Response
     */
    public function calcule(EntityManagerInterface $entityManager, Request $request, Calculator $calculator)
    {



        $playerName = $request->get('player');
        $armyData = $request->get('army');


        $unitTypes = $entityManager->getRepository('App:UnitType')->findAll();

        $link = uniqid(str_replace(' ','-',$playerName).'_'.date('Y-m-d').'_');

        $player = new Player();
        $player->setName($playerName);
        $player->setLink($link);
        $entityManager->persist($player);

        foreach ( $armyData as $unitId => $qty) {
            $unit = $entityManager->getRepository('App:Unit')->find($unitId);
            // If no unit found we skip the line
            if (is_null($unit)) {
                continue;
            }

            // If the quantity is an empty string we skip the line
            if ($qty === "") {
                continue;
            }

            // We search a existing army to update
            $army = $entityManager->getRepository('App:Army')->findOneBy(
                [
                    'player' => $player,
                    'unit' => $unit
                ]
            );


            if (is_null($army)) {
                $army = new Army();
            }

            $army->setPlayer($player);
            $army->setUnit($unit);
            $army->setQuantity($qty);
            $entityManager->persist($army);
            $entityManager->flush();
            unset($army);

        }

        $entityManager->flush();

        if (empty($player->getArmies())) {
            return $this->redirectToRoute('homepage', ['flash'=>'No army to calcul']);
        }
        try {
            $calculator->setPlayer($player);
            $calculator->compilation();
        }catch ( Exception $exception) {
            return $this->redirectToRoute('homepage', ['flash'=>$exception->getMessage()]);
        }


        return $this->render(
            'calcule.html.twig',
            [
                'calculatedArmy' => $calculator->getCalculatedArmy(),
                'unitTypes' => $unitTypes,
                'player' => $player
            ]
        );
    }

    /**
     * @Route("/calcule/{link}" , name="calcul_link")
     *
     * @param                        $link
     * @param EntityManagerInterface $entityManager
     * @param Calculator             $calculator
     *
     * @return Response
     */
    public function show($link, EntityManagerInterface $entityManager, Calculator $calculator)
    {

        if ($link === "") {
            return $this->redirectToRoute('homepage', ['flash'=>'Profile not found']);
        }

        $player = $entityManager->getRepository('App:Player')->findOneBy(['link'=>$link]);

        if (is_null($player)) {
            return $this->redirectToRoute('homepage', ['flash'=>'Profile not found']);
        }


        $unitTypes = $entityManager->getRepository('App:UnitType')->findAll();

        try {
            $calculator->setPlayer($player);
            $calculator->compilation();
        }catch ( Exception $exception) {
            return $this->redirectToRoute('homepage', ['flash'=>$exception->getMessage()]);
        }

        return $this->render(
            'calcule.html.twig',
            [
                'calculatedArmy' => $calculator->getCalculatedArmy(),
                'unitTypes' => $unitTypes,
                'player' => $player
            ]
        );
    }
}