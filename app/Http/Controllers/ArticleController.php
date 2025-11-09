<?php

namespace App\Http\Controllers;

use App\Models\Article; // <-- 1. Ajoutez cette ligne pour importer le modèle
use App\Models\Comment;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only('storeComment');
    }

    // Page d'accueil
    public function home()
    {
        // Articles configurés pour la page d'accueil
        $articles = Article::pourAccueil();
        
        // Témoignages approuvés (minimum 6)
        $testimonials = Testimonial::where('approved', true)
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();

        return view('home', compact('articles', 'testimonials'));
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
        $article->increment('views');
        // Récupérer les commentaires parents (sans parent_id) avec leurs réponses
        $comments = $article->comments()
            ->whereNull('parent_id')
            ->with('replies')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('articles.show', compact('article', 'comments'));
    }
    
    // Page de contact
    public function contact()
    {
        return view('contact');
    }

    // Enregistrer un commentaire
    public function storeComment(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $data = $request->validate([
            'parent_id' => ['nullable', 'exists:comments,id'],
            'content' => ['required', 'string', 'max:2000'],
        ]);

        // Vérifier que le parent_id appartient bien à cet article si fourni
        if (isset($data['parent_id'])) {
            $parentComment = Comment::findOrFail($data['parent_id']);
            if ($parentComment->article_id != $article->id) {
                return redirect()->route('article.show', $article->id)
                    ->with('error', 'Commentaire parent invalide.');
            }
        }

        $user = $request->user();

        $data['article_id'] = $article->id;
        $data['user_id'] = $user->id;
        $data['author_name'] = $user->name;
        $data['author_email'] = $user->email;
        $data['approved'] = true;

        Comment::create($data);

        return redirect()->route('article.show', $article->id)->with('success', 'Merci pour votre commentaire !');
    }
}