<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('photos', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('caminho');
            $table->enum('status', ['pendente', 'aprovado', 'rejeitado'])->default('pendente');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('aprovado_por')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('photos');
    }
};
