<?php

namespace App\Entity;

use App\Repository\HoraireRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: HoraireRepository::class)]
class Horaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $jour = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_ouverture = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heure_fermeture = null;

    #[ORM\ManyToOne(inversedBy: 'horaire')]
    #[ORM\JoinColumn(nullable: true)] // modification en true 
    private ?Admin $admin = null;

    #[ORM\ManyToOne(inversedBy: 'horaire')]
    #[ORM\JoinColumn(nullable: true)] //modification en true 
    private ?Garage $garage = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $ouverture_soir = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $fermeture_soir = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJour(): ?string
    {
        return $this->jour;
    }

    public function setJour(string $jour): static
    {
        $this->jour = $jour;

        return $this;
    }

    public function getHeureOuverture(): ?\DateTimeInterface
    {
        return $this->heure_ouverture;
    }

    public function setHeureOuverture(\DateTimeInterface $heure_ouverture): static
    {
        $this->heure_ouverture = $heure_ouverture;

        return $this;
    }

    public function getHeureFermeture(): ?\DateTimeInterface
    {
        return $this->heure_fermeture;
    }

    public function setHeureFermeture(\DateTimeInterface $heure_fermeture): static
    {
        $this->heure_fermeture = $heure_fermeture;

        return $this;
    }

    public function getAdmin(): ?Admin
    {
        return $this->admin;
    }

    public function setAdmin(?Admin $admin): static
    {
        $this->admin = $admin;

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

    public function getOuvertureSoir(): ?\DateTimeInterface
    {
        return $this->ouverture_soir;
    }

    public function setOuvertureSoir(\DateTimeInterface $ouverture_soir): static
    {
        $this->ouverture_soir = $ouverture_soir;

        return $this;
    }

    public function getFermetureSoir(): ?\DateTimeInterface
    {
        return $this->fermeture_soir;
    }

    public function setFermetureSoir(\DateTimeInterface $fermeture_soir): static
    {
        $this->fermeture_soir = $fermeture_soir;

        return $this;
    }
}
