@extends('admin.layout')

@section('title', 'Admin - Répondre au message')

@section('admin-content')
	<h1 class="page-title">Répondre à {{ $message->name }} ({{ $message->email }})</h1>

	<div style="background:#fff; border-radius:10px; box-shadow:0 4px 6px rgba(0,0,0,0.1); padding:16px; margin-bottom:20px;">
		<div style="color:#666; margin-bottom:8px;">Message reçu le {{ $message->created_at->format('d/m/Y H:i') }}</div>
		<pre style="white-space:pre-wrap; word-wrap:break-word; background:#f8f9fa; padding:12px; border-radius:6px;">{{ $message->message }}</pre>
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
		<button type="submit" class="btn btn-primary">Envoyer</button>
		<a href="{{ route('admin.messages.index') }}" class="btn btn-secondary">Annuler</a>
	</form>
@endsection


