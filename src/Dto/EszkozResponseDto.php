<?php

namespace App\Dto;
use Symfony\Component\Serializer\Annotation\Groups;

Class EszkozResponseDto
{
    /**
     * @Groups({"eszkozok"})
     */
    private $id;

    /**
     * @Groups({"eszkozok"})
     */
    private $marka;

    /**
     * @Groups({"eszkozok"})
     */
    private $tipus;

    /**
     * @Groups({"eszkozok"})
     */
    private $leiras;

    /**
     * @Groups({"eszkozok"})
     */
    private $jelleg;

    /**
     * @Groups({"eszkozok"})
     */
    private $tulajdonos;

    public function __construct($id, $marka, $tipus, $leiras, $jelleg, $tulajdonos)
    {
        $this->id = $id;
        $this->marka = $marka;
        $this->tipus = $tipus;
        $this->leiras = $leiras;
        $this->jelleg = $jelleg;
        $this->tulajdonos = $tulajdonos;
    }    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of marka
     */ 
    public function getMarka()
    {
        return $this->marka;
    }

    /**
     * Set the value of marka
     *
     * @return  self
     */ 
    public function setMarka($marka)
    {
        $this->marka = $marka;

        return $this;
    }

    /**
     * Get the value of tipus
     */ 
    public function getTipus()
    {
        return $this->tipus;
    }

    /**
     * Set the value of tipus
     *
     * @return  self
     */ 
    public function setTipus($tipus)
    {
        $this->tipus = $tipus;

        return $this;
    }

    /**
     * Get the value of leiras
     */ 
    public function getLeiras()
    {
        return $this->leiras;
    }

    /**
     * Set the value of leiras
     *
     * @return  self
     */ 
    public function setLeiras($leiras)
    {
        $this->leiras = $leiras;

        return $this;
    }

    /**
     * Get the value of jelleg
     */ 
    public function getJelleg()
    {
        return $this->jelleg;
    }

    /**
     * Set the value of jelleg
     *
     * @return  self
     */ 
    public function setJelleg($jelleg)
    {
        $this->jelleg = $jelleg;

        return $this;
    }

    /**
     * Get the value of tulajdonos
     */ 
    public function getTulajdonos()
    {
        return $this->tulajdonos;
    }

    /**
     * Set the value of tulajdonos
     *
     * @return  self
     */ 
    public function setTulajdonos($tulajdonos)
    {
        $this->tulajdonos = $tulajdonos;

        return $this;
    }
}