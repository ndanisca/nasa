<?php

namespace NasaBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NeoControllerTest extends WebTestCase
{
    public function testHazardous()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/hazardous');
    }

    public function testFastest()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/fastest');
    }

    public function testBestyear()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'best-year');
    }

    public function testBestmonth()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'best-month');
    }

}
