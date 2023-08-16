<?php

namespace App\Entity;

use App\Repository\TemoignageRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TemoignageRepository::class)]
class Temoignage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $commentaire = null;

    #[ORM\Column]
    private ?int $note = null;

    #[ORM\Column]
    private ?bool $publication = false;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $jourpublication = null;

    #[ORM\ManyToOne(inversedBy: 'temoignage')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Garage $garage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(string $commentaire): static
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function isPublication(): ?bool
    {
        return $this->publication;
    }

    public function setPublication(bool $publication): static
    {
        $this->publication = $publication;

        return $this;
    }

    public function getJourpublication(): ?\DateTimeInterface
    {
        return $this->jourpublication;
    }

    public function setJourpublication(\DateTimeInterface $jourpublication): static
    {
        $this->jourpublication = $jourpublication;

        return $this;
    }

    public function getGarage(): ?Garage
    {
        return $this->garage;
    }

    public function setGarage(?Garage $garage): static
    {
        $this->garage = $garage;

        return $this;
    }
}
