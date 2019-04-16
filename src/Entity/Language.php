<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LanguageRepository")
 */
class Language
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $readinglevel;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="languages", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id",     referencedColumnName="id")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $speakinglevel;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $writinglevel;

    public function getId(): ?int
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

    public function getReadinglevel(): ?int
    {
        return $this->readinglevel;
    }

    public function setReadinglevel(?int $readinglevel): self
    {
        $this->readinglevel = $readinglevel;

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
        return $this->name;
    }

    public function getSpeakinglevel(): ?int
    {
        return $this->speakinglevel;
    }

    public function setSpeakinglevel(?int $speakinglevel): self
    {
        $this->speakinglevel = $speakinglevel;

        return $this;
    }

    public function getWritinglevel(): ?int
    {
        return $this->writinglevel;
    }

    public function setWritinglevel(?int $writinglevel): self
    {
        $this->writinglevel = $writinglevel;

        return $this;
    }
}
