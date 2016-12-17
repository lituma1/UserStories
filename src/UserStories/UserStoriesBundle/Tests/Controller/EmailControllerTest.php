<?php

namespace UserStories\UserStoriesBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class EmailControllerTest extends WebTestCase
{
    public function testAddemail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addEmail');
    }

    public function testDeleteemail()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteEmail');
    }

}
