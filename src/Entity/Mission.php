<?php

namespace App\Entity;

use App\Repository\MissionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MissionRepository::class)]
class Mission
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $title;

    #[ORM\Column(type: 'text')]
    private $description;

    #[ORM\Column(type: 'string', length: 50)]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    private $mission_type;

    #[ORM\Column(type: 'string', length: 255)]
    private $mission_status;

    #[ORM\Column(type: 'time')]
    private $mission_duration;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Agent::class)]
    private $agent;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Hideaway::class)]
    private $hideaway;

    #[ORM\OneToMany(mappedBy: 'mission', targetEntity: Target::class)]
    private $target;

    #[ORM\OneToOne(inversedBy: 'mission', targetEntity: Contact::class, cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private $contact;

    public function __construct()
    {
        $this->agent = new ArrayCollection();
        $this->hideaway = new ArrayCollection();
        $this->target = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

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

    public function getMissionType(): ?string
    {
        return $this->mission_type;
    }

    public function setMissionType(string $mission_type): self
    {
        $this->mission_type = $mission_type;

        return $this;
    }

    public function getMissionStatus(): ?string
    {
        return $this->mission_status;
    }

    public function setMissionStatus(string $mission_status): self
    {
        $this->mission_status = $mission_status;

        return $this;
    }

    public function getMissionDuration(): ?\DateTimeInterface
    {
        return $this->mission_duration;
    }

    public function setMissionDuration(\DateTimeInterface $mission_duration): self
    {
        $this->mission_duration = $mission_duration;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgent(): Collection
    {
        return $this->agent;
    }

    public function addAgent(Agent $agent): self
    {
        if (!$this->agent->contains($agent)) {
            $this->agent[] = $agent;
            $agent->setMission($this);
        }

        return $this;
    }

    public function removeAgent(Agent $agent): self
    {
        if ($this->agent->removeElement($agent)) {
            // set the owning side to null (unless already changed)
            if ($agent->getMission() === $this) {
                $agent->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hideaway[]
     */
    public function getHideaway(): Collection
    {
        return $this->hideaway;
    }

    public function addHideaway(Hideaway $hideaway): self
    {
        if (!$this->hideaway->contains($hideaway)) {
            $this->hideaway[] = $hideaway;
            $hideaway->setMission($this);
        }

        return $this;
    }

    public function removeHideaway(Hideaway $hideaway): self
    {
        if ($this->hideaway->removeElement($hideaway)) {
            // set the owning side to null (unless already changed)
            if ($hideaway->getMission() === $this) {
                $hideaway->setMission(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Target[]
     */
    public function getTarget(): Collection
    {
        return $this->target;
    }

    public function addTarget(Target $target): self
    {
        if (!$this->target->contains($target)) {
            $this->target[] = $target;
            $target->setMission($this);
        }

        return $this;
    }

    public function removeTarget(Target $target): self
    {
        if ($this->target->removeElement($target)) {
            // set the owning side to null (unless already changed)
            if ($target->getMission() === $this) {
                $target->setMission(null);
            }
        }

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }
    public function __toString()
    {
        return $this->title;
        
    }
   
}
