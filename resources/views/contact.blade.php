@extends('layouts.app')

@section('title', 'Contact - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container">
			<h1 class="page-title">Contact</h1>
			<div class="contact-form">
				@if(session('success'))
					<div style="padding:12px 16px; background:#d1e7dd; color:#0f5132; border:1px solid #badbcc; border-radius:6px; margin-bottom:16px;">
						{{ session('success') }}
					</div>
				@endif
				<form method="post" action="{{ route('contact.submit') }}">
					@csrf
					<div class="form-group">
						<label for="name">Nom</label>
						<input type="text" id="name" name="name" class="form-control" placeholder="Votre nom" required value="{{ old('name') }}">
					</div>
					<div class="form-group">
						<label for="email">Email</label>
						<input type="email" id="email" name="email" class="form-control" placeholder="Votre email" required value="{{ old('email') }}">
					</div>
					<div class="form-group">
						<label for="subject">Sujet (optionnel)</label>
						<input type="text" id="subject" name="subject" class="form-control" placeholder="Sujet" value="{{ old('subject') }}">
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea id="message" name="message" class="form-control" placeholder="Votre message" required>{{ old('message') }}</textarea>
					</div>
					<button type="submit" class="btn btn-primary">Envoyer</button>
				</form>
			</div>
		</div>
	</section>
@endsection


