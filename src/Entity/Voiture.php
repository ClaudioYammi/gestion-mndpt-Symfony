<?php

namespace App\Entity;

use App\Repository\VoitureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VoitureRepository::class)
 */
class Voiture
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
    private $matriculevoiture;

    /**
     * @ORM\Column(type="date")
     */
    private $dateentrevoiture;

    /**
     * @ORM\ManyToOne(targetEntity=Chauffeur::class, inversedBy="voitures")
     */
    private $matriculechauffeur;

    /**
     * @ORM\ManyToOne(targetEntity=Type::class, inversedBy="voitures")
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity=Marque::class, inversedBy="voitures")
     */
    private $marque;

    /**
     * @ORM\ManyToOne(targetEntity=Genre::class, inversedBy="voitures")
     */
    private $genre;

    /**
     * @ORM\ManyToOne(targetEntity=Direction::class, inversedBy="voitures")
     */
    private $abrdirection;

    /**
     * @ORM\OneToMany(targetEntity=Personneldetenteur::class, mappedBy="matriculevoiture")
     */
    private $personneldetenteurs;

    /**
     * @ORM\OneToMany(targetEntity=Detentionvoiture::class, mappedBy="matriculevoiture")
     */
    private $detentionvoitures;

    /**
     * @ORM\OneToMany(targetEntity=Etatvoiture::class, mappedBy="matriculevoiture")
     */
    private $etatvoitures;

    #[ORM\Column(length: 255)]
    private ?string $permis = null;

    public function __construct()
    {
        $this->personneldetenteurs = new ArrayCollection();
        $this->detentionvoitures = new ArrayCollection();
        $this->etatvoitures = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatriculevoiture(): ?string
    {
        return $this->matriculevoiture;
    }

    public function setMatriculevoiture(string $matriculevoiture): self
    {
        $this->matriculevoiture = $matriculevoiture;

        return $this;
    }

    public function getDateentrevoiture(): ?\DateTimeInterface
    {
        return $this->dateentrevoiture;
    }

    public function setDateentrevoiture(\DateTimeInterface $dateentrevoiture): self
    {
        $this->dateentrevoiture = $dateentrevoiture;

        return $this;
    }

    public function getMatriculechauffeur(): ?Chauffeur
    {
        return $this->matriculechauffeur;
    }

    public function setMatriculechauffeur(?Chauffeur $matriculechauffeur): self
    {
        $this->matriculechauffeur = $matriculechauffeur;

        return $this;
    }

    public function getType(): ?Type
    {
        return $this->type;
    }

    public function setType(?Type $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

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
            $personneldetenteur->setMatriculevoiture($this);
        }

        return $this;
    }

    public function removePersonneldetenteur(Personneldetenteur $personneldetenteur): self
    {
        if ($this->personneldetenteurs->removeElement($personneldetenteur)) {
            // set the owning side to null (unless already changed)
            if ($personneldetenteur->getMatriculevoiture() === $this) {
                $personneldetenteur->setMatriculevoiture(null);
            }
        }

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
            $detentionvoiture->setMatriculevoiture($this);
        }

        return $this;
    }

    public function removeDetentionvoiture(Detentionvoiture $detentionvoiture): self
    {
        if ($this->detentionvoitures->removeElement($detentionvoiture)) {
            // set the owning side to null (unless already changed)
            if ($detentionvoiture->getMatriculevoiture() === $this) {
                $detentionvoiture->setMatriculevoiture(null);
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
            $etatvoiture->setMatriculevoiture($this);
        }

        return $this;
    }

    public function removeEtatvoiture(Etatvoiture $etatvoiture): self
    {
        if ($this->etatvoitures->removeElement($etatvoiture)) {
            // set the owning side to null (unless already changed)
            if ($etatvoiture->getMatriculevoiture() === $this) {
                $etatvoiture->setMatriculevoiture(null);
            }
        }

        return $this;
    }

    public function getPermis(): ?string
    {
        return $this->permis;
    }

    public function setPermis(string $permis): static
    {
        $this->permis = $permis;

        return $this;
    }
    public function __toString(): string
   {
    return $this->matriculevoiture;
    
   }
}
