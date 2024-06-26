<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;

use App\Entity\Exercise;

use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File as HttpFile;

#[ORM\Entity(repositoryClass: FileRepository::class)]
#[Vich\Uploadable]
class File
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping: 'file', fileNameProperty: 'name', size: 'size')]
    private ?HttpFile $imageFile = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $original_name = null;

    #[ORM\Column(length: 255)]
    private ?string $extension = null;

    #[ORM\Column]
    private ?int $size = null;

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

    public function getOriginalName(): ?string
    {
        return $this->original_name;
    }

    public function setOriginalName(string $original_name): static
    {
        $this->original_name = $original_name;

        return $this;
    }

    public function getExtension(): ?string
    {
        return $this->extension;
    }

    public function setExtension(string $extension): static
    {
        $this->extension = $extension;

        return $this;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setSize(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    /* RELATIONS */

    #[ORM\OneToOne(mappedBy: 'exercise_file', targetEntity: Exercise::class, cascade: ["persist"])]
    private ?Exercise $exercise = null;

    public function getExercise(): ?Exercise
    {
        return $this->exercise;
    }

    public function setExercise(?Exercise $exercise): static
    {
        $this->exercise = $exercise;

        return $this;
    }

    /* VICH */

    public function setImageFile(?HttpFile $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            //$this->setOriginalName($imageFile->getOriginalName());
            //$this->setSize($imageFile->getSize());
        }
    }

    public function getImageFile(): ?HttpFile
    {
        return $this->imageFile;
    }

    public function __toString(): string
    {
        return $this->name ?? '';
    }
}
