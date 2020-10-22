<?php

namespace Database\Factories;

use App\Models\Carro;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarroFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carro::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
        'categoria' => $this->faker->word,
        'modelo' => $this->faker->word,
        'marca' => $this->faker->word,
        'tipo_de_veiculo' => $this->faker->word,
        'ano' => $this->faker->word,
        'potencia_do_motor' => $this->faker->word,
        'quilometragem' => $this->faker->word,
        'combustivel' => $this->faker->word,
        'cambio' => $this->faker->word,
        'direcao' => $this->faker->word,
        'cor' => $this->faker->word,
        'portas' => $this->faker->word,
        'preco' => $this->faker->word,
        'final_de_placa' => $this->faker->word,
        'url' => $this->faker->word,
        'descricao' => $this->faker->word,
        'cep' => $this->faker->word,
        'municipio' => $this->faker->word,
        'bairro' => $this->faker->word,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}

