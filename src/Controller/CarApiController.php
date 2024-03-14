<?php

namespace App\Controller;

use App\Entity\Agency;
use App\Entity\Car;
use App\Repository\CarRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use OpenApi\Attributes as OA;

#[Route("/api")]
#[OA\Tag("cars")]
class CarApiController extends AbstractController
{
    #[OA\Get(
        summary: "Liste des voitures"
    )]
    #[OA\Response(
        response: 200,
        description: "La liste des voitures",
        content: new OA\JsonContent(
            type: 'array',
            items: new OA\Items(
                ref: "#/components/schemas/CarInfos"
            )
        )
    )]
    #[View(serializerGroups: ["car_infos"])]
    #[Route('/cars', methods: ["GET"])]
    public function index(CarRepository $cars)
    {
        return $cars->findAll();
    }

    #[OA\Patch(
        summary: "Marque une voiture comme louée/non louée (en fonction du paramètre rent)"
    )]
    #[OA\Response(
        response: 200,
        description: "La voiture louée",
        content: new OA\JsonContent(ref: "#/components/schemas/CarInfos")
    )]
    #[View(serializerGroups: ["car_infos"])]
    #[Route('/car/{id}', methods: ["PATCH"])]
    public function rentcar(
        Car $car,
        #[MapRequestPayload(serializationContext: ['groups' => ['car_update']])] Car $carUpdate,
        EntityManagerInterface $manager
    ) {
        if ($carUpdate->isRented() !== null) {
            $car->setRented($carUpdate->isRented());
        }
        if ($carUpdate->getName() !== null) {
            $car->setName($carUpdate->getName());
        }
        if ($carUpdate->getLicensePlate() !== null) {
            $car->setLicensePlate($carUpdate->getLicensePlate());
        }

        $manager->flush();

        return $car;
    }

    #[OA\Post(
        summary: "Ajouter une voiture"
    )]
    #[OA\Response(
        response: 200,
        description: "La voiture créée",
        content: new OA\JsonContent(ref: "#/components/schemas/CarInfos")
    )]
    #[View(serializerGroups: ["car_infos"])]
    #[Route("/car/{agency}", methods: ["POST"])]
    public function add(
        Agency $agency,
        #[MapRequestPayload(serializationContext: ['groups' => ['car_new']])] Car $car,
        CarRepository $cars
    ) {
        $car->setAgency($agency);
        $cars->save($car, true);

        return $car;
    }
}
