<?php

namespace CoolbirdBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
    * @group controller
    * @group homecontroller
    */
    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertContains('LOGISTIQUE PETROLIERE', $client->getResponse()->getContent());
        $this->assertContains(
            'Se connecter',
            $client->getResponse()->getContent()
        );
        $this->assertContains(
            'S\'inscrire',
            $client->getResponse()->getContent()
        );
    }
}
