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

    /** @var  carros */
    private $carros;

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
    public function index()
    {
        if (!\Cache::has($this->cacheDeCarros)) {
            $this->setCacheCarros();
        } else {
            $this->carros = \Cache::get($this->cacheDeCarros);
        }

        return $this->sendResponse($this->carros->toArray(), 'Carros retrieved successfully');
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
     *          description="Carros that should be retrieves",
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

        try {
            $carrosLocalizados = $this->carroRepository->pesquisar($request);
        } catch (\Throwable $th) {
            return $this->sendResponse($th->getMessage(), 400);
        }

        return $this->sendResponse($carrosLocalizados->toArray(), 'Carros retrieved successfully');
    }

    //description="Seta o cache de carros: variavel $tempoDoCache defini o tempo do cache em MINUTOS"
    public function setCacheCarros()
    {
        $tempoDoCache = 15;

        \Artisan::call('crawler:carros');

        $this->carros = $this->carroRepository->all();

        if (!empty($this->carros)) {
            \Cache::put($this->cacheDeCarros, $this->carros, now()->addMinute($tempoDoCache));
        }
    }
}
