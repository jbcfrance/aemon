<?php
// src/Controller/DefaultController.php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
     *
     * @Route("/login", name="login")
     * @param EntityManagerInterface $entityManager
     *
     * @return Response
     */
    public function login(EntityManagerInterface $entityManager)
    {
        return $this->render(
            'user/login.html.twig',
            [

            ]
        );
    }

    /**
     *
     * @Route("/logout", name="logout")
     * @param EntityManagerInterface $entityManager
     */
    public function logout(EntityManagerInterface $entityManager)
    {

    }


    /**
     *
     * @Route("/register", name="register")
     * @param Request                      $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // 4) save the User!
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'user/register.html.twig',
            array('form' => $form->createView())
        );
    }

}