<?php

namespace App\Dto;

Class TulajdonosRequestDto
{
    private $nev;
    private $szemelyi;
    private $szuldatum;

    public function __construct($nev, $szemelyi, $szuldatum)
    {
        $this->nev = $nev;
        $this->szemelyi = $szemelyi;
        $this->szuldatum = $szuldatum;
    }

    /**
     * Get the value of nev
     */ 
    public function getNev()
    {
        return $this->nev;
    }

    /**
     * Set the value of nev
     *
     * @return  self
     */ 
    public function setNev($nev)
    {
        $this->nev = $nev;

        return $this;
    }

    /**
     * Get the value of szemelyi
     */ 
    public function getSzemelyi()
    {
        return $this->szemelyi;
    }

    /**
     * Set the value of szemelyi
     *
     * @return  self
     */ 
    public function setSzemelyi($szemelyi)
    {
        $this->szemelyi = $szemelyi;

        return $this;
    }

    /**
     * Get the value of szuldatum
     */ 
    public function getSzuldatum()
    {
        return $this->szuldatum;
    }

    /**
     * Set the value of szuldatum
     *
     * @return  self
     */ 
    public function setSzuldatum($szuldatum)
    {
        $this->szuldatum = $szuldatum;

        return $this;
    }
}