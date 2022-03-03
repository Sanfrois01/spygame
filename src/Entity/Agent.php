<?php

namespace App\Entity;

use App\Repository\AgentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AgentRepository::class)]
class Agent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $fullname;

    #[ORM\Column(type: 'date')]
    private $birthdate;

    #[ORM\Column(type: 'string', length: 255)]
    private $nationality;

    #[ORM\ManyToOne(targetEntity: Mission::class, inversedBy: 'agent')]
    #[ORM\JoinColumn(nullable: false)]
    private $mission;

    #[ORM\ManyToOne(targetEntity: Specialities::class, inversedBy: 'agents_specialities')]
    #[ORM\JoinColumn(nullable: false)]
    private $specialities;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFullname(): ?string
    {
        return $this->fullname;
    }

    public function setFullname(string $fullname): self
    {
        $this->fullname = $fullname;

        return $this;
    }

    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }

    public function setBirthdate(\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    public function getNationality(): ?string
    {
        return $this->nationality;
    }

    public function setNationality(string $nationality): self
    {
        $this->nationality = $nationality;

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

    public function getSpecialities(): ?Specialities
    {
        return $this->specialities;
    }

    public function setSpecialities(?Specialities $specialities): self
    {
        $this->specialities = $specialities;

        return $this;
    }

}
