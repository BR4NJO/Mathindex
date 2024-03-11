<?php

namespace App\Entity;

use App\Repository\ThematicRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ThematicRepository::class)]
class Thematic
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $course_id = null;

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

    public function getCourseId(): ?int
    {
        return $this->course_id;
    }

    public function setCourseId(int $course_id): static
    {
        $this->course_id = $course_id;

        return $this;
    }

    #[ORM\OneToMany(mappedBy: 'Exercise', targetEntity: Exercise::class)]
    private Collection $exercises;
    public function __construct()
    {
        $this->exercises = new ArrayCollection();
    }

    #[ORM\ManyToOne(targetEntity: Course::class, inversedBy: 'thematics')]
    private Course $course;

    public function setCourse(Course $v): void {
        $this->course = $v;
    }
    public function getCourse (): Course {
        return $this->course;
    }
}
