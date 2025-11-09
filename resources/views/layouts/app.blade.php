<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Buena Salud')</title>
    <style>
        /* Reset et base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f8f9fa;
        }

        /* Header */
        .header {
            background-color: white;
            padding: 15px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background-color: #17a2b8;
            border-radius: 8px;
            margin-right: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .nav-menu {
            display: flex;
            list-style: none;
            gap: 30px;
        }

        .nav-menu a {
            text-decoration: none;
            color: #666;
            font-weight: 500;
            transition: color 0.3s;
        }

        .nav-menu a:hover,
        .nav-menu a.active {
            color: #17a2b8;
        }

        .nav-auth {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-auth-form {
            margin: 0;
        }

        .nav-auth-link {
            color: #17a2b8;
            text-decoration: none;
            font-weight: 600;
            background: none;
            border: none;
            cursor: pointer;
            padding: 0;
        }

        .nav-auth-link:hover {
            text-decoration: underline;
        }

        .nav-user {
            font-weight: 600;
            color: #333;
        }

        /* Hero Section avec banniere */
        .hero {
            background-image: url('/images/banierre.png');
            background-size: cover;
            background-position: center;
            height: 400px;
            display: flex;
            align-items: center;
            position: relative;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(23, 162, 184, 0.7);
        }

        .hero-content {
            position: relative;
            z-index: 1;
            color: white;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: bold;
            color: white;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 18px;
            color: white;
            margin-bottom: 30px;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background-color: #17a2b8;
            color: white;
        }

        .btn-primary:hover {
            background-color: #138496;
        }

        /* Bouton dans la hero - bleu plus foncé pour contraster avec la bannière */
        .hero .btn-primary {
            background-color: #00bfff; /* bleu ciel */
            border: 2px solid #00a6e6;
        }

        .hero .btn-primary:hover {
            background-color: #00a6e6;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }

        .btn-secondary {
            background-color: white;
            color: #17a2b8;
            border: 2px solid #17a2b8;
            margin-left: 15px;
        }

        .btn-secondary:hover {
            background-color: #17a2b8;
            color: white;
        }

        /* Main Content */
        .main-content {
            padding: 50px 0;
        }

        .section-title {
            font-size: 32px;
            font-weight: bold;
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .section-title a {
            font-size: 16px;
            color: #17a2b8;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background-color: #17a2b8;
            color: white;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .section-title a::after {
            content: '→';
            font-size: 18px;
            transition: transform 0.3s ease;
        }

        .section-title a:hover {
            background-color: #138496;
            transform: translateX(5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        }

        .section-title a:hover::after {
            transform: translateX(3px);
        }

        .section-title a:active {
            transform: translateX(3px) scale(0.98);
        }

        /* Articles Grid */
        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }

        .article-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }

        .article-card:hover {
            transform: translateY(-5px);
        }

        .article-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .article-content {
            padding: 25px;
        }

        .article-title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        .article-excerpt {
            color: #666;
            line-height: 1.5;
            margin-bottom: 15px;
        }

        /* Footer */
        .footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 30px 0;
            margin-top: 50px;
        }

        .footer-text {
            margin-bottom: 10px;
        }

        /* Contact Form */
        .contact-form {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-control:focus {
            outline: none;
            border-color: #17a2b8;
        }

        textarea.form-control {
            height: 120px;
            resize: vertical;
        }

        .page-title {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
                gap: 20px;
            }

            .nav-menu {
                flex-direction: column;
                gap: 1rem;
            }

            .nav-auth {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
                width: 100%;
            }
            
            .hero h1 {
                font-size: 32px;
            }
            
            .hero p {
                font-size: 16px;
            }
            
            .articles-grid {
                grid-template-columns: 1fr;
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
            <div class="footer-text">© 2025 Buena Salud — Tous droits réservés.</div>
            <div>Contenu à titre informatif seulement. Consultez un professionnel de la santé.</div>
        </div>
    </footer>
</body>
</html>