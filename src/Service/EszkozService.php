<?php

namespace App\Service;

use App\Entity\Eszkoz;
use App\Dto\EszkozRequestDto;
use App\Dto\EszkozResponseDto;
use App\Repository\EszkozRepository;
use App\Repository\TulajdonosRepository;

Class EszkozService
{
    public function save($registry, $eszkozReqeustDto)
    {
        $eszkozRepository = new EszkozRepository($registry);        
        $tulajdonosRepository = new TulajdonosRepository($registry);
        $eszkoz = new Eszkoz();

        $tulajdonos = $tulajdonosRepository->find($eszkozReqeustDto->getTulajdonosId());

        if(!$tulajdonos) {
            return false;
        }

        $eszkoz->setMarka($eszkozReqeustDto->getMarka());
        $eszkoz->setTipus($eszkozReqeustDto->getTipus());
        $eszkoz->setLeiras($eszkozReqeustDto->getLeiras());
        $eszkoz->setJelleg($eszkozReqeustDto->getJelleg());
        $eszkoz->setTulajdonos($tulajdonos);

        $eszkozRepository->add($eszkoz, true);
        return true;
    }

    public function listAll($registry)
    {   
        $eszkozRepository = new EszkozRepository($registry);    
        $eszkozResponseDtoArray = array();
        $eszkozok = $eszkozRepository->findAll();

        if(!$eszkozok) {
            return false;
        }

        foreach($eszkozok as $eszkoz)
        {
            $eszkozResponseDto = new EszkozResponseDto($eszkoz->getId(), $eszkoz->getMarka(), $eszkoz->getTipus(),
             $eszkoz->getLeiras(), $eszkoz->getJelleg(), $eszkoz->getTulajdonos());

            array_push($eszkozResponseDtoArray, $eszkozResponseDto);
        }
        return $eszkozResponseDtoArray;
    }

    public function findOneById($registry, $id)
    {
        $eszkozRepository = new EszkozRepository($registry);  
        $eszkoz = $eszkozRepository->find($id); 

        if(!$eszkoz) {
            return false;
        }
        
        $eszkozResponseDto = new EszkozResponseDto($eszkoz->getId(), $eszkoz->getMarka(), $eszkoz->getTipus(),
         $eszkoz->getLeiras(), $eszkoz->getJelleg(), $eszkoz->getTulajdonos());
        
        return $eszkoz;
    }

    public function deleteById($registry, $id)
    {
        $eszkozRepository = new EszkozRepository($registry);
        $eszkoz = $eszkozRepository->find($id);

        if(!$eszkoz) {
            return false;
        }

        $eszkozRepository->remove($eszkoz, true);
        return true;
    }
}