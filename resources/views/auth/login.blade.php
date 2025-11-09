@extends('layouts.app')

@section('title', 'Connexion - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container" style="max-width: 520px; margin: 0 auto;">
			<h1 class="page-title" style="text-align: center; margin-bottom: 20px;">Connexion</h1>
			<p style="text-align: center; color: #6c757d; margin-bottom: 35px;">Renseignez vos identifiants pour participer aux commentaires.</p>

			<form method="post" action="{{ route('comment.login.submit') }}" class="contact-form" style="box-shadow: 0 6px 18px rgba(0,0,0,0.1);">
				@csrf
				<input type="hidden" name="redirect_to" value="{{ $redirectTo }}">

				@if($errors->has('email'))
					<div class="alert alert-error" style="margin-bottom: 20px;">
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

				<div class="form-group" style="display: flex; align-items: center; gap: 10px;">
					<input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
					<label for="remember" style="margin: 0;">Se souvenir de moi</label>
				</div>

				<button type="submit" class="btn btn-primary" style="width: 100%;">Se connecter</button>
			</form>

			<div style="text-align: center; margin-top: 25px; color: #6c757d;">
				<span>Pas encore de compte ?</span>
				<a href="{{ route('comment.register', ['redirect_to' => $redirectTo]) }}" style="color: #17a2b8; font-weight: 600;">Créer un compte</a>
			</div>
		</div>
	</section>
@endsection


