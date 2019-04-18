<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CvUpdatedRepository")
 */
class CvUpdated
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $user;

    /**
     * @ORM\Column(type="integer")
     */
    private $section;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subSectionId;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?string
    {
        return $this->user;
    }

    public function setUser(string $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getSection(): ?int
    {
        return $this->section;
    }

    public function setSection(int $section): self
    {
        $this->section = $section;

        return $this;
    }

    public function getSubSectionId(): ?string
    {
        return $this->subSectionId;
    }

    public function setSubSectionId(string $subSectionId): self
    {
        $this->subSectionId = $subSectionId;

        return $this;
    }
}
