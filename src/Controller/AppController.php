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
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
     * @Route("/profile", name="user_profile")
     * @param EntityManagerInterface $entityManager
     *
     * @param Request                $request
     *
     * @return Response
     */
    public function profileAction(EntityManagerInterface $entityManager, Request $request)
    {
        // Get all units
        $security = $this->get('security.token_storage');

        // On récupère le token
        $token = $security->getToken();

        // Sinon, on récupère l'utilisateur
        $user = $token->getUser();

        // Si l'utilisateur courant est anonyme, $user vaut « anon. »
        if (null === $user) {
            return $this->redirectToRoute('login');
        } else {
            $user->getUsername();
        }


        return $this->render(
            'profile.html.twig',
            [
                'user' => $user
            ]
        );
    }


    /**
     * @Route("/login", name="login")
     * @param Request             $request
     * @param AuthenticationUtils $authUtils
     *
     * @return Response
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('homepage');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ));
    }

    /**
     * @Route("/login_check", name="login_check")
     */
    public function checkLogin()
    {
        $security = $this->get('security.token_storage');

        // On récupère le token
        $token = $security->getToken();

        // Sinon, on récupère l'utilisateur
        $user = $token->getUser();

        // Si l'utilisateur courant est anonyme, $user vaut « anon. »
        if (null === $user) {
            return $this->redirectToRoute('login');
        } else {
            $user->getUsername();
        }


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
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();


            return $this->redirectToRoute('login');
        }

        return $this->render(
            'register.html.twig',
            array('form' => $form->createView())
        );
    }

}