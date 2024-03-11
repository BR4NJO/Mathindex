<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Classroom;

class ClassroomFixtures extends Fixture
{
    public const CLASSROOMS = [
        "Collège",
        "Lycée",
        "Supérieur"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this::CLASSROOMS as $e) {
            $classroom = new Classroom();
            $classroom->setName($e);

            $manager->persist($classroom);

            $this->addReference($e,$classroom);
        }

        $manager->flush();
    }
}