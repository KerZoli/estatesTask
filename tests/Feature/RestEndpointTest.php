<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RestEndpointTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetDevelopers()
    {
        $response = $this->json('GET', '/api/developers');
        $response->assertStatus(201);
    }
}
