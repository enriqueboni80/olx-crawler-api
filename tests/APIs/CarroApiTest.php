<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Carro;

class CarroApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_api_rota_carros()
    {

        $response = $this->json(
            'GET',
            '/api/v1/carros'
        );
        
        $response->assertStatus(200);
    }
}
