<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SecurityControllerTest extends WebTestCase
{
    /**
     * @group controller
     * @group securitycontroller
     */
    public function testPageLogin(): void
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/login');

        $this->assertCount(
            1,
            $crawler->filter('form[action="/login_check"]')
        );
        $this->assertCount(
            1,
            $crawler->filter('input[name=_username][type=text]')
        );
        $this->assertCount(
            1,
            $crawler->filter('input[name=_password][type=password]')
        );
        $this->assertCount(
            1,
            $crawler->filter('input[name=_submit][type=submit]')
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @group controller
     * @group securitycontroller
     */
    public function testResetPassword(): void
    {
        $client  = static::createClient();
        $crawler = $client->request('GET', '/resetting/request');

        $this->assertCount(
            1,
            $crawler->filter('form[action="/resetting/send-email"]')
        );
        $this->assertCount(
            1,
            $crawler->filter('input[name=username][type=email]')
        );
        $this->assertCount(
            1,
            $crawler->filter('input[type=submit]')
        );
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    /**
     * @group controller
     * @group securitycontroller
     */
    public function testPageLoginSubmitForm(): void
    {
        $client  = static::createClient();

        $crawler = $client->request('GET', '/login');

        $form              = $crawler->selectButton('Log In')->form();
        $form['_username'] = 'heriniaina@passion4humanity.com';
        $form['_password'] = 'test';

        $postCrawler = $client->submit($form);
        $response = $client->getResponse();

        $this->assertContains(
            'Redirecting to',
            $postCrawler->filter('html')->text()
        );
    }
}
