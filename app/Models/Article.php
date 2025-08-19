<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'auteur', 
        'excerpt',
        'content',
        'image',
        'image_couverture',
        'meta_description',
        'published',
        'afficher_accueil',
        'ordre_affichage',
        'date_publication'
    ];

    protected $casts = [
        'published' => 'boolean',
        'afficher_accueil' => 'boolean',
        'date_publication' => 'datetime'
    ];

    // Articles pour la page d'accueil (3 premiers)
    public static function pourAccueil()
    {
        return self::where('published', true)
                   ->where('afficher_accueil', true)
                   ->orderBy('ordre_affichage')
                   ->limit(3)
                   ->get();
    }

    // Tous les articles publiés
    public static function tousLesArticles()
    {
        return self::where('published', true)
                   ->orderBy('date_publication', 'desc')
                   ->get();
    }
}