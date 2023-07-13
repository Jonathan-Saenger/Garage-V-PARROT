<?php

namespace App\Entity;

use App\Repository\GarageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GarageRepository::class)]
class Garage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column]
    private ?int $code_postal = null;

    #[ORM\Column(length: 255)]
    private ?string $ville = null;

    #[ORM\Column]
    private ?int $telephone = null;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Service::class)]
    private Collection $service;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Horaire::class)]
    private Collection $horaire;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Temoignage::class)]
    private Collection $temoignage;

    #[ORM\OneToMany(mappedBy: 'garage', targetEntity: Annonce::class)]
    private Collection $annonce;

    public function __construct()
    {
        $this->service = new ArrayCollection();
        $this->horaire = new ArrayCollection();
        $this->temoignage = new ArrayCollection();
        $this->annonce = new ArrayCollection();
    }

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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?int
    {
        return $this->code_postal;
    }

    public function setCodePostal(int $code_postal): static
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection<int, service>
     */
    public function getService(): Collection
    {
        return $this->service;
    }

    public function addService(service $service): static
    {
        if (!$this->service->contains($service)) {
            $this->service->add($service);
            $service->setGarage($this);
        }

        return $this;
    }

    public function removeService(service $service): static
    {
        if ($this->service->removeElement($service)) {
            // set the owning side to null (unless already changed)
            if ($service->getGarage() === $this) {
                $service->setGarage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, horaire>
     */
    public function getHoraire(): Collection
    {
        return $this->horaire;
    }

    public function addHoraire(horaire $horaire): static
    {
        if (!$this->horaire->contains($horaire)) {
            $this->horaire->add($horaire);
            $horaire->setGarage($this);
        }

        return $this;
    }

    public function removeHoraire(horaire $horaire): static
    {
        if ($this->horaire->removeElement($horaire)) {
            // set the owning side to null (unless already changed)
            if ($horaire->getGarage() === $this) {
                $horaire->setGarage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, temoignage>
     */
    public function getTemoignage(): Collection
    {
        return $this->temoignage;
    }

    public function addTemoignage(temoignage $temoignage): static
    {
        if (!$this->temoignage->contains($temoignage)) {
            $this->temoignage->add($temoignage);
            $temoignage->setGarage($this);
        }

        return $this;
    }

    public function removeTemoignage(temoignage $temoignage): static
    {
        if ($this->temoignage->removeElement($temoignage)) {
            // set the owning side to null (unless already changed)
            if ($temoignage->getGarage() === $this) {
                $temoignage->setGarage(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, annonce>
     */
    public function getAnnonce(): Collection
    {
        return $this->annonce;
    }

    public function addAnnonce(annonce $annonce): static
    {
        if (!$this->annonce->contains($annonce)) {
            $this->annonce->add($annonce);
            $annonce->setGarage($this);
        }

        return $this;
    }

    public function removeAnnonce(annonce $annonce): static
    {
        if ($this->annonce->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getGarage() === $this) {
                $annonce->setGarage(null);
            }
        }

        return $this;
    }
}
