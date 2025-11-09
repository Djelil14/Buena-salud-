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

			<div class="articles-grid gap-4">
				@forelse($articles as $article)
				<article class="article-card" data-article-id="{{ $article->id }}">
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
						<div style="text-align: right;">
							<a href="{{ route('article.show', $article->id) }}" class="inline-block px-6 py-3 text-white bg-blue-600 rounded-lg shadow-md hover:bg-blue-700 transition duration-300 ease-in-out">Lire l'article</a>
						</div>
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


