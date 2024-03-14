<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AgencyApiTest extends WebTestCase
{
    public function testAgenciesList(): void
    {
        $client = static::createClient();
        $client->request('GET', '/api/agencies');

        $agencies = json_decode($client->getResponse()->getContent(), true);

        $this->assertResponseIsSuccessful("La liste des agences est bien obtenue");

        $this->assertEquals(3, count($agencies), "Le nombre d'agence doit correspondre aux données de test");

        $names = [];
        foreach ($agencies as $agency) {
            $this->assertArrayHasKey('id', $agency, "Une agence a un id");
            $this->assertArrayHasKey('name', $agency, "Une agence a un nom");

            $names[] = $agency['name'];
        }

        $this->assertContains('ABC Rent-a-Car', $names, "Test de la présence d'une agence connue");
        $this->assertContains('XYZ Car Rental', $names, "Test de la présence d'une agence connue");
        $this->assertContains('Speedy Rent-A-Car', $names, "Test de la présence d'une agence connue");
    }
}
