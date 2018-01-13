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
     * @Route("/{_locale}", name="homepage", defaults={"_locale"="fr"}, requirements={
     *     "_locale"="en|fr"
     * })
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
                'lastWeek' => isset($playerLastWeek[0]) ? $playerLastWeek[0] : null,
                'lastMonth' => isset($playerLastMonth[0]) ? $playerLastMonth[0] :null
            ]
        );
    }

    /**
     * Calculator entry for a profile that is not the user's one.
     *
     * @Security("has_role('ROLE_USER')")
     * @Route("/addPlayer/{_locale}", name="add_player", defaults={"_locale"="fr"}, requirements={
     *     "_locale"="en|fr"
     * })
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
     * @Route("/updateArmy/{_locale}", name="update_army", defaults={"_locale"="fr"}, requirements={
     *     "_locale"="en|fr"
     * })
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
     * @Route("/listPlayer/{_locale}", name="list_player", defaults={"_locale"="fr"}, requirements={
     *     "_locale"="en|fr"
     * })
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
     * @Route("/userConfig/{_locale}", name="user_config", defaults={"_locale"="fr"}, requirements={
     *     "_locale"="en|fr"
     * })
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