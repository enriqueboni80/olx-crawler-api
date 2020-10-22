<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\PesquisarCarroAPIRequest;
use App\Repositories\CarroRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class CarroController
 * @package App\Http\Controllers\API
 */

class CarroAPIController extends AppBaseController
{
    /** @var  CarroRepository */
    private $carroRepository;

    /** @var  cacheDeCarros */
    private $cacheDeCarros;


    public function __construct(CarroRepository $carroRepo)
    {
        $this->carroRepository = $carroRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/carros",
     *      summary="Retornar a listagem de todos os carros",
     *      tags={"Carro"},
     *      description="Get all Carros",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Carro")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        if (!\Cache::has($this->cacheDeCarros)) {
            $this->setCacheCarros();
        } else {
            $carros = \Cache::get($this->cacheDeCarros);
        }

        return $this->sendResponse($carros->toArray(), 'Carros retrieved successfully');
    }

    /**
     * @param PesquisarCarroAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/carros/pesquisar",
     *      summary="Pesquisa pelos Modelos de Carros",
     *      tags={"Carro"},
     *      description="Store Carro",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Carro that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Carro")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Carro"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function pesquisar(PesquisarCarroAPIRequest $request)
    {
        if (!\Cache::has($this->cacheDeCarros)) {
            $this->setCacheCarros();
        }

        $carros = $this->carroRepository->pesquisar($request);

        return $this->sendResponse($carros->toArray(), 'Carros retrieved successfully');
    }

    public function setCacheCarros()
    {
        \Artisan::call('crawler:carros');
        $carros = $this->carroRepository->all();
        \Cache::put($this->cacheDeCarros, $carros, now()->addHour(1));
    }
}
