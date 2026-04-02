@extends('layouts.app')

@section('title', 'Contact - Buena Salud')

@section('content')
	<section class="main-content contact-page">
		<div class="container">
			<div class="contact-hero fade-up">
				<div>
					<h1 class="contact-page-title">Contactez-nous</h1>
					<p class="contact-page-subtitle">Une question, un retour ou une demande ? Notre équipe vous répond rapidement avec des conseils clairs et utiles.</p>
				</div>
				<div class="contact-hero-mini">
					<span>Réponse moyenne</span>
					<strong>&lt; 24h</strong>
				</div>
			</div>

			<div class="contact-layout fade-up-delayed">
				<aside class="surface contact-side">
					<h3>Pourquoi nous écrire ?</h3>
					<ul>
						<li>Recevoir une réponse personnalisée</li>
						<li>Signaler un problème sur un article</li>
						<li>Proposer un sujet santé à traiter</li>
					</ul>
					<div class="contact-side-note">
						Nous lisons chaque message avec attention et revenons vers vous au plus vite.
					</div>
				</aside>

				<div class="contact-form-wrapper">
				@if(session('success'))
						<div class="alert alert-success">
						{{ session('success') }}
					</div>
				@endif

					@if($errors->any())
						<div class="alert alert-error">
							<strong>Erreur :</strong> Veuillez vérifier les informations saisies.
						</div>
					@endif

					<div class="contact-form-card">
						<form method="post" action="{{ route('contact.submit') }}" class="contact-form">
					@csrf
						@guest
							<div class="form-row">
								<div class="form-group">
									<label for="name" class="form-label">
										Nom <span class="required">*</span>
									</label>
									<input type="text" id="name" name="name" class="form-input" placeholder="Votre nom complet" required value="{{ old('name') }}">
									@error('name')
										<span class="form-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="form-group">
									<label for="email" class="form-label">
										Email <span class="required">*</span>
									</label>
									<input type="email" id="email" name="email" class="form-input" placeholder="votre@email.com" required value="{{ old('email') }}">
									@error('email')
										<span class="form-error">{{ $message }}</span>
									@enderror
								</div>
							</div>
						@else
							<input type="hidden" name="name" value="{{ auth()->user()->name }}">
							<input type="hidden" name="email" value="{{ auth()->user()->email }}">
							<div class="contact-auth-summary">
								Vous contactez le blog en tant que <strong>{{ auth()->user()->name }}</strong> ({{ auth()->user()->email }}).
							</div>
						@endguest

					<div class="form-group">
								<label for="subject" class="form-label">
									Sujet
								</label>
								<input type="text" id="subject" name="subject" class="form-input" placeholder="Sujet de votre message (optionnel)" value="{{ old('subject') }}">
								@error('subject')
									<span class="form-error">{{ $message }}</span>
								@enderror
					</div>

					<div class="form-group">
								<label for="message" class="form-label">
									Message <span class="required">*</span>
								</label>
								<textarea id="message" name="message" class="form-textarea" rows="6" placeholder="Décrivez votre question ou votre demande en détail..." required>{{ old('message') }}</textarea>
								@error('message')
									<span class="form-error">{{ $message }}</span>
								@enderror
					</div>

							<button type="submit" class="btn btn-primary btn-submit">
								<span>Envoyer le message</span>
							</button>
				</form>
					</div>
				</div>
			</div>
		</div>
	</section>

	<style>
		/* Styles pour la page contact */
		.contact-page {
			min-height: calc(100vh - 220px);
		}

		.contact-hero {
			background: linear-gradient(135deg, #0f172a 0%, #1a3f54 50%, #1b8ea1 100%);
			border-radius: 18px;
			padding: 22px;
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 14px;
			margin-bottom: 16px;
			color: #fff;
			flex-wrap: wrap;
		}

		.contact-page-title {
			font-size: clamp(2rem, 4vw, 2.6rem);
			font-weight: 800;
			color: #fff;
			margin-bottom: 8px;
			letter-spacing: -0.5px;
		}

		.contact-page-subtitle {
			font-size: 1rem;
			color: rgba(255, 255, 255, 0.88);
			max-width: 680px;
			margin: 0;
			line-height: 1.6;
		}

		.contact-hero-mini {
			background: rgba(255, 255, 255, 0.12);
			border: 1px solid rgba(255, 255, 255, 0.24);
			border-radius: 12px;
			padding: 10px 12px;
			min-width: 132px;
		}

		.contact-hero-mini span {
			display: block;
			font-size: 12px;
			opacity: 0.9;
		}

		.contact-hero-mini strong {
			display: block;
			font-size: 1.35rem;
			font-weight: 800;
		}

		.contact-layout {
			display: grid;
			grid-template-columns: 300px minmax(0, 1fr);
			gap: 16px;
			align-items: start;
			min-width: 0;
		}

		.contact-side {
			padding: 16px;
			position: sticky;
			top: 86px;
		}

		.contact-side h3 {
			font-size: 1.05rem;
			font-weight: 800;
			margin-bottom: 12px;
			color: #0f172a;
		}

		.contact-side ul {
			list-style: none;
			display: grid;
			gap: 10px;
			margin-bottom: 14px;
		}

		.contact-side li {
			padding: 10px 12px;
			background: #f6fbfe;
			border: 1px solid #dceaf3;
			border-radius: 10px;
			font-size: 14px;
			color: #334155;
		}

		.contact-side-note {
			font-size: 13px;
			color: #64748b;
			line-height: 1.5;
		}

		.contact-form-wrapper {
			width: 100%;
			min-width: 0;
		}

		.contact-form-card {
			background: white;
			border-radius: 18px;
			border: 1px solid #e1eaf1;
			padding: 45px;
			box-shadow: 0 18px 32px rgba(15, 23, 42, 0.09);
		}

		.contact-form {
			display: flex;
			flex-direction: column;
			gap: 24px;
		}

		.contact-auth-summary {
			background: #e7f5ff;
			border: 1px solid #bee3f8;
			padding: 15px 20px;
			border-radius: 8px;
			margin-bottom: 25px;
			color: #0c5460;
			font-size: 14px;
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
			display: flex;
			align-items: center;
			gap: 4px;
		}

		.required {
			color: #dc3545;
			font-weight: 700;
		}

		.form-input,
		.form-textarea {
			padding: 14px 18px;
			border: 2px solid #e9ecef;
			border-radius: 10px;
			font-size: 15px;
			transition: all 0.3s ease;
			font-family: inherit;
			background: #fafbfc;
		}

		.form-input::placeholder,
		.form-textarea::placeholder {
			color: #adb5bd;
		}

		.form-input:focus,
		.form-textarea:focus {
			outline: none;
			border-color: #17a2b8;
			background: white;
			box-shadow: 0 0 0 4px rgba(23, 162, 184, 0.1);
		}

		.form-textarea {
			resize: vertical;
			min-height: 150px;
			line-height: 1.6;
		}

		.form-error {
			color: #dc3545;
			font-size: 13px;
			margin-top: 6px;
			display: flex;
			align-items: center;
			gap: 4px;
		}

		.btn-submit {
			padding: 16px 32px;
			font-size: 16px;
			font-weight: 600;
			border-radius: 10px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 100%;
			margin-top: 4px;
			transition: all 0.3s ease;
			box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
		}

		.btn-submit:hover {
			transform: translateY(-2px);
			box-shadow: 0 6px 20px rgba(23, 162, 184, 0.4);
		}

		.btn-submit:active {
			transform: translateY(0);
		}

		.alert {
			padding: 16px 20px;
			border-radius: 10px;
			margin-bottom: 25px;
			display: flex;
			align-items: center;
			font-size: 15px;
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

		/* Responsive */
		@media (max-width: 768px) {
			.contact-layout {
				grid-template-columns: 1fr;
			}

			.contact-side {
				position: static;
			}

			.contact-hero-mini {
				width: 100%;
			}

			.contact-page-title {
				font-size: 32px;
			}

			.contact-page-subtitle {
				font-size: 16px;
			}

			.contact-form-card {
				padding: 30px 25px;
			}

			.form-title {
				font-size: 24px;
			}

			.form-row {
				grid-template-columns: 1fr;
			}
		}
	</style>
@endsection


