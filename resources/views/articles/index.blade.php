@extends('layouts.app')

@section('title', 'Tous les articles - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container">
			<div class="articles-hero fade-up">
				<div>
					<h1 class="page-title title-no-margin">Tous les articles</h1>
					<p class="section-subtitle articles-hero-subtitle">Explorez nos contenus santé classés pour une lecture claire, rapide et utile.</p>
				</div>
				<div class="articles-hero-kpi">
					<span>Articles</span>
					<strong>{{ method_exists($articles, 'total') ? $articles->total() : $articles->count() }}</strong>
				</div>
			</div>

			<div class="surface articles-toolbar fade-up stagger-1">
				<input type="text" id="articleSearch" class="form-control toolbar-input" placeholder="Rechercher un article...">
			</div>

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

					// Recherche locale rapide
					const searchInput = document.getElementById('articleSearch');
					const rows = Array.from(document.querySelectorAll('[data-search]'));
					const emptySearch = document.getElementById('articlesSearchEmpty');

					function applySearch() {
						const term = (searchInput.value || '').trim().toLowerCase();
						let visible = 0;
						rows.forEach((row) => {
							const haystack = row.dataset.search || '';
							const show = term === '' || haystack.includes(term);
							row.style.display = show ? '' : 'none';
							if (show) visible += 1;
						});
						emptySearch.classList.toggle('is-hidden', visible > 0);
					}

					searchInput.addEventListener('input', applySearch);
				});
			</script>

			<div class="articles-grid fade-up-delayed">
				@forelse($articles as $article)
				@php
					$wordCount = str_word_count(strip_tags($article->content ?? ''));
					$readingTime = max(1, (int) ceil($wordCount / 220));
				@endphp
				<article class="article-card article-card-premium" data-article-id="{{ $article->id }}" data-search="{{ strtolower(($article->title ?? '') . ' ' . ($article->excerpt ?? '') . ' ' . ($article->auteur ?? '')) }}">
					@if($article->image)
					<img src="/images/{{ rawurlencode($article->image) }}" alt="{{ $article->title }}" class="article-image">
					@endif
					<div class="article-content">
						<div class="article-pill">{{ $readingTime }} min</div>
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
			<div id="articlesSearchEmpty" class="empty-state is-hidden mt-lg">
				<p>Aucun article ne correspond à votre recherche.</p>
			</div>

			<div class="mt-lg">
				{{ $articles->links() }}
			</div>
		</div>
	</section>

	<style>
		.articles-hero {
			background: linear-gradient(135deg, #0f172a 0%, #194052 52%, #18889a 100%);
			border-radius: 18px;
			padding: 20px;
			display: flex;
			align-items: flex-start;
			justify-content: space-between;
			gap: 16px;
			color: #fff;
			margin-bottom: 14px;
			flex-wrap: wrap;
		}

		.articles-hero .page-title {
			color: #fff;
		}

		.articles-hero-subtitle {
			color: rgba(255, 255, 255, 0.86);
			margin: 6px 0 0 0;
			max-width: 680px;
		}

		.articles-hero-kpi {
			background: rgba(255, 255, 255, 0.12);
			border: 1px solid rgba(255, 255, 255, 0.25);
			border-radius: 12px;
			padding: 10px 12px;
			min-width: 110px;
		}

		.articles-hero-kpi span {
			display: block;
			font-size: 12px;
			opacity: 0.9;
		}

		.articles-hero-kpi strong {
			font-size: 1.4rem;
			font-weight: 800;
		}

		.articles-toolbar {
			padding: 12px;
			margin-bottom: 12px;
		}

		.toolbar-input {
			width: 100%;
		}

		.article-card-premium {
			position: relative;
		}

		.article-pill {
			display: inline-flex;
			align-items: center;
			padding: 4px 10px;
			border-radius: 999px;
			font-size: 12px;
			font-weight: 700;
			color: #0f766e;
			background: #d9f3f7;
			border: 1px solid #bbe8ef;
			margin-bottom: 10px;
		}

		.empty-state {
			grid-column: 1/-1;
			text-align: center;
			padding: 40px;
			background: #fff;
			border: 1px dashed #d4e3ed;
			border-radius: 12px;
		}

		@media (max-width: 768px) {
			.articles-hero-kpi {
				width: 100%;
			}
		}
	</style>
@endsection


