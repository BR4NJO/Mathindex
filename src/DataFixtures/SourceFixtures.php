<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use App\Entity\Source;

class SourceFixtures extends Fixture
{
    public const SOURCES = [
        "Manuel de mathématiques",
        "Exercice en ligne"
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this::SOURCES as $e) {
            $source = new Source();
            $source->setName($e);

            $this->addReference($e,$source);
            $manager->persist($source);
        }

        $manager->flush();
    }
}