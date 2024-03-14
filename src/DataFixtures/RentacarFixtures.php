<?php

namespace App\DataFixtures;

use App\Entity\Agency;
use App\Entity\Car;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RentacarFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        /*
        Prompt ChatGPT de génération:    
    
         Generate dummy data about rent-a-car agency with their cars following the format:

            [
            'name' => 'Agency name',
            'address' => 'Agency address',
            'cars' => [
                [
                'name' => 'Car name',
                'licensePlate' => 'License plate',
                'rented' => true/false,
                ]
            ]
            ]
        */

        $agencies = [
            [
                'name' => 'ABC Rent-a-Car',
                'address' => '123 Main St, Anytown USA',
                'cars' => [
                    [
                        'name' => 'Toyota Corolla',
                        'licensePlate' => 'ABC1234',
                        'rented' => false,
                    ],
                    [
                        'name' => 'Honda Civic',
                        'licensePlate' => 'ABC5678',
                        'rented' => true,
                    ],
                    [
                        'name' => 'Nissan Altima',
                        'licensePlate' => 'ABC9012',
                        'rented' => false,
                    ]
                ]
            ],
            [
                'name' => 'XYZ Car Rental',
                'address' => '456 Elm St, Anytown USA',
                'cars' => [
                    [
                        'name' => 'Ford Mustang',
                        'licensePlate' => 'XYZ1234',
                        'rented' => false,
                    ],
                    [
                        'name' => 'Chevrolet Camaro',
                        'licensePlate' => 'XYZ5678',
                        'rented' => false,
                    ],
                    [
                        'name' => 'Dodge Charger',
                        'licensePlate' => 'XYZ9012',
                        'rented' => true,
                    ]
                ]
            ],
            [
                'name' => 'Speedy Rent-A-Car',
                'address' => '12 Some Street, Kansas USA',
                'cars' => [
                    [
                        'name' => 'Toyota Corolla',
                        'licensePlate' => 'DQC722',
                        'rented' => false,
                    ],
                    [
                        'name' => 'Jeep Grand Cherokee',
                        'licensePlate' => 'QWE456',
                        'rented' => false,
                    ],
                ]
            ]
        ];

        foreach ($agencies as $agency) {
            $a = new Agency;
            $a
                ->setName($agency['name'])
                ->setAddress($agency['address']);

            $manager->persist($a);
            foreach ($agency['cars'] as $car) {
                $c = new Car;
                $c
                    ->setName($car['name'])
                    ->setLicensePlate($car['licensePlate'])
                    ->setRented($car['rented'])
                    ->setAgency($a);
                $manager->persist($c);
            }
        }

        $manager->flush();
    }
}
