<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactoryInterface;

class UserFixtures extends Fixture
{
    private $hasher;

    public function __construct(PasswordHasherFactoryInterface $factory) 
    {
        $this->hasher = $factory->getPasswordHasher('main');
    }

    public const USERS = [
        ["email" => "dimitri.granit@lyceestvincent.fr",
            "last_name" => "Granit",
            "first_name" => "Dimitri",
            "role" => "admin",
            "password" => "admin"],
        ["email" => "marcus.favernay@lyceestvincent.fr",
            "last_name" => "Favernay",
            "first_name" => "Marcus",
            "role" => "contributor",
            "password" => "admin"],
        ["email" => "alexandre.brunet@lyceestvincent.fr",
            "last_name" => "Brunet",
            "first_name" => "Alexandre",
            "role" => "contributor",
            "password" => "admin"],
    ];
    public function load(ObjectManager $manager): void
    {
        foreach ($this::USERS as $e) {
            $user = new User();
            $user->setEmail($e['email']);
            $user->setPassword($this->hasher->hash($e["password"]));
            $user->setRole($e['role']);
            $user->setLastName($e['last_name']);
            $user->setFirstName($e['first_name']);

            $this->addReference($e["email"],$user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
