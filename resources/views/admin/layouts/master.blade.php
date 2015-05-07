<!DOCTYPE html>
<html lang="en">
@include("admin.includes.head")
<body>
	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#">Buang Library</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/admin') }}">Home</a></li>
					@if (!Auth::guest())
           @if(Auth::User()->isAdmin())
					 <li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Users <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="{{ route('admin.users.index') }}">All</a></li>
							<li><a href="{{ route('admin.users.create') }}">Add</a></li>
							<!-- <li><a href="{{ route('admin.books.index') }}">Logout</a></li> -->
						</ul>
					  </li>
					  @endif
            <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Books <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('admin.books.index') }}">All</a></li>
								@if(Auth::User()->isAdmin())
									<li><a href="{{ route('admin.books.create') }}">Add</a></li>
								@endif
								<!-- <li><a href="{{ route('admin.books.index') }}">Logout</a></li> -->
							</ul>
						</li>
						@if(Auth::User()->isAdmin())
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Categories <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ route('admin.categories.index') }}">All</a></li>
									<li><a href="{{ route('admin.categories.create') }}">Add</a></li>
									<!-- <li><a href="{{ route('admin.books.index') }}">Logout</a></li> -->
								</ul>
							</li>
						@endif
{{-- 						@if(Auth::User()->isAdmin()) --}}
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bookings <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ route('admin.bookings.index') }}">All</a></li>
									<li><a href="{{ route('admin.bookings.create') }}">Add</a></li>
								</ul>
							</li>
						{{-- @endif --}}
					@endif
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>
					@else
					  <li><a href="{{ url('/') }}">Website</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->fullname }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('admin.users.show',Auth::User()->id) }}">My Profile</a></li>
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
	@yield('content')

	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="/assets/admin/js/select2.min.js"></script>
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
  @yield('scripts')
</body>
</html>
