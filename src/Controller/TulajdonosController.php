<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

use App\Dto\TulajdonosRequestDto;
use App\Service\TulajdonosService;

use Symfony\Component\Serializer\SerializerInterface;
use App\Converter\JsonConverter;

class TulajdonosController extends AbstractController
{
    /**
     * @Route("/api/tulajdonos", methods={"POST"})
     */
    public function saveTulajdonos(Request $request, ManagerRegistry $registry): Response
    {
        if($request->headers->get('Content-Type') != 'application/json') {
            return new Response('A HTTP body üres vagy nem megfelelő a Content-Type!', 406);
        }

        $tulajdonosService = new TulajdonosService();
        $data = json_decode($request->getContent(),true);
        $tulajdonosRequestDto = new TulajdonosRequestDto($data['nev'], $data['szemelyi'], date_create($data['szuldatum']));

        if($tulajdonosService->save($registry, $tulajdonosRequestDto)) {
            return new Response('A tulajdonos létrehozása sikeres!', 201);
        }
        return new Response('Fatal Error', 500);             
    }

    /**
     * @Route("/api/tulajdonosok", methods={"GET"})
     */
    public function getAllTulajdonos(Request $request, ManagerRegistry $registry, SerializerInterface $serializer): Response
    {
        $tulajdonosService = new TulajdonosService();
        $tulajdonosok = $tulajdonosService->listAll($registry);

        if(!$tulajdonosok) {
            return new Response('Nem található egyetlen tulajdonos sem!', 404);
        }

        $response = JsonConverter::jsonResponse($serializer, $tulajdonosok);
        
        return $response;
    }

    /**
     * @Route("/api/tulajdonos/{id}", methods={"GET"})
     */
    public function getTulajdonos(Request $request, ManagerRegistry $registry, SerializerInterface $serializer, $id): Response
    {
        $tulajdonosService = new TulajdonosService();
        $tulajdonos = $tulajdonosService->findOneById($registry, $id);

        if(!$tulajdonos) {
            return new Response('Tulajdonos nem található!', 404);
        }

        $response = JsonConverter::jsonResponse($serializer, $tulajdonos);

        return $response;
    }
    
    /**
     * @Route("/api/tulajdonos/{id}", methods={"DELETE"})
     */
    public function deleteTulajdonos(Request $request, ManagerRegistry $registry, $id): Response
    {
        $tulajdonosService = new TulajdonosService();
        $state = $tulajdonosService->deleteById($registry, $id);

        if($state === 0) {
            return new Response('Nincs ilyen tulajdonos!', 404);
        } else if($state === 2) {
            return new Response('A tulajdonos rendelkezik eszközzel/eszközökkel, előbb a hozzá tartozó eszközöket kell törölni!', 403);
        }

        return new Response('A törlés sikeres!', 200);
    }

    /**
     * @Route("/api/tulajdonos/{id}/eszkozok", methods={"GET"})
     */
    public function getAllTulajdonosEszkoz(Request $request, ManagerRegistry $registry, SerializerInterface $serializer, $id): Response
    {
        $tulajdonosService = new TulajdonosService();
        $eszkozok = $tulajdonosService->listAllTulajdonosEszkoz($registry, $id);

        if($eszkozok === 0) {
            return new Response('Tulajdonos nem található!', 404);
        } else if($eszkozok === 1) {
            return new Response('Tulajdonosnak egyetlen eszköze sincs!', 404);
        }

        $response = JsonConverter::jsonResponse($serializer, $eszkozok, 'eszkoz');
        return $response;
    }
}