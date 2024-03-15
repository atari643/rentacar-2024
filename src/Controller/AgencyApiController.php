<?php

namespace App\Controller;

use App\Repository\AgencyRepository;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Agency;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Attribute\MapQueryParameter;
use OpenApi\Attributes as OA;
use OpenApi\Attributes\Parameter;

#[Route("/api")]
#[OA\Tag("agencies")]
class AgencyApiController extends AbstractController
{
    #[OA\Get(summary: "Liste des agences")]
    #[OA\Response(
        response: 200,
        description: "La liste des agences",
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                ref: "#/components/schemas/AgencyInfos"
            )
        )
    )]
    #[View(serializerGroups: ["agency_infos"])]
    #[OA\Parameter(
        description: "filtre agence qui propose des cars à louer",
        in: "query",
        required: false,
        name: "only_available"
    )]
    
    #[Route("/agencies", methods: ["GET"])]
    public function index(
        AgencyRepository $agencies, #[MapQueryParameter] bool $only_available = false)
    {
        return $agencies->findAll();
    }
    #[OA\Patch(
        summary: "affiche les voitures d'une agences",
    )]
    #[OA\Response(
        response: 200,
        description: "Les voitures d'une agences",
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                ref: "#/components/schemas/CarInfos"
            )
        )    )]
    #[View(serializerGroups: ["agency_infos", "car_infos"])]
    #[Route('/agency/{id}', methods: ["GET"])]
    public function agencyCars(
        Agency $agency, AgencyRepository $agencies) {
        return $agencies->find($agency->getId());
    }
    
}
