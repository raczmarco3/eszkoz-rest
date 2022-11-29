<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

use App\Dto\EszkozRequestDto;
use App\Service\EszkozService;

use Symfony\Component\Serializer\SerializerInterface;
use App\Converter\JsonConverter;

class EszkozController extends AbstractController
{
    /**
     * @Route("/api/eszkoz", methods={"POST"})
     */
    public function saveEszkoz(Request $request, ManagerRegistry $registry): Response
    {
        if($request->headers->get('Content-Type') != 'application/json') {
            return new Response('A HTTP body üres vagy nem megfelelő a Content-Type!', 406);
        }
        
        $eszkozService = new EszkozService($registry);
        $data = json_decode($request->getContent(),true);
        $eszkozRequestDto = new EszkozRequestDto($data['marka'], $data['tipus'], $data['leiras'], $data['jelleg'], $data['tulajdonosId']);
        $state = $eszkozService->save($registry, $eszkozRequestDto);

        if($state) {
            return new Response('Az eszköz sikeresen létrejött!', 201);
        } else if(!$state) {
            return new Response('Ez a tulajdonos id nem található az adatbázisban!', 404);
        }
        return new Response('Fatal Error', 500);             
    }

    /**
     * @Route("/api/eszkozok", methods={"GET"})
     */
    public function getAllEszkoz(ManagerRegistry $registry, SerializerInterface $serializer): Response
    {
        $eszkozService = new EszkozService();
        $eszkozok = $eszkozService->listAll($registry);

        if(!$eszkozok) {
            return new Response('Nem található egyetlen eszköz sem!', 404);
        }
        $response = JsonConverter::jsonResponse($serializer, $eszkozok, 'eszkoz');
        return $response;
    }

    /**
     * @Route("/api/eszkoz/{id}", methods={"GET"})
     */
    public function getEszkoz(ManagerRegistry $registry, SerializerInterface $serializer, $id): Response
    {
        $eszkozService = new EszkozService();
        $eszkoz = $eszkozService->findOneById($registry, $id);

        if(!$eszkoz) {
            return new Response('Eszköz nem található!', 404);
        }
        $response = JsonConverter::jsonResponse($serializer, $eszkoz, 'eszkoz');
        return $response;
    }

    /**
     * @Route("/api/eszkoz/{id}", methods={"DELETE"})
     */
    public function deleteEszkoz(ManagerRegistry $registry, $id): Response
    {
        $eszkozService = new EszkozService();
        $state = $eszkozService->deleteById($registry, $id);

        if(!$state) {
            return new Response('Nincs ilyen eszköz!', 404);
        } 
        return new Response('A törlés sikeres!', 200);
    }

    /**
     * @Route("/api/eszkoz/{id}", methods={"PUT"})
     */
    public function UpdateEszkoz(Request $request, ManagerRegistry $registry, $id): Response
    {
        if($request->headers->get('Content-Type') != 'application/json') {
            return new Response('A HTTP body üres vagy nem megfelelő a Content-Type!', 406);
        }
        
        $eszkozService = new EszkozService($registry);
        $data = json_decode($request->getContent(),true);
        $eszkozRequestDto = new EszkozRequestDto($data['marka'], $data['tipus'], $data['leiras'], $data['jelleg'], $data['tulajdonosId']);
        $state = $eszkozService->UpdateEszkoz($registry, $eszkozRequestDto, $id, $data["id"]);

        if($state === 1) {
            return new Response('Az eszköz frissítése sikeres!', 201);
        } else if($state === 2) {
            return new Response('Az eszköz nem található!', 404);
        } else if($state === 3) {
            return new Response('Ez a tulajdonos id nem található az adatbázisban!', 404);
        } else if($state === 0) {
            return new Response('Ezt az eszközt nem szerkesztheted!', 403);
        }
        return new Response('Fatal Error', 500);             
    }
}