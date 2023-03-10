<?php

namespace App\Entity;

use App\Repository\ApplicationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ApplicationsRepository::class)]
class Applications
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $sending_date = null;

    #[ORM\Column(length: 200)]
    private ?string $send_mode = null;

    #[ORM\Column(length: 200)]
    private ?string $type = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column(length: 150)]
    private ?string $support = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $curriculum = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $cover_letter = null;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $users = null;

    #[ORM\ManyToOne(inversedBy: 'applications')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Offers $offers = null;

    #[ORM\OneToOne(inversedBy: 'applications', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Results $results = null;

    #[ORM\OneToMany(mappedBy: 'applications', targetEntity: Reminders::class)]
    private Collection $reminders;

    public function __construct()
    {
        $this->reminders = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSendingDate(): ?\DateTimeInterface
    {
        return $this->sending_date;
    }

    public function setSendingDate(\DateTimeInterface $sending_date): self
    {
        $this->sending_date = $sending_date;

        return $this;
    }

    public function getSendMode(): ?string
    {
        return $this->send_mode;
    }

    public function setSendMode(string $send_mode): self
    {
        $this->send_mode = $send_mode;

        return $this;
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

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(\DateTimeInterface $release_date): self
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getSupport(): ?string
    {
        return $this->support;
    }

    public function setSupport(string $support): self
    {
        $this->support = $support;

        return $this;
    }

    public function getCurriculum(): ?string
    {
        return $this->curriculum;
    }

    public function setCurriculum(?string $curriculum): self
    {
        $this->curriculum = $curriculum;

        return $this;
    }

    public function getCoverLetter(): ?string
    {
        return $this->cover_letter;
    }

    public function setCoverLetter(?string $cover_letter): self
    {
        $this->cover_letter = $cover_letter;

        return $this;
    }

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    public function getOffers(): ?Offers
    {
        return $this->offers;
    }

    public function setOffers(?Offers $offers): self
    {
        $this->offers = $offers;

        return $this;
    }

    public function getResults(): ?Results
    {
        return $this->results;
    }

    public function setResults(Results $results): self
    {
        $this->results = $results;

        return $this;
    }

    /**
     * @return Collection<int, Reminders>
     */
    public function getReminders(): Collection
    {
        return $this->reminders;
    }

    public function addReminder(Reminders $reminder): self
    {
        if (!$this->reminders->contains($reminder)) {
            $this->reminders->add($reminder);
            $reminder->setApplications($this);
        }

        return $this;
    }

    public function removeReminder(Reminders $reminder): self
    {
        if ($this->reminders->removeElement($reminder)) {
            // set the owning side to null (unless already changed)
            if ($reminder->getApplications() === $this) {
                $reminder->setApplications(null);
            }
        }

        return $this;
    }
}
