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
        Schema::create('scategories', function (Blueprint $table) {
            $table->id();
            $table->string('nomScategorie')->unique();
            $table->string('imageScategorie')->nullable();
            $table->unsignedBigInteger('categorieID')
            ->foreign('categorieID')
            ->references('id')
            ->on('categories')
            ->onDelete('restrict'); // similar to Delete Cascade
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scategories');
    }
};
