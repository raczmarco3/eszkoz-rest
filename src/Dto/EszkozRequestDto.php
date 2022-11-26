<?php

namespace App\Dto;

Class EszkozRequestDto
{
    private $marka;
    private $tipus;
    private $leiras;
    private $jelleg;
    private $tulajdonosId;

    public function __construct($marka, $tipus, $leiras, $jelleg, $tulajdonosId)
    {
        $this->marka = $marka;
        $this->tipus = $tipus;
        $this->leiras = $leiras;
        $this->jelleg = $jelleg;
        $this->tulajdonosId = $tulajdonosId;
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
     * Get the value of tulajdonosId
     */ 
    public function getTulajdonosId()
    {
        return $this->tulajdonosId;
    }

    /**
     * Set the value of tulajdonosId
     *
     * @return  self
     */ 
    public function setTulajdonosId($tulajdonosId)
    {
        $this->tulajdonosId = $tulajdonosId;

        return $this;
    }
}