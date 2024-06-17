<?php

namespace App\Entity;

use App\Repository\DirectionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DirectionRepository::class)
 */
class Direction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $abrdirection;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity=Voiture::class, mappedBy="abrdirection")
     */
    private $voitures;

    /**
     * @ORM\OneToMany(targetEntity=Personneldetenteur::class, mappedBy="abrdirection")
     */
    private $personneldetenteurs;

    /**
     * @ORM\OneToMany(targetEntity=Etatvoiture::class, mappedBy="abrdirection")
     */
    private $etatvoitures;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
        $this->personneldetenteurs = new ArrayCollection();
        $this->etatvoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAbrdirection(): ?string
    {
        return $this->abrdirection;
    }

    public function setAbrdirection(string $abrdirection): self
    {
        $this->abrdirection = $abrdirection;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures[] = $voiture;
            $voiture->setAbrdirection($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getAbrdirection() === $this) {
                $voiture->setAbrdirection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Personneldetenteur>
     */
    public function getPersonneldetenteurs(): Collection
    {
        return $this->personneldetenteurs;
    }

    public function addPersonneldetenteur(Personneldetenteur $personneldetenteur): self
    {
        if (!$this->personneldetenteurs->contains($personneldetenteur)) {
            $this->personneldetenteurs[] = $personneldetenteur;
            $personneldetenteur->setAbrdirection($this);
        }

        return $this;
    }

    public function removePersonneldetenteur(Personneldetenteur $personneldetenteur): self
    {
        if ($this->personneldetenteurs->removeElement($personneldetenteur)) {
            // set the owning side to null (unless already changed)
            if ($personneldetenteur->getAbrdirection() === $this) {
                $personneldetenteur->setAbrdirection(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Etatvoiture>
     */
    public function getEtatvoitures(): Collection
    {
        return $this->etatvoitures;
    }

    public function addEtatvoiture(Etatvoiture $etatvoiture): self
    {
        if (!$this->etatvoitures->contains($etatvoiture)) {
            $this->etatvoitures[] = $etatvoiture;
            $etatvoiture->setAbrdirection($this);
        }

        return $this;
    }

    public function removeEtatvoiture(Etatvoiture $etatvoiture): self
    {
        if ($this->etatvoitures->removeElement($etatvoiture)) {
            // set the owning side to null (unless already changed)
            if ($etatvoiture->getAbrdirection() === $this) {
                $etatvoiture->setAbrdirection(null);
            }
        }

        return $this;
    }
    public function __toString(): string
   {
    return $this->abrdirection;
    
   }
}
