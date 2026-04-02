@extends('admin.layout')

@section('title', 'Admin - Articles')

@section('admin-content')
	@php
		$collection = $articles->getCollection();
		$totalArticles = method_exists($articles, 'total') ? $articles->total() : $collection->count();
		$publishedCount = $collection->where('published', true)->count();
		$homeCount = $collection->where('afficher_accueil', true)->count();
		$totalViews = $collection->sum(fn($item) => (int) ($item->views ?? 0));
		$totalImpressions = $collection->sum(fn($item) => (int) ($item->impressions ?? 0));
		$avgCtr = $totalImpressions > 0 ? number_format(($totalViews / max(1, $totalImpressions)) * 100, 1) : 0;
		$publishedRate = $collection->count() > 0 ? round(($publishedCount / max(1, $collection->count())) * 100) : 0;
		$homeRate = $collection->count() > 0 ? round(($homeCount / max(1, $collection->count())) * 100) : 0;
	@endphp

	<div class="dashboard-hero fade-up">
		<div class="dashboard-hero-main">
			<h1 class="page-title title-no-margin">Dashboard Articles</h1>
			<p class="section-subtitle dashboard-subtitle">Pilotez votre contenu, suivez les performances et publiez plus vite.</p>
		</div>
		<div class="dashboard-hero-actions">
			<a href="{{ route('admin.articles.create') }}" class="btn btn-primary">+ Nouvel article</a>
			<a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Voir messages</a>
		</div>
	</div>

	<div class="dashboard-kpis">
		<div class="surface kpi-card fade-up stagger-1">
			<div class="kpi-label">Articles (total)</div>
			<div class="kpi-value">{{ $totalArticles }}</div>
		</div>
		<div class="surface kpi-card fade-up stagger-1">
			<div class="kpi-label">Publiés (page)</div>
			<div class="kpi-value">{{ $publishedCount }}</div>
		</div>
		<div class="surface kpi-card fade-up stagger-2">
			<div class="kpi-label">En accueil (page)</div>
			<div class="kpi-value">{{ $homeCount }}</div>
		</div>
		<div class="surface kpi-card fade-up stagger-3">
			<div class="kpi-label">Vues cumulées (page)</div>
			<div class="kpi-value">{{ number_format($totalViews, 0, ',', ' ') }}</div>
		</div>
	</div>

	<div class="surface performance-strip fade-up-delayed">
		<div class="perf-item">
			<div class="perf-head">
				<span class="perf-label">Taux de publication</span>
				<span class="perf-value">{{ $publishedRate }}%</span>
			</div>
			<div class="perf-bar"><span style="width: {{ $publishedRate }}%"></span></div>
		</div>
		<div class="perf-item">
			<div class="perf-head">
				<span class="perf-label">Présence accueil</span>
				<span class="perf-value">{{ $homeRate }}%</span>
			</div>
			<div class="perf-bar"><span style="width: {{ $homeRate }}%"></span></div>
		</div>
		<div class="perf-item">
			<div class="perf-head">
				<span class="perf-label">CTR moyen (page)</span>
				<span class="perf-value">{{ $avgCtr }}%</span>
			</div>
			<div class="perf-bar"><span style="width: {{ min(100, (float)$avgCtr * 2) }}%"></span></div>
		</div>
	</div>

	@if(isset($topByViews) || isset($topByCtr))
		<div class="metric-grid dashboard-metrics fade-up-delayed">
			@if($topByViews)
				<div class="surface metric-card">
					<div class="metric-title">Top lecture</div>
					<div class="metric-article">{{ $topByViews->title }}</div>
					<div class="metric-meta">{{ $topByViews->views }} vues</div>
				</div>
			@endif
			@if($topByCtr)
				<div class="surface metric-card">
					<div class="metric-title">Meilleur CTR</div>
					<div class="metric-article">{{ $topByCtr->title }}</div>
					@php($ctr = $topByCtr->impressions > 0 ? number_format(($topByCtr->views / max(1, $topByCtr->impressions))*100, 1) : 0)
					<div class="metric-meta">CTR {{ $ctr }}%</div>
				</div>
			@endif
		</div>
	@endif

	@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	<div class="surface table-toolbar fade-up-delayed">
		<input type="text" id="articleSearch" class="form-control toolbar-input" placeholder="Rechercher un article...">
		<label class="toolbar-check">
			<input type="checkbox" id="publishedOnly">
			<span>Afficher seulement les publiés</span>
		</label>
	</div>

	<div class="table-wrap dashboard-table-wrap fade-up-delayed">
		<table class="table" id="articlesTable">
			<thead>
				<tr>
					<th>Titre</th>
					<th>Vues</th>
					<th>Impressions</th>
					<th>CTR</th>
					<th>Publié</th>
					<th>Accueil</th>
					<th>Date</th>
					<th class="table-col-actions">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($articles as $article)
				<tr data-title="{{ strtolower($article->title) }}" data-published="{{ $article->published ? '1' : '0' }}">
					<td>
						<div class="article-title-cell">{{ $article->title }}</div>
					</td>
					<td>{{ $article->views ?? 0 }}</td>
					<td>{{ $article->impressions ?? 0 }}</td>
					<td>{{ ($article->impressions ?? 0) > 0 ? number_format((($article->views ?? 0) / max(1, ($article->impressions ?? 0))) * 100, 1) . '%' : '0%' }}</td>
					<td><span class="status-badge {{ $article->published ? 'is-on' : 'is-off' }}">{{ $article->published ? 'Oui' : 'Non' }}</span></td>
					<td><span class="status-badge {{ $article->afficher_accueil ? 'is-on' : 'is-off' }}">{{ $article->afficher_accueil ? 'Oui' : 'Non' }}</span></td>
					<td>{{ optional($article->date_publication)->format('d/m/Y') }}</td>
					<td>
						<div class="row-actions">
						<a href="{{ route('admin.articles.edit', $article->id) }}" class="icon-btn icon-btn-edit" title="Éditer l'article" aria-label="Éditer l'article">
							<svg viewBox="0 0 24 24" aria-hidden="true">
								<path d="M4 20h4l10-10-4-4L4 16v4z"></path>
								<path d="M14 6l4 4"></path>
							</svg>
						</a>
						<form method="post" action="{{ route('admin.articles.destroy', $article->id) }}" onsubmit="return confirm('Supprimer cet article ?');">
							@csrf
							@method('DELETE')
							<button type="submit" class="icon-btn icon-btn-delete" title="Supprimer l'article" aria-label="Supprimer l'article">
								<svg viewBox="0 0 24 24" aria-hidden="true">
									<path d="M3 6h18"></path>
									<path d="M8 6V4h8v2"></path>
									<path d="M19 6l-1 14H6L5 6"></path>
									<path d="M10 11v6"></path>
									<path d="M14 11v6"></path>
								</svg>
							</button>
						</form>
						</div>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div id="tableEmptyState" class="table-empty-state is-hidden">
			Aucun article ne correspond à vos filtres.
		</div>
		<div class="pagination-wrap">
			{{ $articles->links() }}
		</div>
	</div>

	<style>
		.dashboard-hero {
			background: linear-gradient(135deg, #0f172a 0%, #153b4a 45%, #1b6977 100%);
			color: #fff;
			border-radius: 18px;
			padding: 20px;
			margin-bottom: 16px;
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 16px;
			flex-wrap: wrap;
		}

		.dashboard-hero-main .page-title {
			color: #fff;
		}

		.dashboard-subtitle {
			margin: 6px 0 0 0;
			max-width: 620px;
			color: rgba(255, 255, 255, 0.86);
		}

		.dashboard-hero-actions {
			display: flex;
			gap: 10px;
			flex-wrap: wrap;
		}

		.dashboard-kpis {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
			gap: 12px;
			margin-bottom: 14px;
		}

		.kpi-card {
			padding: 14px 16px;
			border: 1px solid #dceaf3;
		}

		.kpi-label {
			font-size: 12px;
			font-weight: 700;
			letter-spacing: 0.04em;
			text-transform: uppercase;
			color: #64748b;
			margin-bottom: 6px;
		}

		.kpi-value {
			font-size: 1.7rem;
			font-weight: 800;
			color: #0f172a;
		}

		.performance-strip {
			padding: 14px 16px;
			margin-bottom: 14px;
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
			gap: 12px;
		}

		.perf-item {
			padding: 10px 12px;
			border: 1px solid #dceaf3;
			border-radius: 12px;
			background: #fbfeff;
		}

		.perf-head {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 8px;
			gap: 8px;
		}

		.perf-label {
			font-size: 12px;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 0.04em;
			color: #64748b;
		}

		.perf-value {
			font-size: 14px;
			font-weight: 800;
			color: #0f172a;
		}

		.perf-bar {
			height: 8px;
			border-radius: 999px;
			background: #e6f2f7;
			overflow: hidden;
		}

		.perf-bar span {
			display: block;
			height: 100%;
			background: linear-gradient(90deg, #17a2b8, #5ccedd);
			border-radius: inherit;
		}

		.dashboard-metrics .metric-card {
			border: 1px solid #dceaf3;
		}

		.metric-article {
			font-weight: 700;
			margin: 4px 0;
		}

		.dashboard-table-wrap {
			border: 1px solid #dbe8f1;
		}

		.table-toolbar {
			padding: 12px;
			margin-bottom: 10px;
			display: flex;
			gap: 12px;
			align-items: center;
			flex-wrap: wrap;
		}

		.toolbar-input {
			flex: 1;
			min-width: 220px;
		}

		.toolbar-check {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			font-size: 14px;
			color: #334155;
			font-weight: 600;
		}

		.dashboard-table-wrap tbody tr:nth-child(even) {
			background: #fbfdff;
		}

		.dashboard-table-wrap tbody tr:hover {
			background: #f2f9fd;
		}

		.article-title-cell {
			font-weight: 700;
			color: #0f172a;
		}

		.status-badge {
			display: inline-flex;
			padding: 4px 10px;
			border-radius: 999px;
			font-size: 12px;
			font-weight: 700;
			border: 1px solid transparent;
		}

		.status-badge.is-on {
			color: #166534;
			background: #dcfce7;
			border-color: #bbf7d0;
		}

		.status-badge.is-off {
			color: #991b1b;
			background: #fee2e2;
			border-color: #fecaca;
		}

		.icon-btn {
			width: 36px;
			height: 36px;
			border-radius: 10px;
			border: 1px solid transparent;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			background: #fff;
			cursor: pointer;
			transition: transform 0.2s ease, box-shadow 0.2s ease, border-color 0.2s ease, background-color 0.2s ease;
		}

		.icon-btn svg {
			width: 18px;
			height: 18px;
			fill: none;
			stroke: currentColor;
			stroke-width: 2;
			stroke-linecap: round;
			stroke-linejoin: round;
		}

		.icon-btn-edit {
			color: #0f766e;
			border-color: #b9e9df;
			background: #ecfdf5;
		}

		.icon-btn-edit:hover {
			transform: translateY(-1px);
			box-shadow: 0 8px 16px rgba(15, 118, 110, 0.16);
			background: #dff9f0;
		}

		.icon-btn-delete {
			color: #b42318;
			border-color: #fecaca;
			background: #fff1f2;
		}

		.icon-btn-delete:hover {
			transform: translateY(-1px);
			box-shadow: 0 8px 16px rgba(180, 35, 24, 0.16);
			background: #ffe4e6;
		}

		.table-empty-state {
			padding: 18px;
			text-align: center;
			color: #64748b;
			border-top: 1px dashed #dbe8f1;
			background: #fbfdff;
		}

		@media (max-width: 768px) {
			.dashboard-hero-actions {
				width: 100%;
			}

			.dashboard-hero-actions .btn {
				flex: 1;
				text-align: center;
			}
		}
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const searchInput = document.getElementById('articleSearch');
			const publishedOnly = document.getElementById('publishedOnly');
			const rows = Array.from(document.querySelectorAll('#articlesTable tbody tr'));
			const emptyState = document.getElementById('tableEmptyState');

			function applyFilters() {
				const term = (searchInput.value || '').trim().toLowerCase();
				const onlyPublished = publishedOnly.checked;
				let visibleCount = 0;

				rows.forEach((row) => {
					const title = row.dataset.title || '';
					const isPublished = row.dataset.published === '1';
					const matchTitle = term === '' || title.includes(term);
					const matchPublished = !onlyPublished || isPublished;
					const visible = matchTitle && matchPublished;
					row.style.display = visible ? '' : 'none';
					if (visible) visibleCount += 1;
				});

				emptyState.classList.toggle('is-hidden', visibleCount > 0);
			}

			searchInput.addEventListener('input', applyFilters);
			publishedOnly.addEventListener('change', applyFilters);
		});
	</script>
@endsection


