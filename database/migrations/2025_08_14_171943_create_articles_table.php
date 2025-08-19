<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Titre de l'article
            $table->text('excerpt'); // Extrait
            $table->longText('content'); // Contenu complet
            $table->string('image')->nullable(); // Image
            $table->boolean('published')->default(true); // Publié ou non
            $table->timestamps(); // created_at et updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('articles');
    }
};