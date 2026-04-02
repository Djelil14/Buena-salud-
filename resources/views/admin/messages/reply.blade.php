@extends('admin.layout')

@section('title', 'Admin - Répondre au message')

@section('admin-content')
	<h1 class="page-title reply-page-title">Répondre à {{ $message->name }} ({{ $message->email }})</h1>
	<p class="section-subtitle">Conservez un ton clair et professionnel pour améliorer l'expérience utilisateur.</p>

	<div class="surface surface-padded mb-lg">
		<div class="section-subtitle mb-sm">Message reçu le {{ $message->created_at->format('d/m/Y H:i') }}</div>
		<pre class="pre-message">{{ $message->message }}</pre>
	</div>

	<form method="post" action="{{ route('admin.messages.sendReply', $message->id) }}" class="contact-form">
		@csrf
		<div class="form-group">
			<label>Sujet</label>
			<input type="text" name="subject" class="form-control" value="Re: {{ $message->subject }}" required>
		</div>
		<div class="form-group">
			<label>Réponse</label>
			<textarea name="body" class="form-control" rows="8" required>@php echo "\nBonjour {$message->name},\n\nMerci pour votre message. \n\nCordialement,\nL'équipe ".config('app.name')."\n"; @endphp</textarea>
		</div>
		<div class="actions-row reply-actions">
			<button type="submit" class="btn btn-primary">Envoyer</button>
			<a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Annuler</a>
		</div>
	</form>

	<style>
		.reply-page-title {
			word-break: break-word;
			hyphens: auto;
		}

		.pre-message {
			max-width: 100%;
			overflow-x: auto;
			-webkit-overflow-scrolling: touch;
		}

		@media (max-width: 768px) {
			.contact-form {
				padding: 22px 16px;
			}

			.reply-actions {
				flex-direction: column;
			}

			.reply-actions .btn {
				width: 100%;
				justify-content: center;
				text-align: center;
			}
		}
	</style>
@endsection


