@extends('layouts.app')

@section('title', 'Contact - Buena Salud')

@section('content')
	<section class="main-content contact-page">
		<div class="container">
			<div class="contact-header">
				<h1 class="contact-page-title">Contactez-nous</h1>
				<p class="contact-page-subtitle">Nous sommes là pour répondre à vos questions et vous accompagner dans votre parcours de santé.</p>
			</div>

			<div class="contact-wrapper">
				<!-- Formulaire -->
				<div class="contact-form-wrapper">
				@if(session('success'))
						<div class="alert alert-success">
							<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="margin-right: 8px;">
								<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
							</svg>
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
								<svg width="20" height="20" viewBox="0 0 20 20" fill="currentColor" style="margin-left: 8px;">
									<path d="M10.894 2.553a1 1 0 00-1.788 0l-7 14a1 1 0 001.169 1.409l5-1.429A1 1 0 009 15.571V11a1 1 0 112 0v4.571a1 1 0 00.725.962l5 1.428a1 1 0 001.17-1.408l-7-14z"/>
								</svg>
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
			background: #f8f9fa;
			min-height: calc(100vh - 200px);
		}

		.contact-header {
			text-align: center;
			margin-bottom: 50px;
			padding-top: 20px;
		}

		.contact-page-title {
			font-size: 42px;
			font-weight: 700;
			color: #1a1a1a;
			margin-bottom: 15px;
			letter-spacing: -0.5px;
		}

		.contact-page-subtitle {
			font-size: 18px;
			color: #666;
			max-width: 600px;
			margin: 0 auto;
			line-height: 1.6;
		}

		.contact-wrapper {
			display: flex;
			justify-content: center;
			margin-bottom: 60px;
		}

		.contact-form-wrapper {
			position: relative;
			width: 100%;
			max-width: 800px;
		}

		.contact-form-card {
			background: white;
			border-radius: 16px;
			padding: 45px;
			box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
		}

		.contact-form {
			display: flex;
		.contact-auth-summary {
			background: #e7f5ff;
			border: 1px solid #bee3f8;
			padding: 15px 20px;
			border-radius: 8px;
			margin-bottom: 25px;
			color: #0c5460;
			font-size: 14px;
		}
			flex-direction: column;
			gap: 24px;
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
			margin-top: 10px;
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


