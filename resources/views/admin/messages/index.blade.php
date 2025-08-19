@extends('admin.layout')

@section('title', 'Admin - Messages')

@section('admin-content')
	<h1 class="page-title">Messages de contact</h1>

	@if(session('success'))
		<div style="padding:12px 16px; background:#d1e7dd; color:#0f5132; border:1px solid #badbcc; border-radius:6px; margin-bottom:16px;">
			{{ session('success') }}
		</div>
	@endif

	<div style="background:#fff; border-radius:10px; box-shadow:0 4px 6px rgba(0,0,0,0.1);">
		<table style="width:100%; border-collapse:collapse;">
			<thead>
				<tr style="text-align:left; border-bottom:1px solid #eee;">
					<th style="padding:12px;">Nom</th>
					<th style="padding:12px;">Email</th>
					<th style="padding:12px;">Sujet</th>
					<th style="padding:12px;">Reçu le</th>
					<th style="padding:12px; width:160px;">Actions</th>
				</tr>
			</thead>
			<tbody>
				@forelse($messages as $message)
				<tr style="border-top:1px solid #f2f2f2;">
					<td style="padding:12px;">{{ $message->name }}</td>
					<td style="padding:12px;">{{ $message->email }}</td>
					<td style="padding:12px;">{{ $message->subject }}</td>
					<td style="padding:12px;">{{ $message->created_at->format('d/m/Y H:i') }}</td>
					<td style="padding:12px; display:flex; gap:8px;">
						<a href="{{ route('admin.messages.reply', $message->id) }}" class="btn btn-secondary">Répondre</a>
						<form method="post" action="{{ route('admin.messages.destroy', $message->id) }}" onsubmit="return confirm('Supprimer ce message ?');">
							@csrf
							@method('DELETE')
							<button type="submit" class="btn btn-primary" style="background:#dc3545; border-color:#dc3545;">Supprimer</button>
						</form>
					</td>
				</tr>
				@empty
				<tr>
					<td colspan="5" style="padding:12px; text-align:center;">Aucun message.</td>
				</tr>
				@endforelse
			</tbody>
		</table>
		<div style="padding:12px;">
			{{ $messages->links() }}
		</div>
	</div>
@endsection


