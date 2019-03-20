<?php

namespace App\Entity;

use App\Helpers\StringHelpers;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_user")
 * @Vich\Uploadable
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=36)
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $lastName;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $firstName;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateOfBirth;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $placeOfBirth;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $maritalStatus;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $conjointName;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbChildren;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $address;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $nationality;

    /**
     * @Vich\UploadableField(mapping="profil", fileNameProperty="profileName")
     * 
     * @var File
     */
    private $profileFile;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     *
     * @var string
     */
    private $profileName;

    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTime
    */
    private $updatedAt;

    public function __construct()
    {
        parent::__construct();
        $stringHelpers = new StringHelpers();
        $this->id      = $stringHelpers->generateUuid();
        $this->updatedAt = new \DateTime('now');
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getDateOfBirth(): ?\DateTimeInterface
    {
        return $this->dateOfBirth;
    }

    public function setDateOfBirth(?\DateTimeInterface $dateOfBirth): self
    {
        $this->dateOfBirth = $dateOfBirth;

        return $this;
    }

    public function getPlaceOfBirth(): ?string
    {
        return $this->placeOfBirth;
    }

    public function setPlaceOfBirth(?string $placeOfBirth): self
    {
        $this->placeOfBirth = $placeOfBirth;

        return $this;
    }

    public function getMaritalStatus(): ?string
    {
        return $this->maritalStatus;
    }

    public function setMaritalStatus(?string $maritalStatus): self
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    public function getConjointName(): ?string
    {
        return $this->conjointName;
    }

    public function setConjointName(string $conjointName): self
    {
        $this->conjointName = $conjointName;

        return $this;
    }

    public function getNbChildren(): ?int
    {
        return $this->nbChildren;
    }

    public function setNbChildren(?int $nbChildren): self
    {
        $this->nbChildren = $nbChildren;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

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
    public function setEmail($email)
    {
        $email = is_null($email) ? '' : $email;
        parent::setEmail($email);
        $this->setUsername($email);

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getProfileName(): ?string
    {
        return $this->profileName;
    }

    public function setProfileName(?string $profileName): self
    {
        $this->profileName = $profileName;

        return $this;
    }

    /**
     * @return File|null|\Symfony\Component\HttpFoundation\File\UploadedFile $profile
     */
    public function getProfileFile()
    {
        return $this->profileFile;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $profile
     *
    */
    public function setProfileFile(File $profile = null)
    {
        $this->profileFile = $profile;

        if ($profile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }
 }
