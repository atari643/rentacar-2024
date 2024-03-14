<?php

namespace App\Entity;

use App\Repository\CarRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: CarRepository::class)]
class Car
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("car_infos")]
    #[OA\Property(example: "45")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(["car_infos", "car_new", "car_update"])]
    #[OA\Property(example: "UX8172OM", description: "Plaque d'immatriculation")]
    #[Assert\NotBlank]
    private ?string $licensePlate = null;

    #[ORM\Column(length: 255)]
    #[Groups(["car_infos", "car_new", "car_update"])]
    #[OA\Property(example: "Fiat 500", description: "Nom de la voiture (modèle et marque)")]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'cars')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Agency $agency = null;

    #[ORM\Column]
    #[Groups(["car_infos", "car_update"])]
    #[OA\Property(example: "false", description: "Est-ce que la voiture est louée?")]
    private ?bool $rented = false;

    #[Groups("car_infos")]
    #[OA\Property(example: "33", description: "ID de l'agence correspondante")]
    public function getAgencyId(): int
    {
        return $this->getAgency()->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLicensePlate(): ?string
    {
        return $this->licensePlate;
    }

    public function setLicensePlate(string $licensePlate): self
    {
        $this->licensePlate = $licensePlate;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAgency(): ?Agency
    {
        return $this->agency;
    }

    public function setAgency(?Agency $agency): self
    {
        $this->agency = $agency;

        return $this;
    }

    public function isRented(): ?bool
    {
        return $this->rented;
    }

    public function setRented(bool $rented): self
    {
        $this->rented = $rented;

        return $this;
    }
}
