@extends('admin.layout')

@section('title', 'Admin - Nouvel article')

@section('admin-content')
	<h1 class="page-title">Nouvel article</h1>
	<p class="section-subtitle">Rédigez un contenu clair, ajoutez une image et planifiez la publication.</p>

	<form method="post" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="contact-form">
		@csrf
		<div class="editor-grid">
			<div>
				<div class="form-group">
					<label>Titre</label>
					<input type="text" name="title" class="form-control" required value="{{ old('title') }}">
				</div>
				<div class="form-group">
					<label>Auteur</label>
					<input type="text" name="auteur" class="form-control" value="{{ old('auteur') }}">
				</div>
				<div class="form-group">
					<label>Extrait</label>
					<textarea name="excerpt" class="form-control" required>{{ old('excerpt') }}</textarea>
				</div>
				<div class="form-group">
					<label>Contenu</label>
					<textarea name="content" class="form-control editor-content" required rows="12">{{ old('content') }}</textarea>
				</div>
				<div class="form-group">
					<label>Méta description</label>
					<textarea name="meta_description" class="form-control">{{ old('meta_description') }}</textarea>
				</div>
			</div>
			<aside class="surface editor-side">
				<h3 class="editor-side-title">Publication</h3>
				<div class="form-group">
					<label>Date de publication</label>
					<input type="datetime-local" name="date_publication" class="form-control" value="{{ old('date_publication') }}">
				</div>
				<div class="form-group">
					<label>Ordre d'affichage (accueil)</label>
					<input type="number" name="ordre_affichage" class="form-control" value="{{ old('ordre_affichage', 0) }}">
				</div>
				<div class="form-group form-switches">
					<label><input type="checkbox" name="published" value="1" {{ old('published', true) ? 'checked' : '' }}> Publié</label>
					<label><input type="checkbox" name="afficher_accueil" value="1" {{ old('afficher_accueil') ? 'checked' : '' }}> Afficher sur l'accueil</label>
				</div>
				<hr class="editor-separator">
				<div class="form-group">
					<label>Image (liste)</label>
					<input type="file" name="image" class="form-control">
				</div>
				<div class="form-group">
					<label>Image de couverture (détail)</label>
					<input type="file" name="image_couverture" class="form-control">
				</div>
			</aside>
		</div>
		<div class="actions-row">
			<button type="submit" class="btn btn-primary">Créer</button>
			<a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Annuler</a>
		</div>
	</form>

	<style>
		.editor-grid {
			display: grid;
			grid-template-columns: 1fr 320px;
			gap: 18px;
			align-items: start;
		}

		.editor-side {
			padding: 16px;
			position: sticky;
			top: 90px;
		}

		.editor-side-title {
			font-size: 1.05rem;
			font-weight: 800;
			margin-bottom: 10px;
			color: #0f172a;
		}

		.editor-separator {
			border: 0;
			border-top: 1px solid #e4edf3;
			margin: 8px 0 14px;
		}

		.editor-content {
			min-height: 320px;
		}

		@media (max-width: 1024px) {
			.editor-grid {
				grid-template-columns: 1fr;
			}

			.editor-side {
				position: static;
			}
		}
	</style>
@endsection


