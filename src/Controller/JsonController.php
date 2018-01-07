<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class JsonController extends Controller
{
    /**
     * @Route("/json/all-players", name="allPlayers")
     * @param EntityManagerInterface $entityManager
     *
     * @return JsonResponse
     */
    public function allPlayers(EntityManagerInterface $entityManager)
    {
        $players = $entityManager->getRepository('App:Player')->getCount();

        return new JsonResponse($players);
    }
}
