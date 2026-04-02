@extends('admin.layout')

@section('title', 'Admin - Messages')

@section('admin-content')
	@php
		$collection = $messages->getCollection();
		$totalMessages = method_exists($messages, 'total') ? $messages->total() : $collection->count();
		$todayMessages = $collection->filter(fn($m) => $m->created_at && $m->created_at->isToday())->count();
	@endphp

	<div class="messages-hero fade-up">
		<div>
			<h1 class="page-title title-no-margin">Centre de Messages</h1>
			<p class="section-subtitle messages-subtitle">Traitez les demandes rapidement et gardez une relation client premium.</p>
		</div>
		<div class="hero-mini-kpis">
			<div class="mini-kpi">
				<span>Total</span>
				<strong>{{ $totalMessages }}</strong>
			</div>
			<div class="mini-kpi">
				<span>Aujourd'hui</span>
				<strong>{{ $todayMessages }}</strong>
			</div>
		</div>
	</div>

	@if(session('success'))
		<div class="alert alert-success">
			{{ session('success') }}
		</div>
	@endif

	<div class="surface table-toolbar fade-up stagger-1">
		<input type="text" id="messageSearch" class="form-control toolbar-input" placeholder="Rechercher (nom, email, sujet)...">
	</div>

	<div class="table-wrap fade-up-delayed">
		<table class="table" id="messagesTable">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Email</th>
					<th>Sujet</th>
					<th>Reçu le</th>
					<th class="table-col-actions-sm">Actions</th>
				</tr>
			</thead>
			<tbody>
				@forelse($messages as $message)
				<tr data-search="{{ strtolower($message->name . ' ' . $message->email . ' ' . $message->subject) }}">
					<td>{{ $message->name }}</td>
					<td>{{ $message->email }}</td>
					<td>{{ $message->subject }}</td>
					<td>{{ $message->created_at->format('d/m/Y H:i') }}</td>
					<td>
						<div class="row-actions">
						<a href="{{ route('admin.messages.reply', $message->id) }}" class="icon-btn icon-btn-reply" title="Répondre au message" aria-label="Répondre au message">
							<svg viewBox="0 0 24 24" aria-hidden="true">
								<path d="M10 9V5l-7 7 7 7v-4h4a7 7 0 0 0 7-7v-2a7 7 0 0 0-7-7h-4z"></path>
							</svg>
						</a>
						<form method="post" action="{{ route('admin.messages.destroy', $message->id) }}" onsubmit="return confirm('Supprimer ce message ?');">
							@csrf
							@method('DELETE')
							<button type="submit" class="icon-btn icon-btn-delete" title="Supprimer le message" aria-label="Supprimer le message">
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
				@empty
				<tr>
					<td colspan="5" class="table-empty">Aucun message.</td>
				</tr>
				@endforelse
			</tbody>
		</table>
		<div id="messagesEmptyState" class="table-empty-state is-hidden">
			Aucun message ne correspond à votre recherche.
		</div>
		<div class="pagination-wrap">
			{{ $messages->links() }}
		</div>
	</div>

	<style>
		.messages-hero {
			background: linear-gradient(135deg, #0f172a 0%, #1a3f54 55%, #1f8195 100%);
			border-radius: 18px;
			padding: 20px;
			color: #fff;
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 16px;
			flex-wrap: wrap;
			margin-bottom: 14px;
		}

		.messages-hero .page-title {
			color: #fff;
		}

		.messages-subtitle {
			color: rgba(255, 255, 255, 0.86);
			margin: 6px 0 0 0;
		}

		.hero-mini-kpis {
			display: flex;
			gap: 10px;
			flex-wrap: wrap;
		}

		.mini-kpi {
			background: rgba(255, 255, 255, 0.12);
			border: 1px solid rgba(255, 255, 255, 0.24);
			border-radius: 12px;
			padding: 10px 12px;
			min-width: 110px;
		}

		.mini-kpi span {
			display: block;
			font-size: 12px;
			opacity: 0.88;
		}

		.mini-kpi strong {
			font-size: 1.3rem;
			font-weight: 800;
		}

		.table-wrap tbody tr:nth-child(even) {
			background: #fbfdff;
		}

		.table-wrap tbody tr:hover {
			background: #f2f9fd;
		}

		.table-empty-state {
			padding: 16px;
			text-align: center;
			color: #64748b;
			border-top: 1px dashed #dbe8f1;
			background: #fbfdff;
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

		.icon-btn-reply {
			color: #0f766e;
			border-color: #b9e9df;
			background: #ecfdf5;
		}

		.icon-btn-reply:hover {
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
	</style>

	<script>
		document.addEventListener('DOMContentLoaded', function () {
			const input = document.getElementById('messageSearch');
			const rows = Array.from(document.querySelectorAll('#messagesTable tbody tr[data-search]'));
			const emptyState = document.getElementById('messagesEmptyState');

			function applySearch() {
				const term = (input.value || '').trim().toLowerCase();
				let visible = 0;
				rows.forEach((row) => {
					const haystack = row.dataset.search || '';
					const show = term === '' || haystack.includes(term);
					row.style.display = show ? '' : 'none';
					if (show) visible += 1;
				});
				emptyState.classList.toggle('is-hidden', visible > 0);
			}

			input.addEventListener('input', applySearch);
		});
	</script>
@endsection


