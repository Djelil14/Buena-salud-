@extends('layouts.app')

@section('title', 'Admin - Connexion')

@section('content')
	<section class="main-content">
		<div class="container">
			<h1 class="page-title">Connexion administrateur</h1>
			<form method="post" action="{{ route('admin.login.post') }}" class="contact-form" style="max-width:480px;">
				@csrf
				<div class="form-group">
					<label>Nom d'utilisateur</label>
					<input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
					@error('username')
						<div style="color:#dc3545; margin-top:6px;">{{ $message }}</div>
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
@endsection


