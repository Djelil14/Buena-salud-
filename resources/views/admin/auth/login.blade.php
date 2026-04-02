@extends('layouts.app')

@section('title', 'Admin - Connexion')

@section('content')
	<section class="main-content">
		<div class="container centered-form-container">
			<h1 class="page-title text-center">Connexion administrateur</h1>
			<p class="section-subtitle text-center">Accédez au back-office pour gérer les articles et messages.</p>
			<form method="post" action="{{ route('admin.login.post') }}" class="contact-form">
				@csrf
				<div class="form-group">
					<label>Nom d'utilisateur</label>
					<input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
					@error('username')
						<span class="form-error">{{ $message }}</span>
					@enderror
				</div>
				<div class="form-group">
					<label>Mot de passe</label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<button type="submit" class="btn btn-primary">Se connecter</button>
			</form>
		</div>
	</section>

	<style>
		@media (max-width: 768px) {
			.centered-form-container .contact-form {
				padding: 24px 18px;
			}

			.centered-form-container .btn {
				width: 100%;
				justify-content: center;
				text-align: center;
			}
		}
	</style>
@endsection


