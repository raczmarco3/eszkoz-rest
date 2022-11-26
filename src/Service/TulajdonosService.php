<?php

namespace App\Service;

use App\Repository\TulajdonosRepository;
use App\Dto\TulajdonosRequestDto;
use App\Dto\TulajdonosResponseDto;
use App\Entity\Tulajdonos;
use App\Repository\EszkozRepository;
use App\Dto\EszkozResponseDto;

Class TulajdonosService
{

    public function save($registry, $tulajdonosRequestDto)
    {
        $tulajdonos = new Tulajdonos();
        $tulajdonosRepository = new TulajdonosRepository($registry);

        $tulajdonos->setNev($tulajdonosRequestDto->getNev());
        $tulajdonos->setSzemelyi($tulajdonosRequestDto->getSzemelyi());
        $tulajdonos->setSzuldatum($tulajdonosRequestDto->getSzuldatum());
            
        $tulajdonosRepository->add($tulajdonos, true);
        return true;
    }

    public function listAll($registry)
    {   
        $tulajdonosRepository = new TulajdonosRepository($registry);     
        $tulajdonosResponseDtoArray = array();
        $tulajdonosok = $tulajdonosRepository->findAll();

        if(!$tulajdonosok) {
            return false;
        }

        foreach($tulajdonosok as $tulajdonos)
        {
            $tulajdonosResponseDto = new TulajdonosResponseDto($tulajdonos->getId(), $tulajdonos->getNev(), 
            $tulajdonos->getSzemelyi(), $tulajdonos->getSzuldatum());

            array_push($tulajdonosResponseDtoArray, $tulajdonosResponseDto);
        }
        return $tulajdonosResponseDtoArray;
    }

    public function findOneById($registry, $id)
    {
        $tulajdonosRepository = new TulajdonosRepository($registry);
        $tulajdonos = $tulajdonosRepository->find($id);

        if(!$tulajdonos) {
            return false;
        }
        return new TulajdonosResponseDto($tulajdonos->getId(), $tulajdonos->getNev(), 
        $tulajdonos->getSzemelyi(), $tulajdonos->getSzuldatum());
    }

    public function deleteById($registry, $id)
    {
        $tulajdonosRepository = new TulajdonosRepository($registry);
        $eszkozRepository = new EszkozRepository($registry);
        $tulajdonos = $tulajdonosRepository->find($id);
        $eszkozok = $eszkozRepository->findBy(['tulajdonos' => $tulajdonos]);

        if(!$tulajdonos) {
            return 0;
        } else if(!empty($eszkozok)) {
            return 2;
        }

        $tulajdonosRepository->remove($tulajdonos, true);
        return 1;
    }

    public function listAllTulajdonosEszkoz($registry, $id)
    {
        $tulajdonosRepository = new TulajdonosRepository($registry);        
        $tulajdonos = $tulajdonosRepository->find($id);

        if(!$tulajdonos) {
            return 0;
        }

        $eszkozRepository = new EszkozRepository($registry);
        $eszkozok_ = $eszkozRepository->findBy(['tulajdonos' => $tulajdonos]);        

        if(!$eszkozok_) {
            return 1;
        }

        $eszkozok = array();

        foreach($eszkozok_ as $eszkoz)
        {
            $eszkozResponseDto = new EszkozResponseDto($eszkoz->getId(), $eszkoz->getMarka(), $eszkoz->getTipus(),
             $eszkoz->getLeiras(), $eszkoz->getJelleg(), $eszkoz->getTulajdonos());
            
            array_push($eszkozok, $eszkozResponseDto);
        }

        return $eszkozok;
    }
}