<?php

namespace App\Entity;

use App\Repository\AgencyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

use OpenApi\Attributes as OA;

#[ORM\Entity(repositoryClass: AgencyRepository::class)]
class Agency
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups("agency_infos")]
    #[OA\Property(example: "12")]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups("agency_infos")]
    #[OA\Property(example: "Une agence", description: "Nom de l'agence")]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[OA\Property(example: "123 rue de quelque-part, France", description: "Adresse de l'agence")]
    private ?string $address = null;

    #[ORM\OneToMany(mappedBy: 'agency', targetEntity: Car::class, orphanRemoval: true)]
    private Collection $cars;

    public function __construct()
    {
        $this->cars = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    /**
     * @return Collection<int, Car>
     */
    public function getCars(): Collection
    {
        return $this->cars;
    }

    public function addCar(Car $car): self
    {
        if (!$this->cars->contains($car)) {
            $this->cars->add($car);
            $car->setAgency($this);
        }

        return $this;
    }

    public function removeCar(Car $car): self
    {
        if ($this->cars->removeElement($car)) {
            // set the owning side to null (unless already changed)
            if ($car->getAgency() === $this) {
                $car->setAgency(null);
            }
        }

        return $this;
    }
}
