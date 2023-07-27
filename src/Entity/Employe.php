<?php

namespace App\Entity;

use App\Repository\EmployeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EmployeRepository::class)]
class Employe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    private ?string $motdepasse = null;

    #[ORM\ManyToOne(inversedBy: 'employe')]
    private ?Admin $admin = null;

    #[ORM\ManyToMany(targetEntity: Annonce::class)]
    private Collection $annonce;

    #[ORM\ManyToMany(targetEntity: Temoignage::class)]
    private Collection $temoignage;

    public function __construct()
    {
        $this->annonce = new ArrayCollection();
        $this->temoignage = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
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

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getMotdepasse(): ?string
    {
        return $this->motdepasse;
    }

    public function setMotdepasse(string $motdepasse): static
    {
        $this->motdepasse = $motdepasse;

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
        }

        return $this;
    }

    public function removeAnnonce(annonce $annonce): static
    {
        $this->annonce->removeElement($annonce);

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
        }

        return $this;
    }

    public function removeTemoignage(temoignage $temoignage): static
    {
        $this->temoignage->removeElement($temoignage);

        return $this;
    }
}
