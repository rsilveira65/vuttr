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
    public function testPack()
    {
        $this->client->request(
            'GET',
            '/api/tools'
        );

        $this->assertEquals(Response::HTTP_OK, $this->client->getResponse()->getStatusCode());
    }
}