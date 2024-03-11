<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\Thematic;
use App\DataFixtures\CourseFixtures;

class ThematicFixtures extends Fixture implements DependentFixtureInterface
{
    public const THEMATICS = [
        "Suites",
        "Primitives",
        "Géométrie"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this::THEMATICS as $e) {
            $thematic = new Thematic();

            $thematic->setName($e);
            $thematic->setCourse($this->getReference(CourseFixtures::COURSES[array_rand(CourseFixtures::COURSES)]));

            $this->addReference($e,$thematic);

            $manager->persist($thematic);  
        }

        $manager->flush();
    }
    public function getDependencies() {
        return array(
            CourseFixtures::class
        );
    }
}