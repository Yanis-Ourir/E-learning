<?php

namespace App\Entity;

use App\Repository\ToDoListRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ToDoListRepository::class)]
class ToDoList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Exercice::class)]
    private Collection $id_exercice;

    public function __construct()
    {
        $this->id_exercice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Exercice>
     */
    public function getIdExercice(): Collection
    {
        return $this->id_exercice;
    }

    public function addExercice(Exercice $idExercice): self
    {
        if (!$this->id_exercice->contains($idExercice)) {
            $this->id_exercice->add($idExercice);
        }

        return $this;
    }

    public function removeExercice(Exercice $idExercice): self
    {
        $this->id_exercice->removeElement($idExercice);

        return $this;
    }
}
