<?php

namespace App\Repositories;

use App\Models\Carro;
use App\Repositories\BaseRepository;

/**
 * Class CarroRepository
 * @package App\Repositories
 * @version October 22, 2020, 5:55 pm UTC
*/

class CarroRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'teste'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Carro::class;
    }

    public function pesquisar($request)
    {
        $carros = Carro::query();
        foreach ($request->all() as $key => $word) {
            $carros->where($key, 'LIKE', '%' . $word . '%');
        }
        return $carros->get();
    }
}
