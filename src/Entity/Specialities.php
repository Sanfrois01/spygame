<?php

namespace App\Entity;

use App\Repository\SpecialitiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialitiesRepository::class)]
class Specialities
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $type;

    #[ORM\OneToMany(mappedBy: 'specialities', targetEntity: Agent::class)]
    private $agents_specialities;

    public function __construct()
    {
        $this->agents_specialities = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection|Agent[]
     */
    public function getAgentsSpecialities(): Collection
    {
        return $this->agents_specialities;
    }

    public function addAgentsSpeciality(Agent $agentsSpeciality): self
    {
        if (!$this->agents_specialities->contains($agentsSpeciality)) {
            $this->agents_specialities[] = $agentsSpeciality;
            $agentsSpeciality->setSpecialities($this);
        }

        return $this;
    }

    public function removeAgentsSpeciality(Agent $agentsSpeciality): self
    {
        if ($this->agents_specialities->removeElement($agentsSpeciality)) {
            // set the owning side to null (unless already changed)
            if ($agentsSpeciality->getSpecialities() === $this) {
                $agentsSpeciality->setSpecialities(null);
            }
        }

        return $this;
    }
    public function __toString()
    {
        return $this->type;
        
    }
}
