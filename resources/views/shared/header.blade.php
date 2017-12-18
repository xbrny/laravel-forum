<nav class="navbar navbar-light bg-light navbar-expand-md mb-4">
	<div class="container-fluid">
		<a class="navbar-brand" href="/">{{ config('app.name') }}</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#exCollapsingNavbar2">
		&#9776;
		</button>
		<div class="collapse navbar-collapse" id="exCollapsingNavbar2">
			<ul class="nav navbar-nav ml-auto">
				@auth
					<li class="nav-item">
						<form action="/logout" method="POST">
							{{ csrf_field() }}
							<button class="btn btn-sm btn-outline-danger">Logout</button>
						</form>
					</li>				
				@else
					<li class="nav-item">
						<a class="btn btn-sm btn-dark mr-2" href="{{ route('github.login', ['provider' => 'github']) }}">Github</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-sm btn-outline-primary mr-2" href="/login">Login</a>
					</li>
					<li class="nav-item">
						<a class="btn btn-sm btn-primary" href="/register">Register</a>
					</li>
				@endauth
			</ul>
		</div>
	</div>
</nav>