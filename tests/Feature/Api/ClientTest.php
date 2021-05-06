<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ClientTest extends TestCase
{
    use RefreshDatabase;

    protected $url = 'api/auth';

    /**
     * Error Get Create Client
     *
     * @return void
     */
    public function testErrorGetCreateClient()
    {

        $payload = [
            // 'name' => 'Everton Alves',
            // 'email' => 'ellalvesdev@gmail.com',
            // 'password' => 'ellalvesdev@gmail.com',
        ];

        $response = $this->postJson("{$this->url}/clients", $payload);

        $response->assertStatus(422);
    }

    /**
     * Get Create Client
     *
     * @return void
     */
    public function testGetCreateClient()
    {

        $payload = [
            'name' => 'Everton Alves',
            'phone' => '(75) 99189-6668',
            'email' => 'ellalvesdev@gmail.com',
            'password' => 'ellalvesdev@gmail.com',
        ];

        $response = $this->postJson("{$this->url}/clients", $payload);

        $response->assertStatus(201);
                    // ->assertExactJson([
                    //     'data' => [
                    //         'name' => $payload['name'],
                    //         'email' => $payload['email'],
                    //     ]
                    // ]);
    }
}
