<?php

namespace App\Tests\Controller;

use App\Entity\Newsletter;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;


Class HomeControllerTest extends WebTestCase
{
    /**
     * SmokeTest HomeController
     * @param $pageName
     * @param $url
     * @dataProvider provideUrls
     *
     */
    public function testIndex($pageName, $url)
    {
        $client = static::createClient();
        $client->catchExceptions(false);
        $client->request('GET', $url);
        $response = $client->getResponse();

        self::assertTrue(
            $response->isSuccessful(),
            sprintf(
                'Page "%s" should be accessible, but the HTTP is "%s".',
                $pageName,
                $response->getStatusCode()
            )
        );

    }

    public function provideUrls()
    {
        return [
            'read' => ['read', '/read/test'],
            'view' => ['view', '/view/test']
        ];
    }

    public function testForm()
    {
        $client = static::createClient();
        $client->request('GET', '/');

        $crawler = $client->submitForm('save', [
            'newsletter[email]' => 'test@email.com',
        ]);


        self::assertSame(302, $client->getResponse()->getStatusCode());
    }



}