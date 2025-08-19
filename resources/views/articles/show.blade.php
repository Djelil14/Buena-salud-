@extends('layouts.app')

@section('title', $article->title . ' - Buena Salud')

@section('content')
	<section class="main-content">
		<div class="container">
			<article class="article-card" style="overflow: visible;">
				@if($article->image_couverture)
					<div style="width:100%; height:320px; background:url('/images/{{ rawurlencode($article->image_couverture) }}') center/cover; border-radius: 10px 10px 0 0;"></div>
				@endif
				<div class="article-content">
					<h1 class="article-title" style="font-size:28px;">{{ $article->title }}</h1>
					<div style="margin: 10px 0 20px; font-size: 14px; color: #888;">
						Par {{ $article->auteur ?? 'Administrateur' }}
						@if($article->date_publication)
							• {{ $article->date_publication->format('d/m/Y') }}
						@endif
					</div>
					@if($article->image)
						<img src="/images/{{ rawurlencode($article->image) }}" alt="{{ $article->title }}" class="article-image" style="height: 320px; margin-bottom: 20px;">
					@endif
					<div class="article-excerpt" style="margin-bottom: 20px;">{{ $article->excerpt }}</div>
					<div class="article-body" style="line-height: 1.8;">
						{!! nl2br($article->content) !!}
					</div>
					<div style="margin-top:30px;">
						<a href="{{ route('articles') }}" class="btn btn-secondary">← Retour aux articles</a>
					</div>
				</div>
			</article>
		</div>
	</section>
@endsection


