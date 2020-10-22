<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarrosTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carros', function (Blueprint $table) {
            $table->increments('id');
            $table->string('categoria')->nullable();
            $table->string('modelo')->nullable();
            $table->string('marca')->nullable();
            $table->string('tipo_de_veiculo')->nullable();
            $table->string('ano')->nullable();
            $table->string('potencia_do_motor')->nullable();
            $table->string('quilometragem')->nullable();
            $table->string('combustivel')->nullable();
            $table->string('cambio')->nullable();
            $table->string('direcao')->nullable();
            $table->string('cor')->nullable();
            $table->string('portas')->nullable();
            $table->string('preco')->nullable();
            $table->string('final_de_placa')->nullable();
            $table->string('cep')->nullable();
            $table->string('municipio')->nullable();
            $table->string('bairro')->nullable();
            $table->string('url')->nullable();
            $table->string('descricao')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('carros');
    }
}

