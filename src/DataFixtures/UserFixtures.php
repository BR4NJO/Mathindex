<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\User;

class UserFixtures extends Fixture
{
    public const USERS = [
        ["email" => "dimitri.granit@lyceestvincent.fr",
            "last_name" => "Granit",
            "first_name" => "Dimitri",
            "role" => "admin", //roles : admin, contributor
            "password" => ""], //admin
        ["email" => "marcus.favernay@lyceestvincent.fr",
            "last_name" => "Favernay",
            "first_name" => "Marcus",
            "role" => "contributor", //roles : admin, contributor
            "password" => ""], //admin
        ["email" => "alexandre.brunet@lyceestvincent.fr",
            "last_name" => "Brunet",
            "first_name" => "Alexandre",
            "role" => "contributor", //roles : admin, contributor
            "password" => ""], //admin
    ];
    public function load(ObjectManager $manager): void
    {
        foreach ($this::USERS as $e) {
            $user = new User();
            $user->setEmail($e['email']);
            $user->setPassword($e['password']);
            $user->setRole($e['role']);
            $user->setLastName($e['last_name']);
            $user->setFirstName($e['first_name']);

            $this->addReference($e["email"],$user);
            $manager->persist($user);
        }

        $manager->flush();
    }
}
