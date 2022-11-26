<?php

namespace App\Entity;

use App\Repository\EszkozRepository;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=EszkozRepository::class)
 */
class Eszkoz
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
    private $marka;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"eszkoz"})
     */
    private $tipus;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"eszkoz"})
     */
    private $leiras;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"eszkoz"})
     */
    private $jelleg;

    /**
     * @ORM\ManyToOne(targetEntity=Tulajdonos::class, inversedBy="eszkozok")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"eszkoz"})
     */
    private $tulajdonos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarka(): ?string
    {
        return $this->marka;
    }

    public function setMarka(string $marka): self
    {
        $this->marka = $marka;

        return $this;
    }

    public function getTipus(): ?string
    {
        return $this->tipus;
    }

    public function setTipus(string $tipus): self
    {
        $this->tipus = $tipus;

        return $this;
    }

    public function getLeiras(): ?string
    {
        return $this->leiras;
    }

    public function setLeiras(string $leiras): self
    {
        $this->leiras = $leiras;

        return $this;
    }

    public function getJelleg(): ?string
    {
        return $this->jelleg;
    }

    public function setJelleg(string $jelleg): self
    {
        $this->jelleg = $jelleg;

        return $this;
    }

    public function getTulajdonos(): ?Tulajdonos
    {
        return $this->tulajdonos;
    }

    public function setTulajdonos(?Tulajdonos $tulajdonos): self
    {
        $this->tulajdonos = $tulajdonos;

        return $this;
    }
}
