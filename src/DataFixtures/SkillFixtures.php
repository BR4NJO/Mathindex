<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\Skill;
use App\DataFixtures\CourseFixtures;

class SkillFixtures extends Fixture implements DependentFixtureInterface
{
    public const SKILLS = [
        "Chercher",
        "Représenter",
        "Calculer",
        "Modéliser",
        "Raisonner",
        "Communiquer"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this::SKILLS as $e) {
            $skill = new Skill();
            $skill->setName($e);

            $skill->setCourse($this->getReference(CourseFixtures::COURSES[array_rand(CourseFixtures::COURSES)]));

            $this->addReference($e,$skill);
            $manager->persist($skill);
        }

        $manager->flush();
    }
    public function getDependencies() {
        return array(
            CourseFixtures::class
        );
    }
}