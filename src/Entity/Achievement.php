<?php

namespace App\Entity;

use App\Repository\AchievementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchievementRepository::class)]
class Achievement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $achievement_name = null;

    #[ORM\Column(length: 255)]
    private ?string $achievement_icon = null;

    #[ORM\Column(length: 255)]
    private ?string $achievement_description = null;

    #[ORM\ManyToMany(targetEntity: Profil::class, mappedBy: 'achievements')]
    private Collection $profils;

    public function __construct()
    {
        $this->profils = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAchievementName(): ?string
    {
        return $this->achievement_name;
    }

    public function setAchievementName(string $achievement_name): self
    {
        $this->achievement_name = $achievement_name;

        return $this;
    }

    public function getAchievementIcon(): ?string
    {
        return $this->achievement_icon;
    }

    public function setAchievementIcon(string $achievement_icon): self
    {
        $this->achievement_icon = $achievement_icon;

        return $this;
    }

    public function getAchievementDescription(): ?string
    {
        return $this->achievement_description;
    }

    public function setAchievementDescription(string $achievement_description): self
    {
        $this->achievement_description = $achievement_description;

        return $this;
    }

    /**
     * @return Collection<int, Profil>
     */
    public function getProfils(): Collection
    {
        return $this->profils;
    }

    public function addProfil(Profil $profil): self
    {
        if (!$this->profils->contains($profil)) {
            $this->profils->add($profil);
            $profil->addAchievement($this);
        }

        return $this;
    }

    public function removeProfil(Profil $profil): self
    {
        if ($this->profils->removeElement($profil)) {
            $profil->removeAchievement($this);
        }

        return $this;
    }
}
