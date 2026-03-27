<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\ContactMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function dashboard()
    {
        $totalArticles = Article::count();
        $publishedArticles = Article::where('published', true)->count();
        $draftArticles = max(0, $totalArticles - $publishedArticles);
        $totalViews = (int) Article::sum('views');
        $totalImpressions = (int) Article::sum('impressions');
        $avgCtr = $totalImpressions > 0 ? round(($totalViews / max(1, $totalImpressions)) * 100, 1) : 0;
        $totalMessages = ContactMessage::count();
        $latestArticles = Article::orderByDesc('date_publication')->limit(5)->get();
        $latestMessages = ContactMessage::orderByDesc('created_at')->limit(5)->get();

        return view('admin.dashboard', compact(
            'totalArticles',
            'publishedArticles',
            'draftArticles',
            'totalViews',
            'totalImpressions',
            'avgCtr',
            'totalMessages',
            'latestArticles',
            'latestMessages'
        ));
    }

    public function index()
    {
        $articles = Article::orderBy('date_publication', 'desc')->paginate(15);
        $topByViews = Article::orderBy('views', 'desc')->first();
        $topByCtr = Article::where('impressions', '>', 0)
            ->orderByRaw('(views / NULLIF(impressions, 0)) DESC')
            ->first();
        return view('admin.articles.index', compact('articles', 'topByViews', 'topByCtr'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);

        // Upload images si fournis
        $validated['image'] = $this->handleUpload($request, 'image', $request->input('image'));
        $validated['image_couverture'] = $this->handleUpload($request, 'image_couverture', $request->input('image_couverture'));

        $validated['published'] = $request->boolean('published');
        $validated['afficher_accueil'] = $request->boolean('afficher_accueil');

        Article::create($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article créé avec succès.');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $validated = $this->validateRequest($request, updating: true);

        $image = $this->handleUpload($request, 'image', $article->image);
        $imageCouverture = $this->handleUpload($request, 'image_couverture', $article->image_couverture);
        $validated['image'] = $image;
        $validated['image_couverture'] = $imageCouverture;

        $validated['published'] = $request->boolean('published');
        $validated['afficher_accueil'] = $request->boolean('afficher_accueil');

        $article->update($validated);

        return redirect()->route('admin.articles.index')->with('success', 'Article mis à jour.');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Article supprimé.');
    }

    private function validateRequest(Request $request, bool $updating = false): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'auteur' => ['nullable', 'string', 'max:255'],
            'excerpt' => ['required', 'string'],
            'content' => ['required', 'string'],
            'image' => [$updating ? 'nullable' : 'sometimes', 'file', 'image', 'max:5120'],
            'image_couverture' => [$updating ? 'nullable' : 'sometimes', 'file', 'image', 'max:5120'],
            'meta_description' => ['nullable', 'string'],
            'published' => ['nullable'],
            'afficher_accueil' => ['nullable'],
            'ordre_affichage' => ['nullable', 'integer', 'min:0'],
            'date_publication' => ['nullable', 'date'],
        ]);
    }

    private function handleUpload(Request $request, string $fieldName, ?string $fallback = null): ?string
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $safeName = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
            $extension = $file->getClientOriginalExtension();
            $finalName = $safeName . '.' . $extension;
            $file->move(public_path('images'), $finalName);
            return $finalName;
        }
        return $fallback;
    }
}


