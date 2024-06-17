<?php

namespace App\Entity;
use InvalidArgumentException;
use App\Repository\EtatvoitureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtatvoitureRepository::class)
 */
class Etatvoiture
{
    const ETAT_BON = 'bonetat';
    const ETAT_MAUVAIS = 'mauvaisetat';

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $numetat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $etat;

    /**
     * @ORM\Column(type="date")
     */
    private $dateetat;

    /**
     * @ORM\ManyToOne(targetEntity=Direction::class, inversedBy="etatvoitures")
     */
    private $abrdirection;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="etatvoitures")
     */
    private $matriculevoiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumetat(): ?string
    {
        return $this->numetat;
    }

    public function setNumetat(string $numetat): self
    {
        $this->numetat = $numetat;

        return $this;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        if (!in_array($etat, [self::ETAT_BON, self::ETAT_MAUVAIS])) {
            throw new InvalidArgumentException("Etat invalide: $etat");
        }
        $this->etat = $etat;

        return $this;
    }

    public function getDateetat(): ?\DateTimeInterface
    {
        return $this->dateetat;
    }

    public function setDateetat(\DateTimeInterface $dateetat): self
    {
        $this->dateetat = $dateetat;

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

    public function getMatriculevoiture(): ?Voiture
    {
        return $this->matriculevoiture;
    }

    public function setMatriculevoiture(?Voiture $matriculevoiture): self
    {
        $this->matriculevoiture = $matriculevoiture;

        return $this;
    }
    public function __toString(): string
   {
    return $this->numetat;
    
   }
}
