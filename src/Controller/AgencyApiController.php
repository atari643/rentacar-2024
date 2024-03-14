<?php

namespace App\Controller;

use App\Repository\AgencyRepository;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

use OpenApi\Attributes as OA;

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
    #[Route("/agencies", methods: ["GET"])]
    public function index(AgencyRepository $agencies)
    {
        return $agencies->findAll();
    }
}
