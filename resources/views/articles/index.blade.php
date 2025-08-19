@extends('layouts.app')

@section('title', 'Tous les articles - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container">
			<h1 class="page-title">Tous les articles</h1>

			<div class="articles-grid">
				@forelse($articles as $article)
				<article class="article-card">
					@if($article->image)
					<img src="/images/{{ rawurlencode($article->image) }}" alt="{{ $article->title }}" class="article-image">
					@endif
					<div class="article-content">
						<h3 class="article-title">{{ $article->title }}</h3>
						<p class="article-excerpt">{{ $article->excerpt }}</p>
						<div style="margin-top: 15px; margin-bottom: 15px; font-size: 14px; color: #888;">
							Par {{ $article->auteur ?? 'Administrateur' }}
							@if($article->date_publication)
								• {{ $article->date_publication->format('d/m/Y') }}
							@endif
						</div>
						<a href="{{ route('article.show', $article->id) }}" class="btn btn-primary">Lire l'article</a>
					</div>
				</article>
				@empty
				<div style="grid-column: 1/-1; text-align: center; padding: 40px;">
					<p>Aucun article disponible pour le moment.</p>
				</div>
				@endforelse
			</div>

			<div style="margin-top: 30px;">
				{{ $articles->links() }}
			</div>
		</div>
	</section>
@endsection


