<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EntrepriseRepository")
 */
class Entreprise
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     * @Assert\NotBlank(message="Le champ ne peut pas être vide")
     * @Assert\Length(
     * min=4,
     * minMessage="le nom doit avoir minimum {{ limit }} caractères"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
       * @Assert\NotBlank(message="Le champ ne peut pas être vide")
     */
    private $activite;

    /**
     * @ORM\Column(type="string", length=300, nullable=false)
     * @Assert\NotBlank(message="Le champ ne peut pas être vide")
     * @Assert\Regex(pattern="#^[1-9][0-9]{0,2}#", message="Le numéro de rue est incorrect")
	 * @Assert\Regex(pattern="#[rue|avenue|boulevard|impasse|allée|place|route|voie]#",message="Le type de rue est incorrect")
	 * @Assert\Regex(pattern="#[0-9]{5}#", message="Le code postal est incorrect")
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=300, nullable=false)
     * @Assert\Url(message="Ceci n'est pas une URL")
       * @Assert\NotBlank(message="Le champ ne peut pas être vide")
     */
    private $siteweb;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Stage", mappedBy="entreprises")
     */
    private $stages;

    public function __construct()
    {
        $this->stages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getActivite(): ?string
    {
        return $this->activite;
    }

    public function setActivite(string $activite): self
    {
        $this->activite = $activite;

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

    public function getSiteweb(): ?string
    {
        return $this->siteweb;
    }

    public function setSiteweb(string $siteweb): self
    {
        $this->siteweb = $siteweb;

        return $this;
    }

    /**
     * @return Collection|Stage[]
     */
    public function getStages(): Collection
    {
        return $this->stages;
    }

    public function addStage(Stage $stage): self
    {
        if (!$this->stages->contains($stage)) {
            $this->stages[] = $stage;
            $stage->setEntreprises($this);
        }

        return $this;
    }

    public function removeStage(Stage $stage): self
    {
        if ($this->stages->contains($stage)) {
            $this->stages->removeElement($stage);
            // set the owning side to null (unless already changed)
            if ($stage->getEntreprises() === $this) {
                $stage->setEntreprises(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getNom();
    }
}
