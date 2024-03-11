<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use App\Entity\File;

class FileFixtures extends Fixture
{
    public const FILES = [
        ["original_name" => "test.pdf",
            "name" => "MathIndex_Mathématiques_Suites_45_Exercice",
            "extension" => "pdf",
            "size" => 12000],
        ["original_name" => "test.pdf",
            "name" => "MathIndex_Mathématiques_Suites_45_Corrigé",
            "extension" => "pdf",
            "size" => 12000],
        ["original_name" => "test.pdf",
            "name" => "MathIndex_Mathématiques_Suites_84_Exercice",
            "extension" => "pdf",
            "size" => 12000],
        ["original_name" => "test.pdf",
            "name" => "MathIndex_Mathématiques_Suites_84_Corrigé",
            "extension" => "pdf",
            "size" => 12000],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach ($this::FILES as $e) {
            $file = new File();

            $file->setName($e['name']);
            $file->setOriginalName($e['original_name']);
            $file->setExtension($e['extension']);
            $file->setSize($e['size']);

            $manager->persist($file);
            
            $this->addReference($e["name"],$file);
        }

        $manager->flush();
    }
}