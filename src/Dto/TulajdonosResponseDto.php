<?php

namespace App\Dto;

Class TulajdonosResponseDto
{
    private $id;
    private $nev;
    private $szemelyi;
    private $szuldatum;

    public function __construct($id, $nev, $szemelyi, $szuldatum)
    {
        $this->id = $id;
        $this->nev = $nev;
        $this->szemelyi = $szemelyi;
        $this->szuldatum = $szuldatum;
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