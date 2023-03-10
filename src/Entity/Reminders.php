<?php

namespace App\Entity;

use App\Repository\RemindersRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RemindersRepository::class)]
class Reminders
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $reminder_date = null;

    #[ORM\Column(length: 150)]
    private ?string $relaunch_mode = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $job_interwiew_date = null;

    #[ORM\ManyToOne(inversedBy: 'reminders')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Applications $applications = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReminderDate(): ?\DateTimeInterface
    {
        return $this->reminder_date;
    }

    public function setReminderDate(\DateTimeInterface $reminder_date): self
    {
        $this->reminder_date = $reminder_date;

        return $this;
    }

    public function getRelaunchMode(): ?string
    {
        return $this->relaunch_mode;
    }

    public function setRelaunchMode(string $relaunch_mode): self
    {
        $this->relaunch_mode = $relaunch_mode;

        return $this;
    }

    public function getJobInterwiewDate(): ?\DateTimeInterface
    {
        return $this->job_interwiew_date;
    }

    public function setJobInterwiewDate(?\DateTimeInterface $job_interwiew_date): self
    {
        $this->job_interwiew_date = $job_interwiew_date;

        return $this;
    }

    public function getApplications(): ?Applications
    {
        return $this->applications;
    }

    public function setApplications(?Applications $applications): self
    {
        $this->applications = $applications;

        return $this;
    }
}
