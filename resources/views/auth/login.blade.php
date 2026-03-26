@extends('layouts.app')

@section('title', 'Connexion - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container centered-form-container">
			<h1 class="page-title text-center mb-md">Connexion</h1>
			<p class="section-subtitle text-center">Renseignez vos identifiants pour participer aux commentaires.</p>

			<form method="post" action="{{ route('comment.login.submit') }}" class="contact-form">
				@csrf
				<input type="hidden" name="redirect_to" value="{{ $redirectTo }}">

				@if($errors->has('email'))
					<div class="alert alert-error">
						{{ $errors->first('email') }}
					</div>
				@endif

				<div class="form-group">
					<label for="email">Adresse email</label>
					<input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
				</div>

				<div class="form-group">
					<label for="password">Mot de passe</label>
					<input type="password" id="password" name="password" class="form-control" required>
				</div>

				<div class="form-group form-inline-check">
					<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
					<label for="remember">Se souvenir de moi</label>
				</div>

				<button type="submit" class="btn btn-primary form-full">Se connecter</button>
			</form>

			<div class="text-center stack-sm text-muted">
				<span>Pas encore de compte ?</span>
				<a href="{{ route('comment.register', ['redirect_to' => $redirectTo]) }}" class="muted-link">Créer un compte</a>
			</div>
		</div>
	</section>
@endsection







