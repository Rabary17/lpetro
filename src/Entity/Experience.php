<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Helpers\StringHelpers;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ExperienceRepository")
 */
class Experience
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     */
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    private $type;

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
     * @ORM\OneToMany(targetEntity="App\Entity\ReferencedPerson", mappedBy="experiences", cascade={"persist"})
     */
    private $referencedPeople;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_debut;

    /**
     * @ORM\Column(type="date")
     */
    private $Date_fin;

    public function __construct()
    {
        $stringHelpers = new StringHelpers();
        $this->id      = $stringHelpers->generateUuid();
        $this->referencedPeople = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
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
     * @return Collection|ReferencedPerson[]
     */
    public function getReferencedPeople(): Collection
    {
        return $this->referencedPeople;
    }

    public function addReferencedPerson(ReferencedPerson $referencedPerson): self
    {
        if (!$this->referencedPeople->contains($referencedPerson)) {
            $this->referencedPeople[] = $referencedPerson;
            $referencedPerson->setExperiences($this);
        }

        return $this;
    }

    public function removeReferencedPerson(ReferencedPerson $referencedPerson): self
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

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->Date_debut;
    }

    public function setDateDebut(\DateTimeInterface $Date_debut): self
    {
        $this->Date_debut = $Date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->Date_fin;
    }

    public function setDateFin(\DateTimeInterface $Date_fin): self
    {
        $this->Date_fin = $Date_fin;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function __toString()
    {
        return $this->position;
    }
}
