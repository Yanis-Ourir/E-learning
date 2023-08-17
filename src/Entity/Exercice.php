<?php

namespace App\Entity;

use App\Repository\ExerciceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ExerciceRepository::class)]
class Exercice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $statement = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $codepen_exercice = null;

    #[ORM\Column(length: 255)]
    private ?string $codepen_link = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\ManyToOne(inversedBy: 'exercices')]
    private ?User $user = null;

    #[ORM\Column(length: 255)]
    private ?string $codepen_slug = null;

    #[ORM\Column(length: 255)]
    private ?string $codepen_title = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStatement(): ?string
    {
        return $this->statement;
    }

    public function setStatement(string $statement): self
    {
        $this->statement = $statement;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCodepenExercice(): ?string
    {
        return $this->codepen_exercice;
    }

    public function setCodepenExercice(string $codepen_exercice): self
    {
        $this->codepen_exercice = $codepen_exercice;

        return $this;
    }

    public function getCodepenLink(): ?string
    {
        return $this->codepen_link;
    }

    public function setCodepenLink(string $codepen_link): self
    {
        $this->codepen_link = $codepen_link;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCodepenSlug(): ?string
    {
        return $this->codepen_slug;
    }

    public function setCodepenSlug(string $codepen_slug): self
    {
        $this->codepen_slug = $codepen_slug;

        return $this;
    }

    public function getCodepenTitle(): ?string
    {
        return $this->codepen_title;
    }

    public function setCodepenTitle(string $codepen_title): self
    {
        $this->codepen_title = $codepen_title;

        return $this;
    }
}
