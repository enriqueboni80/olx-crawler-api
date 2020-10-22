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
    public function test_create_carro()
    {
        $carro = factory(Carro::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/carros', $carro
        );

        $this->assertApiResponse($carro);
    }

    /**
     * @test
     */
    public function test_read_carro()
    {
        $carro = factory(Carro::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/carros/'.$carro->id
        );

        $this->assertApiResponse($carro->toArray());
    }

    /**
     * @test
     */
    public function test_update_carro()
    {
        $carro = factory(Carro::class)->create();
        $editedCarro = factory(Carro::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/carros/'.$carro->id,
            $editedCarro
        );

        $this->assertApiResponse($editedCarro);
    }

    /**
     * @test
     */
    public function test_delete_carro()
    {
        $carro = factory(Carro::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/carros/'.$carro->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/carros/'.$carro->id
        );

        $this->response->assertStatus(404);
    }
}
