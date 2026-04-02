@extends('admin.layout')

@section('title', 'Admin - Dashboard')

@section('admin-content')
	<div class="admin-dashboard-hero">
		<div>
			<div class="dashboard-kicker">Administration</div>
			<h1 class="page-title title-no-margin">Dashboard</h1>
			<p class="section-subtitle dashboard-subtitle">Vue d'ensemble de votre activité éditoriale et des échanges lecteurs.</p>
		</div>
		<div class="actions-row">
			<a href="{{ route('admin.articles.create') }}" class="btn btn-primary">+ Nouvel article</a>
			<a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Ouvrir les messages</a>
		</div>
	</div>

	<div class="dashboard-kpis-grid">
		<div class="surface kpi-box kpi-accent-cyan">
			<div class="kpi-label">Articles</div>
			<div class="kpi-value">{{ $totalArticles }}</div>
		</div>
		<div class="surface kpi-box kpi-accent-emerald">
			<div class="kpi-label">Publiés</div>
			<div class="kpi-value">{{ $publishedArticles }}</div>
		</div>
		<div class="surface kpi-box kpi-accent-amber">
			<div class="kpi-label">Brouillons</div>
			<div class="kpi-value">{{ $draftArticles }}</div>
		</div>
		<div class="surface kpi-box kpi-accent-violet">
			<div class="kpi-label">Messages reçus</div>
			<div class="kpi-value">{{ $totalMessages }}</div>
		</div>
	</div>

	<div class="dashboard-kpis-grid">
		<div class="surface kpi-box kpi-accent-cyan">
			<div class="kpi-label">Vues totales</div>
			<div class="kpi-value">{{ number_format($totalViews, 0, ',', ' ') }}</div>
		</div>
		<div class="surface kpi-box kpi-accent-slate">
			<div class="kpi-label">Impressions totales</div>
			<div class="kpi-value">{{ number_format($totalImpressions, 0, ',', ' ') }}</div>
		</div>
		<div class="surface kpi-box kpi-accent-emerald">
			<div class="kpi-label">CTR moyen</div>
			<div class="kpi-value">{{ number_format($avgCtr, 1, ',', ' ') }}%</div>
		</div>
	</div>

	<div class="dashboard-divider"></div>

	<div class="dashboard-panels">
		<div class="surface panel-box">
			<div class="panel-head">
				<h2>Derniers articles</h2>
				<a href="{{ route('admin.articles.index') }}" class="muted-link">Voir tout</a>
			</div>
			<ul class="panel-list">
				@forelse($latestArticles as $article)
					<li>
						<div class="panel-main">{{ $article->title }}</div>
						<div class="panel-sub">
							{{ optional($article->date_publication)->format('d/m/Y') ?: 'Sans date' }} • {{ $article->published ? 'Publié' : 'Brouillon' }}
						</div>
					</li>
				@empty
					<li class="panel-empty">Aucun article disponible.</li>
				@endforelse
			</ul>
		</div>

		<div class="surface panel-box">
			<div class="panel-head">
				<h2>Derniers messages</h2>
				<a href="{{ route('admin.messages.index') }}" class="muted-link">Voir tout</a>
			</div>
			<ul class="panel-list">
				@forelse($latestMessages as $message)
					<li>
						<div class="panel-main">{{ $message->name }} — {{ $message->subject }}</div>
						<div class="panel-sub">{{ $message->created_at->format('d/m/Y H:i') }}</div>
					</li>
				@empty
					<li class="panel-empty">Aucun message reçu.</li>
				@endforelse
			</ul>
		</div>
	</div>

	<style>
		.admin-dashboard-hero {
			background: linear-gradient(135deg, #0f172a 0%, #1b3f53 55%, #1690a5 100%);
			border: 1px solid rgba(255, 255, 255, 0.14);
			border-radius: 18px;
			padding: 22px;
			display: flex;
			justify-content: space-between;
			gap: 14px;
			align-items: flex-start;
			flex-wrap: wrap;
			margin-bottom: 14px;
			box-shadow: 0 16px 30px rgba(15, 23, 42, 0.08);
		}

		.dashboard-kicker {
			display: inline-flex;
			align-items: center;
			padding: 4px 10px;
			border-radius: 999px;
			font-size: 11px;
			font-weight: 800;
			letter-spacing: 0.06em;
			text-transform: uppercase;
			color: #ecfeff;
			background: rgba(255, 255, 255, 0.14);
			border: 1px solid rgba(255, 255, 255, 0.3);
			margin-bottom: 10px;
		}

		.dashboard-subtitle {
			margin: 6px 0 0 0;
			color: rgba(255, 255, 255, 0.86);
			max-width: 680px;
		}

		.admin-dashboard-hero .page-title {
			color: #ffffff;
		}

		.dashboard-kpis-grid {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
			gap: 10px;
			margin-bottom: 10px;
		}

		.kpi-box {
			padding: 11px 12px;
			border: 1px solid #d8e7f1;
			background: linear-gradient(180deg, #ffffff 0%, #fbfdff 100%);
			position: relative;
			border-radius: 12px;
		}

		.kpi-label {
			font-size: 11px;
			font-weight: 700;
			letter-spacing: 0.04em;
			text-transform: uppercase;
			color: #64748b;
			margin-bottom: 3px;
		}

		.kpi-value {
			font-size: 1.28rem;
			font-weight: 800;
			color: #0f172a;
			line-height: 1.1;
		}

		.kpi-box::before {
			content: '';
			position: absolute;
			left: 0;
			top: 0;
			bottom: 0;
			width: 4px;
			border-radius: 12px 0 0 12px;
			background: #94a3b8;
		}

		.kpi-accent-cyan::before { background: #06b6d4; }
		.kpi-accent-emerald::before { background: #10b981; }
		.kpi-accent-amber::before { background: #f59e0b; }
		.kpi-accent-violet::before { background: #8b5cf6; }
		.kpi-accent-slate::before { background: #64748b; }

		.dashboard-divider {
			height: 1px;
			background: linear-gradient(90deg, transparent 0%, #d7e5ef 25%, #d7e5ef 75%, transparent 100%);
			margin: 4px 0 14px;
		}

		.dashboard-panels {
			display: grid;
			grid-template-columns: repeat(2, minmax(0, 1fr));
			gap: 14px;
		}

		.panel-box {
			padding: 16px;
			border: 1px solid #d8e7f1;
			background: #fff;
			border-radius: 14px;
		}

		.panel-head {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 10px;
			margin-bottom: 10px;
		}

		.panel-head h2 {
			font-size: 1rem;
			font-weight: 800;
			color: #0f172a;
		}

		.panel-list {
			list-style: none;
			display: grid;
			gap: 10px;
		}

		.panel-list li {
			padding: 10px;
			border: 1px solid #e3ecf3;
			border-radius: 12px;
			background: #fbfdff;
			transition: transform 0.2s ease, box-shadow 0.25s ease, border-color 0.25s ease;
		}

		.panel-list li:hover {
			transform: translateY(-2px);
			border-color: #cfe2ee;
			box-shadow: 0 10px 20px rgba(15, 23, 42, 0.06);
		}

		.panel-main {
			font-weight: 700;
			font-size: 14px;
			color: #0f172a;
			margin-bottom: 2px;
		}

		.panel-sub {
			font-size: 12px;
			color: #64748b;
		}

		.panel-empty {
			text-align: center;
			color: #64748b;
		}

		@media (max-width: 900px) {
			.dashboard-panels {
				grid-template-columns: 1fr;
			}
		}

		@media (max-width: 768px) {
			.admin-dashboard-hero {
				flex-direction: column;
				align-items: stretch;
			}

			.admin-dashboard-hero .actions-row {
				width: 100%;
				flex-direction: column;
			}

			.admin-dashboard-hero .actions-row .btn {
				width: 100%;
				text-align: center;
				justify-content: center;
			}

			.dashboard-kpis-grid {
				grid-template-columns: repeat(auto-fit, minmax(130px, 1fr));
			}

			.panel-head {
				flex-wrap: wrap;
			}
		}

		@media (max-width: 480px) {
			.kpi-value {
				font-size: 1.1rem;
			}
		}
	</style>
@endsection

