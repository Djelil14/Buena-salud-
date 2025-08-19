@extends('layouts.app')

@section('content')
	<section class="main-content">
		<div class="container">
			<div style="display:flex; gap:24px;">
				<aside style="width:240px;">
					<nav style="background:#fff; border-radius:10px; box-shadow:0 4px 6px rgba(0,0,0,0.1); padding:16px;">
						<ul style="list-style:none; display:flex; flex-direction:column; gap:10px;">
							<li><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
							<li><a href="{{ route('admin.articles.index') }}">Articles</a></li>
							<li><a href="{{ route('admin.messages.index') }}">Messages</a></li>
						</ul>
						<form method="post" action="{{ route('admin.logout') }}" style="margin-top:12px;">
							@csrf
							<button type="submit" class="btn btn-secondary">Se déconnecter</button>
						</form>
					</nav>
				</aside>
				<div style="flex:1;">
					@yield('admin-content')
				</div>
			</div>
		</div>
	</section>
@endsection


