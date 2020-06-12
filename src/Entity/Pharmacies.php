<?php

namespace App\Entity;

use App\Repository\PharmaciesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PharmaciesRepository::class)
 */
class Pharmacies
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomPharmacie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adressePharmacie;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @ORM\OneToMany(targetEntity=Produits::class, mappedBy="pharmacies")
     */
    private $produit;

    public function __construct()
    {
        $this->produit = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomPharmacie(): ?string
    {
        return $this->nomPharmacie;
    }

    public function setNomPharmacie(string $nomPharmacie): self
    {
        $this->nomPharmacie = $nomPharmacie;

        return $this;
    }

    public function getAdressePharmacie(): ?string
    {
        return $this->adressePharmacie;
    }

    public function setAdressePharmacie(?string $adressePharmacie): self
    {
        $this->adressePharmacie = $adressePharmacie;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(?string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(?int $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * @return Collection|Produits[]
     */
    public function getProduit(): Collection
    {
        return $this->produit;
    }

    public function addProduit(Produits $produit): self
    {
        if (!$this->produit->contains($produit)) {
            $this->produit[] = $produit;
            $produit->setPharmacies($this);
        }

        return $this;
    }

    public function removeProduit(Produits $produit): self
    {
        if ($this->produit->contains($produit)) {
            $this->produit->removeElement($produit);
            // set the owning side to null (unless already changed)
            if ($produit->getPharmacies() === $this) {
                $produit->setPharmacies(null);
            }
        }

        return $this;
    }
}
