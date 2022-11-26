<?php

namespace App\Converter;

use Symfony\Component\Serializer\SerializerInterface;

use Symfony\Component\HttpFoundation\Response;
use App\Dto\TulajdonosResponseDto;

Class JsonConverter
{
    public static function jsonResponse($serializer, $data, $groupName = false)
    {
        $response = new Response();

        if($groupName) {
            $jsonContent = $serializer->serialize($data, 'json', ['groups' => $groupName]);
        } else {
            $jsonContent = $serializer->serialize($data, 'json');
        }    
        
        $response->setContent($jsonContent);
        $response->headers->set('Content-Type', 'application/json');

        return $response;        
    }
}
