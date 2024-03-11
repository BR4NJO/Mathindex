<?php

namespace App\Entity;

use App\Repository\ExerciseRepository;
use Doctrine\ORM\Mapping as ORM;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Entity\Skill;

#[ORM\Entity(repositoryClass: ExerciseRepository::class)]
class Exercise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = "Placeholder";

    #[ORM\Column(length: 255)]
    private ?string $chapter = "Placeholder";

    #[ORM\Column(length: 255)]
    private ?string $keywords = "Placeholder";

    #[ORM\Column]
    private ?int $difficulty = 0 ;

    #[ORM\Column]
    private ?float $duration = 0;

    #[ORM\Column(length: 255)]
    private ?string $proposed_by_type = "Placeholder";

    #[ORM\Column(length: 255)]
    private ?string $proposed_by_first_name = "Placeholder";

    #[ORM\Column(length: 255)]
    private ?string $proposed_by_last_name = "Placeholder";

    #[ORM\Column(length: 255)]
    private ?string $source_name = "Placeholder";

    #[ORM\Column(length: 255)]
    private ?string $source_information = "Placeholder";

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

    public function getChapter(): ?string
    {
        return $this->chapter;
    }

    public function setChapter(string $chapter): static
    {
        $this->chapter = $chapter;

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

    public function getProposedByType(): ?string
    {
        return $this->proposed_by_type;
    }

    public function setProposedByType(string $proposed_by_type): static
    {
        $this->proposed_by_type = $proposed_by_type;

        return $this;
    }

    public function getProposedByFirstName(): ?string
    {
        return $this->proposed_by_first_name;
    }

    public function setProposedByFirstName(string $proposed_by_first_name): static
    {
        $this->proposed_by_first_name = $proposed_by_first_name;

        return $this;
    }

    public function getProposedByLastName(): ?string
    {
        return $this->proposed_by_last_name;
    }

    public function setProposedByLastName(string $proposed_by_last_name): static
    {
        $this->proposed_by_last_name = $proposed_by_last_name;

        return $this;
    }

    public function getSourceName(): ?string
    {
        return $this->source_name;
    }

    public function setSourceName(string $source_name): static
    {
        $this->source_name = $source_name;

        return $this;
    }

    public function getSourceInformation(): ?string
    {
        return $this->source_information;
    }

    public function setSourceInformation(string $source_information): static
    {
        $this->source_information = $source_information;

        return $this;
    }

    /* RELATIONS */

    #[ORM\ManyToOne(targetEntity: Source::class, inversedBy: 'exercises')]
    private Source $source;
    public function setSource (Source $v): void {
        $this->source = $v;
    }
    public function getSource (): Source {
        return $this->source;
    }

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'exercises')]
    private User $user;
    public function setUser (User $v): void {
        $this->user = $v;
    }
    public function getUser (): User {
        return $this->user;
    }

    #[ORM\OneToOne(targetEntity:File::class, inversedBy: 'exercise')]
    private File $exercise_file;
    public function setExerciseFile (File $v): void {
        $this->exercise_file = $v;
    }
    public function getExerciseFile (): File {
        return $this->exercise_file;
    }

    #[ORM\OneToOne(targetEntity:File::class, inversedBy: 'exercise', cascade: array("persist"))]
    private File $correction_file;
    public function setCorrectionFile (File $v): void {
        $this->correction_file = $v;
    }
    public function getCorrectionFile (): File {
        return $this->correction_file;
    }

    #[ORM\ManyToOne(targetEntity: Classroom::class, inversedBy: 'exercises')]
    private Classroom $classroom;

    public function setClassroom (Classroom $v): void {
        $this->classroom = $v;
    }
    public function getClassroom (): Classroom {
        return $this->classroom;
    }

    #[ORM\ManyToOne(targetEntity: Thematic::class, inversedBy: 'exercises')]
    private Thematic $thematic;

    public function setThematic(Thematic $v): void {
        $this->thematic = $v;
    }
    public function getThematic (): Thematic {
        return $this->thematic;
    }

    #[ORM\ManyToMany(inversedBy: 'exercises', targetEntity: Skill::class)]
    private Collection $skills;
    public function __construct()
    {
        $this->skills = new ArrayCollection();
    }
    public function addSkill (Skill $v): void {
        $this->skills->add($v);
    }
}
