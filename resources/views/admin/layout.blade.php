@extends('layouts.app')

@section('content')
	<section class="main-content">
		<div class="container">
			<div class="admin-grid">
				<aside class="admin-sidebar surface">
					<nav>
						<ul class="admin-sidebar-nav">
							<li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
							<li><a href="{{ route('admin.articles.index') }}">Articles</a></li>
							<li><a href="{{ route('admin.messages.index') }}">Messages</a></li>
						</ul>
						<form method="post" action="{{ route('admin.logout') }}" class="stack-sm">
							@csrf
							<button type="submit" class="btn btn-secondary">Se déconnecter</button>
						</form>
					</nav>
				</aside>
				<div>
					@yield('admin-content')
				</div>
			</div>
		</div>
	</section>
@endsection


