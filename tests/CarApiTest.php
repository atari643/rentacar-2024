<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CarApiTest extends WebTestCase
{
    public function testCarList(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/cars');
        $cars = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful("La liste des voitures est bien obtenue");
        $this->assertEquals(8, count($cars), "Le nombre de voitures doit correspondre aux données de test");
    }

    public function testRentCar(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/cars');
        $cars = json_decode($client->getResponse()->getContent(), true);

        $rentedId = null;

        // Finding a car to rent
        foreach ($cars as $car) {
            if ($car["rented"] == false) {
                $client->request('PATCH', '/api/car/rent/' . $car["id"] . '?rent=true');
                $carData = json_decode($client->getResponse()->getContent(), true);

                $this->assertEquals($car["id"], $carData["id"], "On obient bien la voiture louée");
                $this->assertEquals(true, $carData["rented"], "La voiture louée est bien marquée louée");

                $rentedId = $car["id"];
                break;
            }
        }

        // On vérifie que la voiture est maintenant marquée comme louée
        $client->request('GET', '/api/cars');
        $cars = json_decode($client->getResponse()->getContent(), true);

        foreach ($cars as $car) {
            if ($car["id"] == $rentedId) {
                $this->assertEquals(true, $car["rented"], "La voiture louée est bien louée, même après une requête");
            }
        }
    }
}
