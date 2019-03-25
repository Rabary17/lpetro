<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 */
class Experience
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $period;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $position;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $company;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $achievements;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="experiences")
     */
    private $user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $others;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ReferencedPerson", mappedBy="experiences")
     */
    private $referencedPeople;

    public function __construct()
    {
        $this->referencedPeople = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPeriod(): ?string
    {
        return $this->period;
    }

    public function setPeriod(string $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getCompany(): ?string
    {
        return $this->company;
    }

    public function setCompany(string $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAchievements(): ?string
    {
        return $this->achievements;
    }

    public function setAchievements(?string $achievements): self
    {
        $this->achievements = $achievements;

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

    public function getOthers(): ?string
    {
        return $this->others;
    }

    public function setOthers(?string $others): self
    {
        $this->others = $others;

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getReferencedPeople(): Collection
    {
        return $this->referencedPeople;
    }

    public function addReferencedPerson(Experience $referencedPerson): self
    {
        if (!$this->referencedPeople->contains($referencedPerson)) {
            $this->referencedPeople[] = $referencedPerson;
            $referencedPerson->setExperiences($this);
        }

        return $this;
    }

    public function removeReferencedPerson(Experience $referencedPerson): self
    {
        if ($this->referencedPeople->contains($referencedPerson)) {
            $this->referencedPeople->removeElement($referencedPerson);
            // set the owning side to null (unless already changed)
            if ($referencedPerson->getExperiences() === $this) {
                $referencedPerson->setExperiences(null);
            }
        }

        return $this;
    }
}
