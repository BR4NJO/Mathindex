<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Course;

class CourseFixtures extends Fixture
{
    public const COURSES = ["Mathématiques"];

    public function load(ObjectManager $manager): void
    {
        foreach ($this::COURSES as $e) {
            $course = new Course();
            $course->setName($e);

            $this->addReference($e,$course);

            $manager->persist($course);
        }

        $manager->flush();
    }
}