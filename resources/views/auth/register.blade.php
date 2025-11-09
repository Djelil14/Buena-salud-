@extends('layouts.app')

@section('title', 'Créer un compte - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container" style="max-width: 560px; margin: 0 auto;">
			<h1 class="page-title" style="text-align: center; margin-bottom: 20px;">Créer un compte</h1>
			<p style="text-align: center; color: #6c757d; margin-bottom: 35px;">Choisissez un pseudonyme (ou votre nom) et un mot de passe pour commenter plus facilement.</p>

			<form method="post" action="{{ route('comment.register.submit') }}" class="contact-form" style="box-shadow: 0 6px 18px rgba(0,0,0,0.1);">
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

				<button type="submit" class="btn btn-primary" style="width: 100%;">Créer mon compte</button>
			</form>

			<div style="text-align: center; margin-top: 25px; color: #6c757d;">
				<span>Déjà inscrit ?</span>
				<a href="{{ route('comment.login', ['redirect_to' => $redirectTo]) }}" style="color: #17a2b8; font-weight: 600;">Se connecter</a>
			</div>
		</div>
	</section>
@endsection


