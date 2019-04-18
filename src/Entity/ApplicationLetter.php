<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Helpers\StringHelpers;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ApplicationLetterRepository")
 */
class ApplicationLetter
{
    /**
     * @ORM\Id()
     * @ORM\Column(type="string", length=36)
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="applicationLetters")
     */
    private $user;


    public function __construct()
    {
        $stringHelpers = new StringHelpers();
        $this->id      = $stringHelpers->generateUuid();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
        return $this->content;
    }
}
