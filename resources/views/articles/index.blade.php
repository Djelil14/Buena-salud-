@extends('layouts.app')

@section('title', 'Tous les articles - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container">
			<h1 class="page-title">Tous les articles</h1>

			<script>
				// Comptabiliser une impression par article à l'affichage de la liste
				document.addEventListener('DOMContentLoaded', function() {
					const items = document.querySelectorAll('[data-article-id]');
					const seen = new Set();
					const observer = new IntersectionObserver((entries) => {
						entries.forEach(e => {
							if (e.isIntersecting) {
								const id = e.target.getAttribute('data-article-id');
								if (!seen.has(id)) {
									seen.add(id);
									fetch("{{ route('metrics.impression', '__ID__') }}".replace('__ID__', id), { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' } }).catch(()=>{});
								}
							}
						});
					},{ threshold: 0.5 });
					items.forEach(el => observer.observe(el));
				});
			</script>

			<div class="articles-grid">
				@forelse($articles as $article)
				<article class="article-card" data-article-id="{{ $article->id }}">
					@if($article->image)
					<img src="/images/{{ rawurlencode($article->image) }}" alt="{{ $article->title }}" class="article-image">
					@endif
					<div class="article-content">
						<h3 class="article-title">{{ $article->title }}</h3>
						<p class="article-excerpt">{{ $article->excerpt }}</p>
						<div class="article-meta">
							Par {{ $article->auteur ?? 'Administrateur' }}
							@if($article->date_publication)
								• {{ $article->date_publication->format('d/m/Y') }}
							@endif
						</div>
						<div class="card-actions">
							<a href="{{ route('article.show', $article->id) }}" class="btn btn-primary">Lire l'article</a>
						</div>
					</div>
				</article>
				@empty
				<div class="empty-state">
					<p>Aucun article disponible pour le moment.</p>
				</div>
				@endforelse
			</div>

			<div class="mt-lg">
				{{ $articles->links() }}
			</div>
		</div>
	</section>

	<style>
		.empty-state {
			grid-column: 1/-1;
			text-align: center;
			padding: 40px;
			background: #fff;
			border: 1px dashed #d4e3ed;
			border-radius: 12px;
		}
	</style>
@endsection


