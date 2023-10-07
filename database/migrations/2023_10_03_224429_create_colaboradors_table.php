<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('colaboradors', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger("cpf");
            $table->unsignedBigInteger("rg");

            $table->string("nome", 100);
            $table->string("email", 100);
            $table->string("logradouro");
            $table->unsignedBigInteger("numero");
            $table->string("complemento")->nullable();
            $table->string("bairro");
            $table->unsignedBigInteger("cep");
            $table->string("cidade");
            $table->unsignedBigInteger("telefone");
            $table->unsignedBigInteger("qtd_dependentes");
            $table->unsignedBigInteger("escolaridade");
            $table->boolean("situacao");
            $table->date("data_nascimento");
            $table->date("data_inicio");
            $table->date("data_fim")->nullable();

            // Usuário relacionado
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            // Cargo relacionado
            $table->unsignedBigInteger('cargo_id');
            $table->foreign('cargo_id')->references('id')->on('cargos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colaboradors');
    }
};
