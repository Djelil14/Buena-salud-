<?php

namespace App\Http\Controllers;

use App\Models\Article; // <-- 1. Ajoutez cette ligne pour importer le modèle
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Page d'accueil
    public function home()
    {
        // Articles configurés pour la page d'accueil
        $articles = Article::pourAccueil();

        return view('home', compact('articles'));
    }
    
    // Liste de tous les articles
    public function index()
    {
        // Tous les articles publiés, récents d'abord, avec pagination
        $articles = Article::where('published', true)
            ->orderBy('date_publication', 'desc')
            ->paginate(10);
        return view('articles.index', compact('articles'));
    }
    
    // Afficher un article
    public function show($id)
    {
        // Ici aussi, il faudra récupérer l'article par son ID
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }
    
    // Page de contact
    public function contact()
    {
        return view('contact');
    }
}