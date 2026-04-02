@extends('layouts.app')

@section('content')
	<section class="main-content admin-page">
		<div class="container">
			<div class="admin-shell">
				<div class="admin-mobile-bar">
					<button type="button" class="admin-sidebar-toggle" id="adminSidebarToggle" aria-expanded="false" aria-controls="adminSidebarPanel">
						<span class="admin-sidebar-toggle-icon" aria-hidden="true"></span>
						<span class="sr-only">Ouvrir ou fermer le menu administration</span>
					</button>
					<span class="admin-mobile-title">Administration</span>
				</div>
				<div class="admin-backdrop" id="adminBackdrop" aria-hidden="true"></div>
				<div class="admin-body">
					<aside class="admin-sidebar surface" id="adminSidebarPanel">
						<nav aria-label="Navigation administration">
							<ul class="admin-sidebar-nav">
								<li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
								<li><a href="{{ route('admin.articles.index') }}">Articles</a></li>
								<li><a href="{{ route('admin.messages.index') }}">Messages</a></li>
							</ul>
							<form method="post" action="{{ route('admin.logout') }}" class="stack-sm admin-logout-form">
								@csrf
								<button type="submit" class="btn btn-secondary btn-admin-logout">Se déconnecter</button>
							</form>
						</nav>
					</aside>
					<div class="admin-main-col">
						@yield('admin-content')
					</div>
				</div>
			</div>
		</div>
	</section>

	<style>
		.admin-page {
			min-width: 0;
		}

		.admin-shell {
			min-width: 0;
		}

		.admin-mobile-bar {
			display: none;
			align-items: center;
			gap: 12px;
			margin-bottom: 14px;
			padding: 10px 14px;
			background: var(--surface);
			border: 1px solid var(--border);
			border-radius: 14px;
			box-shadow: var(--shadow-soft);
			position: sticky;
			top: 0;
			z-index: 35;
		}

		.admin-mobile-title {
			font-weight: 800;
			font-size: 1rem;
			color: var(--ink);
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
			min-width: 0;
		}

		.admin-sidebar-toggle {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			width: 44px;
			height: 44px;
			padding: 0;
			border: 1px solid var(--border);
			border-radius: 12px;
			background: #fff;
			cursor: pointer;
			flex-shrink: 0;
			color: var(--ink);
			touch-action: manipulation;
		}

		.admin-sidebar-toggle:hover {
			background: #f0fbfd;
			border-color: #bfeaf0;
		}

		.admin-sidebar-toggle-icon {
			display: block;
			width: 20px;
			height: 2px;
			background: currentColor;
			border-radius: 1px;
			position: relative;
		}

		.admin-sidebar-toggle-icon::before,
		.admin-sidebar-toggle-icon::after {
			content: '';
			position: absolute;
			left: 0;
			width: 20px;
			height: 2px;
			background: currentColor;
			border-radius: 1px;
		}

		.admin-sidebar-toggle-icon::before { top: -6px; }
		.admin-sidebar-toggle-icon::after { top: 6px; }

		.admin-sidebar-toggle[aria-expanded="true"] .admin-sidebar-toggle-icon {
			background: transparent;
		}

		.admin-sidebar-toggle[aria-expanded="true"] .admin-sidebar-toggle-icon::before {
			top: 0;
			transform: rotate(45deg);
		}

		.admin-sidebar-toggle[aria-expanded="true"] .admin-sidebar-toggle-icon::after {
			top: 0;
			transform: rotate(-45deg);
		}

		.admin-backdrop {
			display: none;
			position: fixed;
			inset: 0;
			background: rgba(15, 23, 42, 0.45);
			backdrop-filter: blur(2px);
			z-index: 198;
		}

		.admin-backdrop.is-visible {
			display: block;
		}

		.admin-body {
			display: flex;
			gap: 24px;
			align-items: flex-start;
			min-width: 0;
		}

		.admin-body .admin-sidebar {
			width: 260px;
			flex-shrink: 0;
			position: sticky;
			top: 90px;
			padding: 18px;
		}

		.admin-main-col {
			flex: 1;
			min-width: 0;
		}

		.btn-admin-logout {
			width: 100%;
			justify-content: center;
		}

		@media (max-width: 768px) {
			.admin-mobile-bar {
				display: flex;
			}

			.admin-body {
				display: block;
			}

			.admin-body .admin-sidebar {
				position: fixed;
				top: 0;
				left: 0;
				width: min(300px, 90vw);
				height: 100vh;
				height: 100dvh;
				max-height: 100dvh;
				margin: 0;
				z-index: 200;
				border-radius: 0 16px 16px 0;
				transform: translateX(-108%);
				transition: transform 0.28s ease;
				overflow-y: auto;
				-webkit-overflow-scrolling: touch;
				box-shadow: 8px 0 32px rgba(15, 23, 42, 0.15);
				top: 0;
			}

			.admin-body .admin-sidebar.is-open {
				transform: translateX(0);
			}

			.admin-main-col {
				width: 100%;
			}

			.admin-main-col .actions-row {
				flex-direction: column;
			}

			.admin-main-col .actions-row .btn {
				width: 100%;
				justify-content: center;
				text-align: center;
			}

			.admin-main-col .page-title {
				word-break: break-word;
			}

			.table-wrap {
				margin-left: -4px;
				margin-right: -4px;
				border-radius: 12px;
			}

			.table th,
			.table td {
				padding: 10px 8px;
				font-size: 13px;
			}

			.row-actions {
				gap: 10px;
			}

			.icon-btn {
				width: 44px;
				height: 44px;
				min-width: 44px;
				min-height: 44px;
			}

			.icon-btn svg {
				width: 20px;
				height: 20px;
			}
		}

		@media (max-width: 480px) {
			.dashboard-hero,
			.admin-dashboard-hero,
			.messages-hero,
			.create-hero {
				padding: 16px;
				border-radius: 14px;
			}

			.performance-strip {
				grid-template-columns: 1fr !important;
			}
		}

		@media (prefers-reduced-motion: reduce) {
			.admin-body .admin-sidebar {
				transition: none !important;
			}
		}
	</style>

	<noscript>
		<style>
			@media (max-width: 768px) {
				.admin-mobile-bar { display: none !important; }
				.admin-backdrop { display: none !important; }
				.admin-body .admin-sidebar {
					position: static !important;
					transform: none !important;
					width: 100% !important;
					height: auto !important;
					max-height: none !important;
					border-radius: 14px !important;
					margin-bottom: 16px !important;
					box-shadow: var(--shadow-soft) !important;
				}
			}
		</style>
	</noscript>

	<script>
		(function () {
			var toggle = document.getElementById('adminSidebarToggle');
			var panel = document.getElementById('adminSidebarPanel');
			var backdrop = document.getElementById('adminBackdrop');
			if (!toggle || !panel || !backdrop) return;

			function isMobile() {
				return window.matchMedia('(max-width: 768px)').matches;
			}

			function setOpen(open) {
				toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
				panel.classList.toggle('is-open', open);
				backdrop.classList.toggle('is-visible', open);
				backdrop.setAttribute('aria-hidden', open ? 'false' : 'true');
				document.body.style.overflow = open ? 'hidden' : '';
			}

			function close() {
				setOpen(false);
			}

			toggle.addEventListener('click', function () {
				setOpen(!panel.classList.contains('is-open'));
			});

			backdrop.addEventListener('click', close);

			panel.querySelectorAll('a[href]').forEach(function (link) {
				link.addEventListener('click', function () {
					if (isMobile()) close();
				});
			});

			var logoutForm = panel.querySelector('.admin-logout-form');
			if (logoutForm) {
				logoutForm.addEventListener('submit', function () {
					if (isMobile()) close();
				});
			}

			window.addEventListener('resize', function () {
				if (!isMobile()) close();
			});

			document.addEventListener('keydown', function (e) {
				if (e.key === 'Escape' && panel.classList.contains('is-open')) {
					close();
				}
			});
		})();
	</script>
@endsection

