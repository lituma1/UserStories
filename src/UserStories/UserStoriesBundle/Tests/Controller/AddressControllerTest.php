<?php

namespace UserStories\UserStoriesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AddressControllerTest extends WebTestCase
{
    public function testAddaddress()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addAddress');
    }

    public function testModyfyaddress()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/modyfyAddress');
    }

    public function testDeleteaddress()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteAddress');
    }

}
