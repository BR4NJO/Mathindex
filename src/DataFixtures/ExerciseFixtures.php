<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\Exercise;
use App\DataFixtures\FileFixtures;
use App\DataFixtures\ThematicFixtures;
use App\DataFixtures\ClassroomFixtures;
use App\DataFixtures\SourceFixtures;
use App\DataFixtures\UserFixtures;

class ExerciseFixtures extends Fixture implements DependentFixtureInterface
{

    public const EXERCISES = [
        ["name" => "Exercice sur une suite récurrente",
            "chapter" => "test",
            "keywords" => "tag1;tag2;tag3",
            "difficulty" => 10,
            "proposed_by_type" => "Contributor",
            "proposed_by_first_name" => "John",
            "proposed_by_last_name" => "Smith",
            "source_name" => "https://github.com",
            "source_information" => "test"]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this::EXERCISES as $e) {
            $exercise = new Exercise();
            $exercise->setName($e["name"]);
            $exercise->setChapter($e["chapter"]);
            $exercise->setDifficulty($e["difficulty"]);
            $exercise->setKeywords($e["keywords"]);
            $exercise->setProposedByFirstName($e["proposed_by_first_name"]);
            $exercise->setProposedByLastName($e["proposed_by_last_name"]);
            $exercise->setProposedByType($e["proposed_by_type"]);
            $exercise->setSourceName($e["source_name"]);
            $exercise->setSourceInformation($e["source_information"]);
            
            $exercise->setClassroom($this->getReference(ClassroomFixtures::CLASSROOMS[array_rand(ClassroomFixtures::CLASSROOMS)]));

            $exercise->setThematic($this->getReference(ThematicFixtures::THEMATICS[array_rand(ThematicFixtures::THEMATICS)]));

            $exercise->setSource($this->getReference(SourceFixtures::SOURCES[array_rand(SourceFixtures::SOURCES)]));

            $exercise->setUser($this->getReference(UserFixtures::USERS[array_rand(UserFixtures::USERS)]["email"]));

            for ($i = 0; $i < 3; $i++) {
                $exercise->addSkill($this->getReference(SkillFixtures::SKILLS[array_rand(SkillFixtures::SKILLS)]));
            }

            $exercise->setExerciseFile($this->getReference(FileFixtures::FILES[array_rand(FileFixtures::FILES)]["name"]));
            $exercise->setCorrectionFile($this->getReference(FileFixtures::FILES[array_rand(FileFixtures::FILES)]["name"]));

            $manager->persist($exercise);
        }

        $manager->flush();
    }
    public function getDependencies() {
        return array(
            FileFixtures::class,
            ClassroomFixtures::class,
            ThematicFixtures::class,
            SourceFixtures::class,
            UserFixtures::class,
            SkillFixtures::class
        );
    }
}