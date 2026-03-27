@extends('layouts.app')

@section('title', $article->title . ' - Buena Salud')

@section('content')
	<section class="main-content article-detail">
		<div class="container">
			@php
				$wordCount = str_word_count(strip_tags($article->content ?? ''));
				$readingTime = max(1, (int) ceil($wordCount / 220));
			@endphp
			<div class="article-top-actions">
				<a href="{{ route('articles') }}" class="btn btn-secondary">← Retour aux articles</a>
			</div>

			<article class="article-single">
					@if($article->image)
						<div class="article-hero-image">
							<img src="/images/{{ rawurlencode($article->image) }}" alt="{{ $article->title }}">
						</div>
					@endif

					<div class="article-single-content">
						<header class="article-header">
							<h1 class="article-single-title">{{ $article->title }}</h1>
							<div class="article-head-meta">
								<span class="article-author">Par {{ $article->auteur ?? 'Administrateur' }}</span>
							@if($article->date_publication)
									<span class="article-separator">•</span>
									<time class="article-date">{{ $article->date_publication->format('d F Y') }}</time>
							@endif
								<span class="article-separator">•</span>
								<span>{{ $readingTime }} min de lecture</span>
							</div>
						</header>

						@if($article->excerpt)
							<div class="article-excerpt-single">
								{{ $article->excerpt }}
							</div>
						@endif

						<div class="article-body-content">
							{!! nl2br($article->content) !!}
						</div>
					</div>
			</article>

			<div class="comments-section fade-up">
				@php
					$totalComments = $comments->count() + $comments->sum(function($comment) {
						return $comment->replies ? $comment->replies->count() : 0;
					});
				@endphp
				<h2 class="comments-title">Commentaires <span class="comments-count">({{ $totalComments }})</span></h2>

				@if(session('success'))
					<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif

				@if(session('error'))
					<div class="alert alert-error">
						{{ session('error') }}
					</div>
				@endif

				<div class="comments-list">
					@forelse($comments as $comment)
						@include('articles.partials.comment', ['comment' => $comment, 'article' => $article, 'depth' => 0])
					@empty
						<div class="comments-empty">
							<p>Soyez le premier à commenter cet article.</p>
						</div>
					@endforelse
				</div>

				<div class="comment-form-container" id="main-comment-form">
					<h3 class="comment-form-title">Laisser un commentaire</h3>
					@guest
						<div class="comment-auth-callout">
							<p>Connectez-vous ou créez un compte pour participer aux discussions.</p>
							<div class="comment-auth-actions">
								<a href="{{ route('comment.login', ['redirect_to' => request()->fullUrl()]) }}" class="btn btn-primary">Se connecter</a>
								<a href="{{ route('comment.register', ['redirect_to' => request()->fullUrl()]) }}" class="btn btn-secondary">Créer un compte</a>
							</div>
						</div>
					@endguest

					@auth
						<div class="comment-user-context">
							<div>Connecté en tant que <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }})</div>
							<form method="post" action="{{ route('comment.logout') }}" class="comment-logout-form">
								@csrf
								<button type="submit" class="btn btn-link">Se déconnecter</button>
							</form>
						</div>
						<form method="post" action="{{ route('article.comment.store', $article->id) }}" class="comment-form">
						@csrf
							<input type="hidden" name="parent_id" id="reply_to_comment" value="">
							<div class="form-group">
								<label for="content" class="form-label">Commentaire <span class="required">*</span></label>
								<textarea id="content" name="content" rows="5" class="form-textarea" placeholder="Votre commentaire..." required>{{ old('content') }}</textarea>
								@error('content')
									<span class="form-error">{{ $message }}</span>
								@enderror
							</div>
							<div id="reply-info" class="reply-info is-hidden">
								<strong>Vous répondez à :</strong> <span id="reply-author-name"></span>
								<button type="button" onclick="cancelReply()" class="btn-link-danger">Annuler</button>
							</div>
							<button type="submit" class="btn btn-primary comment-submit">Publier le commentaire</button>
						</form>
					@endauth
				</div>
			</div>
		</div>
	</section>

	<style>
		.article-detail {
			padding-top: 24px;
		}

		.article-single {
			background: white;
			border-radius: 18px;
			border: 1px solid #e4edf3;
			box-shadow: 0 20px 34px rgba(15, 23, 42, 0.08);
			margin-bottom: 34px;
			overflow: hidden;
		}

		.article-top-actions {
			margin-bottom: 24px;
		}

		.article-hero-image {
			width: 100%;
			height: 450px;
			overflow: hidden;
			position: relative;
			background: #e9ecef;
		}

		.article-hero-image img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}

		.article-single-content {
			max-width: 860px;
			margin: 0 auto;
			padding: 56px 46px;
		}


		.article-header {
			margin-bottom: 30px;
			padding-bottom: 25px;
			border-bottom: 2px solid #e9ecef;
		}

		.article-single-title {
			font-size: 42px;
			font-weight: 700;
			line-height: 1.2;
			color: #1a1a1a;
			margin-bottom: 20px;
			letter-spacing: -0.5px;
		}

		.article-head-meta {
			display: flex;
			align-items: center;
			gap: 12px;
			font-size: 15px;
			color: #666;
		}

		.article-author {
			font-weight: 600;
			color: #17a2b8;
		}

		.article-separator {
			color: #ccc;
		}

		.article-date {
			color: #888;
		}

		.article-excerpt-single {
			font-size: 19px;
			line-height: 1.6;
			color: #555;
			font-style: italic;
			padding: 20px 0;
			border-left: 4px solid #17a2b8;
			padding-left: 25px;
			margin-bottom: 30px;
			background: #f8f9fa;
			border-radius: 8px;
		}

		.article-body-content {
			font-size: 19px;
			line-height: 1.75;
			color: #333;
			word-wrap: break-word;
			max-width: 760px;
			margin: 0 auto;
		}

		.article-body-content p {
			margin-bottom: 6px;
		}

		.article-body-content h2,
		.article-body-content h3 {
			margin-top: 16px;
			margin-bottom: 8px;
			color: #1a1a1a;
			font-weight: 600;
		}

		.article-body-content h2 {
			font-size: 28px;
		}

		.article-body-content h3 {
			font-size: 24px;
		}

		.article-body-content ul,
		.article-body-content ol {
			margin: 8px 0;
			padding-left: 26px;
		}

		.article-body-content li {
			margin-bottom: 5px;
		}

		.comments-section {
			background: white;
			border-radius: 18px;
			border: 1px solid #e4edf3;
			box-shadow: 0 20px 34px rgba(15, 23, 42, 0.08);
			padding: 40px;
			margin-bottom: 30px;
		}

		.comments-title {
			font-size: 28px;
			font-weight: 700;
			color: #1a1a1a;
			margin-bottom: 30px;
			padding-bottom: 15px;
			border-bottom: 2px solid #e9ecef;
		}

		.comments-count {
			font-weight: 400;
			color: #666;
			font-size: 20px;
		}

		.alert {
			padding: 14px 18px;
			border-radius: 8px;
			margin-bottom: 25px;
			border-left: 4px solid;
		}

		.alert-success {
			background-color: #d1e7dd;
			color: #0f5132;
			border-color: #0f5132;
		}

		.alert-error {
			background-color: #f8d7da;
			color: #842029;
			border-color: #842029;
		}

		.comments-list {
			display: flex;
			flex-direction: column;
			gap: 20px;
			margin-bottom: 40px;
		}

		.comment-item {
			padding: 20px 18px;
			background: #f8fbfe;
			border-radius: 12px;
			border: 1px solid #dceaf3;
			margin-bottom: 15px;
		}

		.comment-reply {
			margin-left: 40px;
			margin-top: 15px;
			background: #ffffff;
			border-color: #e5ebf0;
		}

		.comment-replies {
			margin-top: 15px;
		}

		.comment-header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 12px;
			flex-wrap: wrap;
			gap: 10px;
		}

		.comment-author-wrap {
			display: inline-flex;
			align-items: center;
			gap: 10px;
		}

		.comment-avatar {
			width: 34px;
			height: 34px;
			border-radius: 50%;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			font-weight: 700;
			font-size: 13px;
			color: #fff;
			background: linear-gradient(135deg, #17a2b8, #56c5d4);
		}

		.comment-author {
			color: #17a2b8;
			font-size: 16px;
		}

		.comment-badge {
			padding: 4px 8px;
			border-radius: 999px;
			font-size: 11px;
			font-weight: 700;
			letter-spacing: 0.02em;
			color: #0f766e;
			background: #d9f3f7;
			border: 1px solid #bbe8ef;
		}

		.comment-date {
			color: #888;
			font-size: 13px;
		}

		.comment-body {
			color: #333;
			line-height: 1.6;
			white-space: pre-line;
			margin-bottom: 12px;
		}

		.comment-actions {
			margin-top: 10px;
		}

		.btn-reply {
			background: none;
			border: none;
			color: #17a2b8;
			cursor: pointer;
			font-size: 14px;
			padding: 5px 10px;
			border-radius: 4px;
			transition: all 0.2s;
			font-weight: 500;
		}

		.btn-reply:hover {
			background: #e7f3ff;
			color: #138496;
		}

		.comments-empty {
			text-align: center;
			padding: 40px 20px;
			color: #888;
			font-style: italic;
		}

		.comment-form-container {
			border-top: 2px solid #e9ecef;
			padding-top: 35px;
		}

		.comment-auth-callout {
			padding: 25px;
			background: #f1f5f9;
			border-radius: 10px;
			border: 1px solid #e2e8f0;
			margin-bottom: 20px;
			text-align: center;
		}

		.comment-auth-actions {
			display: flex;
			justify-content: center;
			gap: 15px;
			flex-wrap: wrap;
			margin-top: 15px;
		}

		.comment-user-context {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 15px;
			padding: 18px;
			background: #f1f5f9;
			border-radius: 10px;
			margin-bottom: 20px;
			font-size: 14px;
		}

		.comment-logout-form {
			margin: 0;
		}

		.comment-form-title {
			font-size: 24px;
			font-weight: 600;
			color: #1a1a1a;
			margin-bottom: 25px;
		}

		.comment-form {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}

		.form-row {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 20px;
		}

		.form-group {
			display: flex;
			flex-direction: column;
		}

		.form-label {
			font-weight: 600;
			color: #333;
			margin-bottom: 8px;
			font-size: 14px;
		}

		.required {
			color: #dc3545;
		}

		.form-input,
		.form-textarea {
			padding: 12px 16px;
			border: 2px solid #e9ecef;
			border-radius: 8px;
			font-size: 15px;
			transition: all 0.3s;
			font-family: inherit;
		}

		.form-input:focus,
		.form-textarea:focus {
			outline: none;
			border-color: #17a2b8;
			box-shadow: 0 0 0 3px rgba(23, 162, 184, 0.1);
		}

		.form-textarea {
			resize: vertical;
			min-height: 120px;
		}

		.form-error {
			color: #dc3545;
			font-size: 13px;
			margin-top: 5px;
		}

		.comment-submit {
			align-self: flex-start;
			padding: 14px 30px;
			font-size: 16px;
			font-weight: 600;
		}

		.btn-link {
			background: none;
			border: none;
			color: #dc3545;
			cursor: pointer;
			font-weight: 600;
			padding: 0;
		}

		.btn-link:hover { text-decoration: underline; }
		.reply-info {
			margin-bottom: 15px;
			padding: 10px 12px;
			background: #e7f3ff;
			border-left: 4px solid #17a2b8;
			border-radius: 6px;
		}

		.btn-link-danger {
			margin-left: 10px;
			color: #dc3545;
			text-decoration: underline;
			background: none;
			border: none;
			cursor: pointer;
			font-weight: 600;
		}

		@media (max-width: 768px) {
			.article-hero-image {
				height: 280px;
			}

			.article-single-content {
				padding: 30px 20px;
			}

			.article-single-title {
				font-size: 32px;
			}

			.article-excerpt-single {
				font-size: 18px;
			}

			.article-body-content {
				font-size: 16px;
				line-height: 1.7;
			}

			.comments-section {
				padding: 25px 20px;
			}

			.form-row {
				grid-template-columns: 1fr;
			}

			.comment-reply {
				margin-left: 20px;
			}

			.comment-avatar {
				width: 30px;
				height: 30px;
				font-size: 12px;
			}
		}
	</style>

	<script>
		function replyToComment(commentId, authorName) {
			// Mettre à jour le champ caché
			document.getElementById('reply_to_comment').value = commentId;
			document.getElementById('reply-author-name').textContent = authorName;
			
			// Afficher l'info de réponse
			document.getElementById('reply-info').classList.remove('is-hidden');
			
			// Faire défiler vers le formulaire
			document.getElementById('main-comment-form').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
			
			// Focus sur le textarea
			document.getElementById('content').focus();
		}

		function cancelReply() {
			// Réinitialiser le formulaire
			document.getElementById('reply_to_comment').value = '';
			document.getElementById('reply-info').classList.add('is-hidden');
			document.getElementById('content').value = '';
		}

		// Annuler la réponse si on soumet le formulaire avec succès
		@if(session('success'))
			setTimeout(function() {
				cancelReply();
			}, 100);
		@endif
	</script>
@endsection


