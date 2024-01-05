<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('estruturas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_produto_pai', 15);
            $table->string('codigo_produto_filho', 15);
            $table->unsignedInteger('quantidade');
            $table->timestamps();

            $table->foreign('codigo_produto_pai')->references('codigo_produto')->on('produtos')->onDelete('cascade');
            $table->foreign('codigo_produto_filho')->references('codigo_produto')->on('produtos')->onDelete('cascade');
            // usando cascade para poder alterar ou deletar automaticamente qualquer vincluo
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('estruturas');
    }
};
