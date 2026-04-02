<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buena Salud')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        :root {
            --primary: #17a2b8;
            --primary-dark: #138496;
            --ink: #1f2937;
            --muted: #6b7280;
            --bg: #f4f8fb;
            --surface: #ffffff;
            --border: #dbe5ec;
            --danger: #dc3545;
            --radius-lg: 16px;
            --radius-md: 12px;
            --shadow-soft: 0 10px 30px rgba(15, 23, 42, 0.08);
        }

        body {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            line-height: 1.6;
            color: var(--ink);
            background: radial-gradient(circle at top right, #eaf7fa 0%, var(--bg) 35%, #f8fafc 100%);
        }

        .header {
            position: sticky;
            top: 0;
            z-index: 40;
            backdrop-filter: blur(10px);
            background-color: rgba(255, 255, 255, 0.95);
            border-bottom: 1px solid var(--border);
            padding: 14px 0;
        }

        .container {
            max-width: 1220px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 22px;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 1.45rem;
            font-weight: 800;
            color: var(--ink);
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(140deg, var(--primary), #50c6d7);
            border-radius: 10px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            box-shadow: 0 8px 20px rgba(23, 162, 184, 0.35);
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 22px;
        }

        .nav-menu a {
            text-decoration: none;
            color: var(--muted);
            font-weight: 600;
            transition: all 0.25s;
            border-radius: 999px;
            padding: 8px 14px;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: var(--primary-dark);
            background: #e8f7fa;
        }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .nav-auth-form {
            margin: 0;
        }

        .nav-auth-link {
            color: var(--primary-dark);
            text-decoration: none;
            font-weight: 600;
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px 0;
        }

        .nav-auth-link:hover {
            text-decoration: underline;
        }

        .nav-user {
            font-weight: 600;
            color: #0f172a;
        }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            text-decoration: none;
            border-radius: 10px;
            font-weight: 700;
            transition: transform 0.2s ease, box-shadow 0.25s ease, background-color 0.25s ease, color 0.25s ease, border-color 0.25s ease;
            border: 1px solid transparent;
            cursor: pointer;
            font-family: inherit;
            line-height: 1.2;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1cb6cf, var(--primary));
            color: white;
            box-shadow: 0 12px 24px rgba(23, 162, 184, 0.25);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 14px 28px rgba(23, 162, 184, 0.35);
        }

        .btn:active {
            transform: translateY(0);
        }

        .btn-secondary {
            background-color: #fff;
            color: var(--primary-dark);
            border-color: #bfeaf0;
        }

        .btn-secondary:hover {
            background-color: #f0fbfd;
        }

        .btn-danger {
            background: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .btn-danger:hover {
            background: #c82333;
            border-color: #c82333;
        }

        .main-content {
            padding: 56px 0;
        }

        .section-title {
            font-size: clamp(1.6rem, 3vw, 2rem);
            font-weight: 800;
            margin-bottom: 14px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .section-title a {
            font-size: 14px;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background-color: var(--primary);
            color: white;
            border-radius: 25px;
            font-weight: 700;
            transition: all 0.25s ease;
            box-shadow: 0 8px 20px rgba(23, 162, 184, 0.25);
        }

        .section-title a::after {
            content: '→';
            font-size: 15px;
            transition: transform 0.2s ease;
        }

        .section-title a:hover {
            background-color: var(--primary-dark);
        }

        .section-title a:hover::after {
            transform: translateX(3px);
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
            margin-top: 30px;
        }

        .article-card {
            background: white;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-soft);
            border: 1px solid #e6eef3;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .article-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 18px 34px rgba(15, 23, 42, 0.14);
        }

        .article-image {
            width: 100%;
            height: 210px;
            object-fit: cover;
        }

        .article-content {
            padding: 25px;
        }

        .article-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 10px;
            color: #111827;
        }

        .article-excerpt {
            color: #4b5563;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        .article-meta {
            font-size: 14px;
            color: #6b7280;
            margin: 12px 0 18px;
        }

        .card-actions {
            text-align: right;
        }

        .card-actions .btn {
            padding: 10px 14px;
        }

        .page-title {
            font-size: clamp(1.8rem, 3.8vw, 2.4rem);
            font-weight: 800;
            margin-bottom: 14px;
            color: #0f172a;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            color: var(--muted);
            margin-bottom: 30px;
            font-size: 1.02rem;
        }

        .text-center { text-align: center; }
        .text-muted { color: #6c757d; }
        .mb-sm { margin-bottom: 8px; }
        .mb-md { margin-bottom: 12px; }
        .mb-xl { margin-bottom: 40px; }
        .is-hidden { display: none; }
        .muted-link { color: var(--primary); font-weight: 600; text-decoration: none; }
        .muted-link:hover { text-decoration: underline; }
        .stack-sm { margin-top: 25px; }
        .centered-form-container { max-width: 620px; margin: 0 auto; }
        .form-full { width: 100%; }
        .form-inline-check { display: flex; align-items: center; gap: 10px; }
        .form-inline-check label { margin: 0; }
        .form-switches { display: flex; gap: 20px; flex-wrap: wrap; }
        .actions-row { display: flex; gap: 10px; flex-wrap: wrap; }
        .actions-row-between { justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .centered-title-row { justify-content: center; margin-bottom: 40px; }
        .title-no-margin { margin: 0; }
        .pagination-wrap { padding: 12px; }
        .mt-lg { margin-top: 30px; }
        .mb-lg { margin-bottom: 30px; }
        .image-thumb { height: 80px; border-radius: 8px; border:1px solid #dde7ef; }
        .thumb-wrap { margin-bottom:8px; }
        .surface-padded { padding:16px; }
        .pre-message {
            white-space:pre-wrap;
            word-wrap:break-word;
            background:#f8f9fa;
            padding:12px;
            border-radius:6px;
        }
        .metric-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap:12px; margin-bottom:16px; }
        .metric-card { padding:14px 16px; }
        .metric-title { font-weight:600; }
        .metric-meta { color:#666; font-size:12px; }
        .table-col-actions { width: 220px; }
        .table-col-actions-sm { width: 190px; }
        .table-empty { text-align:center; }

        .surface {
            background: var(--surface);
            border-radius: var(--radius-lg);
            border: 1px solid #e5edf3;
            box-shadow: var(--shadow-soft);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease;
        }

        .surface:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 30px rgba(15, 23, 42, 0.11);
            border-color: #d2e4ef;
        }

        .contact-form {
            max-width: 700px;
            margin: 0 auto;
            background: white;
            padding: 36px;
            border-radius: var(--radius-lg);
            border: 1px solid #e5edf3;
            box-shadow: var(--shadow-soft);
        }

        .form-group { margin-bottom: 22px; }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #111827;
        }

        .form-control,
        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d9e4eb;
            border-radius: 10px;
            font-size: 15px;
            font-family: inherit;
            background: #fbfdff;
            transition: all 0.2s;
        }

        .form-control:focus,
        .form-input:focus,
        .form-textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 4px rgba(23, 162, 184, 0.12);
            background: #fff;
        }

        textarea.form-control,
        .form-textarea {
            min-height: 120px;
            resize: vertical;
        }

        .form-error {
            color: #b42318;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }

        .alert {
            padding: 12px 14px;
            border-radius: 10px;
            margin-bottom: 14px;
            font-weight: 600;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .admin-grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 24px;
            align-items: start;
        }

        .admin-sidebar {
            position: sticky;
            top: 90px;
            padding: 18px;
        }

        .admin-sidebar-nav {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .admin-sidebar-nav a {
            text-decoration: none;
            color: #334155;
            font-weight: 600;
            display: block;
            padding: 10px 12px;
            border-radius: 10px;
        }

        .admin-sidebar-nav a:hover {
            background: #ecf8fb;
            color: #0f766e;
        }

        .table-wrap {
            overflow-x: auto;
            border-radius: var(--radius-md);
            border: 1px solid #e4edf3;
            background: #fff;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            min-width: 760px;
        }

        .table th {
            text-align: left;
            padding: 14px 12px;
            border-bottom: 1px solid #e9eef3;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            color: #64748b;
        }

        .table td {
            padding: 12px;
            border-top: 1px solid #f0f4f7;
            vertical-align: top;
        }

        .row-actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .footer {
            background-color: #0f172a;
            color: white;
            text-align: center;
            padding: 34px 0;
            margin-top: 50px;
        }

        .footer-text {
            margin-bottom: 10px;
        }

        .fade-up {
            animation: fadeUp 0.55s ease both;
        }

        .fade-up-delayed {
            animation: fadeUp 0.7s ease both;
        }

        .stagger-1 { animation-delay: 60ms; }
        .stagger-2 { animation-delay: 120ms; }
        .stagger-3 { animation-delay: 180ms; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (prefers-reduced-motion: reduce) {
            .fade-up,
            .fade-up-delayed,
            .stagger-1,
            .stagger-2,
            .stagger-3 {
                animation: none !important;
            }

            .btn,
            .surface,
            .article-card {
                transition: none !important;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .nav-menu {
                flex-direction: column;
                gap: 0.4rem;
                width: 100%;
            }

            .nav-auth {
                align-items: flex-start;
                gap: 8px;
                width: 100%;
            }

            .articles-grid {
                grid-template-columns: 1fr;
            }

            .contact-form { padding: 24px; }

            .admin-grid {
                grid-template-columns: 1fr;
            }

            .admin-sidebar {
                position: static;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="{{ route('home') }}" class="logo">
                    <div class="logo-icon">BS</div>
                    Buena Salud
                </a>
                <ul class="nav-menu">
                    <li><a href="{{ route('home') }}" class="{{ Request::is('/') ? 'active' : '' }}">Accueil</a></li>
                    <li><a href="{{ route('articles') }}" class="{{ Request::is('articles*') ? 'active' : '' }}">Articles</a></li>
                    <li><a href="{{ route('contact') }}" class="{{ Request::is('contact') ? 'active' : '' }}">Contact</a></li>
                </ul>
                <div class="nav-auth">
                    @auth
                        <span class="nav-user">{{ auth()->user()->name }}</span>
                        <form method="post" action="{{ route('comment.logout') }}" class="nav-auth-form">
                            @csrf
                            <button type="submit" class="nav-auth-link">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('comment.login', ['redirect_to' => request()->fullUrl()]) }}" class="nav-auth-link">Connexion</a>
                        <a href="{{ route('comment.register', ['redirect_to' => request()->fullUrl()]) }}" class="nav-auth-link">Créer un compte</a>
                    @endauth
                </div>
            </nav>
        </div>
    </header>

    <!-- Contenu principal -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-text">© {{ date('Y') }} Buena Salud — Tous droits réservés.</div>
            <div>Contenu à titre informatif seulement. Consultez un professionnel de la santé.</div>
        </div>
    </footer>
</body>
</html>