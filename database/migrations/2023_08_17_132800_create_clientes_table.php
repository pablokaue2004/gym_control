<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('cpf')->unique();
            $table->string('contato');
            $table->string('numeropessoas');
            $table->string('observacao')->nullable();
            $table->string('endereco');
            $table->string('servico');
            $table->string('valor');
            $table->timestamp('vencimento')->nullable();
            $table->timestamp('datadenascimento')->nullable();
            $table->enum('status', ['pago', 'vencido', 'pendente']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
