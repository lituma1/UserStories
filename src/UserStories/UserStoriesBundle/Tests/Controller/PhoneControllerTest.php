<?php

namespace UserStories\UserStoriesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PhoneControllerTest extends WebTestCase
{
    public function testAddphone()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addPhone');
    }

    public function testDeletephone()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deletePhone');
    }

}
