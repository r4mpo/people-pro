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
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            // Informações básicas da empresa
            $table->unsignedBigInteger('cnpj_raiz');
            $table->string('razao_social');
            $table->string('capital_social')->nullable();
            $table->string('nome_fantasia')->nullable();
            $table->boolean('situacao_cadastral');
            $table->date('data_inicio_atividade');

            // Endereço da empresa
            $table->string("logradouro");
            $table->unsignedBigInteger("numero");
            $table->string("complemento")->nullable();
            $table->string("bairro");
            $table->unsignedBigInteger("cep");

            // Contato
            $table->unsignedBigInteger("ddd1");
            $table->unsignedBigInteger("telefone1");
            $table->unsignedBigInteger("ddd2")->nullable();
            $table->unsignedBigInteger("telefone2")->nullable();

            // Usuário relacionado
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empresas');
    }
};
