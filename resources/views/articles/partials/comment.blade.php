<div class="comment-item {{ $depth > 0 ? 'comment-reply' : '' }}" data-comment-id="{{ $comment->id }}">
	<div class="comment-header">
		<div class="comment-author-wrap">
			<span class="comment-avatar">{{ strtoupper(mb_substr($comment->author_name, 0, 1)) }}</span>
			<strong class="comment-author">{{ $comment->author_name }}</strong>
			@if($depth > 0)
				<span class="comment-badge">Réponse</span>
			@endif
		</div>
		<span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
	</div>
	<div class="comment-body">
		{{ $comment->content }}
	</div>
	<div class="comment-actions">
		@auth
			<button type="button" class="btn-reply" onclick="replyToComment({{ $comment->id }}, '{{ addslashes($comment->author_name) }}')">
				Répondre
			</button>
		@endauth
	</div>

	@if($comment->replies && $comment->replies->count() > 0)
		<div class="comment-replies">
			@foreach($comment->replies as $reply)
				@include('articles.partials.comment', ['comment' => $reply, 'article' => $article, 'depth' => $depth + 1])
			@endforeach
		</div>
	@endif
</div>
