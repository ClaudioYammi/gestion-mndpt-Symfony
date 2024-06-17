<?php

namespace App\Entity;

use App\Repository\PersonneldetenteurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PersonneldetenteurRepository::class)
 */
class Personneldetenteur
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
    private $matriculepersonnel;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="personneldetenteurs")
     */
    private $matriculevoiture;

    /**
     * @ORM\ManyToOne(targetEntity=Direction::class, inversedBy="personneldetenteurs")
     */
    private $abrdirection;

    /**
     * @ORM\OneToMany(targetEntity=Detentionvoiture::class, mappedBy="matriculepersonnel")
     */
    private $detentionvoitures;

    public function __construct()
    {
        $this->detentionvoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculepersonnel(): ?string
    {
        return $this->matriculepersonnel;
    }

    public function setMatriculepersonnel(string $matriculepersonnel): self
    {
        $this->matriculepersonnel = $matriculepersonnel;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getMatriculevoiture(): ?Voiture
    {
        return $this->matriculevoiture;
    }

    public function setMatriculevoiture(?Voiture $matriculevoiture): self
    {
        $this->matriculevoiture = $matriculevoiture;

        return $this;
    }

    public function getAbrdirection(): ?Direction
    {
        return $this->abrdirection;
    }

    public function setAbrdirection(?Direction $abrdirection): self
    {
        $this->abrdirection = $abrdirection;

        return $this;
    }

    /**
     * @return Collection<int, Detentionvoiture>
     */
    public function getDetentionvoitures(): Collection
    {
        return $this->detentionvoitures;
    }

    public function addDetentionvoiture(Detentionvoiture $detentionvoiture): self
    {
        if (!$this->detentionvoitures->contains($detentionvoiture)) {
            $this->detentionvoitures[] = $detentionvoiture;
            $detentionvoiture->setMatriculepersonnel($this);
        }

        return $this;
    }

    public function removeDetentionvoiture(Detentionvoiture $detentionvoiture): self
    {
        if ($this->detentionvoitures->removeElement($detentionvoiture)) {
            // set the owning side to null (unless already changed)
            if ($detentionvoiture->getMatriculepersonnel() === $this) {
                $detentionvoiture->setMatriculepersonnel(null);
            }
        }

        return $this;
    }
    public function __toString(): string
   {
    return $this->matriculepersonnel;
    
   }
}
