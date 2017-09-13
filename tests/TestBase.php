<?php

namespace Tests;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
    public $client;

    public function setUp()
    {
        parent::setUp();

        $this->client = new Client([
            'base_uri' => 'http://localhost:1234',
            'exceptions' => false,
        ]);
    }

    public function assertWithoutRate($response, $data, $from, $to)
    {
        $this->assertResponse($response, $data);

        $this->assertStringStartsWith($from, $data['from']);
        $this->assertStringStartsWith($to, $data['to']);
    }

    public function assertWithRate($response, $data, $from, $to)
    {
        $this->assertResponse($response, $data);

        $this->assertEquals($from, $data['from']);
        $this->assertEquals($to, $data['to']);
    }

    private function assertResponse($response, $data)
    {
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertArrayHasKey('from', $data);
        $this->assertArrayHasKey('to', $data);
    }
}