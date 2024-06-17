<?php

namespace App\Entity;

use App\Repository\DetentionvoitureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DetentionvoitureRepository::class)
 */
class Detentionvoiture
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
    private $numdetention;

    /**
     * @ORM\Column(type="date")
     */
    private $datedetention;

    /**
     * @ORM\ManyToOne(targetEntity=Personneldetenteur::class, inversedBy="detentionvoitures")
     */
    private $matriculepersonnel;

    /**
     * @ORM\ManyToOne(targetEntity=Voiture::class, inversedBy="detentionvoitures")
     */
    private $matriculevoiture;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumdetention(): ?string
    {
        return $this->numdetention;
    }

    public function setNumdetention(string $numdetention): self
    {
        $this->numdetention = $numdetention;

        return $this;
    }

    public function getDatedetention(): ?\DateTimeInterface
    {
        return $this->datedetention;
    }

    public function setDatedetention(\DateTimeInterface $datedetention): self
    {
        $this->datedetention = $datedetention;

        return $this;
    }

    public function getMatriculepersonnel(): ?Personneldetenteur
    {
        return $this->matriculepersonnel;
    }

    public function setMatriculepersonnel(?Personneldetenteur $matriculepersonnel): self
    {
        $this->matriculepersonnel = $matriculepersonnel;

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
    return $this->numdetention;
    
   }
}
