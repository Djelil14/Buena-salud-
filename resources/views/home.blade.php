@extends('layouts.app')

@section('title', 'Buena Salud - Blog médical fiable et accessible')

@section('content')
    <!-- Section Hero -->
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Un blog médical fiable et accessible</h1>
                <p>Des articles rédigés avec soin pour comprendre votre santé au quotidien.</p>
                <a href="{{ route('articles') }}" class="btn btn-primary">Découvrir les articles</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary">Nous contacter</a>
            </div>
        </div>
    </section>

    <!-- Section Articles récents -->
    <section class="main-content">
        <div class="container">
            <h2 class="section-title">
                Articles récents
                <a href="{{ route('articles') }}">Tous les articles</a>
            </h2>
            
            <div class="articles-grid">
                @forelse($articles as $article)
                <article class="article-card">
                    <img src="/images/{{ rawurlencode($article->image) }}" alt="{{ $article->title }}" class="article-image">
                    <div class="article-content">
                        <h3 class="article-title">{{ $article->title }}</h3>
                        <p class="article-excerpt">{{ $article->excerpt }}</p>
                        <div style="margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: #888;">
                            Par {{ $article->auteur }} • {{ $article->date_publication->format('d/m/Y') }}
                        </div>
                        <a href="{{ route('article.show', $article->id) }}" class="btn btn-primary">Voir plus</a>
                    </div>
                </article>
                @empty
                <div style="grid-column: 1/-1; text-align: center; padding: 40px;">
                    <p>Aucun article disponible pour le moment.</p>
                    <p><a href="/secretadmin2025" style="color: #17a2b8;">Créer des articles</a></p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection