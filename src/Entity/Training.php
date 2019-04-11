<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Helpers\StringHelpers;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrainingRepository")
 */
class Training
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="trainings", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id",     referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $startDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $level;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\School", inversedBy="trainings", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id",  onDelete="SET NULL")
     */
    private $school;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Filiere", inversedBy="trainings", cascade={"persist"})
     * @ORM\JoinColumn(referencedColumnName="id",  onDelete="SET NULL")
     */
    private $Filiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TrainingResult", inversedBy="trainings")
     */
    private $result;

    public function __construct()
    {
        $stringHelpers = new StringHelpers();
        $this->id      = $stringHelpers->generateUuid();
    }

    public function getId(): ?string
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

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

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(?\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(?\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getLevel(): ?string
    {
        return $this->level;
    }

    public function setLevel(?string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function __toString()
    {
        return $this->name;
    }

    public function getSchool(): ?School
    {
        return $this->school;
    }

    public function setSchool(?School $school): self
    {
        $this->school = $school;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->Filiere;
    }

    public function setFiliere(?Filiere $Filiere): self
    {
        $this->Filiere = $Filiere;

        return $this;
    }

    public function getResult(): ?TrainingResult
    {
        return $this->result;
    }

    public function setResult(?TrainingResult $result): self
    {
        $this->result = $result;
        
        return $this;
    }
}
