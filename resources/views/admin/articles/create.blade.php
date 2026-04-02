@extends('admin.layout')

@section('title', 'Admin - Nouvel article')

@section('admin-content')
	<div class="create-hero">
		<div>
			<div class="create-kicker">Back office</div>
			<h1 class="page-title title-no-margin">Créer un nouvel article</h1>
			<p class="section-subtitle create-subtitle">Rédigez un contenu structuré, ajoutez vos visuels, puis planifiez la publication en quelques étapes.</p>
		</div>
		<div class="create-hero-badge">
			<span>Étape</span>
			<strong>Édition</strong>
		</div>
	</div>

	<form method="post" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="contact-form create-form">
		@csrf
		<div class="editor-grid">
			<div class="editor-main">
				<div class="surface editor-block">
					<h3 class="editor-block-title">Contenu principal</h3>
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
		<div class="actions-row create-actions">
			<button type="submit" class="btn btn-primary">Créer</button>
			<a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Annuler</a>
		</div>
	</form>

	<style>
		.create-hero {
			background: linear-gradient(135deg, #0f172a 0%, #1b3f53 56%, #1ca3b8 100%);
			border-radius: 18px;
			padding: 20px;
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 14px;
			flex-wrap: wrap;
			margin-bottom: 14px;
			color: #fff;
		}

		.create-kicker {
			display: inline-flex;
			align-items: center;
			padding: 4px 10px;
			border-radius: 999px;
			font-size: 11px;
			font-weight: 800;
			letter-spacing: 0.06em;
			text-transform: uppercase;
			background: rgba(255, 255, 255, 0.14);
			border: 1px solid rgba(255, 255, 255, 0.3);
			margin-bottom: 9px;
		}

		.create-hero .page-title {
			color: #fff;
		}

		.create-subtitle {
			margin: 6px 0 0 0;
			color: rgba(255, 255, 255, 0.86);
			max-width: 680px;
		}

		.create-hero-badge {
			background: rgba(255, 255, 255, 0.12);
			border: 1px solid rgba(255, 255, 255, 0.24);
			border-radius: 12px;
			padding: 10px 12px;
			min-width: 110px;
		}

		.create-hero-badge span {
			display: block;
			font-size: 12px;
			opacity: 0.9;
		}

		.create-hero-badge strong {
			font-size: 1.2rem;
			font-weight: 800;
		}

		.create-form {
			border: 1px solid #dbe8f1;
			box-shadow: 0 22px 36px rgba(15, 23, 42, 0.1);
			padding: 42px;
		}

		.editor-grid {
			display: grid;
			grid-template-columns: 1fr;
			gap: 24px;
			align-items: start;
		}

		.editor-block {
			padding: 22px;
			border: 1px solid #dce8f1;
			border-radius: 14px;
		}

		.editor-block-title {
			font-size: 1.12rem;
			font-weight: 800;
			margin-bottom: 16px;
			color: #0f172a;
		}

		.editor-side {
			padding: 20px;
			position: static;
			top: auto;
			border: 1px solid #dce8f1;
			border-radius: 14px;
		}

		.editor-side-title {
			font-size: 1.08rem;
			font-weight: 800;
			margin-bottom: 14px;
			color: #0f172a;
		}

		.editor-separator {
			border: 0;
			border-top: 1px solid #e4edf3;
			margin: 8px 0 14px;
		}

		.editor-content {
			min-height: 420px;
		}

		.create-form .form-group {
			margin-bottom: 24px;
		}

		.create-form .form-control {
			padding: 14px 16px;
		}

		.create-actions {
			margin-top: 8px;
		}

		@media (max-width: 1024px) {
			.editor-grid {
				grid-template-columns: 1fr;
			}

			.editor-side {
				position: static;
			}

			.create-hero-badge {
				width: 100%;
			}

			.create-form {
				padding: 26px;
			}

			.editor-block,
			.editor-side {
				padding: 16px;
			}
		}

		@media (max-width: 768px) {
			.create-hero {
				flex-direction: column;
				align-items: stretch;
			}

			.create-hero-badge {
				align-self: flex-start;
			}

			.create-form {
				padding: 18px 14px;
			}

			.create-actions {
				flex-direction: column;
			}

			.create-actions .btn {
				width: 100%;
				justify-content: center;
				text-align: center;
			}

			.form-switches {
				flex-direction: column;
				align-items: flex-start;
				gap: 12px;
			}
		}
	</style>
@endsection


