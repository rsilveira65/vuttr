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
class ApiControllerTest extends \PHPUnit_Framework_TestCase
{
    /** @var  \GuzzleHttp\Client $client */
    private $client;

    public function setUp()
    {
        $this->client = new \GuzzleHttp\Client(['base_uri' => 'http://nginx/']);
    }

    /**
     * @covers \ApiBundle\Controller\ApiController::toolAction()
     */
    public function testGetTools()
    {
        $response = $this->client->get('/api/tools');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

    }

    /**
     * @covers \ApiBundle\Controller\ApiController::addToolAction()
     */
    public function testAddTool()
    {
        $response = $this->client->post(
            '/api/tools',
            ['json' =>
                [
                    'title' => 'hotel',
                    'link' => 'https://github.com/typicode/hotel',
                    'description' => 'Local app manager. Start apps within your browser, developer tool with local .localhost domain and https out of the box.',
                    'tags' => ['node', 'organizing', 'webapps', 'domain', 'developer', 'https', 'proxy']
                ]
            ]
        );

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @covers \ApiBundle\Controller\ApiController::deleteToolAction()
     */
    public function testDeleteTool()
    {
        $response = $this->client->delete('/api/tools/id/3');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
    }

    /**
     * @covers \ApiBundle\Controller\ApiController::searchToolAction()
     */
    public function testSearchTools()
    {
        $response = $this->client->get('/api/tools/tag/node');

        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());

    }
}