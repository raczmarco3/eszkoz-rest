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
    public function savEszkoz(Request $request, ManagerRegistry $registry): Response
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
            return new Response('Ez az id nem tartozik egyetlen tulajdonoshoz sem!', 404);
        }
        return new Response('Fatal Error', 500);             
    }

    /**
     * @Route("/api/eszkozok", methods={"GET"})
     */
    public function getAllEszkoz(Request $request, ManagerRegistry $registry, SerializerInterface $serializer): Response
    {
        $eszkozService = new EszkozService();
        $eszkozok = $eszkozService->listAll($registry);

        if(!$eszkozok) {
            return new Response('Nem található egyetlen eszköz sem!', 404);
        }
        $response = JsonConverter::jsonResponse($serializer, $eszkozok, 'eszkozok');
        return $response;
    }

    /**
     * @Route("/api/eszkoz/{id}", methods={"GET"})
     */
    public function getEszkoz(Request $request, ManagerRegistry $registry, SerializerInterface $serializer, $id): Response
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
    public function deleteEszkoz(Request $request, ManagerRegistry $registry, $id): Response
    {
        $eszkozService = new EszkozService();
        $state = $eszkozService->deleteById($registry, $id);

        if(!$state) {
            return new Response('Nincs ilyen eszköz!', 404);
        } 
        return new Response('A törlés sikeres!', 200);
    }
}