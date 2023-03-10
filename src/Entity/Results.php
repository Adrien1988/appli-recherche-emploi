<?php

namespace App\Entity;

use App\Repository\ResultsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResultsRepository::class)]
class Results
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200)]
    private ?string $answer = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $comment = null;

    #[ORM\OneToOne(mappedBy: 'results', cascade: ['persist', 'remove'])]
    private ?Applications $applications = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAnswer(): ?string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): self
    {
        $this->answer = $answer;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getApplications(): ?Applications
    {
        return $this->applications;
    }

    public function setApplications(Applications $applications): self
    {
        // set the owning side of the relation if necessary
        if ($applications->getResults() !== $this) {
            $applications->setResults($this);
        }

        $this->applications = $applications;

        return $this;
    }
}
