<?php
// src/Controller/DefaultController.php

namespace App\Controller;

use App\Entity\Player;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AppController extends Controller
{
    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/", name="homepage")
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function index(EntityManagerInterface $entityManager)
    {

        $user = $this->getUser();

        if (is_null($user)) {
            $this->redirectToRoute('login');
        }

        $userPlayer = $user->getPlayer();

        if(is_null($userPlayer)){
            return $this->render(
                'index.html.twig',
                [
                    'lastWeek' => null,
                    'lastMonth' => null
                ]
            );

        }

        $playerLastWeek = $entityManager->getRepository('App:PlayerHistory')->getLastWeek($user->getPlayer());
        $playerLastMonth = $entityManager->getRepository('App:PlayerHistory')->getLastMonth($user->getPlayer());

        return $this->render(
            'index.html.twig',
            [
                'lastWeek' => $playerLastWeek[0],
                'lastMonth' => $playerLastMonth[0]
            ]
        );
    }

    /**
     * Calculator entry for a profile that is not the user's one.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/addPlayer", name="add_player")
     * @param EntityManagerInterface $entityManager
     * @param Request                $request
     *
     * @return Response
     */
    public function addPlayer(EntityManagerInterface $entityManager, Request $request)
    {
        $user = $this->getUser();

        if (null === $user) {
            $this->redirectToRoute('login');
        }
        // Get all units
        $units = $entityManager->getRepository('App:Unit')->getAllUnitsByType();
        $unitTypes = $entityManager->getRepository('App:UnitType')->findAll();

        $flash = $request->get('flash', null);


        return $this->render(
            'add-player.html.twig',
            [
                'unitsByType'=>$units,
                'unitTypes'=>$unitTypes,
                'flash' => $flash
            ]
        );
    }

    /**
     *
     * Calculator entry for a logged user's army update
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/updateArmy", name="update_army")
     * @param EntityManagerInterface $entityManager
     * @param Request                $request
     *
     * @return Response
     */
    public function updateArmy(EntityManagerInterface $entityManager, Request $request)
    {
        $user = $this->getUser();

        if (null === $user) {
            $this->redirectToRoute('login');
        }

        // We try to get the user's Player profile
        $userPlayer = $user->getPlayer();

        if(is_null($userPlayer)) {
            $userPlayer = new Player();
        }

        $playerArmyQuantityByUnit = $entityManager->getRepository('App:Unit')->getArmyQuantityByUnit($userPlayer);

        // Get all units
        $units = $entityManager->getRepository('App:Unit')->getAllUnitsByType();
        $unitTypes = $entityManager->getRepository('App:UnitType')->findAll();

        $flash = $request->get('flash', null);


        return $this->render(
            'update-army.html.twig',
            [
                'unitsByType' => $units,
                'unitTypes' => $unitTypes,
                'playerArmyQuantityByUnit' => $playerArmyQuantityByUnit,
                'flash' => $flash
            ]
        );
    }

    /**
     *
     * Currently listing all the player profile but at the end will list only the current user's player profil
     *
     * @Route("/listPlayer", name="list_player")
     * @Security("has_role('ROLE_USER')")
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function listPlayer(EntityManagerInterface $entityManager)
    {

        $players = $entityManager->getRepository('App:Player')->findAll();

        $usersPlayer = $entityManager->getRepository('App:User')->getUserPlayerId();


        return $this->render(
            'list-player.html.twig',
            ['players' => $players,
                'userPlayer' => $usersPlayer]
        );
    }

    /**
     *
     * User setting method @todo
     *
     * @Route("/userConfig", name="user_config")
     * @Security("has_role('ROLE_USER')")
     * @param EntityManagerInterface $entityManager
     * @param Request                $request
     *
     * @return Response
     */
    public function userConfig(EntityManagerInterface $entityManager, Request $request)
    {


        return $this->render(
            'settings.html.twig',
            []
        );
    }

}