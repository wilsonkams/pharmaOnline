<?php

namespace App\Entity;

use App\Repository\ProduitsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass=ProduitsRepository::class)
 */
class Produits
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $nomProduit;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $traitement;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $posologie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $disponibilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity=Pharmacies::class, inversedBy="produit")
     */
    private $pharmacies;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProduit(): ?string
    {
        return $this->nomProduit;
    }

    public function setNomProduit(string $nomProduit): self
    {
        $this->nomProduit = $nomProduit;

        return $this;
    }

    public function getTraitement(): ?string
    {
        return $this->traitement;
    }

    public function setTraitement(string $traitement): self
    {
        $this->traitement = $traitement;

        return $this;
    }

    public function getPosologie(): ?string
    {
        return $this->posologie;
    }

    public function setPosologie(string $posologie): self
    {
        $this->posologie = $posologie;

        return $this;
    }

    public function getDisponibilite(): ?string
    {
        return $this->disponibilite;
    }

    public function setDisponibilite(string $disponibilite): self
    {
        $this->disponibilite = $disponibilite;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): self
    {
        $this->images = $images;

        return $this;
    }

    public function getPharmacies(): ?Pharmacies
    {
        return $this->pharmacies;
    }

    public function setPharmacies(?Pharmacies $pharmacies): self
    {
        $this->pharmacies = $pharmacies;

        return $this;
    }
}
