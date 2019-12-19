<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StageRepository")
 */
class Stage
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
    private $titre;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Formation", inversedBy="stages")
     */
    private $formation;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Entreprise", inversedBy="stages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $entreprises;

    public function __construct()
    {
        $this->formation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @return Collection|formation[]
     */
    public function getFormation(): Collection
    {
        return $this->formation;
    }

    public function addFormation(formation $formation): self
    {
        if (!$this->formation->contains($formation)) {
            $this->formation[] = $formation;
        }

        return $this;
    }

    public function removeFormation(formation $formation): self
    {
        if ($this->formation->contains($formation)) {
            $this->formation->removeElement($formation);
        }

        return $this;
    }

    public function getEntreprises(): ?Entreprise
    {
        return $this->entreprises;
    }

    public function setEntreprises(?Entreprise $entreprises): self
    {
        $this->entreprises = $entreprises;

        return $this;
    }
}
