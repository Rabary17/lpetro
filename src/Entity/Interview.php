<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\InterviewRepository")
 */
class Interview
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $interviewBy;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $interviewResume;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $interviewDate;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="interviews", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id",     referencedColumnName="id")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInterviewBy(): ?string
    {
        return $this->interviewBy;
    }

    public function setInterviewBy(?string $interviewBy): self
    {
        $this->interviewBy = $interviewBy;

        return $this;
    }

    public function getInterviewResume(): ?string
    {
        return $this->interviewResume;
    }

    public function setInterviewResume(?string $interviewResume): self
    {
        $this->interviewResume = $interviewResume;

        return $this;
    }

    public function getInterviewDate(): ?\DateTimeInterface
    {
        return $this->interviewDate;
    }

    public function setInterviewDate(?\DateTimeInterface $interviewDate): self
    {
        $this->interviewDate = $interviewDate;

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

    public function __toString()
    {
        return $this->interviewBy;
    }
}
