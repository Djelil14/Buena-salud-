<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('auteur')->default('Administrateur')->after('title');
            $table->string('image_couverture')->nullable()->after('image'); // Image hero
            $table->text('meta_description')->nullable()->after('excerpt'); // Pour SEO
            $table->integer('ordre_affichage')->default(0)->after('published'); // Ordre sur homepage
            $table->boolean('afficher_accueil')->default(false)->after('ordre_affichage'); // Afficher sur homepage
            $table->timestamp('date_publication')->nullable()->after('afficher_accueil');
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropColumn([
                'auteur', 'image_couverture', 'meta_description', 
                'ordre_affichage', 'afficher_accueil', 'date_publication'
            ]);
        });
    }
};