<?php
// src/App/DataFixtures/ORM/LoadUser.php

namespace App\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LoadUser implements FixtureInterface
{

    private $encoder = null;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        // Les noms d'utilisateurs à créer
        $listNames = ['Starwolfy'=>'J45rBa@01s', 'Anaa'=>'anaa'];

        foreach ($listNames as $name=>$pass) {
            // On crée l'utilisateur
            $user = new User;

            // Le nom d'utilisateur et le mot de passe sont identiques pour l'instant
            $user->setUsername($name);

            $encoded = $this->encoder->encodePassword($user, $pass);

            $user->setPassword($encoded);

            $user->setSalt('');
            // On définit uniquement le role ROLE_USER qui est le role de base
            $user->setRoles(array('ROLE_USER'));

            $user->setEnabled(true);

            // On le persiste
            $manager->persist($user);
        }

        // On déclenche l'enregistrement
        $manager->flush();
    }
}