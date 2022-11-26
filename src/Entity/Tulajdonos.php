<?php

namespace App\Entity;

use App\Repository\TulajdonosRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=TulajdonosRepository::class)
 */
class Tulajdonos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"eszkoz"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"eszkoz"})
     */
    private $nev;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"eszkoz"})
     */
    private $szemelyi;

    /**
     * @ORM\Column(type="date")
     * @Groups({"eszkoz"})
     */
    private $szuldatum;

    /**
     * @ORM\OneToMany(targetEntity=Eszkoz::class, mappedBy="tulajdonos")
     *
     */
    private $eszkozok;

    public function __construct()
    {
        $this->eszkozok = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNev(): ?string
    {
        return $this->nev;
    }

    public function setNev(string $nev): self
    {
        $this->nev = $nev;

        return $this;
    }

    public function getSzemelyi(): ?string
    {
        return $this->szemelyi;
    }

    public function setSzemelyi(string $szemelyi): self
    {
        $this->szemelyi = $szemelyi;

        return $this;
    }

    public function getSzuldatum()
    {
        return date_format($this->szuldatum,"Y-m-d");
    }

    public function setSzuldatum(\DateTimeInterface $szuldatum): self
    {
        $this->szuldatum = $szuldatum;

        return $this;
    }

    
    /**
     * @return Collection<int, Eszkoz>
     */
    public function getEszkozok(): Collection
    {
        return $this->eszkozok;
    }

    public function addEszkozok(Eszkoz $eszkozok): self
    {
        if (!$this->eszkozok->contains($eszkozok)) {
            $this->eszkozok[] = $eszkozok;
            $eszkozok->setTulajdonos($this);
        }

        return $this;
    }

    public function removeEszkozok(Eszkoz $eszkozok): self
    {
        if ($this->eszkozok->removeElement($eszkozok)) {
            // set the owning side to null (unless already changed)
            if ($eszkozok->getTulajdonos() === $this) {
                $eszkozok->setTulajdonos(null);
            }
        }

        return $this;
    }
}
