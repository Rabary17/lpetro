<?php

namespace App\Entity;

use App\Helpers\StringHelpers;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\File;
use App\Concern\TaggableTrait;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Entity
 * @ORM\Table(name="app_user")
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User extends BaseUser
{
    use TaggableTrait;

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
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $phoneNumber;

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
     * @ORM\ManyToOne(targetEntity="Nationality")
     */
    private $nationality;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $seen = false;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $send = false;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $sendOn;

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

    /**
     * @ORM\ManyToMany(targetEntity="Hobby", inversedBy="users")
     * @ORM\JoinTable(name="user_hobbies")
     */
    protected $hobbies;

    /**
     * @ORM\ManyToMany(targetEntity="Sport")
     * @ORM\JoinTable(name="user_sports")
     */
    protected $sports;

    /**
     * @ORM\OneToMany(targetEntity="ExtraWorkActivity", mappedBy="user", cascade={"persist", "remove"})
     */
    private $extraWorkActivities;

    /**
     * @ORM\OneToMany(targetEntity="Training", mappedBy="user", cascade={"persist", "remove"})
     */
    private $trainings;

    /**
     * @ORM\OneToMany(targetEntity="Language", mappedBy="user", cascade={"persist", "remove"})
     */
    private $languages;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Experience", mappedBy="user", cascade={"persist", "remove"})
     */
    private $experiences;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\UserSkill", mappedBy="user", cascade={"persist", "remove"})
     */
    private $skills;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ApplicationLetter", mappedBy="user")
     */
    private $applicationLetters;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $submit;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\UserStatut", inversedBy="users", cascade={"remove"})
     * @ORM\JoinColumn(name="statut_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $statut;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $rhvalidate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Interview", mappedBy="user", cascade={"persist", "remove"})
     */
    private $interviews;

    /**
     * @ORM\Column(type="boolean", options={"default":"0"})
     */
    private $archived  = false;

    public function __construct()
    {
        parent::__construct();
        $stringHelpers = new StringHelpers();
        $this->id      = $stringHelpers->generateUuid();
        $this->updatedAt = new \DateTime('now');
        $this->hobbies = new ArrayCollection();
        $this->extraWorkActivities = new ArrayCollection();
        $this->sports = new ArrayCollection();
        $this->trainings = new ArrayCollection();
        $this->experiences = new ArrayCollection();
        $this->skills = new ArrayCollection();
        $this->applicationLetters = new ArrayCollection();
        $this->roles = array('ROLE_CANDIDAT');
        $this->languages = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->interviews = new ArrayCollection();
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
     */
    public function setProfileFile(File $profile = null)
    {
        $this->profileFile = $profile;

        if ($profile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    public function setPhoneNumber(?string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * @return Collection|Hobby[]
     */
    public function getHobbies(): Collection
    {
        return $this->hobbies;
    }

    public function addHobby(Hobby $hobby): self
    {
        if (!$this->hobbies->contains($hobby)) {
            $this->hobbies[] = $hobby;
        }

        return $this;
    }

    public function removeHobby(Hobby $hobby): self
    {
        if ($this->hobbies->contains($hobby)) {
            $this->hobbies->removeElement($hobby);
        }

        return $this;
    }

    /**
     * @return Collection|ExtraWorkActivity[]
     */
    public function getExtraWorkActivities(): Collection
    {
        return $this->extraWorkActivities;
    }

    public function addExtraWorkActivity(ExtraWorkActivity $extraWorkActivity): self
    {
        if (!$this->extraWorkActivities->contains($extraWorkActivity)) {
            $this->extraWorkActivities[] = $extraWorkActivity;
            $extraWorkActivity->setUser($this);
        }

        return $this;
    }

    public function removeExtraWorkActivity(ExtraWorkActivity $extraWorkActivity): self
    {
        if ($this->extraWorkActivities->contains($extraWorkActivity)) {
            $this->extraWorkActivities->removeElement($extraWorkActivity);
            // set the owning side to null (unless already changed)
            if ($extraWorkActivity->getUser() === $this) {
                $extraWorkActivity->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sport[]
     */
    public function getSports(): Collection
    {
        return $this->sports;
    }

    public function addSport(Sport $sport): self
    {
        if (!$this->sports->contains($sport)) {
            $this->sports[] = $sport;
        }

        return $this;
    }

    public function removeSport(Sport $sport): self
    {
        if ($this->sports->contains($sport)) {
            $this->sports->removeElement($sport);
        }

        return $this;
    }

    /**
     * @return Collection|Training[]
     */
    public function getTrainings(): Collection
    {
        return $this->trainings;
    }

    public function addTraining(Training $training): self
    {
        if (!$this->trainings->contains($training)) {
            $this->trainings[] = $training;
            $training->setUser($this);
        }

        return $this;
    }

    public function removeTraining(Training $training): self
    {
        if ($this->trainings->contains($training)) {
            $this->trainings->removeElement($training);
            // set the owning side to null (unless already changed)
            if ($training->getUser() === $this) {
                $training->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Experience[]
     */
    public function getExperiences(): Collection
    {
        return $this->experiences;
    }

    public function addExperience(Experience $experience): self
    {
        if (!$this->experiences->contains($experience)) {
            $this->experiences[] = $experience;
            $experience->setUser($this);
        }

        return $this;
    }

    public function removeExperience(Experience $experience): self
    {
        if ($this->experiences->contains($experience)) {
            $this->experiences->removeElement($experience);
            // set the owning side to null (unless already changed)
            if ($experience->getUser() === $this) {
                $experience->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Skill[]
     */
    public function getSkills(): Collection
    {
        return $this->skills;
    }

    public function addSkill(UserSkill $skill): self
    {
        if (!$this->skills->contains($skill)) {
            $this->skills[] = $skill;
            $skill->setUser($this);
        }

        return $this;
    }

    public function removeSkill(UserSkill $skill): self
    {
        if ($this->skills->contains($skill)) {
            $this->skills->removeElement($skill);
            // set the owning side to null (unless already changed)
            if ($skill->getUser() === $this) {
                $skill->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|ApplicationLetter[]
     */
    public function getApplicationLetters(): Collection
    {
        return $this->applicationLetters;
    }

    public function addApplicationLetter(ApplicationLetter $applicationLetter): self
    {
        if (!$this->applicationLetters->contains($applicationLetter)) {
            $this->applicationLetters[] = $applicationLetter;
            $applicationLetter->setUser($this);
        }

        return $this;
    }

    public function removeApplicationLetter(ApplicationLetter $applicationLetter): self
    {
        if ($this->applicationLetters->contains($applicationLetter)) {
            $this->applicationLetters->removeElement($applicationLetter);
            // set the owning side to null (unless already changed)
            if ($applicationLetter->getUser() === $this) {
                $applicationLetter->setUser(null);
            }
        }

        return $this;
    }

    public function getSeen(): ?bool
    {
        return $this->seen;
    }

    public function setSeen(?bool $seen): self
    {
        $this->seen = $seen;

        return $this;
    }

    public function getSend(): ?bool
    {
        return $this->send;
    }

    public function setSend(?bool $send): self
    {
        $this->send = $send;

        return $this;
    }

    public function getSendOn(): ?\DateTimeInterface
    {
        return $this->sendOn;
    }

    public function setSendOn(?\DateTimeInterface $sendOn): self
    {
        $this->sendOn = $sendOn;

        return $this;
    }

    public function getSubmit(): ?bool
    {
        return $this->submit;
    }

    public function setSubmit(?bool $submit): self
    {
        $this->submit = $submit;

        return $this;
    }

    /**
     * @return Collection|Language[]
     */
    public function getLanguages(): Collection
    {
        return $this->languages;
    }

    public function addLanguage(Language $language): self
    {
        if (!$this->languages->contains($language)) {
            $this->languages[] = $language;
            $language->setUser($this);
        }

        return $this;
    }

    public function removeLanguage(Language $language): self
    {
        if ($this->languages->contains($language)) {
            $this->languages->removeElement($language);
            // set the owning side to null (unless already changed)
            if ($language->getUser() === $this) {
                $language->setUser(null);
            }
        }

        return $this;
    }

    public function getStatut(): ?UserStatut
    {
        return $this->statut;
    }

    public function setStatut(?UserStatut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getRhvalidate(): ?bool
    {
        return $this->rhvalidate;
    }

    public function setRhvalidate(?bool $rhvalidate): self
    {
        $this->rhvalidate = $rhvalidate;

        return $this;
    }

    /**
     * @return Collection|Interview[]
     */
    public function getInterviews(): Collection
    {
        return $this->interviews;
    }

    public function addInterview(Interview $interview): self
    {
        if (!$this->interviews->contains($interview)) {
            $this->interviews[] = $interview;
            $interview->setUser($this);
        }

        return $this;
    }

    public function removeInterview(Interview $interview): self
    {
        if ($this->interviews->contains($interview)) {
            $this->interviews->removeElement($interview);
            // set the owning side to null (unless already changed)
            if ($interview->getUser() === $this) {
                $interview->setUser(null);
            }
        }

        return $this;
    }

    public function getNationality(): ?Nationality
    {
        return $this->nationality;
    }

    public function setNationality(?Nationality $nationality): self
    {
        $this->nationality = $nationality;

        return $this;
    }

    public function getArchived(): ?bool
    {
        return $this->archived;
    }

    public function setArchived(?bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }
}
