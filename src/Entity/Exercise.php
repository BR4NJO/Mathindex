<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
#[Vich\Uploadable]
class Exercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name;

    #[ORM\ManyToOne(targetEntity: Classroom::class, inversedBy: 'exercises')]
    private Classroom $classroom;

    #[ORM\ManyToOne(targetEntity: Thematic::class, inversedBy: 'exercises')]
    private Thematic $thematic;

    #[ORM\Column]
    private ?int $difficulty = 0;

    #[ORM\Column]
    private ?float $duration = 0;

    #[ORM\Column(length: 255)]
    private ?string $keywords;

    #[ORM\OneToOne(cascade: ["persist"])]
    private ?File $exercise_file = null;

    #[ORM\OneToOne(cascade: array("persist"))]
    private ?File $correction_file = null;

    //

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proposed_by_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proposed_by_first_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $proposed_by_last_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $source_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $source_information = null;

    //

    #[ORM\ManyToOne(targetEntity: Source::class, inversedBy: 'exercises')]
    private ?Source $source = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'exercises')]
    private User $user;

    #[ORM\ManyToMany(inversedBy: 'exercises', targetEntity: Skill::class)]
    private Collection $skills;

    #[ORM\Column(length: 255)]
    private ?string $chapter = null;

    #[ORM\ManyToOne(inversedBy: 'exercises')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Course $Course = null;

    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
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

    public function getClassroom(): Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(Classroom $classroom): void
    {
        $this->classroom = $classroom;
    }

    public function getThematic(): Thematic
    {
        return $this->thematic;
    }

    public function setThematic(Thematic $thematic): void
    {
        $this->thematic = $thematic;
    }

    public function getDifficulty(): ?int
    {
        return $this->difficulty;
    }

    public function setDifficulty(int $difficulty): static
    {
        $this->difficulty = $difficulty;
        return $this;
    }

    public function getDuration(): ?float
    {
        return $this->duration;
    }

    public function setDuration(float $duration): static
    {
        $this->duration = $duration;
        return $this;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(string $keywords): static
    {
        $this->keywords = $keywords;
        return $this;
    }

    public function getExerciseFile(): ?File
    {
        return $this->exercise_file;
    }

    public function setExerciseFile(File $exercise_file): void
    {
        $this->exercise_file = $exercise_file;
    }

    public function getCorrectionFile(): ?File
    {
        return $this->correction_file;
    }

    public function setCorrectionFile(File $correction_file): void
    {
        $this->correction_file = $correction_file;
    }

    public function getSource(): ?Source
    {
        return $this->source;
    }

    public function setSource(?Source $source): void
    {
        $this->source = $source;
    }

    public function getUser(): User
    {
        return $this->user;
    }

    public function setUser(User $user): void
    {
        $this->user = $user;
    }

    public function addSkill(Skill $skill): void
    {
        $this->skills->add($skill);
    }

    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function removeSkill(Skill $skill): void
    {
        $this->skills->removeElement($skill);
    }

    public function getProposedByType(): ?string
    {
        return $this->proposed_by_type;
    }

    public function setProposedByType(?string $proposed_by_type): static
    {
        $this->proposed_by_type = $proposed_by_type;

        return $this;
    }

    public function getProposedByFirstName(): ?string
    {
        return $this->proposed_by_first_name;
    }

    public function setProposedByFirstName(?string $proposed_by_first_name): static
    {
        $this->proposed_by_first_name = $proposed_by_first_name;

        return $this;
    }

    public function getProposedByLastName(): ?string
    {
        return $this->proposed_by_last_name;
    }

    public function setProposedByLastName(?string $proposed_by_last_name): static
    {
        $this->proposed_by_last_name = $proposed_by_last_name;

        return $this;
    }

    public function getSourceName(): ?string
    {
        return $this->source_name;
    }

    public function setSourceName(?string $source_name): static
    {
        $this->source_name = $source_name;

        return $this;
    }

    public function getSourceInformation(): ?string
    {
        return $this->source_information;
    }

    public function setSourceInformation(?string $source_information): static
    {
        $this->source_information = $source_information;

        return $this;
    }

    public function getChapter(): ?string
    {
        return $this->chapter;
    }

    public function setChapter(string $chapter): static
    {
        $this->chapter = $chapter;

        return $this;
    }

    public function getCourse(): ?Course
    {
        return $this->Course;
    }

    public function setCourse(?Course $Course): static
    {
        $this->Course = $Course;

        return $this;
    }
}
