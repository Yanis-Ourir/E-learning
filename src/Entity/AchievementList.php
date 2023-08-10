<?php

namespace App\Entity;

use App\Repository\AchievementListRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchievementListRepository::class)]
class AchievementList
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $achievement_name = null;

    #[ORM\Column(length: 255)]
    private ?string $achievement_icon = null;

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
}
