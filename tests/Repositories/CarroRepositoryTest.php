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
    public function test_create_carro()
    {
        $carro = factory(Carro::class)->make()->toArray();

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
    public function test_read_carro()
    {
        $carro = factory(Carro::class)->create();

        $dbCarro = $this->carroRepo->find($carro->id);

        $dbCarro = $dbCarro->toArray();
        $this->assertModelData($carro->toArray(), $dbCarro);
    }

    /**
     * @test update
     */
    public function test_update_carro()
    {
        $carro = factory(Carro::class)->create();
        $fakeCarro = factory(Carro::class)->make()->toArray();

        $updatedCarro = $this->carroRepo->update($fakeCarro, $carro->id);

        $this->assertModelData($fakeCarro, $updatedCarro->toArray());
        $dbCarro = $this->carroRepo->find($carro->id);
        $this->assertModelData($fakeCarro, $dbCarro->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_carro()
    {
        $carro = factory(Carro::class)->create();

        $resp = $this->carroRepo->delete($carro->id);

        $this->assertTrue($resp);
        $this->assertNull(Carro::find($carro->id), 'Carro should not exist in DB');
    }
}
