@extends('layouts.app')

@section('title', 'Buena Salud - Blog médical fiable et accessible')

@section('content')
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h1>Un blog médical fiable et accessible</h1>
                <p>Des articles rédigés avec soin pour comprendre votre santé au quotidien.</p>
                <a href="{{ route('articles') }}" class="btn btn-primary">Découvrir les articles</a>
                <a href="{{ route('contact') }}" class="btn btn-secondary">Nous contacter</a>
            </div>
        </div>
    </section>

    <!-- Section Articles récents -->
    <section class="main-content">
        <div class="container">
            <h2 class="section-title">
                Articles récents
                <a href="{{ route('articles') }}">Tous les articles</a>
            </h2>
            
            <div class="articles-grid">
                @forelse($articles as $article)
                <article class="article-card">
                    <img src="/images/{{ rawurlencode($article->image) }}" alt="{{ $article->title }}" class="article-image">
                    <div class="article-content">
                        <h3 class="article-title">{{ $article->title }}</h3>
                        <p class="article-excerpt">{{ $article->excerpt }}</p>
                        <div class="article-meta">
                            Par {{ $article->auteur }} • {{ $article->date_publication->format('d/m/Y') }}
                        </div>
                        <div class="card-actions">
                            <a href="{{ route('article.show', $article->id) }}" class="btn btn-primary">Voir plus</a>
                        </div>
                    </div>
                </article>
                @empty
                <div class="empty-state">
                    <p>Aucun article disponible pour le moment.</p>
                    <p><a href="/secretadmin2025" class="muted-link">Créer des articles</a></p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section Témoignages -->
    @if(isset($testimonials) && $testimonials->count() > 0)
    <section class="testimonials-slider-section">
        <div class="container">
            <h2 class="section-title text-center centered-title-row">Témoignages</h2>
            
            <div class="testimonials-slider-wrapper">
                <div class="testimonials-slider" id="testimonialsSlider">
                    @foreach($testimonials as $testimonial)
                    <div class="testimonial-slide">
                        <div class="testimonial-content-simple">
                            <p class="testimonial-text">"{{ $testimonial->content }}"</p>
                            <p class="testimonial-author-name">— {{ $testimonial->author_name }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="slider-controls">
                    <button class="slider-btn prev-btn" onclick="changeSlide(-1)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                    </button>
                    <div class="slider-dots" id="sliderDots"></div>
                    <button class="slider-btn next-btn" onclick="changeSlide(1)">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <path d="M9 18l6-6-6-6"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </section>
    @endif

    <style>
        .hero {
            background-image: linear-gradient(rgba(15, 23, 42, 0.45), rgba(23, 162, 184, 0.62)), url('/images/banierre.png');
            background-size: cover;
            background-position: center;
            min-height: 460px;
            display: flex;
            align-items: center;
            margin: 20px;
            border-radius: 20px;
            overflow: hidden;
        }

        .hero-content {
            color: #fff;
            max-width: 720px;
            padding: 40px 0;
        }

        .hero h1 {
            font-size: clamp(2.1rem, 5vw, 3.4rem);
            line-height: 1.15;
            margin-bottom: 16px;
            letter-spacing: -0.03em;
        }

        .hero p {
            font-size: 1.08rem;
            margin-bottom: 26px;
            opacity: 0.96;
        }

        .hero .btn-secondary {
            margin-left: 10px;
        }

        .empty-state {
            grid-column: 1/-1;
            text-align: center;
            padding: 48px 20px;
            background: #fff;
            border: 1px dashed #cddfe9;
            border-radius: 14px;
        }

        .testimonials-slider-section {
            background: #edf6fb;
            padding: 60px 0;
            margin-top: 8px;
        }

        .testimonials-slider-wrapper {
            max-width: 800px;
            margin: 0 auto;
            position: relative;
        }

        .testimonials-slider {
            display: flex;
            overflow: hidden;
            position: relative;
        }

        .testimonial-slide {
            min-width: 100%;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
            display: none;
        }

        .testimonial-slide.active {
            opacity: 1;
            display: block;
        }

        .testimonial-content-simple {
            text-align: center;
            padding: 40px 30px;
            background: white;
            border-radius: 12px;
            border: 1px solid #dceaf2;
            box-shadow: 0 16px 28px rgba(15, 23, 42, 0.08);
        }

        .testimonial-text {
            font-size: 18px;
            line-height: 1.8;
            color: #333;
            font-style: italic;
            margin-bottom: 20px;
            min-height: 80px;
        }

        .testimonial-author-name {
            font-size: 16px;
            font-weight: 600;
            color: #17a2b8;
            margin: 0;
        }

        .slider-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 20px;
            margin-top: 30px;
        }

        .slider-btn {
            background: #17a2b8;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .slider-btn:hover {
            background: #138496;
            transform: scale(1.1);
        }

        .slider-dots {
            display: flex;
            gap: 8px;
        }

        .slider-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #ccc;
            cursor: pointer;
            transition: all 0.3s;
        }

        .slider-dot.active {
            background: #17a2b8;
            width: 30px;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .testimonial-text {
                font-size: 16px;
                min-height: 60px;
            }

            .testimonial-content-simple {
                padding: 30px 20px;
            }

            .hero {
                margin: 10px;
                min-height: 360px;
            }

            .hero .btn-secondary {
                margin-left: 0;
                margin-top: 10px;
            }
        }
    </style>

    <script>
        let currentSlide = 0;
        const slides = document.querySelectorAll('.testimonial-slide');
        const totalSlides = slides.length;

        // Initialiser les dots
        function initDots() {
            const dotsContainer = document.getElementById('sliderDots');
            dotsContainer.innerHTML = '';
            for (let i = 0; i < totalSlides; i++) {
                const dot = document.createElement('div');
                dot.className = 'slider-dot' + (i === 0 ? ' active' : '');
                dot.onclick = () => goToSlide(i);
                dotsContainer.appendChild(dot);
            }
        }

        // Aller à un slide spécifique
        function goToSlide(index) {
            slides[currentSlide].classList.remove('active');
            document.querySelectorAll('.slider-dot')[currentSlide].classList.remove('active');
            
            currentSlide = index;
            if (currentSlide >= totalSlides) currentSlide = 0;
            if (currentSlide < 0) currentSlide = totalSlides - 1;
            
            slides[currentSlide].classList.add('active');
            document.querySelectorAll('.slider-dot')[currentSlide].classList.add('active');
        }

        // Changer de slide
        function changeSlide(direction) {
            goToSlide(currentSlide + direction);
        }

        // Auto-play (optionnel)
        let autoPlayInterval;
        function startAutoPlay() {
            autoPlayInterval = setInterval(() => {
                changeSlide(1);
            }, 5000); // Change toutes les 5 secondes
        }

        function stopAutoPlay() {
            clearInterval(autoPlayInterval);
        }

        // Initialiser au chargement
        document.addEventListener('DOMContentLoaded', function() {
            if (totalSlides > 0) {
                slides[0].classList.add('active');
                initDots();
                startAutoPlay();
                
                // Pause au survol
                const sliderWrapper = document.querySelector('.testimonials-slider-wrapper');
                sliderWrapper.addEventListener('mouseenter', stopAutoPlay);
                sliderWrapper.addEventListener('mouseleave', startAutoPlay);
            }
        });
    </script>

@endsection