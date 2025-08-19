@extends('admin.layout')

@section('title', 'Admin - Éditer article')

@section('admin-content')
	<h1 class="page-title">Éditer: {{ $article->title }}</h1>

	<form method="post" action="{{ route('admin.articles.update', $article->id) }}" enctype="multipart/form-data" class="contact-form">
		@csrf
		@method('PUT')
		<div class="form-group">
			<label>Titre</label>
			<input type="text" name="title" class="form-control" required value="{{ old('title', $article->title) }}">
		</div>
		<div class="form-group">
			<label>Auteur</label>
			<input type="text" name="auteur" class="form-control" value="{{ old('auteur', $article->auteur) }}">
		</div>
		<div class="form-group">
			<label>Extrait</label>
			<textarea name="excerpt" class="form-control" required>{{ old('excerpt', $article->excerpt) }}</textarea>
		</div>
		<div class="form-group">
			<label>Contenu</label>
			<textarea name="content" class="form-control" required rows="10">{{ old('content', $article->content) }}</textarea>
		</div>
		<div class="form-group">
			<label>Image (liste)</label>
			@if($article->image)
				<div style="margin-bottom:8px;"><img src="/images/{{ rawurlencode($article->image) }}" alt="" style="height:80px;"></div>
			@endif
			<input type="file" name="image" class="form-control">
		</div>
		<div class="form-group">
			<label>Image de couverture (détail)</label>
			@if($article->image_couverture)
				<div style="margin-bottom:8px;"><img src="/images/{{ rawurlencode($article->image_couverture) }}" alt="" style="height:80px;"></div>
			@endif
			<input type="file" name="image_couverture" class="form-control">
		</div>
		<div class="form-group">
			<label>Méta description</label>
			<textarea name="meta_description" class="form-control">{{ old('meta_description', $article->meta_description) }}</textarea>
		</div>
		<div class="form-group">
			<label>Ordre d'affichage (accueil)</label>
			<input type="number" name="ordre_affichage" class="form-control" value="{{ old('ordre_affichage', $article->ordre_affichage) }}">
		</div>
		<div class="form-group">
			<label>Date de publication</label>
			<input type="datetime-local" name="date_publication" class="form-control" value="{{ old('date_publication', optional($article->date_publication)->format('Y-m-d\TH:i')) }}">
		</div>
		<div class="form-group" style="display:flex; gap:20px;">
			<label><input type="checkbox" name="published" value="1" {{ old('published', $article->published) ? 'checked' : '' }}> Publié</label>
			<label><input type="checkbox" name="afficher_accueil" value="1" {{ old('afficher_accueil', $article->afficher_accueil) ? 'checked' : '' }}> Afficher sur l'accueil</label>
		</div>
		<button type="submit" class="btn btn-primary">Enregistrer</button>
		<a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Annuler</a>
	</form>
@endsection


