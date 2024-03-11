<?php

namespace App\Entity;

use App\Repository\CourseRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CourseRepository::class)]
class Course
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /* RELATIONS */

    #[ORM\OneToMany(mappedBy: 'Thematic', targetEntity: Thematic::class)]
    private Collection $thematics;

    #[ORM\OneToMany(mappedBy: 'Skill', targetEntity: Skill::class)]
    private Collection $skills;
    public function __construct()
    {
        $this->skills = new ArrayCollection();
        $this->thematics = new ArrayCollection();
    }
}
