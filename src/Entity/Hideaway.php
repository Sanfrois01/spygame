<?php

namespace App\Entity;

use App\Repository\HideawayRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HideawayRepository::class)]
class Hideaway
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $location;

    #[ORM\Column(type: 'string', length: 255)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $hideaway_type;

    #[ORM\ManyToOne(targetEntity: Mission::class, inversedBy: 'hideaway')]
    private $mission;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getHideawayType(): ?string
    {
        return $this->hideaway_type;
    }

    public function setHideawayType(string $hideaway_type): self
    {
        $this->hideaway_type = $hideaway_type;

        return $this;
    }

    public function getMission(): ?Mission
    {
        return $this->mission;
    }

    public function setMission(?Mission $mission): self
    {
        $this->mission = $mission;

        return $this;
    }
}
