<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @SWG\Definition(
 *      definition="Carro",
 *      required={""},
 *      @SWG\Property(
 *          property="modelo",
 *          description="modelo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="marca",
 *          description="marca",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="tipo_de_veiculo",
 *          description="tipo_de_veiculo",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="ano",
 *          description="ano",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="potencia_do_motor",
 *          description="potencia_do_motor",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="quilometragem",
 *          description="quilometragem",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="combustivel",
 *          description="combustivel",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cambio",
 *          description="cambio",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="direcao",
 *          description="direcao",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cor",
 *          description="cor",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="portas",
 *          description="portas",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="preco",
 *          description="preco",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="final_de_placa",
 *          description="final_de_placa",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="cep",
 *          description="cep",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="municipio",
 *          description="municipio",
 *          type="string"
 *      ),
 *      @SWG\Property(
 *          property="bairro",
 *          description="bairro",
 *          type="string"
 *      ),

 * )
 */
class Carro extends Model
{
    use SoftDeletes;

    public $table = 'carros';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'categoria',
        'modelo',
        'marca',
        'tipo_de_veiculo',
        'ano',
        'potencia_do_motor',
        'quilometragem',
        'combustivel',
        'cambio',
        'direcao',
        'cor',
        'portas',
        'preco',
        'final_de_placa',
        'url',
        'descricao',
        'cep',
        'municipio',
        'bairro'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'categoria' => 'string',
        'modelo' => 'string',
        'marca' => 'string',
        'tipo_de_veiculo' => 'string',
        'ano' => 'string',
        'potencia_do_motor' => 'string',
        'quilometragem' => 'string',
        'combustivel' => 'string',
        'cambio' => 'string',
        'direcao' => 'string',
        'cor' => 'string',
        'portas' => 'string',
        'preco' => 'string',
        'final_de_placa' => 'string',
        'url' => 'string',
        'descricao' => 'string',
        'cep' => 'string',
        'municipio' => 'string',
        'bairro' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [];
}

