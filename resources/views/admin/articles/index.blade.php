@extends('admin.layout')

@section('title', 'Admin - Articles')

@section('admin-content')
	<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
		<h1 class="page-title" style="margin:0;">Articles</h1>
		<a href="{{ route('admin.articles.create') }}" class="btn btn-primary">Nouvel article</a>
	</div>

	@if(isset($topByViews) || isset($topByCtr))
		<div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:12px; margin-bottom:16px;">
			@if($topByViews)
				<div style="padding:12px 16px; background:#fff; border:1px solid #eee; border-radius:8px;">
					<div style="font-weight:600;">Article le plus lu</div>
					<div>{{ $topByViews->title }}</div>
					<div style="color:#666; font-size:12px;">{{ $topByViews->views }} vues</div>
				</div>
			@endif
			@if($topByCtr)
				<div style="padding:12px 16px; background:#fff; border:1px solid #eee; border-radius:8px;">
					<div style="font-weight:600;">Meilleur taux de clic</div>
					<div>{{ $topByCtr->title }}</div>
					@php($ctr = $topByCtr->impressions > 0 ? number_format(($topByCtr->views / max(1, $topByCtr->impressions))*100, 1) : 0)
					<div style="color:#666; font-size:12px;">CTR {{ $ctr }}%</div>
				</div>
			@endif
		</div>
	@endif

	@if(session('success'))
		<div style="padding:12px 16px; background:#d1e7dd; color:#0f5132; border:1px solid #badbcc; border-radius:6px; margin-bottom:16px;">
			{{ session('success') }}
		</div>
	@endif

	<div style="background:#fff; border-radius:10px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
		<table style="width:100%; border-collapse:collapse;">
			<thead>
				<tr style="text-align:left; border-bottom:1px solid #eee;">
					<th style="padding:12px;">Titre</th>
					<th style="padding:12px;">Vues</th>
					<th style="padding:12px;">Impressions</th>
					<th style="padding:12px;">CTR</th>
					<th style="padding:12px;">Publié</th>
					<th style="padding:12px;">Accueil</th>
					<th style="padding:12px;">Date</th>
					<th style="padding:12px; width:200px;">Actions</th>
				</tr>
			</thead>
			<tbody>
				@foreach($articles as $article)
				<tr style="border-top:1px solid #f2f2f2;">
					<td style="padding:12px;">{{ $article->title }}</td>
					<td style="padding:12px;">{{ $article->views ?? 0 }}</td>
					<td style="padding:12px;">{{ $article->impressions ?? 0 }}</td>
					<td style="padding:12px;">{{ ($article->impressions ?? 0) > 0 ? number_format((($article->views ?? 0) / max(1, ($article->impressions ?? 0))) * 100, 1) . '%' : '0%' }}</td>
					<td style="padding:12px;">{{ $article->published ? 'Oui' : 'Non' }}</td>
					<td style="padding:12px;">{{ $article->afficher_accueil ? 'Oui' : 'Non' }}</td>
					<td style="padding:12px;">{{ optional($article->date_publication)->format('d/m/Y') }}</td>
					<td style="padding:12px; display:flex; gap:8px;">
						<a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-secondary">Éditer</a>
						<form method="post" action="{{ route('admin.articles.destroy', $article->id) }}" onsubmit="return confirm('Supprimer cet article ?');">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-primary" style="background:#dc3545; border-color:#dc3545;">Supprimer</button>
						</form>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
		<div style="padding:12px;">
			{{ $articles->links() }}
		</div>
	</div>
@endsection


