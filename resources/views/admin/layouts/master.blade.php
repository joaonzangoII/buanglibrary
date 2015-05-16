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
							<li><a href="{{ route('admin.users.index') }}">View All</a></li>
							<li><a href="{{ route('admin.users.create') }}">Create</a></li>
							<!-- <li><a href="{{ route('admin.books.index') }}">Logout</a></li> -->
						</ul>
					  </li>
					  @endif
            <li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Books <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ route('admin.books.index') }}">View All</a></li>
								@if(Auth::User()->isAdmin())
									<li><a href="{{ route('admin.books.create') }}">Create</a></li>
								@endif
								<!-- <li><a href="{{ route('admin.books.index') }}">Logout</a></li> -->
							</ul>
						</li>
						
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Book Categories <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ route('admin.categories.index') }}">View All</a></li>
									@if(Auth::User()->isAdmin())
										<li><a href="{{ route('admin.categories.create') }}">Create</a></li>
						      @endif
									<!-- <li><a href="{{ route('admin.books.index') }}">Logout</a></li> -->
								</ul>
							</li>
{{-- 						@if(Auth::User()->isAdmin()) --}}
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Bookings <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu">
									<li><a href="{{ route('admin.bookings.index') }}">View All</a></li>
									@if(Auth::User()->isAdmin())
										<li><a href="{{ route('admin.bookings.create') }}">Create</a></li>
									@else
										<li><a class="disabled" href="{{ route('admin.bookings.any') }}">Create</a></li>
									@endif
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
					  @if(!Auth::User()->isAdmin())
					  <li><a  href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" role="button" >{{ $cart->count() }} items <span class="glyphicon glyphicon-shopping-cart"></span><b class="caret"></b></a>
						  <ul class="dropdown-menu" role="menu">
						  <table class="table table-striped">
						    <th>ID</th>
						    <th>Title</th>
						    <th>Quantity</th>
						    <th>Price</th>
						    <th>User</th>
						    @if($cart->count() > 5)
						    	@foreach($cart->items()->take(5) as $item)
							      <tr>      
								      <td>{{ $item->id }}</td>
								      <td>{{ $item->name }}</td>
								      <td>{{ $item->quantity }}</td>
								      <td>{{ $item->price }}</td>
								      <td>{{ \App\User::find($item->user_id)->fullname }}</td>
							      </tr>
						       @endforeach
                @else
                  @foreach($cart->items() as $item)
							      <tr>      
								      <td>{{ $item->id }}</td>
								      <td>{{ $item->name }}</td>
								      <td>{{ $item->quantity }}</td>
								      <td>{{ $item->price }}</td>
								      <td>{{ \App\User::find($item->user_id)->fullname }}</td>
							      </tr>
						       @endforeach
						    @endif
						      
						  </table>
				{{-- 		  
						  @foreach ($cart->items() as $item)
						  	<li><a tabindex="-1" href="#">{{ $item->name }}  - {{ $item->quantity }} </a></li>
						  @endforeach --}}
						  	<li><a class="text-center" href="{{ route("admin.bookings.cart") }}">View All</a></li>
						  </ul>
					  </li>
					  @endif
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
<div id="page-wrapper">
	<div class="container-fluid">
		<!-- <div class="row"> -->
		<div class="col-lg-12">
			@if (Session::has('flash_notice'))
				<div class="alert alert-success alert-dismissable" id="success-alert">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				{{ Session::get('flash_notice') }}
				</div>
			@endif
			@yield('content')
		</div>
	</div>
</div>

	<!-- Scripts -->
	<script src="/assets/admin/js/jquery.min.js"></script>
	<script type="text/javascript" src="/assets/admin/js/jquery-ui.js"></script>
	<script src="/assets/admin/js/bootstrap.min.js"></script>
	<script src="/assets/admin/js/select2.min.js"></script>
  <script src="/assets/admin/js/bootstrap-toggle.min.js"></script>
  <script type="text/javascript"  src="/assets/admin/js/chart.min.js"></script>
  <script src="<a href="http://www.jqueryscript.net/tags.php?/twitter/">twitter</a>-bootstrap-hover-dropdown.js"></script> 
  {!!Rapyd::scripts() !!}
  @yield('scripts')
  <script type="text/javascript">
	 window.setTimeout(function() {
	  $(".alert-success").fadeTo(500, 0).slideUp(500, function(){
	      $(this).remove();
	  });
	  }, 5000);
  </script>
{{--   <script>
	  $(document).ready(function() {
	  	$('.js-activated').dropdownHover().dropdown();
	  });
  </script> --}}

</body>
</html>
