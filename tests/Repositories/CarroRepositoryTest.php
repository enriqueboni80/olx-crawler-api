<?php namespace Tests\Repositories;

use App\Models\Carro;
use App\Repositories\CarroRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class CarroRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var CarroRepository
     */
    protected $carroRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->carroRepo = \App::make(CarroRepository::class);
    }

    /**
     * @test create
     */
    public function test_respositories_gravar_carro()
    {
        $carro = Carro::factory()->make()->toArray();

        $createdCarro = $this->carroRepo->create($carro);

        $createdCarro = $createdCarro->toArray();
        $this->assertArrayHasKey('id', $createdCarro);
        $this->assertNotNull($createdCarro['id'], 'Created Carro must have id specified');
        $this->assertNotNull(Carro::find($createdCarro['id']), 'Carro with given id must be in DB');
        $this->assertModelData($carro, $createdCarro);
    }

    /**
     * @test read
     */
    public function test_respositories_pesquisar_carro()
    {
        $carro = Carro::factory()->create();

        $dbCarro = $this->carroRepo->find($carro->id);

        $dbCarro = $dbCarro->toArray();
        $this->assertModelData($carro->toArray(), $dbCarro);
    }
}
