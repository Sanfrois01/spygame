<?php

namespace App\Entity;

use App\Repository\ContactRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContactRepository::class)]
class Contact
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

    #[ORM\OneToOne(mappedBy: 'contact', targetEntity: Mission::class, cascade: ['persist', 'remove'])]
    private $mission;

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

    public function setMission(Mission $mission): self
    {
        // set the owning side of the relation if necessary
        if ($mission->getContact() !== $this) {
            $mission->setContact($this);
        }

        $this->mission = $mission;

        return $this;
    }

    public function __toString()
    {
        return $this->fullname;
    }
}
