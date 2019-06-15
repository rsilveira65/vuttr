<?php

namespace Tests\ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class ApiControllerTest
 * @author Rafael Silveira <rsilveiracc@gmail.com>
 * @covers \ApiBundle\Controller\ApiController
 * @package ApiBundle\Tests\Controller
 */
class ApiControllerTest extends WebTestCase
{
    /** @var Client */
    private $client;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    /**
     * @covers \ApiBundle\Controller\ApiController::toolAction()
     */
    public function testGetTools()
    {
        $this->client->request(
            'GET',
            '/api/tools'
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('title', $data[0]);
        $this->assertArrayHasKey('link', $data[0]);
        $this->assertArrayHasKey('description', $data[0]);
        $this->assertArrayHasKey('tags', $data[0]);
    }

    /**
     * @covers \ApiBundle\Controller\ApiController::toolAction()
     */
    public function testAddTool()
    {
        $this->client->request(
            'POST',
            '/api/tools',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode(

                [
                    'title' => 'hotel',
                    'link' => 'https://github.com/typicode/hotel',
                    'description' => 'Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.',
                    'tags' => ['node', 'organizing', 'webapps', 'domain', 'developer', 'https', 'proxy']
                ]

            )
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('title', $data[0]);
        $this->assertArrayHasKey('link', $data[0]);
        $this->assertArrayHasKey('description', $data[0]);
        $this->assertArrayHasKey('tags', $data[0]);
    }

    /**
     * @covers \ApiBundle\Controller\ApiController::toolAction()
     */
    public function testDeleteTool()
    {
        $this->client->request(
            'DELETE',
            '/api/tools/id/5'
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }

    /**
     * @covers \ApiBundle\Controller\ApiController::toolAction()
     */
    public function testSearchTools()
    {
        $this->client->request(
            'GET',
            '/api/tools/tag/rest'
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());

        $data = json_decode($this->client->getResponse()->getContent(), true);

        $this->assertArrayHasKey('id', $data[0]);
        $this->assertArrayHasKey('title', $data[0]);
        $this->assertArrayHasKey('link', $data[0]);
        $this->assertArrayHasKey('description', $data[0]);
        $this->assertArrayHasKey('tags', $data[0]);
    }
}