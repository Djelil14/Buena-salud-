@extends('layouts.app')

@section('title', 'Créer un compte - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container centered-form-container">
			<h1 class="page-title text-center mb-md">Créer un compte</h1>
			<p class="section-subtitle text-center">Choisissez un pseudonyme (ou votre nom) et un mot de passe pour commenter plus facilement.</p>

			<form method="post" action="{{ route('comment.register.submit') }}" class="contact-form">
				@csrf
				<input type="hidden" name="redirect_to" value="{{ $redirectTo }}">

				<div class="form-group">
					<label for="name">Pseudonyme / Nom</label>
					<input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required autofocus>
					@error('name')
						<span class="form-error">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="email">Adresse email</label>
					<input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
					@error('email')
						<span class="form-error">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="password">Mot de passe</label>
					<input type="password" id="password" name="password" class="form-control" required>
					@error('password')
						<span class="form-error">{{ $message }}</span>
					@enderror
				</div>

				<div class="form-group">
					<label for="password_confirmation">Confirmer le mot de passe</label>
					<input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
				</div>

				<button type="submit" class="btn btn-primary form-full">Créer mon compte</button>
			</form>

			<div class="text-center stack-sm text-muted">
				<span>Déjà inscrit ?</span>
				<a href="{{ route('comment.login', ['redirect_to' => $redirectTo]) }}" class="muted-link">Se connecter</a>
			</div>
		</div>
	</section>
@endsection







